<?php
namespace App\Controller;

use App\Core\AbstractController;
use App\Core\Middlewares\Auth;
use App\Core\Validator;
use App\Repository\CompteRepository;
use App\Entity\Compte;

class CompteController extends AbstractController {
    private CompteRepository $compteRepository;
    
    public function __construct() {
        $this->compteRepository = new CompteRepository();
    }
    
    public function index() {
        // Vérifier l'authentification
        if (!Auth::check()) {
            redirect('/login');
            return;
        }
        
        $user = Auth::user();
        $comptes = $this->compteRepository->findByUserId($user['id']);
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
        
        $data = $_POST;
        $user = Auth::user();
        
        // Validation des données
        $rules = [
            'type_compte' => 'required',
            'montant_initial' => 'required'
        ];
        
        if (!Validator::validate($data, $rules)) {
            $this->redirectWithErrors('/compte/create', Validator::getErrors(), $data);
            return;
        }
        
        // Créer le compte
        $compte = new Compte(
            0,
            $user['numero_tel'],
            $user['photo_recto'] ?? '',
            $user['photo_verso'] ?? '',
            '', // password sera géré séparément
            $user['numero_cni'],
            (int)$data['montant_initial'],
            \App\Entity\TypeCompte::from($data['type_compte']),
            new \App\Entity\Client($user['id'], $user['nom'], $user['prenom'], $user['adresse'], $user['numero_tel'])
        );
        
        if ($this->compteRepository->create($compte)) {
            $this->redirectWithSuccess('/dashboard', 'Compte créé avec succès.');
        } else {
            $this->redirectWithErrors('/compte/create', ['general' => 'Erreur lors de la création du compte'], $data);
        }
    }
}