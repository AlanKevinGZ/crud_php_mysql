<?php  

function conectarDB() : mysqli{
    $db=mysqli_connect('localhost','root','123456789','bienesraices');

    if (!$db) {
        echo 'Error conexion';
        exit;
    }

    return $db;
}