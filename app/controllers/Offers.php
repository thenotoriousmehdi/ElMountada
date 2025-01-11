<?php

class Offers
{
    private $offersModel;
    use Controller;
    
    public function index()
    {
        $offers = $this->offersModel->getAllOffers();
    }

    public function showOffers()
    {
        $this->startSession();
        $this->View('offers');
        $this->offersModel = new OffersModel();
        $view = new OffersView();
        $offers = $this->offersModel->getAllOffers();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->loadHeader($sessionData);
        $view->offers($offers);
        $view->foot();
        $view->footer();
    }
}
