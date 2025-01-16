<?php


class NotificationsModel {
    use Database;



    public function createNotification($title, $message)
{
    $query = "INSERT INTO notifications (title, message) VALUES (:title, :message)";
    $data = [
        ':title' => $title,
        ':message' => $message
    ];

   return  $this->query($query, $data);
}

public function getNotifications()
    {
        $query = "SELECT * FROM notifications ORDER BY created_at DESC";
        return $this->query($query);
    }


    public function getUnreadNotificationsCount()
    {
        $query = "SELECT COUNT(*) FROM notifications WHERE is_read = 0";
        return $this->query($query);
    }



}
?>
