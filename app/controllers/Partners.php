<?php


class Partners
{
   use Controller;
   use Database;
    private $partnerModel;
    private $partnersView;
    public function __construct()
    {
        $this->partnerModel = new PartnersModel(); 
    }

  
    public function showCatalogue()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('partners');
        $view = new PartnersView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view ->displaySessionMessage();
        $view->header($sessionData); 
        $partnersH = $this->partnerModel->getAllPartnersByCategory(1);  
        $partnersC = $this->partnerModel->getAllPartnersByCategory(2);  
        $partnersE = $this->partnerModel->getAllPartnersByCategory(3);  
        $partnersA = $this->partnerModel->getAllPartnersByCategory(4);  
        $view->showPartnersByCategory("Hôtels", $partnersH);
        $view->showPartnersByCategory("Cliniques", $partnersC);
        $view->showPartnersByCategory("Ecoles", $partnersE);
        $view->showPartnersByCategory("Agences de voyages", $partnersA);
        $view->foot();
        $view->footer();
    }


    public function showPartnerDetails($partnerId)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $partner = $this->partnerModel->getPartnerDetails($partnerId);
    if ($partner) {
        $this->View('partners');
        $view = new PartnersView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->header($sessionData); 
        $view->PartnerDetails($partner);
        $view->foot();
        $view->footer();
    } else {
        echo "Partner not found.";
    }
}

    public function showPartnerCard($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('partners');
        $view = new PartnersView();
        $sessionData = $this->getSessionData();
        $partnerCard = $this ->partnerModel->getPartnerCard($id);
        $view->Head();
        $view->header($sessionData);
        $view->PartnerCard($partnerCard);
        $view->foot();
        $view->footer();
    }

    public function showPartners()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
            header('Location: /ElMountada/auth/showLoginPage'); 
            exit();
        }

        $this->View('partners');
        $view = new PartnersView();
        $sessionData = $this->getSessionData();
        $partners = $this ->partnerModel ->getAllPartners();
       
        $view->Head();
        $view ->displaySessionMessage();
        $view->header($sessionData);
        $view->Partners( $partners);
        $view->foot();
        $view->footer();
    }


    public function deletePartner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['partner_id'])) {
                $partner_id = $_POST['partner_id']; 
            
                $success =  $this->partnerModel->deletePartner($partner_id);
            
                if ($success) {
                    $_SESSION['status'] = "Le partenaire a été supprimé avec success";
                    $_SESSION['status_type'] = 'success';
                    header('Location: /ElMountada/partners/showPartners');
                    exit();
                } else {
                    $_SESSION['status'] = "La suppression a échoué";
                    $_SESSION['status_type'] = 'error';
                    header('Location: /ElMountada/partners/showPartners');
                    exit();
                }
            }
        }
    }



public function filterPartners()
{
    $cities = $this->partnerModel->getAllCities();
    $this->partnersView->displayFilterForm($cities);

    if(isset($_POST['filter_submit'])) {
        $categorie = $_POST['categorie'] ?? '';
        $ville = $_POST['ville'] ?? '';
        
        if(!empty($ville)) {
            $partners = $this->partnerModel->getPartnersByVille($ville);
            $this->partnersView->PartnerSection("Partenaires à " . $ville, $partners);
            return; 
        }
    
    }
}
 

public function showAddPartner(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
        header('Location: /ElMountada/auth/showLoginPage'); 
        exit();
    }

    $this->View('partners');
    $view = new PartnersView();
    $sessionData = $this->getSessionData();
    $partners = $this ->partnerModel ->getAllPartners();
    $view->Head();
    $view ->displaySessionMessage();
    $view->header($sessionData);
    $view->addPartner();
    $view->foot();
    $view->footer();

}

public function handleAddPartner() {
    // Start session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Validate required fields
            if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['phone_number']) || empty($_POST['password']) || empty($_POST['partner_categorie'])) {
                throw new Exception("Tous les champs sont requis.");
            }

            // Prepare data
            $data = [
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'phone_number' => $_POST['phone_number'],
                'password' => $_POST['password'],
                'partner_categorie' => $_POST['partner_categorie'],
                'ville' => $_POST['ville'] ?? null,
                'adresse' => $_POST['adresse'] ?? null,
                'description' => $_POST['description'] ?? null,
                'logo_path' => null
            ];

            // Handle file upload
            if (!empty($_FILES['logo']['name']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $data['logo_path'] = $this->handleImageUpload($_FILES['logo']);
            }

            // Insert into users table
            $userQuery = "INSERT INTO users (email, full_name, phone_number, password, type, is_member) 
                          VALUES (:email, :name, :phone, :password, 'partner', 0)";

            $userData = [
                ':email' => $data['email'],
                ':name' => $data['name'],
                ':phone' => $data['phone_number'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ];

            $userInsert = $this->query($userQuery, $userData);

            if ($userInsert) {
                // Get the last inserted user ID
                $conn = $this->connectDb();
                $userId = $conn->lastInsertId();
                $this->disconnectDb($conn);

                // Insert into partners table
                $partnerQuery = "INSERT INTO partners (id, categorie_id, description, ville, adresse, logo_path) 
                                 VALUES (:id, :categorie_id, :description, :ville, :adresse, :logo_path)";

                $partnerData = [
                    ':id' => $userId, 
                    ':categorie_id' => $data['partner_categorie'],
                    ':description' => $data['description'],
                    ':ville' => $data['ville'],
                    ':adresse' => $data['adresse'],
                    ':logo_path' => $data['logo_path']
                ];

                $partnerInsert = $this->query($partnerQuery, $partnerData);

                if ($partnerInsert) {
                    $_SESSION['status'] = "Partenaire ajouté avec succès!";
                    $_SESSION['status_type'] = 'success';
                    header('Location: /ElMountada/');
                    exit();
                } else {
                    $_SESSION['status'] = "Échec de l'ajout du partenaire.";
                    $_SESSION['status_type'] = 'error';
                    header('Location: /ElMountada/');
                    exit();
                }
            }

        } catch (Exception $e) {
            $_SESSION['status'] = "Erreur: " . $e->getMessage();
            $_SESSION['status_type'] = 'error';
            header('Location: /ElMountada/');
            exit();
        }
    }
}

// File upload handler
private function handleImageUpload($file) {
    $uploadDir = './public/uploads/partners/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($fileExtension, $allowedExtensions)) {
        throw new Exception('Invalid logo type. Only JPG, JPEG, PNG, GIF are allowed.');
    }

    $fileName = uniqid() . '.' . $fileExtension;
    $filePath = $uploadDir . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        throw new Exception('Failed to upload logo image.');
    }

    return '/ElMountada/public/uploads/partners/' . $fileName;
}



}
