<?php

class MembershipModel
{
  use Database;


  public function getMemberships()
  {
    $query = "SELECT * FROM membership_types";
    return $this->query($query);
  }

  public function getMembershipCard($id)
  {
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
    m.user_id = :id ";

    $data = [':id' => $id];
    $results = $this->query($query, $data);
    return $results ? $results[0] : null;
  }

  public function insertMembershipRequest($data) {
    // Query to insert membership request
    $query = "INSERT INTO members (user_id, membership_type_id, photo, idpiece, recu, status, membership_date)
              VALUES (:user_id, :membership_type_id, :photo, :idpiece, :recu, 'pending', NOW())";

    // Prepared data for binding to the query
    $params = [
        ':user_id' => $data['userId'],
        ':membership_type_id' => $data['membershipTypeId'],
        ':photo' => $data['photo'],
        ':idpiece' => $data['identity'],  // Updated to 'identity' field
        ':recu' => $data['receipt'],      // Updated to 'receipt' field
    ];

    // Use the query method to execute the insert
    try {
        $result = $this->query($query, $params);
        return $result;
    } catch (PDOException $e) {
        // Handle any errors from the database query
        error_log("Error inserting membership request: " . $e->getMessage());
        return false;
    }
}






  public function getMembershipDetails()
  {
    
    $query = "SELECT 
    u.id AS user_id, 
    u.full_name, 
    u.email, 
    u.phone_number,  
    m.photo, 
    m.status, 
    m.idpiece, 
    m.recu, 
    m.secteurRemise, 
    m.membership_date, 
    m.billing_date, 
    m.QrCode, 
    m.membership_type_id,
    mt.name AS membership_name 
FROM users u
LEFT JOIN members m ON u.id = m.user_id
LEFT JOIN membership_types mt ON m.membership_type_id = mt.id 
WHERE u.type = 'member'
        ";



    $result = $this->query($query);
    return !empty($result) ? $result : false;
  }


  public function getMembershipRequests()
  {
    
    $query = "SELECT 
    u.id AS user_id, 
    u.full_name, 
    u.email, 
    u.phone_number,
    m.photo,   
    m.status, 
    m.idpiece, 
    m.recu, 
    m.secteurRemise, 
    m.membership_date, 
    m.billing_date, 
    m.QrCode, 
    m.membership_type_id,
    mt.name AS membership_name 
FROM users u
LEFT JOIN members m ON u.id = m.user_id
LEFT JOIN membership_types mt ON m.membership_type_id = mt.id 
WHERE m.status= 'pending'
        ";
    $result = $this->query($query);
    return !empty($result) ? $result : false;
  }

  public function updateMembershipAccepted($id) {
    $query = "UPDATE users SET type = 'member' WHERE id = :id";
    $data = ['id' => $id];
    $this->query($query, $data);
    $query = "UPDATE members SET status = 'active' WHERE user_id = :id";
    $this->query($query, $data);
}

}
