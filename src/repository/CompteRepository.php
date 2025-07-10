<?php
namespace App\Repository;

use App\Entity\Compte;
use App\Entity\Client;
use App\Entity\TypeCompte;
use App\Core\AbstractRepository;

class CompteRepository extends AbstractRepository {
    
    public function findByUserId(int $userId): array {
        $stmt = $this->pdo->prepare("
            SELECT c.*, u.nom, u.prenom, u.adresse 
            FROM comptes c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.user_id = ?
        ");
        $stmt->execute([$userId]);
        $comptes = [];
        
        while ($data = $stmt->fetch()) {
            $client = new Client(
                $data['user_id'],
                $data['nom'],
                $data['prenom'],
                $data['adresse'],
                $data['numero_tel']
            );
            
            $compte = new Compte(
                $data['id'],
                $data['numero_tel'],
                $data['photo_recto'],
                $data['photo_verso'],
                $data['password'],
                $data['numero_cni'],
                $data['solde'],
                TypeCompte::from($data['type_compte']),
                $client
            );
            
            $comptes[] = $compte;
        }
        
        return $comptes;
    }
    
    public function create($compte): bool {
        $sql = "INSERT INTO comptes (user_id, numero_tel, photo_recto, photo_verso, numero_cni, solde, type_compte, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $compte->getClient()->getId(),
            $compte->getNumeroTel(),
            $compte->getPhotoRecto(),
            $compte->getPhotoVerso(),
            $compte->getNumeroCNI(),
            $compte->getMontant(),
            $compte->getType()->value
        ]);
    }
    
    public function findById(int $id): ?Compte {
        $stmt = $this->pdo->prepare("
            SELECT c.*, u.nom, u.prenom, u.adresse 
            FROM comptes c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.id = ?
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
            
            return new Compte(
                $data['id'],
                $data['numero_tel'],
                $data['photo_recto'],
                $data['photo_verso'],
                $data['password'],
                $data['numero_cni'],
                $data['solde'],
                TypeCompte::from($data['type_compte']),
                $client
            );
        }
        
        return null;
    }
    
    public function update($compte): bool {
        $sql = "UPDATE comptes SET numero_tel = ?, photo_recto = ?, photo_verso = ?, numero_cni = ?, solde = ?, type_compte = ? WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $compte->getNumeroTel(),
            $compte->getPhotoRecto(),
            $compte->getPhotoVerso(),
            $compte->getNumeroCNI(),
            $compte->getMontant(),
            $compte->getType()->value,
            $compte->getIdCompte()
        ]);
    }
    
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM comptes WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function findAll(): array {
        $stmt = $this->pdo->query("
            SELECT c.*, u.nom, u.prenom, u.adresse 
            FROM comptes c 
            JOIN users u ON c.user_id = u.id 
            ORDER BY c.created_at DESC
        ");
        $comptes = [];
        
        while ($data = $stmt->fetch()) {
            $client = new Client(
                $data['user_id'],
                $data['nom'],
                $data['prenom'],
                $data['adresse'],
                $data['numero_tel']
            );
            
            $compte = new Compte(
                $data['id'],
                $data['numero_tel'],
                $data['photo_recto'],
                $data['photo_verso'],
                $data['password'],
                $data['numero_cni'],
                $data['solde'],
                TypeCompte::from($data['type_compte']),
                $client
            );
            
            $comptes[] = $compte;
        }
        
        return $comptes;
    }
}