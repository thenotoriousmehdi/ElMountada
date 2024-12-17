<?php
require_once './app/models/partners.php';

class PartnerController
{
    private $partnerModel;

    public function __construct($db)
    {
        $this->partnerModel = new PartnerModel($db); 
    }

    public function partners()
    {
        $partners = $this->partnerModel->getAllPartnersLogos();
        require 'views/partnersView.php';
        require 'views/accueil.php';
    }
}
