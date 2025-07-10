<?php
namespace Ciara3\Sprint3;

use Ciara2\Sprint2\AbstractController;
class CompteController extends  AbstractController{
    
    public function index(){}
    public function edit(){}
    public function show(){}
    public function delete(){}
    
     
  
    public function create() {
        
         
    }

    public function store(){
        echo 'hello';
        $this->render('commande/compte.php');
    }
 
}