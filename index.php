<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("./app/controllers/authController.php");
require_once("./app/controllers/accueilController.php");
require_once './app/controllers/partnersController.php';



$action = isset($_GET['action']) ? $_GET['action'] : 'home';

$authController=new AuthController();

        // $authController->showLoginPage();
        // $authController->showRegisterPage();
$accueilController=new AccueilController();
$accueilController->showHead();
//$accueilController->showNavBar();
$accueilController->showHeader();
$accueilController->showDiaporama();
$accueilController->showPartners();
$accueilController->showFooter();
$accueilController->showFoot();
?>

