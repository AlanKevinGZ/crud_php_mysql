<?php

 /* importar db */

 require 'includes/config/database.php';
 $db=conectarDB();

 /* consulta */
 $query="SELECT * FROM propiedades LIMIT ${limite}";


 /* obtener resultados */

 $resultado=mysqli_query($db,$query);
 


?>


<div class="grid_propiedad">

     <?php while($propiedad=mysqli_fetch_assoc($resultado)): ?>
       
    
    <div class="propiedad_contenedor">
        <div class="img_propiedad">
            <img src="/imagenes/<?php echo $propiedad["imagen"].'.jpg'  ?>" alt="">
        </div>
        <div class="titulo_propiedad">
            <h3><?php echo $propiedad["titulo"]?></h3>
            <p><?php echo $propiedad["descripcion"]?></p>

            <span><?php echo '$'.$propiedad["precio"]?></span>
        </div>

        <div class="grid_iconos">
            <img src="build/img/icono_dormitorio.svg" alt="">
            <p><?php echo $propiedad["habitaciones"]?></p>
            <img src="build/img/icono_estacionamiento.svg" alt="">
            <p><?php echo $propiedad ["estacionamiento"]?></p>
            <img src="build/img/icono_wc.svg" alt="">
            <p><?php echo $propiedad["wc"]?></p>
        </div>

        <div class="btn_ver">
       
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="btn">Ver Propiedad</a>
        </div>
    </div>
    
    <?php endwhile; ?>

</div>

<?php     
/* cerrar conexion */
mysqli_close($db);
?>