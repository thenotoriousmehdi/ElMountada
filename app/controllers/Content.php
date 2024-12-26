<?php
class Content {
    
    private $contenuModel;
    private $contenuView;
    use Controller;
    use Database;
    public function __construct() {
        $this->contenuModel = new ContentModel();
    }

    
    public function getNews() {
        $News = $this->contenuModel->getNews();
        return $News;
    }

    public function getLatest() {
        $latest = $this->contenuModel->getLatest();
        return $latest;
    }

    public function showAddContent() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
                header("Location: /ElMountada/auth/showLoginPage/");
                exit();
            }
        }
        $sessionData = $this->getSessionData();
        $this->View('content');
        $view = new ContentView();
        $view ->Head();
        $view ->header( $sessionData);
        $view ->addContent();
        $view->footer();
        $view->foot();
    }

    public function showContent() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $sessionData = $this->getSessionData();
        $this->View('content');
        $content = $this->contenuModel->getAllContent();
        $view = new ContentView();
        $view ->Head();
        $view ->header( $sessionData);
        $view ->Content($content);
        $view->footer();
        $view->foot();
    }






     public function store() {
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
                 $_SESSION['success'] = 'Entry created successfully';
                 header('Location: /ElMountada/');
                 exit;
             } else {
                throw new Exception('Failed to create entry');
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
         if (!in_array($data['type'], ['announce', 'nouvelle', 'evenement', 'activite'])) {
             throw new Exception('Invalid type selected');
         }
         if (!empty($data['event_date']) && !strtotime($data['event_date'])) {
             throw new Exception('Invalid event date');
         }
     }


     private function handleImageUpload($file) {
   $uploadDir = './public/uploads/';
         if (!is_dir($uploadDir)) {
             mkdir($uploadDir, 0777, true);
        }

         $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
         $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

         if (!in_array($fileExtension, $allowedExtensions)) {
             throw new Exception('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');
         }

         $fileName = uniqid() . '.' . $fileExtension;
         $filePath = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
             throw new Exception('Failed to upload image');
         }

         return $filePath;
     }
}
?>
