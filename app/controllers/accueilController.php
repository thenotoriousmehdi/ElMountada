<?php
require_once("./app/views/sharedViews/accueil.php");
require_once("app/models/content.php");
require_once("app/models/partners.php");
require_once("app/models/offers.php");

class AccueilController {
    private $accueilView;
    private $contentModel; 
    private $partnerModel;
    private $offersModel;

    public function __construct() {
        $this->accueilView = new Accueil();
        $db = (new Database())->connectDb();
        $this->partnerModel = new PartnerModel($db);
        $this->contentModel = new ContentModel($db);
        $this->offersModel = new Offers($db); 
    }

    public function showDiaporama() {
        $News = $this->contentModel->getNews();

        if (empty($News)) {
            $this->accueilView->diaporama([], "No news available at the moment.");
        } else {
            $this->accueilView->diaporama($News);
        }
    }
    

    public function showLatest() {
        $Latest = $this->contentModel->getLatest();

        if (empty($Latest)) {
            $this->accueilView->latest([], "No news available at the moment.");
        } else {
            $this->accueilView->latest($Latest);
        }
    }

    public function showNavBar(){
        $this->accueilView->navBar();
    }

    public function showHeader() {
        $this->accueilView->header();
    }

    public function showPartnersLogos() {
        $partnersLogos = $this->partnerModel->getAllPartnersLogos();
        $this->accueilView->partnersLogos($partnersLogos);
    }

    public function showFooter() {
        $this->accueilView->Footer();
    }

    public function showHead() {
        $this->accueilView->Head();
    }

    public function showFoot() {
        $this->accueilView->Foot();
    }

    public function showOffers() {
        $offers = $this->offersModel->getAllOffers();
        $this->accueilView->offers($offers); 
    }
}
?>
