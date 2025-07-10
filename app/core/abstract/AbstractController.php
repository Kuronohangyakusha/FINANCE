<?php
namespace App\Core;

use App\Core\Session;

abstract class AbstractController{
    protected $Layout = 'base.layout.php';
    
    abstract public function create();
    abstract public function index();
    abstract public function edit();
    abstract public function show();
    abstract public function delete();
    abstract public function store();
    
    public function render($view, $data = []){
        // Extraire les données pour les rendre disponibles dans la vue
        extract($data);
        
        ob_start();
        require_once __DIR__ . '/../../template/'.$view;
        $contentForLayout = ob_get_clean();  
        require_once __DIR__ . '/../../template/layout/'.$this->Layout;
    }
    
    protected function redirectWithErrors($url, $errors, $oldInputs = []) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $oldInputs;
        redirect($url);
    }
    
    protected function redirectWithSuccess($url, $message) {
        setFlashMessage('success', $message);
        redirect($url);
    }

}