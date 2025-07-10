<?php
namespace App\Repository;

use App\Entity\User;
use App\Core\abstract\AbstractRepository;

class UserRepository extends AbstractRepository {
    
    public function findByPhone(string $phone): ?User {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE numero_tel = ?");
        $stmt->execute([$phone]);
        $data = $stmt->fetch();
        
        if ($data) {
            return User::fromArray($data);
        }
        
        return null;
    }
    
    public function create($user): bool {
        $sql = "INSERT INTO users (nom, prenom, adresse, numero_tel, numero_cni, password, photo_recto, photo_verso, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $user->getNom(),
            $user->getPrenom(),
            $user->getAdresse(),
            $user->getNumeroTel(),
            $user->getNumeroCni(),
            $user->getPassword(),
            $user->getPhotoRecto(),
            $user->getPhotoVerso()
        ]);
    }
    
    public function findById(int $id): ?User {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        
        if ($data) {
            return User::fromArray($data);
        }
        
        return null;
    }
    
    public function update($user): bool {
        $sql = "UPDATE users SET nom = ?, prenom = ?, adresse = ?, numero_tel = ?, numero_cni = ?, photo_recto = ?, photo_verso = ? WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $user->getNom(),
            $user->getPrenom(),
            $user->getAdresse(),
            $user->getNumeroTel(),
            $user->getNumeroCni(),
            $user->getPhotoRecto(),
            $user->getPhotoVerso(),
            $user->getId()
        ]);
    }
    
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM users ORDER BY created_at DESC");
        $users = [];
        
        while ($data = $stmt->fetch()) {
            $users[] = User::fromArray($data);
        }
        
        return $users;
    }
    
    public function phoneExists(string $phone): bool {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE numero_tel = ?");
        $stmt->execute([$phone]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function cniExists(string $cni): bool {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE numero_cni = ?");
        $stmt->execute([$cni]);
        return $stmt->fetchColumn() > 0;
    }
}