<?php 

//importar conexion
require 'includes/config/database.php';
$db=conectarDB();

//crear un email y paswword
$email="correo@corre.com";

$password="123456";

$passwordHash=password_hash($password,PASSWORD_DEFAULT);


//query para crear el usuario
$query=" INSERT INTO usuarios (email, password) VALUES 
( '${email}', '${passwordHash}' )";

echo $query;
//agregarlo a la bd
mysqli_query($db,$query);


?>
