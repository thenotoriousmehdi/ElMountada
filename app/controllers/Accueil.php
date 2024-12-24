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
        $this->checkLogin();
         $db = $this->connectDb();
         $this->contentModel = new ContentModel($db);
         $this->partnersModel = new PartnersModel($db);
         $this->offersModel = new OffersModel($db);
         $this->View('accueil');
         $view = new AccueilView();
         $News = $this->contentModel->getNews();
         $Latest = $this->contentModel->getLatest();
         $offers = $this->offersModel->getAllOffers();
         $partnersLogos = $this->partnersModel->getAllPartnersLogos();
         $view ->Head();
         $view ->header();
         $view ->diaporama($News);
         $view ->latest($Latest);
         $view ->offers($offers);
         $view ->partnersLogos($partnersLogos);
         $view ->foot();
         $view ->footer();
    }
}
