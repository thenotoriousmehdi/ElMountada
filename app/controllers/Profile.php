<?php

class Profile
{
    private $userModel;
    use Controller;
    
    public function __construct()
    {
        $this-> userModel = new UserModel();
    }

    public function showProfilePage($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('profile');
        $view = new ProfileView();
        $sessionData = $this->getSessionData();
        $profile = $this ->userModel-> getProfile($id);
        $view->Head();
        $view ->displaySessionMessage();
        $view->header($sessionData);
        $view->myProfile($profile);
        $view->foot();
        $view->footer();
    }

    public function updateProfile() 
    {if (session_status() == PHP_SESSION_NONE) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /ElMountada/auth/showLoginPage/");
            exit();
        }
    }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sessionData = $this->getSessionData();
            $id = $sessionData['user_id'];
            $fullName = trim($_POST['full_name']);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $phoneNumber = trim($_POST['phone_number']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die('Invalid email format.');
            }

            $result = $this->userModel->modifierProfile($id, $fullName, $email, $phoneNumber);

            if ($result) {
               $_SESSION['status'] = "Profil modifie avec success";
                header('Location: /ElMountada/profile/showProfilePage?id=' . $id);
                exit();
            } else {
                die('Failed to update profile.');
            }
        }
    }


    public function updatePassword() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /ElMountada/auth/showLoginPage/");
                exit();
            }
        }

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            

            $sessionData = $this->getSessionData();
            $id = $sessionData['user_id']; 
            $currentPassword = trim($_POST['current_password']);
            $newPassword = trim($_POST['new_password']);
            $confirmPassword = trim($_POST['confirm_password']);

            if (strlen($newPassword) < 6) {
                die('New password must be at least 6 characters long.');
            }

            if ($newPassword !== $confirmPassword) {
                die('New passwords do not match.');
            }
        

            if (!$this->userModel->verifyPassword($id, $currentPassword)) {
                die('Current password is incorrect.');
            }

            $result = $this->userModel->updatePassword($id, $newPassword);
            if ($result) {
            $_SESSION['status'] = "Mot de passe modifier avec success";
                header('Location: /ElMountada/profile/showProfilePage?id=' . $id);
                exit();
            } else {
                die('Failed to update password.');
            }
        }
    }


}
