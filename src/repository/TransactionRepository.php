<?php
namespace App\Repository;

use App\Entity\Transaction;
use App\Entity\Compte;
use App\Entity\Client;
use App\Entity\TypeTransaction;
use App\Entity\TypeCompte;
use App\Core\AbstractRepository;
use DateTime;

class TransactionRepository extends AbstractRepository {
    
    public function findByCompteId(int $compteId): array {
        $stmt = $this->pdo->prepare("
            SELECT t.*, c.numero_tel, c.photo_recto, c.photo_verso, c.numero_cni, c.solde, c.type_compte,
                   u.nom, u.prenom, u.adresse
            FROM transactions t 
            JOIN comptes c ON t.compte_id = c.id 
            JOIN users u ON c.user_id = u.id 
            WHERE t.compte_id = ? 
            ORDER BY t.date_transaction DESC
        ");
        $stmt->execute([$compteId]);
        
        return $this->buildTransactionsFromResults($stmt);
    }
    
    public function findByUserId(int $userId): array {
        $stmt = $this->pdo->prepare("
            SELECT t.*, c.numero_tel, c.photo_recto, c.photo_verso, c.numero_cni, c.solde, c.type_compte,
                   u.nom, u.prenom, u.adresse
            FROM transactions t 
            JOIN comptes c ON t.compte_id = c.id 
            JOIN users u ON c.user_id = u.id 
            WHERE u.id = ? 
            ORDER BY t.date_transaction DESC
        ");
        $stmt->execute([$userId]);
        
        return $this->buildTransactionsFromResults($stmt);
    }
    
    public function findRecent(int $limit = 10): array {
        $stmt = $this->pdo->prepare("
            SELECT t.*, c.numero_tel, c.photo_recto, c.photo_verso, c.numero_cni, c.solde, c.type_compte,
                   u.nom, u.prenom, u.adresse
            FROM transactions t 
            JOIN comptes c ON t.compte_id = c.id 
            JOIN users u ON c.user_id = u.id 
            ORDER BY t.date_transaction DESC 
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        
        return $this->buildTransactionsFromResults($stmt);
    }
    
    private function buildTransactionsFromResults($stmt): array {
        $transactions = [];
        
        while ($data = $stmt->fetch()) {
            $client = new Client(
                $data['user_id'],
                $data['nom'],
                $data['prenom'],
                $data['adresse'],
                $data['numero_tel']
            );
            
            $compte = new Compte(
                $data['compte_id'],
                $data['numero_tel'],
                $data['photo_recto'],
                $data['photo_verso'],
                '', // password non nécessaire ici
                $data['numero_cni'],
                $data['solde'],
                TypeCompte::from($data['type_compte']),
                $client
            );
            
            $transaction = new Transaction(
                $data['id'],
                $data['montant'],
                new DateTime($data['date_transaction']),
                TypeTransaction::from($data['type_transaction']),
                $compte
            );
            
            $transactions[] = $transaction;
        }
        
        return $transactions;
    }
    
    public function create($transaction): bool {
        $sql = "INSERT INTO transactions (compte_id, montant, date_transaction, type_transaction) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $transaction->getCompte()->getIdCompte(),
            $transaction->getMontantTransaction(),
            $transaction->getDate()->format('Y-m-d H:i:s'),
            $transaction->getTypeTransaction()->value
        ]);
    }
    
    public function findById(int $id): ?Transaction {
        $stmt = $this->pdo->prepare("
            SELECT t.*, c.numero_tel, c.photo_recto, c.photo_verso, c.numero_cni, c.solde, c.type_compte,
                   u.nom, u.prenom, u.adresse, u.id as user_id
            FROM transactions t 
            JOIN comptes c ON t.compte_id = c.id 
            JOIN users u ON c.user_id = u.id 
            WHERE t.id = ?
        ");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        
        if ($data) {
            $client = new Client(
                $data['user_id'],
                $data['nom'],
                $data['prenom'],
                $data['adresse'],
                $data['numero_tel']
            );
            
            $compte = new Compte(
                $data['compte_id'],
                $data['numero_tel'],
                $data['photo_recto'],
                $data['photo_verso'],
                '',
                $data['numero_cni'],
                $data['solde'],
                TypeCompte::from($data['type_compte']),
                $client
            );
            
            return new Transaction(
                $data['id'],
                $data['montant'],
                new DateTime($data['date_transaction']),
                TypeTransaction::from($data['type_transaction']),
                $compte
            );
        }
        
        return null;
    }
    
    public function update($transaction): bool {
        $sql = "UPDATE transactions SET montant = ?, type_transaction = ? WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $transaction->getMontantTransaction(),
            $transaction->getTypeTransaction()->value,
            $transaction->getId_transaction()
        ]);
    }
    
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM transactions WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function findAll(): array {
        $stmt = $this->pdo->query("
            SELECT t.*, c.numero_tel, c.photo_recto, c.photo_verso, c.numero_cni, c.solde, c.type_compte,
                   u.nom, u.prenom, u.adresse, u.id as user_id
            FROM transactions t 
            JOIN comptes c ON t.compte_id = c.id 
            JOIN users u ON c.user_id = u.id 
            ORDER BY t.date_transaction DESC
        ");
        
        return $this->buildTransactionsFromResults($stmt);
    }
}