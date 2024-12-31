<?php


class Partners
{
   use Controller;
    private $partnerModel;
    private $partnersView;
    public function __construct()
    {
        $this->partnerModel = new PartnersModel(); 
    }

  
    public function showCatalogue()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('partners');
        $view = new PartnersView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view ->displaySessionMessage();
        $view->header($sessionData);  
        $partnersH = $this->partnerModel->getAllPartnersByCategory(1);  
        $partnersC = $this->partnerModel->getAllPartnersByCategory(2);  
        $partnersE = $this->partnerModel->getAllPartnersByCategory(3);  
        $partnersA = $this->partnerModel->getAllPartnersByCategory(4);  
        $view->showPartnersByCategory("Hôtels", $partnersH);
        $view->showPartnersByCategory("Cliniques", $partnersC);
        $view->showPartnersByCategory("Ecoles", $partnersE);
        $view->showPartnersByCategory("Agences de voyages", $partnersA);
        $view->foot();
        $view->footer();
    }


    public function showPartnerCard($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('partners');
        $view = new PartnersView();
        $sessionData = $this->getSessionData();
        $partnerCard = $this ->partnerModel->getPartnerCard($id);
        $view->Head();
        $view->header($sessionData);
        $view->PartnerCard($partnerCard);
        $view->foot();
        $view->footer();
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



}
