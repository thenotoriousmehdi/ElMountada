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

    public function addPartner($data)
    {
        try {
            $userQuery = "INSERT INTO users (email, full_name, phone_number, password, type, is_member) 
                     VALUES (:email, :name, :phone, :password, 'partner', 0)";

            $userData = [
                ':email' => $data['email'],
                ':name' => $data['name'],
                ':phone' => $data['phone_number'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ];
            if (!$this->query($userQuery, $userData)) {
                error_log("Failed to insert into users table");
                return false;
            }
            $getUserIdQuery = "SELECT id FROM users WHERE email = :email LIMIT 1";
            $userResult = $this->query($getUserIdQuery, [':email' => $data['email']]);

            if (empty($userResult)) {
                error_log("Failed to retrieve user ID from users table");
                return false;
            }

            $userId = $userResult[0]->id;
            $partnerQuery = "INSERT INTO partners (id, categorie_id, description, ville, adresse, logo_path) 
                        VALUES (:id, :categorie_id, :description, :ville, :adresse, :logo_path)";

            $partnerData = [
                ':id' => $userId,
                ':categorie_id' => $data['partner_categorie'],
                ':description' => $data['description'] ?? null,
                ':ville' => $data['ville'] ?? null,
                ':adresse' => $data['adresse'] ?? null,
                ':logo_path' => $data['logo_path'] ?? null
            ];

            $partnerInsert = $this->query($partnerQuery, $partnerData);

            if (!$partnerInsert) {
                error_log("Failed to insert into partners table. User ID: " . $userId);
                return false;
            }

            return true;
        } catch (Exception $e) {
            error_log("Error in addPartner: " . $e->getMessage());
            return false;
        }
    }



    public function getFilteredPartners($ville = null, $categoryId = null)
    {
        $query = "SELECT 
        partners.id AS partner_id,
        partners.categorie_id,
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
        users ON users.id = partners.id AND users.type = 'partner' ";
        $params = [];

        if ($ville) {
            $query .= " AND ville = :ville";
            $params[':ville'] = $ville;
        }

        if ($categoryId) {
            $query .= " AND categorie_id = :category_id";
            $params[':category_id'] = $categoryId;
        }

        return $this->query($query, $params);
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

        $results = $this->query($query, [':categorie_id' => $categorieId]);
        return $results;
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
    partners.id = :id";

        $data = [':id' => $id];
        $results = $this->query($query, $data);
        return $results ? $results[0] : null;
    }




    public function deletePartner($partner_id)
    {
        $query = "DELETE FROM partners WHERE id = :partner_id";
        $data = ['partner_id' => $partner_id];
        return $this->query($query, $data);
    }

    public function getPartnerDetails($partnerId)
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
    membership_types.price AS membership_type_price,

    GROUP_CONCAT(DISTINCT special_offers.reduction_value ORDER BY special_offers.reduction_value) AS special_offer_reductions,
    GROUP_CONCAT(DISTINCT special_offers.description ORDER BY special_offers.reduction_value) AS special_offer_descriptions,
    GROUP_CONCAT(DISTINCT special_offers.end_date ORDER BY special_offers.reduction_value) AS special_offer_end_dates,
    GROUP_CONCAT(DISTINCT special_offer_membership.name ORDER BY special_offers.reduction_value) AS special_offer_membership_types

FROM
    partners

JOIN users ON users.id = partners.id AND users.type = 'partner'

JOIN categories ON categories.id = partners.categorie_id

LEFT JOIN reductions ON reductions.partner_id = partners.id

LEFT JOIN advantages ON advantages.partner_id = partners.id
LEFT JOIN membership_types AS reduction_membership ON reduction_membership.id = reductions.membership_type_id
LEFT JOIN membership_types AS advantage_membership ON advantage_membership.id = advantages.membership_type_id
LEFT JOIN membership_types ON membership_types.id = partners.categorie_id

LEFT JOIN special_offers ON special_offers.partner_id = partners.id
LEFT JOIN membership_types AS special_offer_membership ON special_offer_membership.id = special_offers.membership_type_id

WHERE partners.id = :partner_id

GROUP BY
    partners.id, partners.categorie_id, categories.name, partners.description, partners.ville, 
    partners.adresse, partners.logo_path, partners.created_at, users.id, users.email, 
    users.full_name, users.phone_number, users.password, users.type, users.is_member,
    membership_types.name, membership_types.description, membership_types.price;


";

        $data = [':partner_id' => $partnerId];
        $results = $this->query($query, $data);

        return $results ? $results[0] : null;
    }



    public function getAllVilles()
    {
        $query = "SELECT DISTINCT ville FROM partners";
        return $this->query($query);
    }

    public function filterPartners($ville = null, $categorie = null)
    {
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
      LEFT JOIN membership_types ON membership_types.id = partners.categorie_id";

        $conditions = [];
        $data = [];

        if ($ville) {
            $conditions[] = "partners.ville LIKE :ville";
            $data[':ville'] = '%' . $ville . '%';
        }

        if ($categorie) {
            $conditions[] = "categories.name LIKE :categorie";
            $data[':categorie'] = '%' . $categorie . '%';
        }

        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }


        $query .= " GROUP BY
          partners.id, partners.categorie_id, categories.name, partners.description, partners.ville, 
          partners.adresse, partners.logo_path, partners.created_at, users.id, users.email, 
          users.full_name, users.phone_number, users.password, users.type, users.is_member,
          membership_types.name, membership_types.description, membership_types.price";

        $results = $this->query($query, $data);
        return $results ? $results : null;
    }
    public function getAllCategories()
    {
        $query = "SELECT DISTINCT name FROM categories";
        return $this->query($query);
    }

    public function getPartnerById($id)
    {
        try {
            $query = "SELECT u.*, p.* 
                 FROM users u 
                 JOIN partners p ON u.id = p.id 
                 WHERE u.id = :id AND u.type = 'partner'";

            $result = $this->query($query, [':id' => $id]);
            return !empty($result) ? $result[0] : null;
        } catch (Exception $e) {
            error_log("Error in getPartnerById: " . $e->getMessage());
            return null;
        }
    }




    public function updatePartner($data)
    {
        try {
            $userQuery = "UPDATE users SET 
                     email = :email, 
                     full_name = :name, 
                     phone_number = :phone";

            $userData = [
                ':email' => $data['email'],
                ':name' => $data['name'],
                ':phone' => $data['phone_number'],
                ':id' => $data['id']
            ];

            if (isset($data['password'])) {
                $userQuery .= ", password = :password";
                $userData[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            $userQuery .= " WHERE id = :id";

            if (!$this->query($userQuery, $userData)) {
                error_log("Failed to update user data");
                return false;
            }

            $partnerQuery = "UPDATE partners SET 
                        categorie_id = :categorie_id,
                        description = :description,
                        ville = :ville,
                        adresse = :adresse";

            $partnerData = [
                ':id' => $data['id'],
                ':categorie_id' => $data['partner_categorie'],
                ':description' => $data['description'],
                ':ville' => $data['ville'],
                ':adresse' => $data['adresse']
            ];

            if (isset($data['logo_path'])) {
                $partnerQuery .= ", logo_path = :logo_path";
                $partnerData[':logo_path'] = $data['logo_path'];
            }

            $partnerQuery .= " WHERE id = :id";

            if (!$this->query($partnerQuery, $partnerData)) {
                error_log("Failed to update partner data");
                return false;
            }

            return true;
        } catch (Exception $e) {
            error_log("Error in updatePartner: " . $e->getMessage());
            return false;
        }
    }


    public function addReduction($partnerId, $membershipTypeId, $reductionValue)
    {
        $query = "INSERT INTO reductions (partner_id, membership_type_id, reduction_value) 
              VALUES (:partner_id, :membership_type_id, :reduction_value)";

        $data = [
            ':partner_id' => $partnerId,
            ':membership_type_id' => $membershipTypeId,
            ':reduction_value' => $reductionValue
        ];

        if (!$this->query($query, $data)) {
            error_log("Failed to insert into reductions table");
            return false;
        }
        return true;
    }

    public function addAdvantage($partnerId, $membershipTypeId, $description)
    {
        $query = "INSERT INTO advantages (partner_id, membership_type_id, description) 
              VALUES (:partner_id, :membership_type_id, :description)";

        $data = [
            ':partner_id' => $partnerId,
            ':membership_type_id' => $membershipTypeId,
            ':description' => $description
        ];

        if (!$this->query($query, $data)) {
            error_log("Failed to insert into advantages table");
            return false;
        }
        return true;
    }

    public function addSpecialOffer($partnerId, $membershipTypeId, $reductionValue, $description, $endDate)
    {
        $query = "INSERT INTO special_offers (partner_id, membership_type_id, reduction_value, description, end_date) 
              VALUES (:partner_id, :membership_type_id, :reduction_value, :description, :end_date)";

        $data = [
            ':partner_id' => $partnerId,
            ':membership_type_id' => $membershipTypeId,
            ':reduction_value' => $reductionValue,
            ':description' => $description,
            ':end_date' => $endDate
        ];

        if (!$this->query($query, $data)) {
            error_log("Failed to insert into special_offers table");
            return false;
        }
        return true;
    }


    public function getPartners()
    {
        $query  = "SELECT id, full_name FROM users WHERE type = 'partner'";
        return $this->query($query);
    }
    public function getAllMembershipTypes()
    {
        $query  = "SELECT id, name FROM membership_types";
        return $this->query($query);
    }

    public function deleteItem($type, $id) {
        $table = $this->getTableName($type);
        $query = "DELETE FROM $table WHERE id = :id";
        return $this->query($query, [':id' => $id]);
    }

    public function updateItem($type, $id, $data) {
        $table = $this->getTableName($type);
        $column = ($type === 'reduction') ? 'reduction_value' : 'description';
        $query = "UPDATE $table SET $column = :value WHERE id = :id";
        return $this->query($query, [':value' => $data['value'], ':id' => $id]);
    }

    private function getTableName($type) {
        switch ($type) {
            case 'reduction':
                return 'reductions';
            case 'advantage':
                return 'advantages';
            case 'special_offer':
                return 'special_offers';
            default:
                throw new Exception('Invalid type');
        }
    }





}
