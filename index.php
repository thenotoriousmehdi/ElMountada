<?php
require_once "./app/controllers/offersController.php";
session_start();

spl_autoload_register(function ($class) {
    require "./app/controllers/" . $class . ".php";
});

function route($url) {


    $baseURL = "/ElMountada"; 

    $url = strtolower(str_replace($baseURL, '', $url)); 

    switch ($url) {
        case '/':  
            $accueilController = new AccueilController();
            $accueilController->showHead();
            $accueilController->showHeader();
            $accueilController->showDiaporama();
            $accueilController->showLatest();
            $accueilController->showOffers();
            $accueilController->showPartnersLogos();
            $accueilController->showFooter();
            $accueilController->showFoot();
            break;
        case '/auth':  
            $accueilController = new AccueilController();
            $authController = new AuthController();
            $accueilController->showHead();
            $authController->showLoginPage();
            $accueilController->showFoot();
            break;   

         case '/partners':  
                $accueilController = new AccueilController();
                $partnersController = new PartnersController();
                $accueilController->showHead();
                $accueilController->showHeader();
                $partnersController ->partnersHotels();
                $partnersController ->partnersCliniques();
                $partnersController ->partnersEcoles();
                $partnersController ->partnersAgencesDeVoyage();
                $accueilController->showFoot();
                break; 

                case '/offers':  
                    $accueilController = new AccueilController();
                    $offersController = new OffersController();
                    $accueilController->showHead();
                    $accueilController->showHeader();
                    $offersController->showOffers();
                    $accueilController->showFoot();
                    break; 

        default:
            http_response_code(404);
            echo "Page not found";
            break;
    }
}

$url = $_SERVER['REQUEST_URI'];
route($url);
