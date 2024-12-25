
<?php

class Auth {
    private $userModel;
    private $authView;
    use Controller;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function showLoginPage() {
        $this->View('auth');
        $view = new AuthView();
        $view->Head();
        $view->login();
        $view->foot();
    }
    public function showSignUpPage() {
        $this->View('auth');
        $view = new AuthView();
        $view->Head();
        $view->signup();
        $view->foot();
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $user = $this->userModel->getUserByEmail($email);
            if ($user && password_verify($password, $user->password)) {
                session_start();
                echo "Session started!<br>";
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_type'] = $user->type;
                header("Location: /ElMountada/");
                exit();
            } else {
                echo "<p>Invalid email or password.</p>";
            }
        }
    }

    public function handleSignup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $fullName = htmlspecialchars($_POST['full_name'], ENT_QUOTES, 'UTF-8');  
            $phoneNumber = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');  

            if ($password !== $confirmPassword) {
                $errorMessage = "Passwords do not match.";
                $this->showSignUpPage();
                return;
            }

    
            $existingUser = $this->userModel->getUserByEmail($email);
            if ($existingUser) {
                $errorMessage = "Email is already in use.";
                $this->showSignUpPage();
                return;
            }

            $this->userModel->createUser($email, $password, $fullName, $phoneNumber);

        
            header("Location: /ElMountada/auth/showLoginPage");
            exit();
        }
    }


    public function handleLogout() {
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
    
            header("Location: /ElMountada");
            exit();
        }
    }
    
    
}
?>