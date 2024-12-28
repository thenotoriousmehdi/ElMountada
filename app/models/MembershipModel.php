<?php

class MembershipModel {
  use Database;

    
    public function getMemberships() {
        $query = "SELECT * FROM membership_types";
        return $this->query($query);
    }

    public function getMembershipCard($id) {
      $query = "SELECT 
    m.user_id,

    m.membership_date,
    m.billing_date,
    m.QrCode,
    u.email,
    u.full_name,
    u.phone_number
FROM 
    members m
JOIN 
    users u
ON 
    m.user_id = u.id
  WHERE 
  id = :id";
  
      $data = [':id' => $id]; 
      $results = $this->query($query, $data);  
      return $results ? $results[0] : null; 
    }




    
}
