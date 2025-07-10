<?php
namespace App\Service;

class ImageUploadService {
    private string $uploadPath;
    private int $maxFileSize;
    private array $allowedTypes;
    
    public function __construct() {
        $this->uploadPath = $_ENV['UPLOAD_PATH'] ?? __DIR__ . '/../../public/images/';
        $this->maxFileSize = $_ENV['MAX_FILE_SIZE'] ?? 2097152; // 2MB
        $this->allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        
        // Créer le dossier s'il n'existe pas
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }
    
    public function upload($file, $prefix = 'img') {
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
    
    private function validateFile($file) {
        // Vérifier si le fichier a été uploadé
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
        
        // Vérifier que c'est vraiment une image
        $imageInfo = getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            return false;
        }
        
        return true;
    }
    
    private function generateFileName($file, $prefix) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        return $prefix . '_' . uniqid() . '_' . time() . '.' . $extension;
    }
    
    public function delete($fileName) {
        $filePath = $this->uploadPath . $fileName;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }
    
    public function getUploadPath() {
        return $this->uploadPath;
    }
    
    public function getErrors() {
        return [
            UPLOAD_ERR_INI_SIZE => 'Le fichier dépasse la taille maximale autorisée',
            UPLOAD_ERR_FORM_SIZE => 'Le fichier dépasse la taille maximale du formulaire',
            UPLOAD_ERR_PARTIAL => 'Le fichier n\'a été que partiellement téléchargé',
            UPLOAD_ERR_NO_FILE => 'Aucun fichier n\'a été téléchargé',
            UPLOAD_ERR_NO_TMP_DIR => 'Dossier temporaire manquant',
            UPLOAD_ERR_CANT_WRITE => 'Échec de l\'écriture du fichier sur le disque',
            UPLOAD_ERR_EXTENSION => 'Une extension PHP a arrêté le téléchargement'
        ];
    }
}