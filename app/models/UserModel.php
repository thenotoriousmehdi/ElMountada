<?php

class UserModel {
    use Database;

    private $db;

    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $result = $this->query($query, ['email' => $email]);
        return $result ? $result[0] : false; 
    }

    public function createUser($email, $password, $fullName, $phoneNumber) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into the 'users' table with type 'simple'
        $query = "INSERT INTO users (email, password, type) VALUES (:email, :password, :type)";
        $params = [
            'email' => $email,
            'password' => $hashedPassword,
            'type' => 'simple'
        ];
        $this->query($query, $params);

        $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $result = $this->query($query, ['email' => $email]);

        if ($result) {
            $userId = $result[0] -> id;
            $query = "INSERT INTO simple_users (id, full_name, phone_number) VALUES (:id, :full_name, :phone_number)";
            $params = [
                'id' => $userId,
                'full_name' => $fullName,
                'phone_number' => $phoneNumber
            ];
            $this->query($query, $params);
        }
    }
}
