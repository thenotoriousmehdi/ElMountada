
<?php

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class MembershipModel
{

    use Database;


    public function getMemberships()
    {
        $query = "SELECT * FROM membership_types";
        return $this->query($query);
    }

    public function renewMembership($userId, $newBillingDate)
    {
        $query = "UPDATE members 
              SET billing_date = :new_billing_date 
              WHERE user_id = :user_id";

        $data = [
            ':user_id' => $userId,
            ':new_billing_date' => $newBillingDate
        ];

        return $this->query($query, $data);
    }

    public function getMembershipCard($id)
    {
        $query = "SELECT
        m.user_id,
        m.membership_date,
        m.billing_date,
        m.QrCode,
        u.email,
        u.full_name,
        u.phone_number,
        mt.name AS membership_type_name,
        CASE 
            WHEN m.billing_date < CURDATE() THEN TRUE 
            ELSE FALSE 
        END AS needs_renewal
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

    public function insertMembershipRequest($data)
    {
        $query = "INSERT INTO members (user_id, membership_type_id, photo, idpiece, recu, status, membership_date)
              VALUES (:user_id, :membership_type_id, :photo, :idpiece, :recu, 'pending', NOW())";
        $params = [
            ':user_id' => $data['userId'],
            ':membership_type_id' => $data['membershipTypeId'],
            ':photo' => $data['photo'],
            ':idpiece' => $data['identity'],
            ':recu' => $data['receipt'],
        ];

        try {
            $result = $this->query($query, $params);

            if ($result) {
                $query = "SELECT
                        m.user_id,
                        m.membership_date,
                        m.billing_date,
                        u.email,
                        u.full_name,
                        u.phone_number,
                        mt.name AS membership_type_name,
                        CASE 
                            WHEN m.billing_date < CURDATE() THEN TRUE 
                            ELSE FALSE 
                        END AS needs_renewal
                      FROM
                        members m
                      JOIN
                        users u ON m.user_id = u.id
                      JOIN
                        membership_types mt ON m.membership_type_id = mt.id
                      WHERE
                        m.user_id = :user_id";

                $memberData = $this->query($query, [':user_id' => $data['userId']]);

                if ($memberData) {
                    $memberData = $memberData[0];

                    $qrData = json_encode([
                        'user_id' => $memberData->user_id,
                        'full_name' => $memberData->full_name,
                        'email' => $memberData->email,
                        'phone_number' => $memberData->phone_number,
                        'membership_date' => $memberData->membership_date,
                        'billing_date' => $memberData->billing_date,
                        'membership_type' => $memberData->membership_type_name,
                        'needs_renewal' => $memberData->needs_renewal
                    ]);



                    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/ElMountada/public/uploads/qr_codes/';

                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }


                    $qrFilePath = $uploadDir . 'member_' . $data['userId'] . '.png';


                    $qrCode = new QrCode($qrData);
                    $writer = new PngWriter();
                    $qrImage = $writer->write($qrCode);
                    $qrImage->saveToFile($qrFilePath);


                    $baseUrl = "/ElMountada";
                    $qrFileUrl = $baseUrl . '/public/uploads/qr_codes/member_' . $data['userId'] . '.png';

                    $updateQuery = "UPDATE members SET QrCode = :qr_code_path WHERE user_id = :user_id";
                    $this->query($updateQuery, [
                        ':qr_code_path' => $qrFileUrl,
                        ':user_id' => $data['userId']
                    ]);
                }

                return $result;
            }

            return false;
        } catch (PDOException $e) {
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

    public function updateMembershipAccepted($id)
    {
        $query = "UPDATE users SET type = 'member' WHERE id = :id";
        $data = ['id' => $id];
        $this->query($query, $data);
        $query = "UPDATE members SET status = 'active' WHERE user_id = :id";
        $this->query($query, $data);
    }


    public function updateMembershipRefused($id)
    {
        $query = "UPDATE members SET status = 'refused' WHERE user_id = :id";
        $data = ['id' => $id];
        $this->query($query, $data);
    }
}
