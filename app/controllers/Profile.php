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
        $view->header($sessionData);
        $view->myProfile($profile);
        $view->foot();
        $view->footer();
    }
}
