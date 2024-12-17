<?php

require_once 'app/models/Content.php';

class ContentController {
    private $contenuModel;

    public function __construct($pdo) {
        $this->contenuModel = new ContentModel($pdo);
    }

    
    public function getNews() {
        $News = $this->contenuModel->getNews();
        return $News;
    }

    public function getLatest() {
        $latest = $this->contenuModel->getLatest();
        return $latest;
    }
}
?>
