<?php
namespace App\Service;

use App\Repository\CompteRepository;
use App\Repository\UserRepository;
use App\Entity\Compte;
use App\Entity\Client;
use App\Entity\TypeCompte;
use App\Core\Validator;

class CompteService {
    private CompteRepository $compteRepository;
    private UserRepository $userRepository;
    
    public function __construct() {
        $this->compteRepository = new CompteRepository();
        $this->userRepository = new UserRepository();
    }
    
    /**
     * Créer un nouveau compte
     */
    public function createCompte(array $data, int $userId): array {
        // Validation des données
        $rules = [
            'type_compte' => 'required',
            'montant_initial' => 'required'
        ];
        
        if (!Validator::validate($data, $rules)) {
            return ['success' => false, 'errors' => Validator::getErrors()];
        }
        
        // Récupérer l'utilisateur
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            return ['success' => false, 'errors' => ['general' => 'Utilisateur non trouvé']];
        }
        
        // Vérifier si l'utilisateur a déjà un compte principal
        if ($data['type_compte'] === 'principal') {
            $existingComptes = $this->compteRepository->findByUserId($userId);
            foreach ($existingComptes as $compte) {
                if ($compte->getType() === TypeCompte::PRINCIPAL) {
                    return ['success' => false, 'errors' => ['type_compte' => 'Vous avez déjà un compte principal']];
                }
            }
        }
        
        // Créer le client
        $client = new Client(
            $user->getId(),
            $user->getNom(),
            $user->getPrenom(),
            $user->getAdresse(),
            $user->getNumeroTel()
        );
        
        // Créer le compte
        $compte = new Compte(
            0,
            $user->getNumeroTel(),
            $user->getPhotoRecto() ?? '',
            $user->getPhotoVerso() ?? '',
            '', // password sera géré séparément
            $user->getNumeroCni(),
            (int)$data['montant_initial'],
            TypeCompte::from($data['type_compte']),
            $client
        );
        
        if ($this->compteRepository->create($compte)) {
            return ['success' => true, 'message' => 'Compte créé avec succès'];
        } else {
            return ['success' => false, 'errors' => ['general' => 'Erreur lors de la création du compte']];
        }
    }
    
    /**
     * Obtenir tous les comptes d'un utilisateur
     */
    public function getUserComptes(int $userId): array {
        return $this->compteRepository->findByUserId($userId);
    }
    
    /**
     * Obtenir un compte par ID
     */
    public function getCompteById(int $id): ?Compte {
        return $this->compteRepository->findById($id);
    }
    
    /**
     * Mettre à jour le solde d'un compte
     */
    public function updateSolde(int $compteId, int $nouveauSolde): array {
        $compte = $this->compteRepository->findById($compteId);
        if (!$compte) {
            return ['success' => false, 'errors' => ['general' => 'Compte non trouvé']];
        }
        
        $compte->setMontant($nouveauSolde);
        
        if ($this->compteRepository->update($compte)) {
            return ['success' => true, 'message' => 'Solde mis à jour avec succès'];
        } else {
            return ['success' => false, 'errors' => ['general' => 'Erreur lors de la mise à jour du solde']];
        }
    }
    
    /**
     * Effectuer un dépôt
     */
    public function depot(int $compteId, int $montant): array {
        if ($montant <= 0) {
            return ['success' => false, 'errors' => ['montant' => 'Le montant doit être positif']];
        }
        
        $compte = $this->compteRepository->findById($compteId);
        if (!$compte) {
            return ['success' => false, 'errors' => ['general' => 'Compte non trouvé']];
        }
        
        $nouveauSolde = $compte->getMontant() + $montant;
        return $this->updateSolde($compteId, $nouveauSolde);
    }
    
    /**
     * Effectuer un retrait
     */
    public function retrait(int $compteId, int $montant): array {
        if ($montant <= 0) {
            return ['success' => false, 'errors' => ['montant' => 'Le montant doit être positif']];
        }
        
        $compte = $this->compteRepository->findById($compteId);
        if (!$compte) {
            return ['success' => false, 'errors' => ['general' => 'Compte non trouvé']];
        }
        
        if ($compte->getMontant() < $montant) {
            return ['success' => false, 'errors' => ['montant' => 'Solde insuffisant']];
        }
        
        $nouveauSolde = $compte->getMontant() - $montant;
        return $this->updateSolde($compteId, $nouveauSolde);
    }
    
    /**
     * Effectuer un transfert entre comptes
     */
    public function transfert(int $compteSourceId, int $compteDestinationId, int $montant): array {
        if ($montant <= 0) {
            return ['success' => false, 'errors' => ['montant' => 'Le montant doit être positif']];
        }
        
        if ($compteSourceId === $compteDestinationId) {
            return ['success' => false, 'errors' => ['general' => 'Impossible de transférer vers le même compte']];
        }
        
        $compteSource = $this->compteRepository->findById($compteSourceId);
        $compteDestination = $this->compteRepository->findById($compteDestinationId);
        
        if (!$compteSource || !$compteDestination) {
            return ['success' => false, 'errors' => ['general' => 'Un des comptes n\'existe pas']];
        }
        
        if ($compteSource->getMontant() < $montant) {
            return ['success' => false, 'errors' => ['montant' => 'Solde insuffisant sur le compte source']];
        }
        
        // Effectuer le transfert
        $retraitResult = $this->retrait($compteSourceId, $montant);
        if (!$retraitResult['success']) {
            return $retraitResult;
        }
        
        $depotResult = $this->depot($compteDestinationId, $montant);
        if (!$depotResult['success']) {
            // Annuler le retrait en cas d'erreur
            $this->depot($compteSourceId, $montant);
            return $depotResult;
        }
        
        return ['success' => true, 'message' => 'Transfert effectué avec succès'];
    }
    
    /**
     * Obtenir le solde total d'un utilisateur
     */
    public function getSoldeTotal(int $userId): int {
        $comptes = $this->getUserComptes($userId);
        $soldeTotal = 0;
        
        foreach ($comptes as $compte) {
            $soldeTotal += $compte->getMontant();
        }
        
        return $soldeTotal;
    }
    
    /**
     * Supprimer un compte
     */
    public function deleteCompte(int $compteId): array {
        $compte = $this->compteRepository->findById($compteId);
        if (!$compte) {
            return ['success' => false, 'errors' => ['general' => 'Compte non trouvé']];
        }
        
        if ($compte->getMontant() > 0) {
            return ['success' => false, 'errors' => ['general' => 'Impossible de supprimer un compte avec un solde positif']];
        }
        
        if ($this->compteRepository->delete($compteId)) {
            return ['success' => true, 'message' => 'Compte supprimé avec succès'];
        } else {
            return ['success' => false, 'errors' => ['general' => 'Erreur lors de la suppression du compte']];
        }
    }
}