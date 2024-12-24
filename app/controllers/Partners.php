<?php


class Partners
{
    private $partnerModel;
    private $partnersView;
    use Database;
    public function __construct()
    {
        $db = $this->connectDb();
        $this->partnersView = new PartnersView();
        $this->partnerModel = new PartnersModel($db); 
    }

  


public function filterPartners()
{
    $cities = $this->partnerModel->getAllCities();
    $this->partnersView->displayFilterForm($cities);

    if(isset($_POST['filter_submit'])) {
        $categorie = $_POST['categorie'] ?? '';
        $ville = $_POST['ville'] ?? '';
        
        if(!empty($ville)) {
            $partners = $this->partnerModel->getPartnersByVille($ville);
            $this->partnersView->PartnerSection("Partenaires à " . $ville, $partners);
            return; 
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
