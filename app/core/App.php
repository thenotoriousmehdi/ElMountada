<?php
class App
{
    private $controller = '';
    private $method = '';
    private $parameters = [];


    public function splitURL()
    {
        $URL = $_GET['url'] ?? 'accueil/ShowAccueil';
        $URL = explode('/', trim($URL));
        return $URL;
    }

    private function getParameters()
    {
        $parameters  = array_slice($_GET, 1);
        $this->parameters = array_values($parameters);
    }
    public function loadController()
    {
        $URL = $this->splitURL();
        $this->getParameters();
        $filename = "./app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require_once $filename;
            $this->controller = ucfirst($URL[0]);
            $controller = new $this->controller;
            if (!empty($URL[1])) {
                if (method_exists($controller, $URL[1])) {
                    $this->method = $URL[1];
                    
                    call_user_func_array([$controller, $this->method], $this->parameters);
                } else {
                    call_user_func_array([$controller, "method_not_found"], []);
                }
            } else {
                $this->method = "ShowAccueil";
                call_user_func_array([$controller, $this->method], $this->parameters);
            }
        } else {
            require_once './app/controllers/_404.php';
            $this->controller = '_404';
        }
    }
}