<?php
namespace App\Controller;
 
 

use App\Core\AbstractController;
use App\Core\Validator;
use App\Core\Middlewares\Auth;
use App\Service\UserService;
use App\Entity\User;
 

class SecurityController extends  AbstractController{
    private UserService $userService;
    
    public function __construct() {
        $this->userService = new UserService();
    }
    
    public function create(){
        $this->Layout='LayoutConnexion.html.php';
        $this->render('Security/register.php');
    }
    
    public function store() {
        $result = $this->userService->createUser($_POST, $_FILES);
        
        if ($result['success']) {
            $this->redirectWithSuccess('/login', $result['message']);
        } else {
            $this->redirectWithErrors('/create', $result['errors'], $_POST);
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
        $result = $this->userService->authenticate($_POST);
        
        if ($result['success']) {
            Auth::login($result['user']->toArray());
            redirect('/dashboard');
        } else {
            $this->redirectWithErrors('/login', $result['errors'], $_POST);
        }
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