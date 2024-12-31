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

  public function getAllPartnersByCategory($categorieId)
  {
      $query = "SELECT * FROM partners WHERE categorie_id = :categorie_id"; 
      return $this->query($query, ['categorie_id' => $categorieId]);
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

public function getPartnerCard($id)
  {
    $query =  "SELECT
    partners.id AS partner_id,
    partners.categorie_id,
    categories.name AS category_name,
    partners.description,
    partners.ville,
    partners.adresse,
    partners.logo_path,
    partners.created_at,
    users.id AS user_id,
    users.email,
    users.full_name,
    users.phone_number,
    users.type AS user_type
FROM
    partners
JOIN
    users ON users.id = partners.id AND users.type = 'partner'
JOIN
    categories ON categories.id = partners.categorie_id
WHERE
    partners.id = :id" ;

    $data = [':id' => $id];
    $results = $this->query($query, $data);
    return $results ? $results[0] : null;
  }

}
