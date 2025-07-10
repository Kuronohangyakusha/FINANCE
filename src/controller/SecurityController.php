<?php
namespace Ciara3\Sprint3;
 
 

use Ciara2\Sprint2\AbstractController;
 

class SecurityController extends  AbstractController{
    public function store(){}
     public function index(){
      
     }
     public function edit(){}
     public function show(){}
     public function delete(){}
     public function create(){
        $this->Layout='LayoutConnexion.html.php';
        $this->render('Security/connexion.html');
     }
  

}