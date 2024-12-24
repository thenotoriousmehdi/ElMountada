<?php


class PartnersModel
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

    
    public function getAllHotels()
    {
        $query = "SELECT * FROM partners WHERE categorie_id = 1"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getAllCliniques()
    {
        $query = "SELECT * FROM partners WHERE categorie_id = 2"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 
    public function getAllEcoles()
    {
        $query = "SELECT * FROM partners WHERE categorie_id = 3"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getAllAgencesDeVoyage()
    {
        $query = "SELECT * FROM partners WHERE categorie_id = 4"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
public function getAllCities()
{
    $query = "SELECT DISTINCT ville FROM partners";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

public function getPartnersByVille($ville)
{
    $query = "SELECT * FROM partners WHERE ville = :ville";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':ville' => $ville]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
