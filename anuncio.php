<?php  
require 'includes/funciones.php';



$id=$_GET["id"];
$id=filter_var($id,FILTER_VALIDATE_INT);

if ($id==false) {
    header('Location: /');
}

require 'includes/config/database.php';
$db=conectarDB();

$consultaId="SELECT * FROM propiedades WHERE id = ${id}";
$resultadoId=mysqli_query($db, $consultaId);

//si el id existe si no lo re direcciona
if ($resultadoId->num_rows===0) {
    header('Location: /');
}
$propiedad=mysqli_fetch_assoc($resultadoId);



incluirTemplate('header');
 ?>

    <main class="main seccion">
        <div class="contenedor">
            <h2><?php echo  $propiedad["titulo"];?></h2>

        <div class="conten_propiedad">
            <div class="contenido_imagen">
                <div class="img_propiedad">
              
                    <img src="/imagenes/<?php echo  $propiedad["imagen"].'.jpg';?>" alt="">
                </div>
            </div>

            <div class="resumen_propiedad">
                <div class="costo">
                    <p><?php echo '$'.$propiedad["precio"]?></p>
                </div>
                <div class="grid_iconos iconos">
                    <img src="build/img/icono_dormitorio.svg" alt="">
                    <p><?php echo $propiedad["habitaciones"]?></p>
                    <img src="build/img/icono_estacionamiento.svg" alt="">
                    <p><?php echo $propiedad["estacionamiento"]?></p>
                    <img src="build/img/icono_wc.svg" alt="">
                    <p><?php echo $propiedad["wc"]?></p>
                </div>

                <div class="sobre_propiedad">
                    <p><?php echo $propiedad["descripcion"]?></p>
                </div>
            </div>
        </div>
         
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>

 