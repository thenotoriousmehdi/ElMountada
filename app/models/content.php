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
}
?>
