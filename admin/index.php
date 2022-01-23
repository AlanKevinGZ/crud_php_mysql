<?php  
   
   require '../includes/funciones.php';
   $auth=estadoAutenticado();
   
   if (!$auth) {
       header('Location: /');
      }

  /* IMPORTAR LA conexion */
  require '../includes/config/database.php';
  $db=conectarDB();

  /* escribir el query */
    $query="SELECT * FROM propiedades";

  /* consulta LA BD */
 $consulta=mysqli_query($db,$query);
   
 

//mustra mensaje condicional ??
$resultado=$_GET["resultado"] ?? null;

if ($_SERVER["REQUEST_METHOD"]=="POST") {
   $id=$_POST['id'];
   $id=filter_var($id,FILTER_VALIDATE_INT);

   if ($id) {

    //eliminar el archivo
    $queryArchivo="SELECT imagen From propiedades WHERE id= ${id}";

    $resultadoArchivo=mysqli_query($db,$queryArchivo);

    $propiedadArchivo=mysqli_fetch_assoc($resultadoArchivo);
   
    unlink('../imagenes/'.$propiedadArchivo['imagen'].'.jpg');

    //elimina la propiedad
    $query="DELETE FROM propiedades WHERE id= ${id}";

    $resultado=mysqli_query($db,$query);

    if ($resultado) {
        header('Location: /admin');
    }
   }
   
}



incluirTemplate('header');
 ?>

    <main class="main seccion">
        <div class="contenedor">
            <h1>Administrador Bienes Raices</h1>
            <?php switch ($resultado) {
                case '1':
                    echo '<p class="alerta exito">Anuncio Creado Correctamente
                    </p>';
                    break;
                    case '2':
                    echo '<p class="alerta exito">Anuncio Modificado Correctamente
                    </p>';
                    break;
                
                default:
                    # code...
                    break;
            }

                   
             
            ?>

            <div class="btn_opciones">
            <a href="/admin/propiedad/crear.php" class="btn2">Crear</a>
            <a href="../cerrarSesion.php" class="btn3">Cerrar Sesion</a>
            </div>
            

        </div>

        <div class="mostrar_elementos contenedor">
            <table class="propiedades">
                <thead>
                    <tr>

                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Acciones</th>

                    </tr>
                </thead>

                <tbody>
                <?php  while ($propiedad = mysqli_fetch_assoc($consulta)):?>
                    <tr>
                        <td><?php echo $propiedad['id'];?></td>
                        <td><?php echo $propiedad['titulo'];?></td>
                        <td> <img src="/imagenes/<?php echo $propiedad['imagen'].'.jpg'; ?> " class="imagen_tabla" alt="imgPropiedad"></td>
                        <td><?php echo  '$'.$propiedad['precio'];?></td>
                        <td>
                           
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id'];?>">
                           <input type="submit" class="delete" value="Eliminar">
                        </form>
                            <a  href="../admin/propiedad/actualizar.php?id=<?php echo $propiedad['id']; ?>"  class="edit">Actulizar</a>
                        </td>
                    </tr>
                    <?php  endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php 
    //cerrar conexion
    mysqli_close($db);
    incluirTemplate('footer');
    
    ?>