<?php


class DonsModel {
    use Database;

    public function getDonationCategoriesWithCount() {
        $query = "
             SELECT dc.category_id, dc.name, COUNT(d.id) AS donation_count
            FROM donationCategories dc
            LEFT JOIN donations d ON dc.category_id = d.donation_category_id
            GROUP BY dc.category_id
        ";
        
        return $this->query($query);
    }

    public function getDonationsRequests() {
        $query = "SELECT * FROM donationsRequests
         WHERE status = 'pending'
        ";
        return $this->query($query);
    }

    public function updateDonationsRequestRefused($id) {
        $query = "UPDATE donationsRequests SET status = 'Refused' WHERE id = :id";
        $data = [':id' => $id]; 
        return $this->query($query, $data);  
    }


    public function updateDonationsRequestAccepted($id) {
        $updateQuery = "UPDATE donationsRequests SET status = 'Accepted' WHERE id = :id";
    $this->query($updateQuery, ['id' => $id]);

   
    $query = "SELECT id, user_id, name, document, aid_type FROM donationsRequests WHERE id = :id LIMIT 1";
    $result = $this->query($query, ['id' => $id]);

    if ($result) {
        $requestData = $result[0];
        $insertQuery = "INSERT INTO donations (user_id, name, document, aid_type) 
                       VALUES (:user_id, :name, :document, :aid_type)";
        
        $params = [
            'user_id' => $requestData->user_id,
            'name' => $requestData->name,
            'document' => $requestData->document,
            'aid_type' => $requestData->aid_type
        ];

        $this->query($insertQuery, $params);
    } 
    }








    public function getDonations() {
        $query = "SELECT * FROM donations";
        return $this->query($query);
    }


    public function updateDonationsDoneAccepted($id) {
        $query = "UPDATE donationsDone SET status = 'accepted' WHERE id = :id";
        $data = [':id' => $id]; 
        return $this->query($query, $data);  
    }

    public function updateDonationsDoneRefused($id) {
        $query = "UPDATE donationsDone SET status = 'Refused' WHERE id = :id";
        $data = [':id' => $id]; 
        return $this->query($query, $data);  
    }



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



    public function getDonationsDone() {
        $query = "SELECT 
    d.id,
    u.email AS user_name,
    d.somme,
    dc.name AS category_name,
    d.recu,
    d.status,
    d.created_at
FROM 
    donationsDone d
LEFT JOIN 
    users u ON d.user_id = u.id
LEFT JOIN 
    donationCategories dc ON d.donation_category_id = dc.category_id
    WHERE 
    d.status = 'pending'";
        return $this->query($query);
    }


    public function addDonation($data) {
        try {
            $query = "
                INSERT INTO donationsDone (user_id, somme, donation_category_id, recu, status, created_at)
                VALUES (:user_id, :somme, :donation_category_id, :recu, :status, CURRENT_TIMESTAMP)
            ";
            
            $params = [
                'user_id' => (int)$data['user_id'],  
                'somme' => (string)$data['somme'],   
                'donation_category_id' => (int)$data['donation_category_id'], 
                'recu' => $data['recu'],
                'status' => $data['status'] ?? 'Pending'  
            ];
            
            return $this->query($query, $params);
        } catch (Exception $e) {
            error_log("Error in addDonation: " . $e->getMessage());
            return false;
        }
    }

    public function addDonationRequest($user_id, $name, $dob, $aid_type,  $description, $document, $status = 'Pending') {
        $query = "
            INSERT INTO donationsRequests (user_id, name, dob, aid_type, description, document, status)
            VALUES (:user_id, :name, :dob, :aid_type, :description, :document, :status)
        ";

        $params = [
            'user_id' => $user_id,
            'name' => $name,
            'dob' => $dob,
            'aid_type' => $aid_type,
            'description' => $description,
            'document' => $document,
            'status' => $status,
        ];

        return $this->query($query, $params);
    }


}
?>
