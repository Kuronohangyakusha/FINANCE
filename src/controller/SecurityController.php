<?php
namespace App\Controller;
 
 

use App\Core\AbstractController;
use App\Core\Validator;
use App\Core\Middlewares\Auth;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Service\ImageUploadService;
 

class SecurityController extends  AbstractController{
    private UserRepository $userRepository;
    private ImageUploadService $imageUploadService;
    
    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->imageUploadService = new ImageUploadService();
    }
    
    public function create(){
        $this->Layout='LayoutConnexion.html.php';
        $this->render('Security/register.php');
    }
    
    public function store() {
        $data = $_POST;
        
        // Validation
        $rules = [
            'nom' => 'required|min:2|max:50',
            'prenom' => 'required|min:2|max:50',
            'adresse' => 'required|min:5|max:255',
            'numero_tel' => 'required|phone',
            'numero_cni' => 'required|cni',
            'password' => 'required|min:6'
        ];
        
        if (!Validator::validate($data, $rules)) {
            $this->redirectWithErrors('/create', Validator::getErrors(), $data);
            return;
        }
        
        // Vérifier l'unicité du téléphone et CNI
        if ($this->userRepository->phoneExists($data['numero_tel'])) {
            $this->redirectWithErrors('/create', ['numero_tel' => 'Ce numéro de téléphone est déjà utilisé'], $data);
            return;
        }
        
        if ($this->userRepository->cniExists($data['numero_cni'])) {
            $this->redirectWithErrors('/create', ['numero_cni' => 'Ce numéro CNI est déjà utilisé'], $data);
            return;
        }
        
        // Upload des photos
        $photoRecto = null;
        $photoVerso = null;
        
        if (isset($_FILES['photo_recto']) && $_FILES['photo_recto']['error'] === UPLOAD_ERR_OK) {
            $photoRecto = $this->imageUploadService->upload($_FILES['photo_recto'], 'recto');
            if (!$photoRecto) {
                $this->redirectWithErrors('/create', ['photo_recto' => 'Erreur lors de l\'upload de la photo recto'], $data);
                return;
            }
        }
        
        if (isset($_FILES['photo_verso']) && $_FILES['photo_verso']['error'] === UPLOAD_ERR_OK) {
            $photoVerso = $this->imageUploadService->upload($_FILES['photo_verso'], 'verso');
            if (!$photoVerso) {
                $this->redirectWithErrors('/create', ['photo_verso' => 'Erreur lors de l\'upload de la photo verso'], $data);
                return;
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
            $this->redirectWithSuccess('/login', 'Compte créé avec succès. Vous pouvez maintenant vous connecter.');
        } else {
            $this->redirectWithErrors('/create', ['general' => 'Erreur lors de la création du compte'], $data);
        }
    }
    
    public function login() {
        if (Auth::check()) {
            redirect('/dashboard');
            return;
        }
        
        $this->Layout = 'LayoutConnexion.html.php';
        $this->render('Security/login.php');
    }
    
    public function authenticate() {
        $data = $_POST;
        
        $rules = [
            'numero_tel' => 'required|phone',
            'password' => 'required'
        ];
        
        if (!Validator::validate($data, $rules)) {
            $this->redirectWithErrors('/login', Validator::getErrors(), $data);
            return;
        }
        
        $user = $this->userRepository->findByPhone($data['numero_tel']);
        
        if (!$user || !$user->verifyPassword($data['password'])) {
            $this->redirectWithErrors('/login', ['general' => 'Numéro de téléphone ou mot de passe incorrect'], $data);
            return;
        }
        
        Auth::login($user->toArray());
        redirect('/dashboard');
    }
    
    public function logout() {
        Auth::logout();
        redirect('/login');
    }
    
    // Méthodes abstraites requises
    public function index() {}
    public function edit() {}
    public function show() {}
    public function delete() {}
  

}