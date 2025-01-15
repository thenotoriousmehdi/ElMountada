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

  



    public function getFilteredOffers($ville = null, $categoryId = null, $type = null, $sortColumn = null, $sortDirection = 'ASC') {
        $queryReductions = "
        SELECT
            'reduction' AS type,
            r.id AS item_id,
            r.reduction_value AS value,
            NULL AS description,
            u.full_name AS partner_name,
            c.name AS category_name,
            p.logo_path,
            p.ville AS location,
            r.created_at
        FROM
            reductions r
            JOIN partners p ON r.partner_id = p.id
            JOIN users u ON p.id = u.id
            JOIN categories c ON p.categorie_id = c.id";

    $querySpecialOffers = "
        SELECT
            'special_offer' AS type,
            so.id AS item_id,
            so.reduction_value AS value,
            so.description AS description,
            u.full_name AS partner_name,
            c.name AS category_name,
            p.logo_path,
            p.ville AS location,
            so.created_at
        FROM
            special_offers so
            JOIN partners p ON so.partner_id = p.id
            JOIN users u ON p.id = u.id
            JOIN categories c ON p.categorie_id = c.id";

    $queryAdvantages = "
        SELECT
            'advantage' AS type,
            a.id AS item_id,
            NULL AS value,
            a.description AS description,
            u.full_name AS partner_name,
            c.name AS category_name,
            p.logo_path,
            p.ville AS location,
            a.created_at
        FROM
            advantages a
            JOIN partners p ON a.partner_id = p.id
            JOIN users u ON p.id = u.id
            JOIN categories c ON p.categorie_id = c.id";

    $whereClauses = [];
    $params = [];

    if ($ville) {
        $whereClauses[] = "p.ville = :ville";
        $params[':ville'] = $ville;
    }
    if ($categoryId) {
        $whereClauses[] = "p.categorie_id = :category_id";
        $params[':category_id'] = $categoryId;
    }

    $whereClause = '';
    if (!empty($whereClauses)) {
        $whereClause = " WHERE " . implode(" AND ", $whereClauses);
    }

    $queries = [];
    if (!$type || $type === 'reduction') {
        $queries[] = $queryReductions . $whereClause;
    }
    if (!$type || $type === 'special_offer') {
        $queries[] = $querySpecialOffers . $whereClause;
    }
    if (!$type || $type === 'advantage') {
        $queries[] = $queryAdvantages . $whereClause;
    }
        $sortDirection = strtoupper($sortDirection) === 'DESC' ? 'DESC' : 'ASC';
        
        $allowedSortColumns = [
            'partner_name', 'category_name', 'location', 
            'type', 'value', 'created_at'
        ];
        
        $orderBy = " ORDER BY ";
        if ($sortColumn && in_array($sortColumn, $allowedSortColumns)) {
            $orderBy .= "$sortColumn $sortDirection";
        } else {
            $orderBy .= "created_at DESC"; 
        }
    
        $query = implode(" UNION ALL ", $queries) . $orderBy;
    
        return $this->query($query, $params);
    }
    public function getAllfiltredOffers() {
        return $this->getFilteredOffers(null, null, null);
    }

    public function getAllCities() {
        $query = "SELECT DISTINCT ville FROM partners ORDER BY ville";
        return $this->query($query);
    }

    public function getAllCategories() {
        $query = "SELECT id, name FROM categories ORDER BY name";
        return $this->query($query);
    }

    public function getAllTypes() {
        return [
            'reduction' => 'Réduction',
            'special_offer' => 'Offre spéciale',
            'advantage' => 'Avantage'
        ];
    }

}
