<?php

class HistoryModel 
{
    use Database;
    public function getMesdons($user_id) {
        $query = "SELECT 
        d.id,
    d.somme,
    dc.name AS category_name,
    d.recu,
    d.status,
    d.created_at
FROM 
    donationsDone d

LEFT JOIN 
    donationCategories dc ON d.donation_category_id = dc.category_id
        
        WHERE user_id = :user_id AND status = 'accepted'";
        $data = [':user_id' => $user_id]; 
        return $this->query($query, $data);  
    }

    public function getMesBenevolats($user_id) {
        $query = "
    SELECT 
        ep.id AS participation_id,
        ep.created_at AS participation_date,
        c.id AS event_id,
        c.title,
        c.description,
        c.type,
        c.event_date,
        c.image_path,
        c.location
    FROM 
        event_participation AS ep
    JOIN 
        contenu AS c 
    ON 
        ep.content_id = c.id
    WHERE 
        ep.user_id = :user_id
        AND c.type = 'benevolat'
";
        $data = [':user_id' => $user_id]; 
        return $this->query($query, $data);  
    }










   



}
