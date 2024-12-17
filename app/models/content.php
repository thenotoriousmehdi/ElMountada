<?php
require_once("server/db.php");

class ContentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db; 
    }

    
    public function getNews() {
        $stmt = $this->db->prepare("SELECT * FROM contenu WHERE type = 'nouvelle' ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getLatest() {
        $stmt = $this->db->prepare("SELECT title, description, type, event_date, image_path, location 
              FROM contenu 
              ORDER BY created_at DESC 
              LIMIT 9");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }



}
?>
