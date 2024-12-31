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

  public function MembershipRequest($data)
  {
    $query = " INSERT INTO members 
      (user_id, status, idpiece, recu, secteurRemise, membership_date, billing_date, QrCode, membership_type_id) 
      VALUES 
      (:user_id, :status, :idpiece, :recu, :secteurRemise, :membership_date, :billing_date, :QrCode, :membership_type_id)
  ";

    return $this->query($query, [
      ':user_id' => $data['user_id'],
      ':status' => $data['status'],
      ':idpiece' => $data['idpiece'],
      ':recu' => $data['recu'],
      ':secteurRemise' => $data['secteurRemise'],
      ':membership_date' => $data['membership_date'],
      ':billing_date' => $data['billing_date'],
      ':QrCode' => $data['QrCode'],
      ':membership_type_id' => $data['membership_type_id'],
    ]);
  }

  public function getMembershipDetails()
  {
    
    $query = "SELECT 
    u.id AS user_id, 
    u.full_name, 
    u.email, 
    u.phone_number,  
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
}
