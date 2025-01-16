
<?php

class Auth
{
    private $userModel;
    private $authView;
    use Controller;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function showLoginPage()
    {
        $this->View('auth');
        $view = new AuthView();
        $view->Head();
        $view->displaySessionMessage();
        $view->login();
        $view->foot();
    }


    public function showSignUpPage()
    {
        $this->View('auth');
        $view = new AuthView();
        $view->Head();
        $view->displaySessionMessage();
        $view->signup();
        $view->foot();
    }

    
    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $user = $this->userModel->getUserByEmail($email);

            if ($user) {
                if ($user->Active != 1) {
                    session_start();
                    $_SESSION['status'] = "Votre compte est bloqué. Veuillez contacter le support.";
                    $_SESSION['status_type'] = 'error';
                    header("Location:" . ROOT . "/auth/showLoginPage");
                    exit();
                }

                if ($user && password_verify($password, $user->password)) {
                    session_start();
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_type'] = $user->type;
                    unset($_SESSION['status']);
                    header("Location:" . ROOT . "/");
                    exit();
                }
            }

            session_start();
            $_SESSION['status'] = "Mot de passe ou email incorrect";
            $_SESSION['status_type'] = 'error';
            header("Location:" . ROOT . "/auth/showLoginPage");
            exit();
        }
    }


    public function handleSignup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $fullName = htmlspecialchars($_POST['full_name'], ENT_QUOTES, 'UTF-8');
            $phoneNumber = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');

            if ($password !== $confirmPassword) {
                $_SESSION['status'] = "Mots de passe incoherents";
                $_SESSION['status_type'] = 'error';
                $this->showSignUpPage();
                return;
            }


            $existingUser = $this->userModel->getUserByEmail($email);
            if ($existingUser) {
                $_SESSION['status'] = "Email deja utilise";
                $_SESSION['status_type'] = 'error';
                $this->showSignUpPage();
                return;
            }

            $success = $this->userModel->createUser($email, $password, $fullName, $phoneNumber);

            if ($success) {
                $this->startSession();
                $_SESSION['status'] = "Votre compte est crée avec success";
                $_SESSION['status_type'] = 'success';
                header("Location:" . ROOT . "/auth/showLoginPage");
                exit();
            }
        }
    }


    public function handleLogout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION = array();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            }

            session_destroy();

            header("Location:" . ROOT . "");
            exit();
        }
    }
}
?>