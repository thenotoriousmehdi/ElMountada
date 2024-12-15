<?php
require_once("app/models/news.php");

class NewsController {

    public function showDiaporama() {
        $newsModel = new NewsModel();
        $latestNews = $newsModel->getNews();
        require_once("app/views/accueil.php");
    }
}
?>
