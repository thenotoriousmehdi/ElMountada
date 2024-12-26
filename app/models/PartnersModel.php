<?php


class PartnersModel
{
  use Database;

  public function getAllPartnersLogos()
  {
      $query = "SELECT logo_path FROM partners";

      $PartnerLogos = $this->query($query); 
      return $PartnerLogos;
  }

    
    public function getAllHotels()
    {
        $query = "SELECT * FROM partners WHERE categorie_id = 1"; 
        return $this->query($query);
    }

    
    public function getAllCliniques()
    {
        $query = "SELECT * FROM partners WHERE categorie_id = 2"; 
        return $this->query($query);
    }

 
    public function getAllEcoles()
    {
        $query = "SELECT * FROM partners WHERE categorie_id = 3"; 
        return $this->query($query);
    }

    
    public function getAllAgencesDeVoyage()
    {
        $query = "SELECT * FROM partners WHERE categorie_id = 4"; 
        return $this->query($query);
    }
    
public function getAllCities()
{
    $query = "SELECT DISTINCT ville FROM partners";
    return $this->query($query);
}

public function getPartnersByVille($ville)
{
    $query = "SELECT * FROM partners WHERE ville = :ville";
    return $this->query($query);
}
}
