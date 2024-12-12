<?php
require_once("./app/views/sharedViews/auth.php");


class AuthController{
    private $authView;
    public function __construct() {
        $this->authView = new Auth();
    }
    public function showLoginPage(){
        
        $this->authView->login();  
    }
    
    
    public function handleLogin() {
        $commun=new Commun();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $userModel = new UserModel(); 
            $user = $userModel->auth($username, $password);
            if ($user) {
                if($user["valide"]==1){
                    if ($user["bloque"]==0) {
                        # code...
                        echo "Logged in";
                        session_start();
                $_SESSION['user'] = $user;
                header("Location: ./index.php?action=home");
                    }else echo "VOUS ETES BLOQUE";
                   
                } else {
                    
                    $text="Registration is waiting to be approuved!";
                    $id="";
                    $commun->waitingApprouval($text,"register");
                } 
                
            } else {
                
                $text="Wrong credentials";
                $id="";
                $commun->waitingApprouval($text,"login");                
            }
        } 
}
public function handleLogout(){
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_SESSION)) unset($_SESSION['user']);;
    header("Location: ./index.php?action=home");

}
}
?>