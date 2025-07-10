<?php
namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Core\abstract\Validator;

class UserService {
    private UserRepository $userRepository;
    private ImageUploadService $imageUploadService;
    
    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->imageUploadService = new ImageUploadService();
    }
    
    /**
     * Créer un nouvel utilisateur
     */
    public function createUser(array $data, array $files = []): array {
        // Validation des données
        $rules = [
            'nom' => 'required|min:2|max:50',
            'prenom' => 'required|min:2|max:50',
            'adresse' => 'required|min:5|max:255',
            'numero_tel' => 'required|phone',
            'numero_cni' => 'required|cni',
            'password' => 'required|min:6'
        ];
        
        if (!Validator::validate($data, $rules)) {
            return ['success' => false, 'errors' => Validator::getErrors()];
        }
        
        // Vérifier l'unicité du téléphone et CNI
        if ($this->userRepository->phoneExists($data['numero_tel'])) {
            return ['success' => false, 'errors' => ['numero_tel' => 'Ce numéro de téléphone est déjà utilisé']];
        }
        
        if ($this->userRepository->cniExists($data['numero_cni'])) {
            return ['success' => false, 'errors' => ['numero_cni' => 'Ce numéro CNI est déjà utilisé']];
        }
        
        // Upload des photos
        $photoRecto = null;
        $photoVerso = null;
        
        if (isset($files['photo_recto']) && $files['photo_recto']['error'] === UPLOAD_ERR_OK) {
            $photoRecto = $this->imageUploadService->upload($files['photo_recto'], 'recto');
            if (!$photoRecto) {
                return ['success' => false, 'errors' => ['photo_recto' => 'Erreur lors de l\'upload de la photo recto']];
            }
        }
        
        if (isset($files['photo_verso']) && $files['photo_verso']['error'] === UPLOAD_ERR_OK) {
            $photoVerso = $this->imageUploadService->upload($files['photo_verso'], 'verso');
            if (!$photoVerso) {
                return ['success' => false, 'errors' => ['photo_verso' => 'Erreur lors de l\'upload de la photo verso']];
            }
        }
        
        // Créer l'utilisateur
        $user = new User(
            0,
            $data['nom'],
            $data['prenom'],
            $data['adresse'],
            $data['numero_tel'],
            $data['numero_cni'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $photoRecto,
            $photoVerso
        );
        
        if ($this->userRepository->create($user)) {
            return ['success' => true, 'message' => 'Compte créé avec succès'];
        } else {
            return ['success' => false, 'errors' => ['general' => 'Erreur lors de la création du compte']];
        }
    }
    
    /**
     * Authentifier un utilisateur
     */
    public function authenticate(array $credentials): array {
        $rules = [
            'numero_tel' => 'required|phone',
            'password' => 'required'
        ];
        
        if (!Validator::validate($credentials, $rules)) {
            return ['success' => false, 'errors' => Validator::getErrors()];
        }
        
        $user = $this->userRepository->findByPhone($credentials['numero_tel']);
        
        if (!$user || !$user->verifyPassword($credentials['password'])) {
            return ['success' => false, 'errors' => ['general' => 'Numéro de téléphone ou mot de passe incorrect']];
        }
        
        return ['success' => true, 'user' => $user];
    }
    
    /**
     * Obtenir un utilisateur par ID
     */
    public function getUserById(int $id): ?User {
        return $this->userRepository->findById($id);
    }
    
    /**
     * Obtenir un utilisateur par téléphone
     */
    public function getUserByPhone(string $phone): ?User {
        return $this->userRepository->findByPhone($phone);
    }
    
    /**
     * Mettre à jour un utilisateur
     */
    public function updateUser(User $user, array $data): array {
        $rules = [
            'nom' => 'required|min:2|max:50',
            'prenom' => 'required|min:2|max:50',
            'adresse' => 'required|min:5|max:255',
            'numero_tel' => 'required|phone',
            'numero_cni' => 'required|cni'
        ];
        
        if (!Validator::validate($data, $rules)) {
            return ['success' => false, 'errors' => Validator::getErrors()];
        }
        
        // Vérifier l'unicité si les données ont changé
        if ($data['numero_tel'] !== $user->getNumeroTel() && $this->userRepository->phoneExists($data['numero_tel'])) {
            return ['success' => false, 'errors' => ['numero_tel' => 'Ce numéro de téléphone est déjà utilisé']];
        }
        
        if ($data['numero_cni'] !== $user->getNumeroCni() && $this->userRepository->cniExists($data['numero_cni'])) {
            return ['success' => false, 'errors' => ['numero_cni' => 'Ce numéro CNI est déjà utilisé']];
        }
        
        // Mettre à jour les données
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        $user->setAdresse($data['adresse']);
        $user->setNumeroTel($data['numero_tel']);
        $user->setNumeroCni($data['numero_cni']);
        
        if ($this->userRepository->update($user)) {
            return ['success' => true, 'message' => 'Utilisateur mis à jour avec succès'];
        } else {
            return ['success' => false, 'errors' => ['general' => 'Erreur lors de la mise à jour']];
        }
    }
}