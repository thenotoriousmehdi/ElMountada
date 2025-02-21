
<?php

class Contact
{
    private $contactModel;

    use Controller;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    public function showContactForm()
    {

        $this->startSession();
        $this->View('Contact');
        $view = new ContactView();

        $sessionData = $this->getSessionData();
        $view->Head();
        $view->displaySessionMessage();
        $view->loadHeader($sessionData);
        $partners = $this->contactModel->getPartnerNames();
        $view->ContactForm($partners);
        $view->footer();
        $view->foot();
    }


    public function showMessagesPage()
    {

        $this->startSession();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
            header('Location:' . ROOT . '/auth/showLoginPage');
            exit();
        }

        $this->View('Contact');
        $view = new ContactView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->displaySessionMessage();
        $view->loadHeader($sessionData);
        $view->displaySessionMessage();
        $messages = $this->contactModel->getMessages();
        $view->MessagesPage($messages);
        $view->footer();
        $view->foot();
    }



    public function handleFormSubmit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $type = $_POST['message_type'] ?? '';
            $message = $_POST['message_content'] ?? '';
            $partnerId = ($type === 'avis') ? ($_POST['partner_id'] ?? null) : null;



            if (empty($type) || empty($message)) {
                $this->startSession();
                $_SESSION['status'] = 'Please fill in all required fields.';
                $_SESSION['status_type'] = 'error';
                header('Location:' . ROOT . '/contact/showContactForm');
                exit;
            }

            $isSaved = $this->contactModel->saveContactMessage($type, $message, $partnerId);

            if ($isSaved) {
                $this->startSession();
                $_SESSION['status']  = 'Votre message a bien été envoyé!';
                $_SESSION['status_type'] = 'success';
                header('Location:' . ROOT . '/');
                exit;
            } else {
                $this->startSession();
                $_SESSION['status'] = 'An error occurred. Please try again.';
                $_SESSION['status_type'] = 'error';
                header('Location:' . ROOT . '/contact/showContactForm');
                exit;
            }
        }
    }
}
?>