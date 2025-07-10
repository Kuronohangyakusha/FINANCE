<?php
namespace App\Service;

use App\Repository\TransactionRepository;
use App\Repository\CompteRepository;
use App\Entity\Transaction;
use App\Entity\TypeTransaction;
use App\Core\Validator;
use DateTime;

class TransactionService {
    private TransactionRepository $transactionRepository;
    private CompteRepository $compteRepository;
    private CompteService $compteService;
    
    public function __construct() {
        $this->transactionRepository = new TransactionRepository();
        $this->compteRepository = new CompteRepository();
        $this->compteService = new CompteService();
    }
    
    /**
     * Créer une nouvelle transaction
     */
    public function createTransaction(array $data): array {
        $rules = [
            'compte_id' => 'required',
            'montant' => 'required',
            'type_transaction' => 'required'
        ];
        
        if (!Validator::validate($data, $rules)) {
            return ['success' => false, 'errors' => Validator::getErrors()];
        }
        
        $compte = $this->compteRepository->findById((int)$data['compte_id']);
        if (!$compte) {
            return ['success' => false, 'errors' => ['compte_id' => 'Compte non trouvé']];
        }
        
        $montant = (int)$data['montant'];
        $typeTransaction = TypeTransaction::from($data['type_transaction']);
        
        // Vérifier le solde pour les retraits et paiements
        if (in_array($typeTransaction, [TypeTransaction::RETRAIT, TypeTransaction::PAIEMENT])) {
            if ($compte->getMontant() < $montant) {
                return ['success' => false, 'errors' => ['montant' => 'Solde insuffisant']];
            }
        }
        
        // Créer la transaction
        $transaction = new Transaction(
            0,
            $montant,
            new DateTime(),
            $typeTransaction,
            $compte
        );
        
        if ($this->transactionRepository->create($transaction)) {
            // Mettre à jour le solde du compte
            $this->updateCompteAfterTransaction($compte, $montant, $typeTransaction);
            return ['success' => true, 'message' => 'Transaction créée avec succès'];
        } else {
            return ['success' => false, 'errors' => ['general' => 'Erreur lors de la création de la transaction']];
        }
    }
    
    /**
     * Mettre à jour le solde du compte après une transaction
     */
    private function updateCompteAfterTransaction($compte, int $montant, TypeTransaction $type): void {
        $nouveauSolde = $compte->getMontant();
        
        switch ($type) {
            case TypeTransaction::DEPOT:
                $nouveauSolde += $montant;
                break;
            case TypeTransaction::RETRAIT:
            case TypeTransaction::PAIEMENT:
                $nouveauSolde -= $montant;
                break;
        }
        
        $this->compteService->updateSolde($compte->getIdCompte(), $nouveauSolde);
    }
    
    /**
     * Obtenir les transactions d'un compte
     */
    public function getTransactionsByCompte(int $compteId): array {
        return $this->transactionRepository->findByCompteId($compteId);
    }
    
    /**
     * Obtenir les transactions d'un utilisateur
     */
    public function getTransactionsByUser(int $userId): array {
        return $this->transactionRepository->findByUserId($userId);
    }
    
    /**
     * Obtenir une transaction par ID
     */
    public function getTransactionById(int $id): ?Transaction {
        return $this->transactionRepository->findById($id);
    }
    
    /**
     * Obtenir les transactions récentes
     */
    public function getRecentTransactions(int $limit = 10): array {
        return $this->transactionRepository->findRecent($limit);
    }
    
    /**
     * Obtenir les statistiques des transactions
     */
    public function getTransactionStats(int $userId): array {
        $transactions = $this->getTransactionsByUser($userId);
        
        $stats = [
            'total_depot' => 0,
            'total_retrait' => 0,
            'total_paiement' => 0,
            'nombre_transactions' => count($transactions)
        ];
        
        foreach ($transactions as $transaction) {
            switch ($transaction->getTypeTransaction()) {
                case TypeTransaction::DEPOT:
                    $stats['total_depot'] += $transaction->getMontantTransaction();
                    break;
                case TypeTransaction::RETRAIT:
                    $stats['total_retrait'] += $transaction->getMontantTransaction();
                    break;
                case TypeTransaction::PAIEMENT:
                    $stats['total_paiement'] += $transaction->getMontantTransaction();
                    break;
            }
        }
        
        return $stats;
    }
    
    /**
     * Annuler une transaction
     */
    public function cancelTransaction(int $transactionId): array {
        $transaction = $this->transactionRepository->findById($transactionId);
        if (!$transaction) {
            return ['success' => false, 'errors' => ['general' => 'Transaction non trouvée']];
        }
        
        // Vérifier si la transaction peut être annulée (par exemple, moins de 24h)
        $now = new DateTime();
        $diff = $now->diff($transaction->getDate());
        if ($diff->days > 0) {
            return ['success' => false, 'errors' => ['general' => 'Impossible d\'annuler une transaction de plus de 24h']];
        }
        
        // Inverser l'effet de la transaction sur le solde
        $compte = $transaction->getCompte();
        $montant = $transaction->getMontantTransaction();
        $type = $transaction->getTypeTransaction();
        
        // Inverser l'opération
        switch ($type) {
            case TypeTransaction::DEPOT:
                $this->compteService->retrait($compte->getIdCompte(), $montant);
                break;
            case TypeTransaction::RETRAIT:
            case TypeTransaction::PAIEMENT:
                $this->compteService->depot($compte->getIdCompte(), $montant);
                break;
        }
        
        // Supprimer la transaction
        if ($this->transactionRepository->delete($transactionId)) {
            return ['success' => true, 'message' => 'Transaction annulée avec succès'];
        } else {
            return ['success' => false, 'errors' => ['general' => 'Erreur lors de l\'annulation de la transaction']];
        }
    }
}