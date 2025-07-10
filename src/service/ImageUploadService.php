<?php
namespace App\Service;

class ImageUploadService {
    private string $uploadPath;
    private int $maxFileSize;
    private array $allowedTypes;
    private array $allowedExtensions;
    
    public function __construct() {
        $this->uploadPath = $_ENV['UPLOAD_PATH'] ?? __DIR__ . '/../../public/uploads/images/';
        $this->maxFileSize = $_ENV['MAX_FILE_SIZE'] ?? 2097152; // 2MB
        $this->allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $this->allowedExtensions = ['jpg', 'jpeg', 'png'];
        
        // Créer le dossier s'il n'existe pas
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }
    
    /**
     * Upload une image
     * @param array $file Le fichier $_FILES
     * @param string $prefix Préfixe pour le nom du fichier
     * @return string|false Le nom du fichier uploadé ou false en cas d'erreur
     */
    public function upload(array $file, string $prefix = 'img'): string|false {
        if (!$this->validateFile($file)) {
            return false;
        }
        
        $fileName = $this->generateFileName($file, $prefix);
        $filePath = $this->uploadPath . $fileName;
        
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return $fileName;
        }
        
        return false;
    }
    
    /**
     * Valide un fichier image
     * @param array $file Le fichier à valider
     * @return bool
     */
    private function validateFile(array $file): bool {
        // Vérifier si le fichier a été uploadé sans erreur
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        
        // Vérifier la taille
        if ($file['size'] > $this->maxFileSize) {
            return false;
        }
        
        // Vérifier le type MIME
        if (!in_array($file['type'], $this->allowedTypes)) {
            return false;
        }
        
        // Vérifier l'extension
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowedExtensions)) {
            return false;
        }
        
        // Vérifier que c'est vraiment une image
        $imageInfo = getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Génère un nom de fichier unique
     * @param array $file Le fichier
     * @param string $prefix Le préfixe
     * @return string
     */
    private function generateFileName(array $file, string $prefix): string {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        return $prefix . '_' . uniqid() . '_' . time() . '.' . $extension;
    }
    
    /**
     * Supprime un fichier
     * @param string $fileName Le nom du fichier à supprimer
     * @return bool
     */
    public function delete(string $fileName): bool {
        $filePath = $this->uploadPath . $fileName;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }
    
    /**
     * Retourne le chemin d'upload
     * @return string
     */
    public function getUploadPath(): string {
        return $this->uploadPath;
    }
    
    /**
     * Retourne l'URL publique d'une image
     * @param string $fileName Le nom du fichier
     * @return string
     */
    public function getImageUrl(string $fileName): string {
        return '/uploads/images/' . $fileName;
    }
    
    /**
     * Vérifie si un fichier existe
     * @param string $fileName Le nom du fichier
     * @return bool
     */
    public function fileExists(string $fileName): bool {
        return file_exists($this->uploadPath . $fileName);
    }
    
    /**
     * Retourne les erreurs d'upload possibles
     * @return array
     */
    public function getUploadErrors(): array {
        return [
            UPLOAD_ERR_INI_SIZE => 'Le fichier dépasse la taille maximale autorisée par le serveur',
            UPLOAD_ERR_FORM_SIZE => 'Le fichier dépasse la taille maximale du formulaire',
            UPLOAD_ERR_PARTIAL => 'Le fichier n\'a été que partiellement téléchargé',
            UPLOAD_ERR_NO_FILE => 'Aucun fichier n\'a été téléchargé',
            UPLOAD_ERR_NO_TMP_DIR => 'Dossier temporaire manquant',
            UPLOAD_ERR_CANT_WRITE => 'Échec de l\'écriture du fichier sur le disque',
            UPLOAD_ERR_EXTENSION => 'Une extension PHP a arrêté le téléchargement'
        ];
    }
    
    /**
     * Retourne le message d'erreur pour un code d'erreur donné
     * @param int $errorCode Le code d'erreur
     * @return string
     */
    public function getErrorMessage(int $errorCode): string {
        $errors = $this->getUploadErrors();
        return $errors[$errorCode] ?? 'Erreur inconnue';
    }
}