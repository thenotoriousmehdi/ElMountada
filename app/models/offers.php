<?php
require_once("server/db.php");
class Offers {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

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
    LIMIT 10;
";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
