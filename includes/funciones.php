<?php 

require 'app.php';

function incluirTemplate(string $nombre){
    include TEMPLATE_URL."/{$nombre}.php";
}

function estadoAutenticado():bool{
    session_start();
  
    $auth=$_SESSION['login'];

    if ($auth) {
        return true;
    }

    return false;
    
}