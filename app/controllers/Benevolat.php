<?php

class benevolat
{
     use Controller;
    

     private $contentModel;

    public function __construct() {
        $this-> contentModel = new ContentModel();
    }


    public function ShowBenevolat() 
    {
        $this->startSession();

        $sessionData = $this->getSessionData();
        $content = $this -> contentModel -> getBenevolat();
        $this->View('benevolat');
        $view = new BenevolatView();
    
        $view->Head();
        $view->header($sessionData);
    
        // if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
            $view->Benevolat($content);
        // } else {
        
        // }
    
        $view->footer();
        $view->foot();
    }

    public function Participer()
    {
        $this->startSession();
        if (isset($_POST['content_id'])) {
            $userId = $_SESSION['user_id']; 
            $contentId = $_POST['content_id'];
            $result = $this->contentModel->addParticipation($userId, $contentId);
            if ($result) {
                $_SESSION['status'] = "Participation enregistrée avec success !";
                $_SESSION['status_type'] = 'success';
            } else {
                $_SESSION['status'] = "La participation a échoué";
                $_SESSION['status_type'] = 'error';
            }
            header('Location: /ElMountada/content/showDetails?id=' . $contentId);
            exit;
        }
        header('Location: /ElMountada/content/index');
        exit;
    }
}
