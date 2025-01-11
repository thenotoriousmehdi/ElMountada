<?php

class Accueil
{
     use Controller;
    

     private $contentModel;
     private $partnersModel;
    private $offersModel;

    public function __construct() {
        $this-> partnersModel = new PartnersModel();
    }

    public function ShowAccueil() 
    {
         $this->startSession();
         $this->contentModel = new ContentModel();
         $this->offersModel = new OffersModel();
         $this->View('accueil');
         $view = new AccueilView();
         $News = $this->contentModel->getNews();
         $latest = $this->contentModel->getLatest();
         $offers = $this->offersModel->get10Offers();
         $partnerLogos = $this->partnersModel->getAllPartnersLogos();
         $sessionData = $this->getSessionData();
         $view ->Head();
         $view ->displaySessionMessage();
         $view->loadHeader($sessionData);
         if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
         $view ->diaporama($News);
         $view ->latest($latest);
         $view ->offers($offers);
         $view ->partnersLogos($partnerLogos);
         $view ->footer();
        }  else {
        
        $view ->adminWelcome();

        }
        
         $view ->foot();
    }
}
