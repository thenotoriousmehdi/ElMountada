<?php

class Membership
{

    use Controller;

    private $membershipModel;

    public function __construct()
    {
        $this->membershipModel = new MembershipModel();
    }
    
    public function showSubscribePage()
    {
        $this->startSession();
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->loadHeader($sessionData);
        $memberships = $this->membershipModel->getMemberships();
        $view->Memberships($memberships);
        $view->foot();
        $view->footer();
    }

    public function showMembershipForm()
    {
        $this->startSession();
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $view->Head();
        $view->displaySessionMessage();
        $view->loadHeader($sessionData);
        $view->MembershipForm($sessionData);
        $view->foot();
        $view->footer();
    }

    public function showSubscriptionsHistory()
    {
        $this->startSession();
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $subscriptions = $this->membershipModel->getSubscriptionsHistory();
        $view->Head();
        $view->displaySessionMessage();
        $view->loadHeader($sessionData);
        $view->SubscriptionsHistory($subscriptions);
        $view->foot();
        $view->footer();
    }

    public function showMembershipCard($id)
    {
        $this->startSession();
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $membershipCard = $this->membershipModel->getMembershipCard($id);

        if (!$membershipCard) {
            header('Location: /error');
            exit;
        }

        $view->Head();
        $view->loadHeader($sessionData);
        $view->MembershipCard($membershipCard);
        $view->foot();
        $view->footer();
    }



    public function showMembers()
    {
        $this->startSession();

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
            header('Location:' . ROOT . '/auth/showLoginPage');
            exit();
        }
        $this->View('membership');
        $view = new MembershipView();
        $sessionData = $this->getSessionData();
        $members = $this->membershipModel->getMembershipDetails();
        $membersRequest = $this->membershipModel->getMembershipRequests();
        $view->Head();
        $view->displaySessionMessage();
        $view->loadHeader($sessionData);
        $view->displayMembers($members);
        $view->MembershipRequests($membersRequest);
        $view->foot();
        $view->footer();
    }


    public function handleMembershipRequest()
    {
        $this->startSession();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (empty($_POST['membership_type_id'])) {
                    throw new Exception("Le type d'abonnement est requis.");
                }

                $data = [
                    'userId' => $_SESSION['user_id'] ?? null,
                    'membershipTypeId' => $_POST['membership_type_id'],
                    'photo' => null,
                    'identity' => null,
                    'receipt' => null
                ];

                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/memberships/';
                $relativePath = '/public/uploads/memberships/';

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                $files = ['photo', 'identity', 'receipt'];

                foreach ($files as $file) {
                    if (!empty($_FILES[$file]['name']) && $_FILES[$file]['error'] === UPLOAD_ERR_OK) {
                        $targetFile = $targetDir . basename($_FILES[$file]['name']);
                        if (move_uploaded_file($_FILES[$file]['tmp_name'], $targetFile)) {
                            $data[$file] = $relativePath . basename($_FILES[$file]['name']);
                        } else {
                            $_SESSION['status'] = "Erreur lors du téléchargement du fichier $file.";
                            $_SESSION['status_type'] = 'error';
                            header('Location:' . ROOT . '/');
                            exit;
                        }
                    }
                }

                $success = $this->membershipModel->insertMembershipRequest($data);

                if ($success) {
                    $_SESSION['status'] = "Votre demande d'abonnement a été envoyée et est en attente de confirmation.";
                    $_SESSION['status_type'] = 'success';
                    header('Location:' . ROOT . '/');
                    exit();
                } else {
                    $_SESSION['status'] = "L'ajout de votre demande d'abonnement a échoué.";
                    $_SESSION['status_type'] = 'error';
                    header('Location:' . ROOT . '/');
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['status'] = "Erreur: " . $e->getMessage();
                $_SESSION['status_type'] = 'error';
                header('Location:' . ROOT . '/membership/showMembershipForm');
                exit();
            }
        }
    }



    private function handleImageUpload($file)
    {

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

        if (!in_array($fileExtension, $allowedExtensions)) {
            throw new Exception('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');
        }

        $fileName = uniqid() . '.' . $fileExtension;
        $filePath = $uploadDir . $fileName;


        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            throw new Exception('Failed to upload image');
        }

        return 'public/uploads/' . $fileName;
    }




    public function acceptMembership($id)
    {
        $success = $this->membershipModel->updateMembershipAccepted($id);
        if ($success) {
            $this->startSession();
            $_SESSION['status'] = "Membre accepté";
            $_SESSION['status_type'] = 'success';
            header('Location:' . ROOT . '/membership/showMembers/');
        } else {
            return ['success' => false, 'message' => 'Failed to update status'];
        }
    }
    public function archiveSubscription($membership_id)
    {

        $success = $this->membershipModel->archiveSubscription($membership_id);
        if ($success) {
            $this->startSession();
            $_SESSION['status'] = "Archivé avec success";
            $_SESSION['status_type'] = 'success';
            header('Location:' . ROOT . '/membership/showSubscriptionsHistory/');
        } else {
            return ['success' => false, 'message' => 'Failed to update status'];
        }
    }


    public function refuseMembership($id)
    {
        $success = $this->membershipModel->updateMembershipRefused($id);
        if ($success) {
            $this->startSession();
            $_SESSION['status'] = "Membre refusé";
            $_SESSION['status_type'] = 'success';
            header('Location:' . ROOT . '/membership/showMembers/');
        } else {
            return ['success' => false, 'message' => 'Failed to update status'];
        }
    }
}
