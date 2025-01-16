<?php

class StatistiquesModel
{
    use Database;





    public function getUsersStatistiques()
    {

        $query = "SELECT 
    COUNT(*) AS total_users,
    SUM(type = 'partner') AS total_partners,
    SUM(type = 'member') AS total_members
FROM users";
        return $this->query($query);
    }

    public function getSumDonations()
    {

        $query = "SELECT SUM(CAST(somme AS DECIMAL(10, 2))) AS total_donations
FROM donationsdone
WHERE status = 'accepted' ";
        return $this->query($query);
    }
}
