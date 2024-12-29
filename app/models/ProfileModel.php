<?php

class ProfileModel {
    use Database;

    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $result = $this->query($query, ['email' => $email]);
        return $result ? $result[0] : false; 
    }

    public function createUser($email, $password, $fullName, $phoneNumber) {
        
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
        $this->query($query, $params);
    }

}
