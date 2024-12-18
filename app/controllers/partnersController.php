<?php
require_once './app/models/partners.php';
require_once './app/views/sharedViews/partners.php';

class PartnersController
{
    private $partnerModel;
    private $partnersView;

    public function __construct()
    {
        $this->partnersView = new Partners();
        $db = (new Database())->connectDb();
        $this->partnerModel = new PartnerModel($db); 
    }

    public function partnersLogos()
    {
        $partners = $this->partnerModel->getAllPartnersLogos();
        require './app/views/sharedViews/partners.php';
        require './app/views/sharedViews/accueil.php';
    }

    public function partnersHotels()
    {
        $partnersH = $this->partnerModel->getAllHotels();
        $this->partnersView->Hotels($partnersH);
     
    }

    public function partnersCliniques()
    {
        $partnersC = $this->partnerModel->getAllCliniques();
        $this->partnersView->Cliniques($partnersC);
       
    }

    public function partnersEcoles()
    {
        $partnersE = $this->partnerModel->getAllEcoles();
        $this->partnersView->Ecoles($partnersE);
        
    }

    public function partnersAgencesDeVoyage()
    {
        $partnersA = $this->partnerModel->getAllAgencesDeVoyage();
        $this->partnersView->AgencesDeVoyages($partnersA);
       
    }
}
