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
        $membershipTypes = $this->offersModel->getAllMembershipTypes(); 
    
        $formattedCities = [];
        foreach ($cities as $city) {
            $formattedCities[] = $city->ville;
        }
    
        $formattedCategories = [];
        foreach ($categories as $category) {
            $formattedCategories[$category->id] = $category->name;
        }
    
        $formattedMembershipTypes = [];
        foreach ($membershipTypes as $membershipType) {
            $formattedMembershipTypes[$membershipType->id] = $membershipType->name;
        }
    
        if (isset($_POST['filter_submit'])) {
            $selectedVille = !empty($_POST['ville']) ? $_POST['ville'] : null;
            $selectedCategory = !empty($_POST['category']) ? $_POST['category'] : null;
            $selectedType = !empty($_POST['type']) ? $_POST['type'] : null;
            $selectedMembershipType = !empty($_POST['membership_type']) ? $_POST['membership_type'] : null; 
            $sortColumn = !empty($_POST['sort_column']) ? $_POST['sort_column'] : null;
            $sortDirection = !empty($_POST['sort_direction']) ? $_POST['sort_direction'] : 'ASC';
    
            $offers = $this->offersModel->getFilteredOffers(
                $selectedVille,
                $selectedCategory,
                $selectedType,
                $selectedMembershipType, 
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
        $view->offers($offers, $formattedCities, $formattedCategories, $types, $formattedMembershipTypes); 
        $view->footer();
        $view->foot();
    }
    
}
