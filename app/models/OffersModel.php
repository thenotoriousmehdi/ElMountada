<?php

class OffersModel {
  use Database;

    

    public function getAllOffers() {
        $query = "SELECT 
    'reduction' AS type,
    r.id AS item_id,
    r.reduction_value AS value,
    NULL AS description,
    u.full_name AS partner_name,
    c.name AS category_name,
    p.logo_path,
    p.ville AS location
FROM 
    reductions r
JOIN 
    partners p ON r.partner_id = p.id
JOIN 
    users u ON p.id = u.id 
JOIN 
    categories c ON p.categorie_id = c.id

UNION ALL

SELECT 
    'special_offer' AS type, 
    so.id AS item_id,
    so.reduction_value AS value,
    so.description AS description,
    u.full_name AS partner_name,
    c.name AS category_name,
    p.logo_path,
    p.ville AS location
FROM 
    special_offers so
JOIN 
    partners p ON so.partner_id = p.id
JOIN 
    users u ON p.id = u.id 
JOIN 
    categories c ON p.categorie_id = c.id

UNION ALL

SELECT 
    'advantage' AS type, 
    a.id AS item_id,
    NULL AS value, 
    a.description AS description,
    u.full_name AS partner_name,
    c.name AS category_name,
    p.logo_path,
    p.ville AS location
FROM 
    advantages a
JOIN 
    partners p ON a.partner_id = p.id
JOIN 
    users u ON p.id = u.id
JOIN 
    categories c ON p.categorie_id = c.id
ORDER BY 
    partner_name, type, item_id
    ";
    
    $offers = $this->query($query);

        return $offers;
    }


    public function get10Offers() {
        $query = "SELECT
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
    membership_types.name, membership_types.description, membership_types.price
    ORDER BY 
    partners.created_at DESC
    Limit 10
";

   return $this->query($query);
    }
}
