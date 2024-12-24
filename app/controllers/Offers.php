<?php

class Offers
{
    private $offersModel;
    private $offersView;
    use Controller;
    use Database;


    public function index()
    {
        $offers = $this->offersModel->getAllOffers();
    }

    public function showOffers()
    {
        $db = $this->connectDb();
        $this->View('offers');
        $this->offersModel = new OffersModel($db);
        $view = new OffersView();
        $offers = $this->offersModel->getAllOffers();
        $view->Head();
        $view->header();
        $view->offers($offers);
        $view->foot();
        $view->footer();
    }
}
