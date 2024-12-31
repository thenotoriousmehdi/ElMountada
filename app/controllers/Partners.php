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

    public function showPartners()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
            header('Location: /ElMountada/auth/showLoginPage'); 
            exit();
        }

        $this->View('partners');
        $view = new PartnersView();
        $sessionData = $this->getSessionData();
        $partners = $this ->partnerModel ->getAllPartners();
        $view->Head();
        $view ->displaySessionMessage();
        $view->header($sessionData);
        $view->Partners( $partners);
        $view->foot();
        $view->footer();
    }


    public function deletePartner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['partner_id'])) {
                $partner_id = $_POST['partner_id']; 
            
                $success =  $this->partnerModel->deletePartner($partner_id);
            
                if ($success) {
                    $_SESSION['status'] = "Le partenaire a été supprimé avec success";
                    $_SESSION['status_type'] = 'success';
                    header('Location: /ElMountada/partners/showPartners');
                    exit();
                } else {
                    $_SESSION['status'] = "La suppression a échoué";
                    $_SESSION['status_type'] = 'error';
                    header('Location: /ElMountada/partners/showPartners');
                    exit();
                }
            }
        }
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
