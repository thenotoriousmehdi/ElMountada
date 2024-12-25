<?php

class Offers
{
    private $offersModel;
    private $offersView;
    use Controller;
    
    public function index()
    {
        $offers = $this->offersModel->getAllOffers();
    }

    public function showOffers()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('offers');
        $this->offersModel = new OffersModel();
        $view = new OffersView();
        $offers = $this->offersModel->getAllOffers();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->header($sessionData);
        $view->offers($offers);
        $view->foot();
        $view->footer();
    }
}
