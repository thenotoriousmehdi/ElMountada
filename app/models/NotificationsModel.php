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

    $this->query($query, $data);
}





}
?>
