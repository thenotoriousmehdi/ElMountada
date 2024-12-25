<?php

class OffersModel {
  use Database;

    

    public function getAllOffers() {
        $query = "SELECT 
    o.ville, 
    o.establishment, 
    c.name AS categorie, 
    o.reduction, 
    o.membership_type
FROM 
    offers o
JOIN 
    categories c ON o.categorie_id = c.id
ORDER BY 
    o.created_at DESC
";
    $offers = $this->query($query);

        return $offers;
    }

    public function get10Offers() {
        $query = "SELECT 
    o.ville, 
    o.establishment, 
    c.name AS categorie, 
    o.reduction, 
    o.membership_type
FROM 
    offers o
JOIN 
    categories c ON o.categorie_id = c.id
ORDER BY 
    o.created_at DESC
    Limit 10
";
    $offers = $this->query($query);

        return $offers;
    }
}
