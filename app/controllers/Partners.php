<?php


class Partners
{
   use Controller;
   use Database;
    private $partnerModel;
    private $membershipModel;
    private $favoriteModel;
    private $partnersView;
    public function __construct()
    {
        $this->partnerModel = new PartnersModel(); 
        $this-> membershipModel = new MembershipModel();
        $this-> favoriteModel = new FavoriteModel();
    }

  
    public function showCatalogue()
    {
        $this->startSession();
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
    $this->startSession();
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

public function showCheckMembers()
{
    $this->startSession();

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'partner') {
        header('Location: /ElMountada/auth/showLoginPage'); 
        exit();
    }
    $sessionData = $this->getSessionData();
    $this->View('partners');
    $view = new PartnersView();
    $view->Head();
    $view->header($sessionData);
    $userData = null;
    $message = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
        $userData = $this->membershipModel->getMembershipCard($_POST['user_id']);
        if (!$userData) {
            $message = 'Aucun membre trouvé avec cet identifiant';
        }
    }
    $view->CheckMembers(['userData' => $userData, 'message' => $message]);
    $view->footer();
    $view->foot();
}

    public function showPartnerCard($id)
    {
        $this->startSession();
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
    $this->startSession();

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
        header('Location: /ElMountada/auth/showLoginPage');
        exit();
    }
    $ville = isset($_POST['ville']) ? $_POST['ville'] : null;
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : null;
    $villes = $this->partnerModel->getAllVilles();
    $categories = $this->partnerModel->getAllCategories();
    $this->View('partners');
    $view = new PartnersView();
    $sessionData = $this->getSessionData();
    $partners = $this->partnerModel->filterPartners($ville, $categorie);
    $view->Head();
    $view->displaySessionMessage();
    $view->header($sessionData);
    $view->Partners($partners, $villes, $categories);
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
                    $this->startSession();
                    $_SESSION['status'] = "Le partenaire a été supprimé avec success";
                    $_SESSION['status_type'] = 'success';
                    header('Location: /ElMountada/partners/showPartners');
                    exit();
                } else {
                    $this->startSession();
                    $_SESSION['status'] = "La suppression a échoué";
                    $_SESSION['status_type'] = 'error';
                    header('Location: /ElMountada/partners/showPartners');
                    exit();
                }
            }
        }
    }




public function showAddPartner(){
    $this->startSession();

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
        header('Location: /ElMountada/auth/showLoginPage'); 
        exit();
    }

    $this->View('partners');
    $view = new PartnersView();
    $sessionData = $this->getSessionData();
    $view->Head();
    $view ->displaySessionMessage();
    $view->header($sessionData);
    $view->addPartner();
    $view->foot();
    $view->footer();

}

public function handleAddPartner() {
    $this->startSession();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            if (empty($_POST['email']) || empty($_POST['name']) || 
                empty($_POST['phone_number']) || empty($_POST['password']) || 
                empty($_POST['partner_categorie'])) {
                throw new Exception("Tous les champs sont requis.");
            }

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

            if (!empty($_FILES['logo']['name']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $data['logo_path'] = $this->handleImageUpload($_FILES['logo']);
            }

            $result = $this->partnerModel->addPartner($data);
            
            if ($result) {
                $this->startSession();
                $_SESSION['status'] = "Partenaire ajouté avec succès!";
                $_SESSION['status_type'] = 'success';
                header('Location: /ElMountada/');
                exit();
            } else {
                throw new Exception("Échec de l'ajout du partenaire.");
            }

        } catch (Exception $e) {
            $this->startSession();
            $_SESSION['status'] = "Erreur: " . $e->getMessage();
            $_SESSION['status_type'] = 'error';
            header('Location: /ElMountada/');
            exit();
        }
    }
}

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


