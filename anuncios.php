<?php  
require 'includes/funciones.php';

incluirTemplate('header');

?>

    <main class="main seccion">
        <div class="contenedor">
            <h1>Anuncios</h1>

            <?php 
            $limite=10;
           include 'includes/template/anuncios.php';
         
        ?>
           
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>

 