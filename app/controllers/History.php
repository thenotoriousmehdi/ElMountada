
<?php

class History {
    private $historyModel;
    use Controller;

    public function __construct() {
        $this-> historyModel = new HistoryModel();
    }

    

    public function showHistoryPage() {
        $this->startSession();
        $sessionData = $this->getSessionData();
        $user_id = $sessionData['user_id'];
        $this->View('history');
        $view = new HistoryView();
        $mesDons = $this ->historyModel ->getMesdons($user_id);
        $mesBenevolats = $this -> historyModel -> getMesBenevolats($user_id);
        $subscriptions = $this ->historyModel -> getMesPaiements($user_id);
        $view->Head();
        $view->loadHeader($sessionData);
        $view ->MesDons($mesDons);
        $view -> MesBenevolats($mesBenevolats);
        $view -> MesPayments($subscriptions);
        $view->foot();
        $view->footer();
    }
    

}
?>