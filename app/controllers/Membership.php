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
}
