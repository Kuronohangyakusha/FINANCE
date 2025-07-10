<?php
namespace Ciara2\Sprint2;


abstract class AbstractController{
    protected $Layout = 'base.layout.php';
    abstract public function create();
    abstract public function index();
    abstract public function edit();
    abstract public function show();
    abstract public function delete();
    abstract public function store();
   public function render($view){
    ob_start();
    require_once __DIR__ . '/../../template/'.$view.'.php';
    $contentForLayout = ob_get_clean();  
    require_once __DIR__ . '/../../template/layout/'.$this->Layout;
}

}