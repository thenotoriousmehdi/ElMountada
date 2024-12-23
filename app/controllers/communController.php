<?php
require_once("./app/views/commun.php");


class CommunController{
    private $communView;
    public function __construct() {
        $this->communView = new Commun();
    }
    
    public function showNavBar(){
        $this->communView->navBar();
    }

    public function showHeader() {
        $this->communView->header();
    }

    public function showFooter() {
        $this->communView->Footer();
    }

    public function showHead() {
        $this->communView->Head();
    }

    public function showFoot() {
        $this->communView->Foot();
    }
}
?>