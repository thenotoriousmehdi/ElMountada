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
        $query = "SELECT * FROM donationsRequests";
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
