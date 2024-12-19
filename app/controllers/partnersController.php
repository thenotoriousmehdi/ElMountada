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

    // In PartnersController
public function filterPartners()
{
    $cities = $this->partnerModel->getAllCities();
    $this->partnersView->displayFilterForm($cities);

    if(isset($_POST['filter_submit'])) {
        $categorie = $_POST['categorie'] ?? '';
        $ville = $_POST['ville'] ?? '';
        
        if(!empty($ville)) {
            // If ville is selected, show all partners from that ville
            $partners = $this->partnerModel->getPartnersByVille($ville);
            $this->partnersView->PartnerSection("Partenaires à " . $ville, $partners);
            return; // Stop here, don't show other sections
        }
    
    }
}

public function partnersHotels()
{
    if(!isset($_POST['categorie']) || $_POST['categorie'] == '' || $_POST['categorie'] == '1') {
        $partnersH = $this->partnerModel->getAllHotels();
        $this->partnersView->Hotels($partnersH);
    }
}

public function partnersCliniques()
{
    if(!isset($_POST['categorie']) || $_POST['categorie'] == '' || $_POST['categorie'] == '2') {
        $partnersC = $this->partnerModel->getAllCliniques();
        $this->partnersView->Cliniques($partnersC);
    }
}

public function partnersEcoles()
{
    if(!isset($_POST['categorie']) || $_POST['categorie'] == '' || $_POST['categorie'] == '3') {
        $partnersE = $this->partnerModel->getAllEcoles();
        $this->partnersView->Ecoles($partnersE);
    }
}

public function partnersAgencesDeVoyage()
{
    if(!isset($_POST['categorie']) || $_POST['categorie'] == '' || $_POST['categorie'] == '4') {
        $partnersA = $this->partnerModel->getAllAgencesDeVoyage();
        $this->partnersView->AgencesDeVoyages($partnersA);
    }
}
}
