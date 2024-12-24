<?php
session_start();
spl_autoload_register(function ($class) {
    require "./app/controllers/" . $class . ".php";
});

function route($url, $method) {
    $baseURL = "/ElMountada";
    $url = strtolower(str_replace($baseURL, '', $url));
    
    $urlParts = explode('/', trim($url, '/'));
    $page = $urlParts[0] ?? '';
    $action = $urlParts[1] ?? '';

    $communController = new CommunController();
    $communController->showHead();
    
    if ($url !== '/auth') {
        $communController->showHeader();
    }


    switch (true) {
        // Home page 
        case $url === '/':
            $accueilController = new AccueilController();
            $accueilController->showDiaporama();
            $accueilController->showLatest();
            $accueilController->showOffers();
            $accueilController->showPartnersLogos();
            break;

        // Auth page
        case $url === '/auth':
            $authController = new AuthController();
            $authController->showLoginPage();
            break;

        // Partners page
        case $url === '/partners':
            $partnersController = new PartnersController();
            $partnersController->filterPartners();
            $partnersController->partnersHotels();
            $partnersController->partnersCliniques();
            $partnersController->partnersEcoles();
            $partnersController->partnersAgencesDeVoyage();
            break;

        // Offers page
        case $url === '/offers':
            $offersController = new OffersController();
            $offersController->showOffers();
            break;

        // Content pages and actions
        case $page === 'content':
            $contentController = new ContentController();
            if ($method === 'POST' && $action === 'store') {
                // Handle form submission
                $contentController->store();
            } else {
                // Show the add content form
                $contentController->showAddContent();
            }
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
$method = $_SERVER['REQUEST_METHOD'];
route($url, $method);