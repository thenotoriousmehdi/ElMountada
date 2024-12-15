<?php

require_once("./app/controllers/authController.php");
require_once("./app/controllers/accueilController.php");



$action = isset($_GET['action']) ? $_GET['action'] : 'home';

//$authController=new AuthController();

        //$authController->showLoginPage();
       // $authController->showRegisterPage();
$accueilController=new AccueilController();
$accueilController->showDiaporama();

?>

