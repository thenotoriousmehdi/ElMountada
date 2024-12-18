<?php
require_once "app/models/offers.php";

class OffersController {
    private $offersModel;

    public function __construct($db) {
        $this->offersModel = new Offers($db);
    }

    public function index() {
        $offers = $this->offersModel->getAllOffers();
        require_once "views/offers.php";
        require_once "app/views/accueil.php";
    }
}
