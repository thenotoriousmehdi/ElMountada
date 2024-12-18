<?php
require_once './app/models/partners.php';
require_once './app/views/sharedViews/partners.php';

class PartnersController
{
    private $partnerModel;
    private $partnersView;

    public function __construct($db)
    {
        $this->partnerModel = new PartnerModel($db); 
    }

    public function partnersLogos()
    {
        $partners = $this->partnerModel->getAllPartnersLogos();
        require './app/views/sharedViews/partners.php';
        require 'views/accueil.php';
    }

    public function partnersHotels()
    {
        $partners = $this->partnerModel->getAllHotels();
        require './app/views/sharedViews/partners.php';
    }

    public function partnersCliniques()
    {
        $partners = $this->partnerModel->getAllCliniques();
        require './app/views/sharedViews/partners.php';
    }

    public function partnersEcoles()
    {
        $partners = $this->partnerModel->getAllEcoles();
        require './app/views/sharedViews/partners.php';
        
    }

    public function partnersAgencesDeVoyage()
    {
        $partners = $this->partnerModel->getAllAgencesDeVoyage();
        require './app/views/sharedViews/partners.php';
       
    }




}
