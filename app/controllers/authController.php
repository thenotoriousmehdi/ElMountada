<?php
require_once("./app/views/auth.php");


class AuthController{
    private $authView;
    public function __construct() {
        $this->authView = new Auth();
    }
    public function showLoginPage(){
        
        $this->authView->login();  
    }
    
    
    public function handleLogin() {
        
}
public function handleLogout(){
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    // if (isset($_SESSION)) unset($_SESSION['user']);;
    // header("Location: ./index.php?action=home");

}
}
?>