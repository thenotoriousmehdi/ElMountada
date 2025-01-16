<?php

class Offers
{
    private $offersModel;
    use Controller;

    public function __construct()
    {
        $this->offersModel = new OffersModel();
    }

    public function showOffers()
    {
        $this->startSession();
        $sessionData = $this->getSessionData();

        $cities = $this->offersModel->getAllCities();
        $categories = $this->offersModel->getAllCategories();
        $types = $this->offersModel->getAllTypes();

        $formattedCities = [];
        foreach ($cities as $city) {
            $formattedCities[] = $city->ville;
        }

        $formattedCategories = [];
        foreach ($categories as $category) {
            $formattedCategories[$category->id] = $category->name;
        }

        if (isset($_POST['filter_submit'])) {
            $selectedVille = !empty($_POST['ville']) ? $_POST['ville'] : null;
            $selectedCategory = !empty($_POST['category']) ? $_POST['category'] : null;
            $selectedType = !empty($_POST['type']) ? $_POST['type'] : null;
            $sortColumn = !empty($_POST['sort_column']) ? $_POST['sort_column'] : null;
            $sortDirection = !empty($_POST['sort_direction']) ? $_POST['sort_direction'] : 'ASC';

            $offers = $this->offersModel->getFilteredOffers(
                $selectedVille,
                $selectedCategory,
                $selectedType,
                $sortColumn,
                $sortDirection
            );
        } else {
            $offers = $this->offersModel->getAllFiltredOffers();
        }

        $this->View('offers');
        $view = new OffersView();
        $view->Head();
        $view->loadHeader($sessionData);
        // $view->displayFilterForm($formattedCities, $formattedCategories, $types);
        $view->offers($offers, $formattedCities, $formattedCategories, $types);
        $view->footer();
        $view->foot();
    }
}
