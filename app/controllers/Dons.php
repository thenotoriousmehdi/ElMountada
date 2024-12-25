
<?php

class Dons {
    private $donsModel;
    use Controller;

    public function __construct() {
        $this-> donsModel = new DonsModel();
    }

    public function showDonsPage() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('dons');
        $view = new donsView();
        $categoryCounts = $this -> donsModel->getDonationCategoriesWithCount();
        $donationsRequests = $this -> donsModel ->getDonationsRequests();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->header($sessionData);
        $view->Dons($categoryCounts, $sessionData,  $donationsRequests );
        $view->foot();
        $view->footer();
    }
    
    public function showAddDon() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->View('dons');
     
            $view = new donsView();
            $sessionData = $this->getSessionData();
            $view->Head();
            $view->header($sessionData);
            $view->faireUnDon();
            $view->foot();
            $view->footer();
        }

        public function showRequestDon() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $this->View('dons');
                $view = new donsView();
                $sessionData = $this->getSessionData();
                $view->Head();
                $view->header($sessionData);
                $view->demanderUnDon();
                $view->foot();
                $view->footer();
            }




            public function store() {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
            
                    $data = [
                        'user_id' => $_SESSION['user_id'] ?? null,
                        'somme' => $_POST['somme'] ?? null,
                        'donation_category_id' => $_POST['donation_category_id'] ?? null,
                        'recu' => null,
                        'status' => 'pending'
                    ];
            
                    // Handle file upload first
                    if (!empty($_FILES['recu']['name'])) {
                        $targetDir = './public/uploads/';
                        $targetFile = $targetDir . basename($_FILES['recu']['name']);
                        if (!file_exists($targetDir)) {
                            mkdir($targetDir, 0755, true);
                        }
        
                        if (move_uploaded_file($_FILES['recu']['tmp_name'], $targetFile)) {
                            $data ['recu'] = $targetFile;
                        }
                    }
            
                    try {

                        if (empty($data['user_id']) || empty($data['somme']) || empty($data['donation_category_id'])) {
                            echo "Tous les champs obligatoires doivent être remplis.";
                            return;
                        }
            
                        $success = $this->donsModel->addDonation($data);
                        
                        if ($success) {
                            header('Location: /ElMountada/dons/showDonsPage/');
                            exit();
                        } else {
                            echo "Une erreur s'est produite lors de l'ajout de la donation.";
                        }
                    } catch (Exception $e) {
                        echo "Erreur: " . $e->getMessage();
                    }
                }
            }


    public function storeRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

        
            $user_id = $_SESSION['user_id'] ?? null;

            if (!$user_id) {
                header('Location: /ElMountada/auth/showLoginPage');
                exit();
            }

            // Get form data
            $name = $_POST['name'] ?? null;
            $dob = $_POST['dob'] ?? null;
            $aid_type = $_POST['aid_type'] ?? null;
            $description = $_POST['description'] ?? null;
            $document = null;

            if (!empty($_FILES['document']['name'])) {
                $targetDir = './public/uploads/';
                $targetFile = $targetDir . basename($_FILES['document']['name']);
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                if (move_uploaded_file($_FILES['document']['tmp_name'], $targetFile)) {
                    $document = $targetFile;
                }
            }

            if ($name && $dob && $aid_type && $description ) {
                
                $success = $this->donsModel->addDonationRequest($user_id, $name, $dob, $aid_type,  $description, $document);
                var_dump($success);
                if ($success) {
                    header('Location: /ElMountada/dons/showDonsPage/');
                    exit();
                } else {
                    echo  "Une erreur s'est produite lors de l'ajout de la demande de don.";
        
                }
            } else {
                echo "Veuillez remplir tous les champs obligatoires.";
            }
        }
    }
  
}
?>