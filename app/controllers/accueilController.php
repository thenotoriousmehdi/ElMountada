<?php
require_once("./app/views/sharedViews/accueil.php");


class AccueilController{
    private $accueilView;
    public function __construct() {
        $this->accueilView = new Accueil();
    }
    public function showDiaporama(){
        
        $this->accueilView-> diaporama();  
    }
    
    
    

}
?>