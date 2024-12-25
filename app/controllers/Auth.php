
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