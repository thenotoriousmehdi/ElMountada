<?php
session_start();

spl_autoload_register(function ($class) {
    require "./app/controllers/" . $class . ".php";
});

function route($url) {


    $baseURL = "/ElMountada"; 

    $url = strtolower(str_replace($baseURL, '', $url)); 

    $communController = new CommunController();
            $communController->showHead();
            if ($url !== '/auth') {
                $communController->showHeader();
            }

    switch ($url) {
        case '/':  
            $accueilController = new AccueilController();
            $accueilController->showDiaporama();
            $accueilController->showLatest();
            $accueilController->showOffers();
            $accueilController->showPartnersLogos();
            break;
        case '/auth':  
            $accueilController = new AccueilController();
            $authController = new AuthController();
            $authController->showLoginPage();
            break;   

         case '/partners':  
            $accueilController = new AccueilController();
            $partnersController = new PartnersController();
            $partnersController ->filterPartners();
            $partnersController ->partnersHotels();
            $partnersController ->partnersCliniques();
            $partnersController ->partnersEcoles();
            $partnersController ->partnersAgencesDeVoyage();
            break; 

        case '/offers':  
            $accueilController = new AccueilController();
            $offersController = new OffersController();
            $offersController->showOffers();
          break; 

        default:
            http_response_code(404);
            echo "Page not found";
            break;
    }

    $communController->showFooter();
    $communController->showFoot();


}

$url = $_SERVER['REQUEST_URI'];
route($url);
