<?php

class UserModel
{
    use Database;

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $result = $this->query($query, ['email' => $email]);
        return $result ? $result[0] : false;
    }


    public function deleteUser($user_id)
    {
        $query = "DELETE FROM users WHERE id = :user_id";
        $data = [':user_id' => $user_id];
        return $this->query($query, $data);
    }


    public function blockUser($user_id)
    {
        $query = "  UPDATE users
SET Active = 0 WHERE id = :user_id";
        $data = [':user_id' => $user_id];
        return $this->query($query, $data);
    }

    public function deblockUser($user_id)
    {
        $query = "  UPDATE users
SET Active = 1 WHERE id = :user_id";
        $data = [':user_id' => $user_id];
        return $this->query($query, $data);
    }

    public function makeMember($user_id)
    {
        $query = "UPDATE users
   SET is_member = 1 WHERE id = :user_id";
        $data = [':user_id' => $user_id];
        return $this->query($query, $data);
    }




    public function createUser($email, $password, $fullName, $phoneNumber)
    {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, password, full_name, phone_number, is_member, type) VALUES (:email, :password, :full_name, :phone_number, :is_member, :type )";
        $params = [
            'email' => $email,
            'password' => $hashedPassword,
            'full_name' => $fullName,
            'phone_number' => $phoneNumber,
            'is_member' => 0,
            'type' => 'simple'
        ];
        return $this->query($query, $params);
    }

    public function getProfile($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $data = [':id' => $id];
        $results = $this->query($query, $data);
        return $results ? $results[0] : null;
    }

    public function modifierProfile($id, $fullName, $email, $phoneNumber)
    {
        $query = "UPDATE 
                users 
            SET 
                full_name = :full_name, 
                email = :email, 
                phone_number = :phone_number 
            WHERE 
                id = :id
        ";

        $data = [
            ':full_name' => $fullName,
            ':email' => $email,
            ':phone_number' => $phoneNumber,
            ':id' => $id
        ];

        return $this->query($query, $data);
    }

    public function verifyPassword($id, $password)
    {
        $query = "SELECT password FROM users WHERE id = :id";
        $data = [':id' => $id];
        $result = $this->query($query, $data);
        if ($result && password_verify($password, $result[0]->password)) {
            return true;
        }

        return false;
    }


    public function filteruser($type = null)
    {
        $query = "SELECT id, email, full_name, phone_number, type, is_member, active 
            FROM users";
        $conditions = [];
        $data = [];

        if ($type) {
            $conditions[] = "type = :type";
            $data[':type'] = $type;
        }

        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        return $this->query($query, $data);
    }

    public function updatePassword($id, $newPassword)
    {

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = :password WHERE id = :id";
        $data = [
            ':password' => $hashedPassword,
            ':id' => $id
        ];

        return $this->query($query, $data);
    }
}
