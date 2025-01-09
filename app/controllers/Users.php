<?php

class Users
{
     use Controller;
    

     private $usersModel;

    public function __construct() {
        $this-> usersModel = new UserModel();
    }

    public function ShowUsers() 
    {
         $this->startSession();
         $sessionData = $this->getSessionData();
         $type = isset($_POST['type']) ? $_POST['type'] : null;
         $users = $this->usersModel->filteruser( $type);
         $this->View('users');
         $view = new UsersView();
         $view ->Head();
         $view ->displaySessionMessage();
         $view ->header($sessionData);
         $view-> Users($users);
         $view ->footer();    
         $view ->foot();
    }

    public function showProfilePage($id)
    {
        $this->startSession();
        $this->View('profile');
        $view = new ProfileView();
        $sessionData = $this->getSessionData();
        $profile = $this ->usersModel-> getProfile($id);
        $view->Head();
        $view ->displaySessionMessage();
        $view->header($sessionData);
        $view->myProfile($profile);
        $view->foot();
        $view->footer();
    }


    public function updateProfile() 
    {
        $this->startSession();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /ElMountada/auth/showLoginPage/");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['user_id'] ?? null;
            $fullName = trim($_POST['full_name']);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $phoneNumber = trim($_POST['phone_number']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die('Invalid email format.');
            }

            $result = $this->usersModel->modifierProfile($id, $fullName, $email, $phoneNumber);

            if ($result) {
               $_SESSION['status'] = "Profil modifie avec success";
                header('Location: /ElMountada/profile/showProfilePage?id=' . $id);
                exit();
            } else {
                die('Failed to update profile.');
            }
        }
    }


    public function deleteUser()
    {
        $user_id = $_POST['user_id'] ?? null;

        if ($user_id) {
            $success = $this->usersModel->deleteUser($user_id);

            if ($success) {
                $this->startSession();
                $_SESSION['status'] = "utilisateur supprimé avec success";
                $_SESSION['status_type'] = 'success';
                header('Location: /ElMountada/users/ShowUsers'); 
                exit;
            } else {
                $this->startSession();
                $_SESSION['status'] = "L'operation a échoué.";
                $_SESSION['status_type'] = 'error';
                header('Location: /ElMountada/users/ShowUsers'); 
                exit;
            }
           
        }

    }


    public function blockUser()
    {
        $user_id = $_POST['user_id'] ?? null;

        if ($user_id) {
            $success = $this->usersModel->blockUser($user_id);

            if ($success) {
                $this->startSession();
                $_SESSION['status'] = "Uilisateur bloqué avec success";
                $_SESSION['status_type'] = 'success';
                header('Location: /ElMountada/users/ShowUsers'); 
                exit;
            } else {
                $this->startSession();
                $_SESSION['status'] = "L'operation a échoué.";
                $_SESSION['status_type'] = 'error';
                header('Location: /ElMountada/users/ShowUsers'); 
                exit;
            }
           
        }

    }


    public function makeMember()
    {
        $user_id = $_POST['user_id'] ?? null;

        if ($user_id) {
            $success = $this->usersModel->makeMember($user_id);

            if ($success) {
                $this->startSession();
                $_SESSION['status'] = "L'utilisateur est désormais membre";
                $_SESSION['status_type'] = 'success';
                header('Location: /ElMountada/users/ShowUsers'); 
                exit;
            } else {
                $this->startSession();
                $_SESSION['status'] = "L'operation a échoué.";
                $_SESSION['status_type'] = 'error';
                header('Location: /ElMountada/users/ShowUsers'); 
                exit;
            }
           
        }

    }





}
