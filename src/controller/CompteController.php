<?php
namespace App\Controller;

use App\Core\AbstractController;
use App\Core\Middlewares\Auth;
class CompteController extends  AbstractController{
    
    public function index(){}
    public function edit(){}
    public function show(){}
    public function delete(){}
    
     
  
    public function create() {
        
         
    }

    public function store(){
        echo 'hello';
    public function __construct() {
        // Vérifier l'authentification pour toutes les méthodes
        if (!Auth::check()) {
    }
        // Page de création de compte (dashboard)
        $user = Auth::user();
        $user = Auth::user();
        $this->render('commande/compte.php', ['user' => $user]);
 
}