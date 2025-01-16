<?php


class ContactModel
{
    use Database;

    public function getPartnerNames()
    {
        $query = "SELECT id, full_name FROM users WHERE type = :type";
        $data = [':type' => 'partner'];
        return $this->query($query, $data);
    }


    public function getMessages()
    {
        $query = "SELECT 
            contact.*,
            users.full_name AS partner_name
        FROM 
            contact
        LEFT JOIN 
            users
        ON 
            contact.partner_id = users.id";
        return $this->query($query);
    }

    public function saveContactMessage($type, $message, $partnerId = null)
    {
        $query = "INSERT INTO contact (type, message, partner_id, created_at) 
                VALUES (:type, :message, :partner_id, NOW())";

        $data = [
            ':type' => $type,
            ':message' => $message,
            ':partner_id' => $partnerId
        ];

        return $this->query($query, $data);
    }
}
