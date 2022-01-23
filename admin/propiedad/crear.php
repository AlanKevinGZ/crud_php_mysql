<?php  

require '../../includes/funciones.php';
$auth=estadoAutenticado();

if (!$auth) {
    header('Location: /');
   }

    //base de datos
    require '../../includes/config/database.php';
   $db=conectarDB();

   //consultar los vendedores de la bd
   $consulta="SELECT * FROM vendedores";
   $resultado=mysqli_query($db,$consulta);

   //arreglo con  mensaje errores
    $errores=[];

    $titulo='';
    $precio='';
    $descripcion='';
    $habitaciones='';
    $wc='' ;  
    $estacionamiento='';
    $vendedor='';
    
   //Ejecuta cuando el usuari envia el formulario
    if ($_SERVER["REQUEST_METHOD"]=="POST") {

       /*  var_dump($_POST);
        echo '<br>'; */

      /*  var_dump($_FILES);  

       exit;  */

        //mysqli_real_escape_string Esta función siempre debe usarse (con pocas excepciones) para hacer seguros los datos antes de enviar una consulta a MySQL.
       $titulo=mysqli_real_escape_string($db,$_POST["titulo"]);
       $precio=mysqli_real_escape_string($db,$_POST["precio"]);
       $descripcion=mysqli_real_escape_string($db,$_POST["descripcion"]);
       $habitaciones=mysqli_real_escape_string($db,$_POST["habitaciones"]);
       $wc=mysqli_real_escape_string($db,$_POST["wc"]);
       $estacionamiento=mysqli_real_escape_string($db,
       $_POST["estacionamiento"]);
       $vendedor=mysqli_real_escape_string($db,$_POST["vendedor"]);

       $creado=date('Y/m/d');

       /* asignar file a una variable */
       $imagen=$_FILES["image"];
        

       //validacion
       $titulo=trim($titulo);
       $descripcion=trim($descripcion);

       if (!$titulo || strlen($titulo)<20) {
           $errores[]='Debes Agregar Un Titulo o debe tener al menos 20 caracteres';
       }
       if (!$precio || $precio<10000) {
        $errores[]='Debes Agregar Un Precio o debe ser mayor a 10000';
       }
       if (!$descripcion ||  strlen($descripcion)<50) {
        $errores[]='La descripcion es obligatoria o es muy corta debe tener almenos 50 caracteres';
       }
       if (!$habitaciones) {
        $errores[]='Debe Agregar una habitacion o mas';
       }
       if (!$wc) {
        $errores[]='Debe Agregar una habitacion o mas';
       } 
       if (!$estacionamiento) {
        $errores[]='Debe Agregar una estacionamiento o mas';
       }

       if (!$vendedor) {
        $errores[]='Seleccione un Vendedor';
       }
       if (!$imagen["name"]) {
        $errores[]='La imagen es Obligaroria';
       }

       /* validar por tamaño */
       /* convertir de kilobyte a byte */
        $medida=1000*1000;

    
       if ($imagen["size"]>$medida) {
        $errores[]='La imagen es muy pesada';
       } 


      /*  echo '<pre>';
       var_dump($errores);
       echo '</pre>';  */

       
      //revisar si el arreglo de errores esta vacio

      if (empty($errores)) {

        /* subida de archivos */

        /* crear carpeta */
        $carpetaImagenes='../../imagenes';
        
        if (!is_dir( $carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        //general nombre unico
        $nombreImagen=md5(uniqid(rand(),true));

       /* subir imagen */
       move_uploaded_file($imagen["tmp_name"],$carpetaImagenes."/".$nombreImagen.'.jpg');

        //insertar a la bd
        $query="INSERT INTO propiedades (titulo,precio,imagen,descripcion,habitaciones,wc,estacionamiento,creado,vendedorId) 
        VALUES ('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc', '$estacionamiento','$creado','$vendedor')";
 
        //echo $query;
 
        /* almacenar en la bd */
 
        $resultadodb=mysqli_query($db,$query);
 
        if ($resultadodb) {

            //redireccionar al usario no debe de haber codigo html antes
            header('Location: /admin?resultado=1');
        }

      }

    
    }



incluirTemplate('header');
 ?>

    <main class="main seccion">
        <div class="contenedor">
            <h1>Crear</h1>

            <a href="/admin" class="btn2">Volver</a>

            <?php foreach ($errores as $error):?>

                <div class="alerta error">
                    <?php echo $error ?>
                </div>
           

            <?php endforeach;?>


            <form action="/admin/propiedad/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
                <fieldset>
                    <legend>Informacion General</legend>

                    <label for="titulo">Titulo: </label>
                    <input type="text" id="titulo" placeholder="Titulo a la Propiedad" name="titulo" value="<?php echo $titulo ?>">

                    <label for="precio">Precio: </label>
                    <input type="number" id="precio" placeholder="Precio de la Propiedad" name="precio" min="1" 
                    value="<?php echo $precio?>">

                    <label for="image">Imagen: </label>
                    <input type="file" id="image" accept="image/jpeg, 
                    image/png" name="image">
                    
                    <label for="descripcion">Descrpcion: </label>
                    <textarea id="descripcion" 
                    name="descripcion"><?php echo $descripcion?></textarea>
                </fieldset>

                <fieldset>
                    <legend>Informacion Propiedad</legend>

                    <label for="habitaciones">Habitaciones: </label>
                    <input type="number" id="habitaciones" 
                    placeholder="Ej: 3" min="1" max="9" name="habitaciones"
                    value="<?php echo $habitaciones?>">

                    <label for="wc">Baños: </label>
                    <input type="number" id="wc" 
                    placeholder="Ej: 3" min="1" max="9" name="wc"
                    value="<?php echo $wc?>">

                    <label for="estacionamiento">Estacionamientos: </label>
                    <input type="number" id="estacionamiento" 
                    placeholder="Ej: 3"  min="1" max="9" name="estacionamiento"
                    value="<?php echo $estacionamiento?>" >
                </fieldset>


                <fieldset>
                    <legend>Vendedores</legend>

                    <select name="vendedor" id="">
                        <option value="">--Seleciona--</option>
                        <?php while($row=mysqli_fetch_assoc($resultado)):?>
                            <option 
                            <?php echo $vendedor==$row['id']?'selected':''?>
                            value="<?php echo $row['id'];?>">  
                                <?php 
                                 echo $row['nombre']." ".$row['apellido'] 
                                ?>
                            </option>

                        <?php endwhile;?>
                    </select>
                </fieldset>

                <input type="submit" value="Crear Propiedad" class="btn2">
            
            </form>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>
