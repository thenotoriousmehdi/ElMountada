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
      $query = "SELECT 
      partners.id AS partner_id,
    partners.ville,
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
WHERE categorie_id = :categorie_id"; 
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

  public function getAllPartners()
  {
    $query =  "SELECT
    partners.id AS partner_id,
    partners.categorie_id,
    categories.name AS category_name,
    partners.description AS partner_description,
    partners.ville,
    partners.adresse,
    partners.logo_path,
    partners.created_at,
    users.id AS user_id,
    users.email,
    users.full_name,
    users.phone_number,
    users.password,
    users.type AS user_type,
    users.is_member,

    GROUP_CONCAT(DISTINCT reductions.reduction_value ORDER BY reductions.reduction_value) AS reductions,
    GROUP_CONCAT(DISTINCT reduction_membership.name ORDER BY reductions.reduction_value) AS reduction_membership_type_names,

    GROUP_CONCAT(DISTINCT advantages.description ORDER BY advantages.description) AS advantages,
    GROUP_CONCAT(DISTINCT advantage_membership.name ORDER BY advantages.description) AS advantage_membership_type_names,

    membership_types.name AS membership_type_name,
    membership_types.description AS membership_type_description,
    membership_types.price AS membership_type_price

FROM
    partners

JOIN users ON users.id = partners.id AND users.type = 'partner'


JOIN categories ON categories.id = partners.categorie_id

LEFT JOIN reductions ON reductions.partner_id = partners.id

LEFT JOIN advantages ON advantages.partner_id = partners.id
LEFT JOIN membership_types AS reduction_membership ON reduction_membership.id = reductions.membership_type_id
LEFT JOIN membership_types AS advantage_membership ON advantage_membership.id = advantages.membership_type_id
LEFT JOIN membership_types ON membership_types.id = partners.categorie_id

GROUP BY
    partners.id, partners.categorie_id, categories.name, partners.description, partners.ville, 
    partners.adresse, partners.logo_path, partners.created_at, users.id, users.email, 
    users.full_name, users.phone_number, users.password, users.type, users.is_member,
    membership_types.name, membership_types.description, membership_types.price;
" ;
    $results = $this->query($query);
    return $results ? $results : null;
  }


  public function deletePartner($partner_id)
{
    $query = "DELETE FROM partners WHERE id = :partner_id";
    $data = ['partner_id' => $partner_id];
    return $this->query($query, $data);
   
}




}
