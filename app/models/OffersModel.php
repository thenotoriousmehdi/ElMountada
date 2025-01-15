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
    p.ville AS location,
    r.created_at AS created_at 
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
    p.ville AS location,
    so.created_at AS created_at 
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
    p.ville AS location,
    a.created_at AS created_at 
FROM 
    advantages a
JOIN 
    partners p ON a.partner_id = p.id
JOIN 
    users u ON p.id = u.id
JOIN 
    categories c ON p.categorie_id = c.id
ORDER BY 
    created_at DESC ";
    
    $offers = $this->query($query);

        return $offers;
    }


    public function get10Offers() {
        $query = "SELECT 
    'reduction' AS type,
    r.id AS item_id,
    r.reduction_value AS value,
    NULL AS description,
    u.full_name AS partner_name,
    c.name AS category_name,
    p.logo_path,
    p.ville AS location,
    r.created_at AS created_at 
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
    p.ville AS location,
    so.created_at AS created_at 
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
    p.ville AS location,
    a.created_at AS created_at 
FROM 
    advantages a
JOIN 
    partners p ON a.partner_id = p.id
JOIN 
    users u ON p.id = u.id
JOIN 
    categories c ON p.categorie_id = c.id
ORDER BY 
    created_at DESC
    Limit 10
";

   return $this->query($query);
    }
}
