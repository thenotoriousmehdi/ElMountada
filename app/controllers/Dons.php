
<?php

class Dons
{
    private $donsModel;
    use Controller;

    public function __construct()
    {
        $this->donsModel = new DonsModel();
    }

    public function showDonsPage()
    {
        $this->startSession();
        $this->View('dons');
        $view = new donsView();
        $categoryCounts = $this->donsModel->getDonationCategoriesWithCount();
        $donationsRequests = $this->donsModel->getDonationsRequests();
        $donations = $this->donsModel->getDonations();
        $donationsDone = $this->donsModel->getDonationsDone();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->displaySessionMessage();
        $view->loadHeader($sessionData);
        $view->Dons($categoryCounts, $sessionData,  $donationsRequests, $donations, $donationsDone);
        $view->foot();
        $view->footer();
    }



    public function showAddDon()
    {
        $this->checkLogin();
        $this->View('dons');
        $view = new donsView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->loadHeader($sessionData);
        $view->displaySessionMessage();
        $view->faireUnDon();
        $view->foot();
        $view->footer();
    }

    public function showRequestDon()
    {
        $this->checkLogin();
        $this->View('dons');
        $view = new donsView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->displaySessionMessage();
        $view->loadHeader($sessionData);
        $view->demanderUnDon();
        $view->foot();
        $view->footer();
    }



    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->startSession();
            $data = [
                'user_id' => $_SESSION['user_id'] ?? null,
                'somme' => $_POST['somme'] ?? null,
                'donation_category_id' => $_POST['donation_category_id'] ?? null,
                'recu' => null,
                'status' => 'pending'
            ];


            if (!empty($_FILES['recu']['name'])) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/ElMountada/public/uploads/donationsDone/';
                        $relativePath = '/public/uploads/donationsDone/';

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                $targetFile = $targetDir . basename($_FILES['recu']['name']);

                if (move_uploaded_file($_FILES['recu']['tmp_name'], $targetFile)) {
                    $data['recu'] = $relativePath . basename($_FILES['recu']['name']);
                }
            }

            try {

                if (empty($data['user_id']) || empty($data['somme']) || empty($data['donation_category_id'])) {
                    echo "Tous les champs obligatoires doivent être remplis.";
                    return;
                }

                $success = $this->donsModel->addDonation($data);

                if ($success) {
                    $this->startSession();
                    $_SESSION['status'] = "Donation enregistrée, elle apparaitera dans votre historique dès qu'un admin la confiermera ";
                    $_SESSION['status_type'] = 'success';
                    header('Location: ' . ROOT . '/dons/showDonsPage/');
                    exit();
                } else {
                    echo "Une erreur s'est produite lors de l'ajout de la donation.";
                }
            } catch (Exception $e) {
                echo "Erreur: " . $e->getMessage();
            }
        }
    }


    public function storeRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->startSession();


            $user_id = $_SESSION['user_id'] ?? null;

            if (!$user_id) {
                header('Location:' . ROOT . '/auth/showLoginPage');
                exit();
            }

            $name = $_POST['name'] ?? null;
            $dob = $_POST['dob'] ?? null;
            $aid_type = $_POST['aid_type'] ?? null;
            $description = $_POST['description'] ?? null;
            $document = null;
            if (!empty($_FILES['document']['name'])) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/ElMountada/public/uploads/donationsRequests/';
                $relativePath = '/public/uploads/donationsRequests/';

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                $targetFile = $targetDir . basename($_FILES['document']['name']);

                if (move_uploaded_file($_FILES['document']['tmp_name'], $targetFile)) {
                    $document = $relativePath . basename($_FILES['document']['name']);
                }
            }

            if ($name && $dob && $aid_type && $description) {

                $success = $this->donsModel->addDonationRequest($user_id, $name, $dob, $aid_type,  $description, $document);
                var_dump($success);
                if ($success) {
                    $this->startSession();
                    $_SESSION['status'] = "Votre demande de dons a été enregistrée avec success";
                    $_SESSION['status_type'] = 'success';
                    header('Location:' . ROOT . '/dons/showDonsPage/');
                    exit();
                } else {
                    echo  "Une erreur s'est produite lors de l'ajout de la demande de don.";
                }
            } else {
                echo "Veuillez remplir tous les champs obligatoires.";
            }
        }
    }

    public function acceptDonation($id)
    {
        $success = $this->donsModel->updateDonationsDoneAccepted($id);
        if ($success) {
            $this->startSession();
            $_SESSION['status'] = "Donation accéptée";
            $_SESSION['status_type'] = 'success';
            header('Location:' . ROOT . '/dons/showDonsPage/');
        } else {
            return ['success' => false, 'message' => 'Failed to update status'];
        }
    }

    public function RefuseDonation($id)
    {
        $success = $this->donsModel->updateDonationsDoneRefused($id);

        if ($success) {
            $this->startSession();
            $_SESSION['status'] = "Donation refusée";
            $_SESSION['status_type'] = 'success';
            header('Location:' . ROOT . '/dons/showDonsPage/');
        } else {
            echo  "Une erreur s'est produite ";
        }
    }


    public function RefuseRequest($id)
    {
        $success = $this->donsModel->updateDonationsRequestRefused($id);
        if ($success) {
            $this->startSession();
            $_SESSION['status'] = "Demande de donation refusée";
            $_SESSION['status_type'] = 'success';
            header('Location:' . ROOT . '/dons/showDonsPage/');
        } else {
            echo  "Une erreur s'est produite ";
        }
    }


    public function AcceptRequest($id)
    {
        $success = $this->donsModel->updateDonationsRequestAccepted($id);
        if ($success) {
            $this->startSession();
            $_SESSION['status'] = "Demande de donation accéptée";
            $_SESSION['status_type'] = 'success';
            header('Location:' . ROOT . '/dons/showDonsPage/');
        } else {
            echo  "Une erreur s'est produite ";
        }
    }
}
?>