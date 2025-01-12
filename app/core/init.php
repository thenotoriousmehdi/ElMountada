<?php 

 spl_autoload_register(function($classname){
	
  	require $filename = "./app/models/".ucfirst($classname).".php";
	  require_once __DIR__ . '/../../vendor/autoload.php';

 });

 
require 'config.php';
require 'Database.php';
require 'Controller.php';
require 'view.php';
require 'App.php';