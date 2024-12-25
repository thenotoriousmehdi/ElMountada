<?php

class UserModel {
    use Database;


    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $result = $this->query($query, ['email' => $email]);
        return $result ? $result[0] : false; 
    }

   
}
