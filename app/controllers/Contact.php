
<?php

class Contact {
    private $contactModel;
  
    use Controller;

    public function __construct() {
        $this->contactModel = new ContactModel();
    }

    public function showContactForm() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('Contact');
        $view = new ContactView();

        $sessionData = $this->getSessionData();
        $view->Head();
        $view ->displaySessionMessage();
        $view ->Header( $sessionData);
        $view ->displaySessionMessage();
        $partners = $this -> contactModel ->getPartnerNames();
        $view->ContactForm($partners);
        $view->foot();
        $view ->Footer();
    }
  
    public function handleFormSubmit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $type = $_POST['message_type'] ?? '';
            $message = $_POST['message_content'] ?? '';
            $partnerId = ($type === 'avis') ? ($_POST['partner_id'] ?? null) : null;


           
            if (empty($type) || empty($message)) {
                $_SESSION['status'] = 'Please fill in all required fields.';
                $_SESSION['status_type'] = 'error';
                header('Location: /ElMountada/contact/showContactForm');
                exit;
            }

            $isSaved = $this->contactModel->saveContactMessage($type, $message, $partnerId);

            if ($isSaved) {
                $_SESSION['status']  = 'Your message has been sent successfully!';
                $_SESSION['status_type'] = 'success';
                header('Location: /ElMountada/');
                exit;
            } else {
                $_SESSION['status'] = 'An error occurred. Please try again.';
                $_SESSION['status_type'] = 'error';
                header('Location: /ElMountada/contact/showContactForm');
                exit;
            }
        }
    }

   
    
}
?>