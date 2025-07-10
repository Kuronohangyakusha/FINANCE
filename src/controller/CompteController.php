<?php
namespace App\Controller;

use App\Core\AbstractController;
use App\Core\Middlewares\Auth;

class CompteController extends AbstractController {
    
    public function index() {}
    public function edit() {}
    public function show() {}
    public function delete() {}
    
    public function create() {
        // Vérifier l'authentification
        if (!Auth::check()) {
            redirect('/login');
            return;
        }
        
        // Page de création de compte (dashboard)
        $user = Auth::user();
        $this->render('commande/compte.php', ['user' => $user]);
    }

    public function store() {
        echo 'hello';
    }
}