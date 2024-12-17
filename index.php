<?php
session_start();

spl_autoload_register(function ($class) {
    require "./app/controllers/" . $class . ".php";
});

function route($url) {
        
    // Your base URL is '/ElMountada'
    $baseURL = "/Elmountada"; 
    
    // Remove the base URL from the request URI if it exists
    $url = strtolower(str_replace($baseURL, '', $url)); // Normalize URL
    

    

    // Routing logic
    switch ($url) {
        case '/':  
            $accueilController = new AccueilController();
            $accueilController->showHead();
            $accueilController->showHeader();
            $accueilController->showDiaporama();
            $accueilController->showLatest();
            $accueilController->showOffers();
            $accueilController->showPartners();
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
        default:
            http_response_code(404);
            echo "Page nogtre";
            break;
    }
}

$url = $_SERVER['REQUEST_URI'];
route($url);
