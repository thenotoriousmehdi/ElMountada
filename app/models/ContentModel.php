<?php


class ContentModel {
  use Database;

    

    
    public function getNews() {
        $query = "SELECT * FROM contenu WHERE type = 'nouvelle' ORDER BY created_at DESC";
        return $this->query($query);
    }

    public function getBenevolat() {
        $query = "SELECT * FROM contenu WHERE type = 'benevolat' ORDER BY created_at DESC";
        return $this->query($query);
    }


    public function getAllContent() {
        $query ="SELECT id,title, description, type, event_date, image_path, location 
              FROM contenu 
              ORDER BY created_at DESC";
        return $this->query($query);
    }



    public function getLatest() {
        $query ="SELECT id, title, description, type, event_date, image_path, location 
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


public function getById($contentId) {
    try {
        $query = "SELECT * FROM contenu WHERE id = :id";
        $data = [':id' => $contentId];
        $result = $this->query($query, $data);
        return $result ? $result[0] : null;
    } catch (PDOException $e) {
        error_log("Error fetching content: " . $e->getMessage());
        throw $e;
    }
}

public function addParticipation($userId, $contentId)
    {
        $query = "INSERT INTO event_participation (user_id, content_id, created_at) VALUES (:user_id, :content_id, NOW())";
        $data = [
            ':user_id' => $userId,
            ':content_id' => $contentId
        ];
        return $this->query($query, $data);
    }


    public function participants($id)
    {
        $query = "
        SELECT u.id, u.full_name, u.email, u.phone_number, u.type
        FROM event_participation ep
        JOIN users u ON ep.user_id = u.id
        WHERE ep.content_id = :content_id
    ";
    $data = [
        ':content_id' => $id,
    ];
    return $this->query($query, $data);
    }




public function update($data) {
    try {
        $query = "UPDATE contenu SET 
                  title = :title, 
                  description = :description, 
                  type = :type, 
                  location = :location";
    
        if (!empty($data['event_date'])) {
            $query .= ", event_date = :event_date";
        } else {
            $query .= ", event_date = NULL";
        }
        
        if (!empty($data['image_path'])) {
            $query .= ", image_path = :image_path";
        }
        
        $query .= " WHERE id = :id";
        $params = [
            ':id' => $data['id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':type' => $data['type'],
            ':location' => $data['location']
        ];
        if (!empty($data['event_date'])) {
            $params[':event_date'] = $data['event_date'];
        }
        if (!empty($data['image_path'])) {
            $params[':image_path'] = $data['image_path'];
        }

        error_log("Update query: " . $query);
        error_log("Parameters: " . print_r($params, true));

        return $this->query($query, $params);
    } catch (PDOException $e) {
        error_log("Error updating content: " . $e->getMessage());
        throw $e;
    }
}


     public function filterContent($title = null, $type = null, $event_date = null, $location = null, $categorie = null)
     {
         $query = "SELECT * FROM contenu";
         $conditions = [];
         $data = [];
     
       
         if ($title) {
             $conditions[] = "title LIKE :title";
             $data[':title'] = '%' . $title . '%';
         }
     
     
         if ($type) {
             $conditions[] = "type = :type";
             $data[':type'] = $type;
         }
     
       
         if ($event_date) {
             $conditions[] = "event_date = :event_date";
             $data[':event_date'] = $event_date;
         }
     
        
         if ($location) {
             $conditions[] = "location = :location";
             $data[':location'] = $location;
         }
     
       
         if ($categorie) {
             $conditions[] = "categorie = :categorie";
             $data[':categorie'] = $categorie;
         }

         if (count($conditions) > 0) {
             $query .= " WHERE " . implode(" AND ", $conditions);
         }
    
         return $this->query($query, $data);
     }
     


     public function deleteContent($content_id)
     {
         $query = "DELETE FROM contenu WHERE id = :content_id";
         $data = [':content_id' => $content_id];
         $this->query($query, $data);
     }


public function getVilles()
{
    $query = "SELECT DISTINCT location FROM contenu";
    return $this->query($query);
}












}
?>
