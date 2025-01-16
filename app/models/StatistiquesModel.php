<?php

class StatistiquesModel {
    use Database;

    



    public function getUsersStatistiques() {

    $query = "SELECT 
    COUNT(*) AS total_users,
    SUM(type = 'partner') AS total_partners,
    SUM(type = 'member') AS total_members
FROM users";
    return $this->query($query);
    
    }
    
  
}






