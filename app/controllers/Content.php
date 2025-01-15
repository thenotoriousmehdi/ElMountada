<?php
class Content {
    
    private $contenuModel;
    private $notificationsModel;
    private $contenuView;
    use Controller;
    use Database;
    public function __construct() {
        $this->contenuModel = new ContentModel();
        $this -> notificationsModel = new NotificationsModel();
    }

    public function showDetails($id)
{
    $this->startSession();
    $content = $this->contenuModel->getById($id);
    $users = $this -> contenuModel -> participants($id);
    $sessionData = $this->getSessionData();
    $this->View('content');
    $view = new ContentView();
    $view ->Head();
    $view ->displaySessionMessage();
    $view->loadHeader($sessionData);
    $view ->ContentDetails($content,   $sessionData, $users);
    $view->footer();
    $view->foot();
}

    
   

    public function showAddContent() {
      
        $this->startSession();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
                header("Location:' . ROOT . '/auth/showLoginPage/");
                exit();
        }
        $sessionData = $this->getSessionData();
        $this->View('content');
        $view = new ContentView();
        $view ->Head();
        $view ->displaySessionMessage();
        $view->loadHeader($sessionData);
        $view ->addContent();
        $view->footer();
        $view->foot();
    }

    public function showContent()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sessionData = $this->getSessionData();
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : null;
        $eventDate = isset($_POST['event_date']) ? $_POST['event_date'] : null;
        $ville = isset($_POST['location']) ? $_POST['location'] : null;
    
        $content = $this->contenuModel->filterContent($title, $type, $eventDate, $ville);
        $villes = $this -> contenuModel->getVilles();
        $this->View('content');
        $view = new ContentView();
    
        $view->Head();
        $view->loadHeader($sessionData);
    
        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
            $view->Content($content);
        } else {
            $view->ContentTable($content, $villes);
        }
    
        $view->footer();
        $view->foot();
    }
    
    public function deleteContent()
    {
        $content_id = $_POST['content_id'] ?? null;

        if ($content_id) {
            $success = $this->contenuModel->deleteContent($content_id);

            if ($success) {
                $_SESSION['status'] = "supprime avec success";
                $_SESSION['status_type'] = 'success';
                header('Location:' . ROOT . '/content/showContent'); 
                exit;
            } else {
                $_SESSION['status'] = "L'operation a échoué.";
                $_SESSION['status_type'] = 'error';
                header('Location:' . ROOT . '/content/showContent'); 
                exit;
            }
           
        }

    }



     public function store() {
        $this->startSession();
        
         try {
             $this->validateInput($_POST);

             $imagePath = null;
             if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                 $imagePath = $this->handleImageUpload($_FILES['image']);
             }

             $data = [
                 'title' => $_POST['title'],
                 'description' => $_POST['description'],
                 'type' => $_POST['type'],
                 'event_date' => !empty($_POST['event_date']) ? $_POST['event_date'] : null,
                 'image_path' => $imagePath,
                 'location' => $_POST['location'] ?? null
             ];

        
             $result = $this->contenuModel->insert($data);
             
             if ($result) {
                $this->startSession();
                $this->notificationsModel->createNotification($_POST['type'], "Un contenu " . $_POST['title'] . " a été ajouté à ElMountada !");
                $_SESSION['status'] = "Contenu ajouter avec success";
                $_SESSION['status_type'] = 'sucess';
                header('Location:' . ROOT . '/accueil/showAccueil');
                 exit;
             } else {
                $_SESSION['status'] = "L'ajout de Contenu a échoué";
                $_SESSION['status_type'] = 'error';
                 header('Location:' . ROOT . '/accueil/showAccueil');
            }

         } catch (Exception $e) {
             $_SESSION['error'] = $e->getMessage();
             header('Location: /content');
             exit;
         }
     }

     private function validateInput($data) {
         if (empty($data['title'])) {
             throw new Exception('Title is required');
         }
         if (empty($data['description'])) {
             throw new Exception('Description is required');
         }
         if (empty($data['type'])) {
             throw new Exception('Type is required');
         }
         if (!in_array($data['type'], ['announce', 'nouvelle', 'evenement', 'activite', 'benevolat'])) {
             throw new Exception('Invalid type selected');
         }
         if (!empty($data['event_date']) && !strtotime($data['event_date'])) {
             throw new Exception('Invalid event date');
         }
     }


     private function handleImageUpload($file) {

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '<?= ROOT ?>/public/uploads/content/';
    
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    
        if (!in_array($fileExtension, $allowedExtensions)) {
            throw new Exception('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');
        }
    

       $fileName = 'content' . uniqid() . '.' . $fileExtension;
        $filePath = $uploadDir . $fileName;
    
    
        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            throw new Exception('Failed to upload image');
        }
    
        return '<?= ROOT ?>/public/uploads/content/' . $fileName;
    }
    

public function showEditContent($contentId) {
   
        $content = $this->contenuModel->getById($contentId);
        $this->View('content');
        $view = new ContentView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->loadHeader($sessionData);
        $view->updateContent($content);
        $view->footer();
        $view->foot();

   
}

public function updateContent() {
    $this->startSession();
    
    try {
        $this->validateInput($_POST);

        $imagePath = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imagePath = $this->handleImageUpload($_FILES['image']);
} else {

    $imagePath = $_POST['existing_image_path'] ?? null;
}

        $data = [
            'id' => $_POST['id'], 
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'type' => $_POST['type'],
            'event_date' => $_POST['event_date'] ?? null,
            'image_path' => $imagePath,
            'location' => $_POST['location']
        ];

        var_dump($_POST);

        $result = $this->contenuModel->update($data);

        if ($result) {
            $this->startSession();
            $_SESSION['status'] = "Contenu mis à jour avec succès";
            $_SESSION['status_type'] = 'success';
            header('Location:' . ROOT . '/content/showContent');
            exit;
        } else {
            $this->startSession();
            $_SESSION['status'] = "La mise à jour du contenu a échoué";
            $_SESSION['status_type'] = 'error';
            header('Location:' . ROOT . '/content/showContent');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location:' . ROOT . '/content/showContent');
        exit;
    }
}

}
?>
