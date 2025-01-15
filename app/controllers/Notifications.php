<?php

class Notifications
{
    private $notificationsModel;
    use Controller;
    
   
    public function __construct() {
        $this-> notificationsModel = new NotificationsModel();
    }
    public function showAddNotification()
    {
        $this->startSession();
        $this->View('notifications');
        $view = new NotificationsView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->loadHeader($sessionData);
        $view->addNotifications();
        $view->foot();
        $view->footer();
    }

    
    public function createNotification()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = htmlspecialchars($_POST['title']);
        $message = htmlspecialchars($_POST['message']);
        $this->notificationsModel->createNotification($title, $message);
        $_SESSION['status'] = "Notification ajoutée avec success.";
        $_SESSION['status_type'] = 'success';
        header('Location:' . ROOT . '');
    }
}

}
