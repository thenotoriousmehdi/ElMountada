<?php
require_once "app/models/offers.php";
require_once "app/views/sharedViews/offers.php";

class OffersController {
    private $offersModel;
    private $offersView;

    public function __construct() {
        $db = (new Database())->connectDb();
        $this->offersModel = new OffersModel($db);
        $this->offersView = new Offers();
    }

    public function index() {
        $offers = $this->offersModel->getAllOffers();
    }

    public function showOffers() {
        $offers = $this->offersModel->getAllOffers();
        $this->offersView->offers($offers); 
    }
}
