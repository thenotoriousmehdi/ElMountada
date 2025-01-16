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
         $this->View('statistiques');
         $view = new StatistiquesView();
         $view ->Head();
         $view ->displaySessionMessage();
         $view->loadHeader($sessionData);
         $view-> Statistiques($usersData);
         $view ->footer();    
         $view ->foot();
    }

    





}
