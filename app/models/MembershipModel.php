<?php

class MembershipModel {
  use Database;

    
    public function getMemberships() {
        $query = "SELECT * FROM membership_types";
        return $this->query($query);
    }

    public function getMembershipCard($id) {
      $query =  "SELECT 
    m.user_id,
    m.membership_date,
    m.billing_date,
    m.QrCode,
    u.email,
    u.full_name,
    u.phone_number,
    mt.name AS membership_type_name
FROM 
    members m
JOIN 
    users u ON m.user_id = u.id
JOIN 
    membership_types mt ON m.membership_type_id = mt.id
WHERE 
    m.user_id = :id";
  
      $data = [':id' => $id]; 
      $results = $this->query($query, $data);  
      return $results ? $results[0] : null; 
    }




    
}
