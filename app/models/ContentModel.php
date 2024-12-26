<?php


class ContentModel {
  use Database;

    

    
    public function getNews() {
        $query = "SELECT * FROM contenu WHERE type = 'nouvelle' ORDER BY created_at DESC";
        return $this->query($query);
    }


    public function getAllContent() {
        $query ="SELECT title, description, type, event_date, image_path, location 
              FROM contenu 
              ORDER BY created_at DESC";
        return $this->query($query);
    }



    public function getLatest() {
        $query ="SELECT title, description, type, event_date, image_path, location 
              FROM contenu 
              ORDER BY created_at DESC 
              LIMIT 9";
          return $this->query($query);
    }

     public function insert($data) {
         try {
            $query = "INSERT INTO contenu (title, description, type, event_date, image_path, location) 
                    VALUES (:title, :description, :type, :event_date, :image_path, :location)";
            
            $data = [ 
          ':title' => $data['title'],
            ':description' => $data['description'],
             ':type' => $data['type'],
             ':event_date' => $data['event_date'],
             ':image_path' => $data['image_path'],
            ':location' => $data['location']
        ];
        return $this->query($query, $data);  
        ;
         } catch (PDOException $e) {
             error_log("Error inserting news: " . $e->getMessage());
             throw $e;
         }
     }

}
?>
