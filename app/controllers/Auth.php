<?php

class Auth
{
    private $authView;
    use Controller;
    use Database;
    
    // Show login page
    public function showLoginPage()
    {
        $db = $this->connectDb();  // Database connection
        $this->View('auth');
        $view = new AuthView();
        $view->Head();
        $view->login();
        $view->foot();
    }

    // Handle login process
    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get user inputs
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Connect to the database
            $db = $this->connectDb();
    
            // Prepare the query to find the user by email
            $stmt = $db->prepare("SELECT id, password, type FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            // Fetch the user from the database
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                // Successful login
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $user['type'];
                header("Location: /ElMountada/offers/showOffers"); // Update this to your desired page
                exit();
            } else {
                // Invalid login
                echo "Invalid email or password.";
            }
        }
    }
    

    // Handle logout process
    public function handleLogout()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start(); // Start the session if not already active
        }

        // Destroy the session to log the user out
        session_destroy();

        // Redirect to the homepage or login page after logout
        header("Location: index.php?action=home");
        exit;
    }

    // Redirect user based on their type
   
}
?>
