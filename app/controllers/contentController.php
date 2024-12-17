<?php

require_once 'app/models/Content.php';

class ContentController {
    private $contenuModel;

    public function __construct($pdo) {
        $this->contenuModel = new ContenuModel($pdo);
    }

    // Function to get all "nouvelles"
    public function getNews() {
        $latestNews = $this->contenuModel->getNews();
        return $latestNews;
    }
}
?>
