<?php

class Favorite
{
    use Controller;


    private $favoriteModel;

    public function __construct()
    {
        $this->favoriteModel = new FavoriteModel();
    }

    public function showFavorite($user_id)
    {
        $this->startSession();
        $sessionData = $this->getSessionData();
        $this->View('favorite');
        $view = new FavoriteView();
        $favorites = $this->favoriteModel->getFavoritesByUser($user_id);
        $view->Head();
        $view->loadHeader($sessionData);
        $view->FavoritePage($favorites);
        $view->foot();
        $view->footer();
    }

    
    public function toggleFavorite()
    {
        $this->startSession();

        $partnerId = $_POST['partner_id'] ?? null;
        $userId = $_POST['user_id'] ?? null;
        $returnUrl = $_POST['return_url'] ?? '<?= ROOT ?>/partners/showCatalogue/';

        if (!$partnerId || !$userId) {
            $_SESSION['status'] = "Erreur: Paramètres manquants";
            $_SESSION['status_type'] = 'error';
            header("Location: $returnUrl");
            return;
        }

        $isFavorite = $this->favoriteModel->isFavorite($userId, $partnerId);

        if ($isFavorite) {
            $success = $this->favoriteModel->removeFavorite($userId, $partnerId);
            $message = "Partenaire retiré de vos favoris";
        } else {
            $success = $this->favoriteModel->addFavorite($userId, $partnerId);
            $message = "Partenaire ajouté à vos favoris";
        }

        $_SESSION['status'] = $success ? $message : "Une erreur est survenue";
        $_SESSION['status_type'] = $success ? 'success' : 'error';

        header("Location: $returnUrl");
    }
}
