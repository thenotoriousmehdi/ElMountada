<?php
require_once("./app/views/sharedViews/accueil.php");
require_once("app/models/content.php");
require_once("app/models/partners.php");

class AccueilController{
    private $accueilView;
    private $contentModel; 
    private $partnerModel;
    public function __construct() {
        $this->accueilView = new Accueil();
        $db = (new Database())->connectDb();
        $this->partnerModel = new PartnerModel($db);
        $this->contentModel = new ContentModel($db); 
    }
    public function showDiaporama(){
        $latestNews = $this->contentModel->getNews();

        // If no news are available, show a message
        if (empty($latestNews)) {
            $this->accueilView->diaporama([], "No news available at the moment.");
        } else {
            $this->accueilView->diaporama($latestNews); 
        }
    }  

    public function showNavBar(){
      
            $this->accueilView->navBar();
    }

    public function showHeader(){
      
        $this->accueilView->header();
}

public function showPartners(){
      
    $partners = $this->partnerModel->getAllPartnersLogos();
    $this->accueilView->partners($partners);
}
public function showFooter(){
      
    $this->accueilView->Footer();
}



    public function showHead(){
      
        $this->accueilView->Head();
}

public function showFoot(){
      
    $this->accueilView->Foot();
}



}
?>