<?php

class Statistiques
{
     use Controller;
    

     private $statistiquesModel;

    public function __construct() {
        $this-> statistiquesModel = new StatistiquesModel();
    }

    public function ShowStatistiques() 
    {
         $this->startSession();
         $sessionData = $this->getSessionData();
         $usersData = $this -> statistiquesModel -> getUsersStatistiques();
         $donationsData = $this -> statistiquesModel -> getSumDonations();
         $this->View('statistiques');
         $view = new StatistiquesView();
         $view ->Head();
         $view ->displaySessionMessage();
         $view->loadHeader($sessionData);
         $view-> Statistiques($usersData, $donationsData);
         $view ->footer();    
         $view ->foot();
    }

    


}
