<?php


class NotificationsModel
{
    use Database;



    public function createNotification($title, $message)
    {
        try {

            $userQuery = "SELECT id FROM users";
            $users = $this->query($userQuery);

            if (empty($users)) {
                error_log("No users found.");
                return false;
            }

            foreach ($users as $user) {
                $query = "INSERT INTO notifications (title, message, is_read, is_active, user_id) 
                          VALUES (:title, :message, :is_read, :is_active, :user_id)";
                $data = [
                    ':title' => $title,
                    ':message' => $message,
                    ':is_read' => 0,
                    ':is_active' => 1,
                    ':user_id' => $user->id
                ];


                $this->query($query, $data);
            }

            return true;
        } catch (PDOException $e) {
            error_log("Error in creating notification: " . $e->getMessage());
            return false;
        }
    }






    public function getUnreadNotifications($user_id)
    {
        $query = "SELECT COUNT(*) as unread_count FROM notifications 
                 WHERE user_id = :user_id AND is_read = 0";
        $data = [':user_id' => $user_id];
        $result = $this->query($query, $data);

        if (!empty($result)) {
            return $result[0]->unread_count;
        }
        return 0;
    }

    public function markNotificationsAsRead($user_id)
    {
        $query = "UPDATE notifications SET is_read = 1 
                 WHERE user_id = :user_id AND is_read = 0";
        $data = [':user_id' => $user_id];
        return $this->query($query, $data);
    }

    public function getNotifications($user_id)
    {
        $query = "SELECT * FROM notifications 
                 WHERE user_id = :user_id 
                 ORDER BY created_at DESC";
        $data = [':user_id' => $user_id];
        return $this->query($query, $data);
    }
}
