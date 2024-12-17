<?php
require_once("server/db.php");
class PartnerModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db; 
    }

    public function getAllPartnersLogos()
    {
        $query = "SELECT logo_path FROM partners";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}
