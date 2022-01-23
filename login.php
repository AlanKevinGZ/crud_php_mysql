<?php
require 'includes/config/database.php';
$db = conectarDB();

/* aunteticar el usuario */
$errores = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST["password"]);

    if (!$email) {
        $errores[] = 'Llene el campo de Email';
    }
    if (!$password) {
        $errores[] = 'Llene el campo Password ';
    }

    if (empty($errores)){
        //si el usuario existe
        $query="SELECT * FROM usuarios WHERE email= '${email}'";
        $resultado=mysqli_query($db, $query);
       
        if ($resultado->num_rows) {
           //si el passwor es caorrcto
           $usuario=mysqli_fetch_assoc($resultado);

           /* verificar si el password es correcto o no */

           $auth=password_verify($password,$usuario["password"]);
           if($auth){
               //el usuario esta auntenticado
                session_start();

                //llenar el arreglo de la sesion

                $_SESSION['usuario']= $usuario['email'];
                $_SESSION['login']= true;
               
                header('Location: /admin');

           }else{
            $errores[]="El Password es incorrecto";
           }
        }else{
            $errores[]="El usuario no existe";
        }

    }

    
}


/* incluir header */
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="main seccion contenido-centrado">
    <div class="contenedor">
        <h1>Iniciar Sesion</h1>

        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error ?>
            </div>


        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Login</legend>

                <label for="email">E-mail: </label>
                <input type="email" id="email" placeholder="Email:correo@corre.com" name="email" require>


                <label for="password">Password: </label>
                <input type="password" id="password" placeholder="Password:123456" name="password" require>

            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="btn2">

        </form>
    </div>
</main>

<?php incluirTemplate('footer'); ?>