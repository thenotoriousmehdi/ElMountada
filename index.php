<?php

require_once("./app/controllers/authController.php");




$action = isset($_GET['action']) ? $_GET['action'] : 'home';

$authController=new AuthController();

        $authController->showLoginPage();
       // $authController->showRegisterPage();
    
?>