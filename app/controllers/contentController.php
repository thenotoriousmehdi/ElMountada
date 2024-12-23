<?php

require_once 'app/models/content.php';
require_once 'app/views/content.php';

class ContentController {
    private $contenuModel;
    private $contenuView;

    public function __construct() {
        $db = (new Database())->connectDb();
        $this->contenuModel = new ContentModel($db);
        $this->contenuView = new Content();
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
        $upload =  $this ->contenuView->addContent();
        return $upload;    
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
                header('Location: /news');
                exit;
            } else {
                throw new Exception('Failed to create entry');
            }

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /news/create');
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
