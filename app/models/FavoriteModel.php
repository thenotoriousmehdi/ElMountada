<?php

class FavoriteModel 
{
    use Database;

    public function addFavorite($user_id, $partner_id)
    {

        $queryCheck = "SELECT COUNT(*) as count FROM favorites WHERE user_id = :user_id AND partner_id = :partner_id";
        $result = $this->query($queryCheck, [
            'user_id' => $user_id,
            'partner_id' => $partner_id,
        ]);
    
        if ($result[0]->count == 0) {
            $queryInsert = "INSERT INTO favorites (user_id, partner_id) VALUES (:user_id, :partner_id)";
            return $this->query($queryInsert, [
                'user_id' => $user_id,
                'partner_id' => $partner_id,
            ]);
        }
    
        
        return false;
    }
    
    public function getFavoritesByUser($user_id)
    {
        $query = "SELECT u.id AS user_id, u.full_name, u.email, u.phone_number, u.type, u.is_member, u.active, p.id, p.logo_path, p.ville FROM favorites f INNER JOIN partners p ON f.partner_id = p.id INNER JOIN users u ON p.id = u.id WHERE f.user_id = :user_id";
        return $this->query($query, ['user_id' => $user_id]);
    }

    public function removeFavorite($userId, $partnerId)
    {
        $query = "DELETE FROM favorites WHERE user_id = :user_id AND partner_id = :partner_id";
        return $this->query($query, ['user_id' => $userId, 'partner_id' => $partnerId]);
    }

    public function isFavorite($user_id, $partner_id) {
        $query = "SELECT COUNT(*) as count FROM favorites WHERE user_id = :user_id AND partner_id = :partner_id";
        $result = $this->query($query, [
            'user_id' => $user_id,
            'partner_id' => $partner_id
        ]);
        return $result[0]->count > 0;
    }
}
