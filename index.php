<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("./app/controllers/authController.php");
require_once("./app/controllers/accueilController.php");
require_once './app/controllers/partnersController.php';
require_once './app/controllers/partnersController.php';

$accueilController=new AccueilController();
$authController=new AuthController();
//$partnersController=new PartnersController($db);


//Home Page
 $accueilController->showHead();
 $accueilController->showHeader();
 $accueilController->showDiaporama();
 $accueilController->showLatest();
 $accueilController->showOffers();
 $accueilController->showPartnersLogos();
 $accueilController->showFooter();
 $accueilController->showFoot();

//Login page
// $accueilController->showHead();
// $authController->showLoginPage();
// $accueilController->showFoot();

//Partners page
// $accueilController->showHead();
// $accueilController->showHeader();
//  $partnersController->showLoginPage();
//  $accueilController->showFoot();


?>