public function updatePartner() {
    $this->startSession();
    
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
        header('Location: /ElMountada/auth/showLoginPage');
        exit();
    }

    $partnerId = $_GET['id'] ?? null;
    if (!$partnerId) {
        $this->startSession();
        $_SESSION['status'] = "ID du partenaire non spécifié";
        $_SESSION['status_type'] = 'error';
        header('Location: /ElMountada/partners/ShowPartners');
        exit();
    }

    $partner = $this->partnerModel->getPartnerById($partnerId);
    if (!$partner) {
        $this->startSession();
        $_SESSION['status'] = "Partenaire non trouvé";
        $_SESSION['status_type'] = 'error';
        header('Location: /ElMountada/partners/ShowPartners');
        exit();
    }

    $this->View('partners');
    $view = new PartnersView();
    $sessionData = $this->getSessionData();
    $view->Head();
    $view->displaySessionMessage();
    $view->header($sessionData);
    $view->updatePartnerForm($partner);
    $view->foot();
    $view->footer();
}

public function handleUpdatePartner() {
    $this->startSession();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            if (empty($_POST['email']) || empty($_POST['name']) || 
                empty($_POST['phone_number']) || empty($_POST['partner_categorie'])) {
                throw new Exception("Tous les champs obligatoires doivent être remplis.");
            }

            $data = [
                'id' => $_POST['partner_id'],
                'email' => $_POST['email'],
                'name' => $_POST['name'],
                'phone_number' => $_POST['phone_number'],
                'partner_categorie' => $_POST['partner_categorie'],
                'ville' => $_POST['ville'] ?? null,
                'adresse' => $_POST['adresse'] ?? null,
                'description' => $_POST['description'] ?? null,
                'logo_path' => null
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }
            if (!empty($_FILES['logo']['name']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $data['logo_path'] = $this->handleImageUpload($_FILES['logo']);
            }

            $result = $this->partnerModel->updatePartner($data);
            if ($result) {
                $this->startSession();
                $_SESSION['status'] = "Partenaire mis à jour avec succès!";
                $_SESSION['status_type'] = 'success';
            } else {
                throw new Exception("Échec de la mise à jour du partenaire.");
            }
        } catch (Exception $e) {
            $this->startSession();
            $_SESSION['status'] = "Erreur: " . $e->getMessage();
            $_SESSION['status_type'] = 'error';
        }
        header('Location: /ElMountada/partners/ShowPartners');
        exit();
    }
}



 public function showAddOffer() {
     $this->startSession();

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
        header('Location: /ElMountada/auth/showLoginPage');
        exit();
    }
    
    $users = $this->partnerModel->getPartners();
    $membershipTypes = $this->partnerModel->getAllMembershipTypes();
    $this->View('partners');
    $view = new PartnersView();
    $sessionData = $this->getSessionData();
    $view->Head();
    $view->displaySessionMessage();
    $view->header($sessionData);
    $view -> addOffer($users, $membershipTypes);
    $view->foot();
    $view->footer();
   

}

public function handleAddOffer() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $partnerId = $_POST['user_id']; 
        $type = $_POST['type']; 
        $membershipTypeId = $_POST['membership_type_id'];

        if ($type === 'reduction') {
            $reductionValue = $_POST['reduction_value'];
            $success = $this->partnerModel->addReduction($partnerId, $membershipTypeId, $reductionValue);
        } elseif ($type === 'advantage') {
            $description = $_POST['description'];
            $success = $this->partnerModel->addAdvantage($partnerId, $membershipTypeId, $description);
        }
        
     
        if ($success) {
            $this->startSession();
            $_SESSION['status'] = 'La remise/avantages a été ajouté avec succes';
            $_SESSION['status_type'] = 'success';
        } else {
            $this->startSession();
            $_SESSION['status'] = 'Failed to add the ' . $type . '. Please try again.';
            $_SESSION['status_type'] = 'error';
        }
        
        header("Location: /ElMountada/partners/showPartners");
        exit();
        
    }
}

}
