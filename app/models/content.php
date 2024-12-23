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

    public function insert($data) {
        try {
            $sql = "INSERT INTO contenu (title, description, type, event_date, image_path, location) 
                    VALUES (:title, :description, :type, :event_date, :image_path, :location)";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':type' => $data['type'],
                ':event_date' => $data['event_date'],
                ':image_path' => $data['image_path'],
                ':location' => $data['location']
            ]);
        } catch (PDOException $e) {
            error_log("Error inserting news: " . $e->getMessage());
            throw $e;
        }
    }

}
?>
