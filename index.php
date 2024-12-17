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
        case '/':  // If the URL is empty or '/'
            $accueilController = new AccueilController();
            $accueilController->showHead();
            $accueilController->showHeader();
            $accueilController->showDiaporama();
            $accueilController->showOffers();
            $accueilController->showPartners();
            $accueilController->showFooter();
            $accueilController->showFoot();
            break;
        case '/auth':  // If the URL is '/auth'
            $authController = new AuthController();
            $authController->showLoginPage();
            break;   
        default:
            // If no matching route, show 404
            http_response_code(404);
            echo "Page nogtre";
            break;
    }
}

// Get the request URI and pass it to the route function
$url = $_SERVER['REQUEST_URI'];
route($url);
