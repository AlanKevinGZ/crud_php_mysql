<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Bienes Raices</title>
</head>
<body>
  
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="barra">
                <div class="titulo_header">
                  <a href="index.php"><img src="build/img/logo.svg" alt="logo"></a>
                </div>

                <div class="mobil-menu">
                    <img src="build/img/barras.svg" alt="menu-res">
                </div>

               <div class="derecha">
                <div class="dark_mode">
                    <img src="build/img/dark-mode.svg" alt="" class="btndark">
                </div>

                <nav class="menu">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                </nav>

               </div>
            </div>

            <h2>Ventas de Casas De Lujo En La Playa</h2>

        </div>
       
    </header>

    <main class="main seccion">
        <h1>Más sobre Nosotros</h1>
        <div class="contenedor">
            <div class="iconos-nosotros">
                <div class="icono">
                    <img src="build/img/icono1.svg" alt="seguridad" loading='lazy'>
                    <h3>Seguridad</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure laboriosam saepe reiciendis exercitationem ducimus officia, esse eligendi? </p>

                </div>

                <div class="icono">
                    <img src="build/img/icono2.svg" alt="precio" loading='lazy'>
                    <h3>Precio</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure laboriosam saepe reiciendis exercitationem ducimus officia, esse eligendi? </p>

                </div>

                <div class="icono">
                    <img src="build/img/icono3.svg" alt="Tiempo" loading='lazy'>
                    <h3>Tiempo</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure laboriosam saepe reiciendis exercitationem ducimus officia, esse eligendi? </p>

                </div>
            </div>
        </div>
    </main>

    <section class="propiedades">

        <h2>Casas y Departamentos En Venta </h2>
        <div class="contenedor">
        
        <?php 
            $limite=3;
           include 'includes/template/anuncios.php';
         
        ?>

            <div class="ver_todas">
                <a href="anuncios.php" class="btn2">Ver Mas</a>
            </div>
        </div>
    </section>

    <section class="section_contacto">
        <div class="contenedor">
            <div class="contacto_contenido">
                <h2>Encuentra la casa de tus sueños</h2>

                <p>Llena el formulario de contacto y un ascesor se pondra en contacto contigo en brevedad </p>

                <div class="btn_contacto">
                    <a href="" class="btn_con">Contacto</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section_blog">
        
        <div class="contenedor">
            <div class="contenido_inferior">
                <div class="blog">
                    <h2>Blog</h2>

                    <article class="entrada_blog">
                        <div class="imagenes">
                            <picture>
                                <img src="build/img/blog1.jpg" alt="">
                            </picture>
                        </div>

                        <div class="texto_entrada">
                            <a href="entrada.php">
                                <h4>Terraza en el Techo</h4>
                                <p>Escrito el: <span>20/10/21</span> por <span>Admin</span> </p>

                                <p>
                                    Consejos para contruir una terraza en tu casa los mejores materiales
                                </p>
                            </a>
                        </div>

                    </article>

                    <article class="entrada_blog">
                        <div class="imagenes">
                            <picture>
                                <img src="build/img/blog2.jpg" alt="">
                            </picture>
                        </div>

                        <div class="texto_entrada">
                            <a href="entrada.php">
                                <h4>Picina en el Techo</h4>
                                <p>Escrito el: <span>20/10/21</span> por <span>Admin</span> </p>

                                <p>
                                    Consejos para contruir una terraza en tu casa los mejores materiales
                                </p>
                            </a>
                        </div>

                    </article>

                </div>

                <div class="testimoniales">
                    <h3>Testimoniales</h3>
                    <div class="testimonial">
                        <blockquote>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi odio, quos at doloremque quaerat rerum. Iure, necessitatibus fugit. 
                        </blockquote>
                        <p>-Antonio Diaz</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php 
    
      require 'includes/funciones.php';
      incluirTemplate('footer');
    ?>


