<?php
namespace App\Controller;

use App\Core\AbstractController;
use App\Core\Middlewares\Auth;
use App\Service\CompteService;

class CompteController extends AbstractController {
    private CompteService $compteService;
    
    public function __construct() {
        $this->compteService = new CompteService();
    }
    
    public function index() {
        // Vérifier l'authentification
        if (!Auth::check()) {
            redirect('/login');
            return;
        }
        
        $user = Auth::user();
        $comptes = $this->compteService->getUserComptes($user['id']);
        $this->render('compte/list.php', ['user' => $user, 'comptes' => $comptes]);
    }
    
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
        // Vérifier l'authentification
        if (!Auth::check()) {
            redirect('/login');
            return;
        }
        
        $user = Auth::user();
        
        $result = $this->compteService->createCompte($_POST, $user['id']);
        
        if ($result['success']) {
            $this->redirectWithSuccess('/dashboard', $result['message']);
        } else {
            $this->redirectWithErrors('/compte/create', $result['errors'], $_POST);
        }
    }
}