<?php

class Accueil
{
     use Controller;
    
     private $accueilView;
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
         $Latest = $this->contentModel->getLatest();
         $offers = $this->offersModel->get10Offers();
         $partnerLogos = $this->partnersModel->getAllPartnersLogos();
         $sessionData = $this->getSessionData();
         $view ->Head();
         $view ->displaySessionMessage();
         $view ->header($sessionData);
         $view ->diaporama($News);
         $view ->latest($Latest);
         $view ->offers($offers);
         $view ->partnersLogos($partnerLogos);
         $view ->footer();
         $view ->foot();
    }
}
