<?php
require_once("./app/views/sharedViews/accueil.php");
require_once("app/models/news.php");

class AccueilController{
    private $accueilView;
    public function __construct() {
        $this->accueilView = new Accueil();
    }
    public function showDiaporama(){
        $newsModel = new NewsModel();
        $latestNews = $newsModel->getNews();
        if (empty($latestNews)) {
            $this->accueilView->diaporama([], "No news available at the moment.");
        } else {
            $this->accueilView->diaporama($latestNews);
        }
    }  

    public function showNavBar(){
      
            $this->accueilView->navBar();
    }

    public function showHead(){
      
        $this->accueilView->Head();
}

public function showFooter(){
      
    $this->accueilView->Footer();
}



}
?>