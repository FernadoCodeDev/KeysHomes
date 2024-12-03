<?php
include './includes/templades/header.php';
?>

<!--Data-KeysHomes.scss-->
<main class="seccion">
    <div class="Data-KeysHomes" id="Data-KeysHomes">
        <div class="property-data">
            <div class="property">
                <h2 class="number">400<span class="plus-sign">+</span></h2>
                <p class="text-property-data">Propiedades listas</p>
            </div>
            <div class="customers">
                <h2 class="number">2400<span class="plus-sign">+</span></h2>
                <p class="text-property-data">Clientes felices</p>
            </div>
        </div>
        <div class="work-data">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium assumenda, ipsa aliquam nisi odio veritatis dolor enim, quasi at doloribus exercitationem, quae repudiandae! Asperiores rem at illo, totam laboriosam praesentium.</p>
        </div>
    </div>
</main>

<!--Anuncios.Scss-->
<section class="seccion contenedor">
    <h2>Nuestras Propiedades</h2>

    <?php
    $limite = 3;
    include './includes/templades/anuncio.php';
    ?>


    <div class="alinear-derecha">
        <a href="Propiedades.php" class="boton-SeaGreen-inline-block">Ver todas las propiedades</a>
    </div>

</section>

<!--Fondo Secundario-->
<section class="Fondo-Secundario">
    <div class="Overplay-Secundario">
        <h2>Busca tú Hogar</h2>
        <p>Nosotros lo vamos a encontrar</p>
        <a href="Propiedades.php" class="boton-tomato-inline-block">ver Propiedades</a>

    </div>
    <img src="src/Image/Home 15.jpg" alt="Fondo Secundario">

</section>

<!--inferior.scss-->
<div class="contenedor seccion seccion-inferior">
    <section>
        <h3 class="Nuestras-Propiedades">Nuestras Propiedades</h3>

        <ARTicle class="Entrada-arte">
            <div class="imagen">
                <img src="src/Image/Home 1.png" alt="arte 1">
            </div>

            <div class="texto-entrada">
                <h4>Moderna casa en un entorno natural </h4>
                <p>Chicago,<span>Illinois</span></p>
                <p>propiedad de dos pisos, que combina estilo contemporáneo con detalles clásicos. Con 3 habitaciones amplias, 2 baños completos y una construcción de 250 metros cuadrados, con un extenso jardín y la terraza Ubicada en las afueras de Chicago, Illinois</p>
            </div>
        </ARTicle>

        <ARTicle class="Entrada-arte">
            <div class="imagen">

                <img src="src/Image/Home 2.png" alt="arte 2">
            </div>

            <div class="texto-entrada">
                <h4>Imponente residencia moderna campestre</h4>
                <p>Chicago,<span>Illinois</span></p>
                <p>Descubre esta propiedad de dos pisos que combina un estilo moderno y rústico. Con 4 habitaciones, 3 baños y 300 metros cuadrados, cuenta con un jardín impecable y una entrada elegante. Ubicada en las afueras de Chicago, es perfecta para disfrutar de la naturaleza.</p>
            </div>
        </ARTicle>
    </section>

    <section class="testimoniales">
        <h3>testimoniales</h3>
        <div class="testimonial">
            <blockquote class="ImgAndTextTestimonial">
                <img src="src/Image/Comillas.png" alt="Comillas" class="comillas">
                <p class="Text-testimonial">Gracias a Key Homes, encontré la casa de mis sueños en el vecindario perfecto. Su equipo me guió en cada paso del proceso, desde la búsqueda hasta la compra. La atención personalizada y el conocimiento del mercado me hicieron sentir respaldado y seguro. ¡Ahora disfruto de mi nuevo hogar, y no podría estar más feliz!</p>
            </blockquote>
            <p class="Autor-testimonial">Camila Díaz</p>
        </div>
    </section>
</div>

<!--footer.scss-->
<?php
include './includes/templades/footer.php';
?>

<script src="build/js/bundle.min.js"></script>

</body>

</html>