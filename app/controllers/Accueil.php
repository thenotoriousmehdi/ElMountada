<?php

class Accueil
{
     use Controller;
     use Database;
    
     private $accueilView;
     private $contentModel;
     private $partnersModel;
    private $offersModel;

    public function ShowAccueil() 
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
         $db = $this->connectDb();
         $this->contentModel = new ContentModel($db);
         $this->partnersModel = new PartnersModel($db);
         $this->offersModel = new OffersModel();
         $this->View('accueil');
         $view = new AccueilView();
         $News = $this->contentModel->getNews();
         $Latest = $this->contentModel->getLatest();
         $offers = $this->offersModel->get10Offers();
         $partnersLogos = $this->partnersModel->getAllPartnersLogos();
         $view ->Head();
         $sessionData = $this->getSessionData();
         $view ->header($sessionData);
         $view ->diaporama($News);
         $view ->latest($Latest);
         $view ->offers($offers);
         $view ->partnersLogos($partnersLogos);
         $view ->footer();
         $view ->foot();
    }
}
