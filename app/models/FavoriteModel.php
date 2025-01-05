<?php

class FavoriteModel 
{
    use Database;

    public function addFavorite($user_id, $partner_id)
    {
        $query = "INSERT INTO favorites (user_id, partner_id) VALUES (:user_id, :partner_id)";
        return $this->query($query, [
            'user_id' => $user_id,
            'partner_id' => $partner_id,
        ]);
    }

    public function removeFavorite($userId, $partnerId)
    {
        $query = "DELETE FROM favorites WHERE user_id = :user_id AND partner_id = :partner_id";
        return $this->query($query, ['user_id' => $userId, 'partner_id' => $partnerId]);
    }


    public function getFavoritesByUser($user_id)
    {
        $query = "SELECT partner_id FROM favorites WHERE user_id = :user_id";
        return $this->query($query, ['user_id' => $user_id]);
    }

    public function isFavorite($user_id, $partner_id)
    {
        $query = "SELECT 1 FROM favorites WHERE user_id = :user_id AND partner_id = :partner_id";
        return $this->query($query, ['user_id' => $user_id, 'partner_id' => $partner_id]);
    }
}
