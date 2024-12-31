<?php

class Membership
{
    
    use Controller;
    
    private $membershipModel;

    public function __construct() {
        $this-> membershipModel = new MembershipModel();
    }
    public function showSubscribePage()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->header($sessionData);
        $memberships= $this ->membershipModel->getMemberships();
        $view->Memberships($memberships);
        $view->foot();
        $view->footer();
    }

    public function showMembershipForm()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view ->displaySessionMessage();
        $view->header($sessionData);
        $view->MembershipForm($sessionData);
        $view->foot();
        $view->footer();
    }

    public function showMembershipCard($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $membershipCard = $this ->membershipModel->getMembershipCard($id);
        $view->Head();
        $view->header($sessionData);
        $view->MembershipCard($membershipCard);
        $view->foot();
        $view->footer();
    }

    public function showMembers()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
            header('Location: /ElMountada/auth/showLoginPage'); 
            exit();
        }
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $members = $this ->membershipModel->getMembershipDetails();
        $view->Head();
        $view->header($sessionData);
        $view->displayMembers($members);
        $view->foot();
        $view->footer();
    }








    public function handleMembershipRequest($id)
    {
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = './public/uploads/';
            
            $photos = $this->handleFileUpload($_FILES['photo'], $uploadDir);
            $identity = $this->handleFileUpload($_FILES['identity'], $uploadDir);
            $receipt = $this->handleFileUpload($_FILES['receipt'], $uploadDir);
            
            if ($photos && $identity && $receipt) {
                $membershipData = [
                    'user_id' => $_SESSION['user_id'],
                    'status' => 'inactive',
                    'idpiece' => $identity,
                    'recu' => $receipt,
                    'secteurRemise' => 'default',
                    'membership_date' => date('Y-m-d'),
                    'billing_date' => date('Y-m-d'),
                    'QrCode' => uniqid('QR_'),
                    'membership_type_id' => 1
                ];
                
                if ($this->membershipModel->MembershipRequest($membershipData)) {
                    $_SESSION['success'] = "Votre demande d'adhésion a été envoyée avec succès";
                    header('Location: /dashboard');
                    exit;
                }
            }
            
            $_SESSION['error'] = "Erreur lors de l'envoi des fichiers";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    private function handleFileUpload($file, $directory) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        
        $filename = uniqid() . '_' . basename($file['name']);
        $path = $directory . $filename;
        
        return move_uploaded_file($file['tmp_name'], $path) ? $path : false;
    }






    
}
