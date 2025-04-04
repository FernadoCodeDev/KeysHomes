<?php
include './includes/templades/header.php';
?>

<!--DataKeysHomes.scss-->
<main>
    <div class="DataKeysHomes" id="Data-KeysHomes">
        <div class="propertyData">
            <div>
                <h2 class="Results">400<span>+</span></h2>
                <p class="TextResults">Propiedades listas</p>
            </div>
            <div>
                <h2 class="Results">2400<span>+</span></h2>
                <p class="TextResults">Clientes felices</p>
            </div>
        </div>
        <div class="TextDataKeysHomes">
            <p>Conectando sueños con hogares. En KeysHomes trabajamos para que cada cliente encuentre no solo una casa, sino un lugar donde construir recuerdos y vivir plenamente. Nuestra misión es facilitar este proceso con transparencia y dedicación.</p>
        </div>
    </div>
</main>

<!--Advertisements.Scss-->
<section class="section-max-width">
    <h2>Nuestras Propiedades</h2>

    <?php
    $limite = 3;
    include './includes/templades/Advertisements.php';
    ?>


    <div class="AlignRight">
        <a href="Properties.php" class="button-SeaGreen-inline-block">Ver todas las propiedades</a>
    </div>

</section>

<!--SecondaryFund.scss-->
<section class="SecondaryFund">
    <div class="OverplaySecondary">
        <h2>Busca tú Hogar</h2>
        <p>Nosotros lo vamos a encontrar</p>
        <a href="Properties.php" class="button-tomato-inline-block">Ver Propiedades</a>

    </div>
    <img src="src/Image/Home 15.webp" alt="Fondo Secundario">
</section>

<!--lower.scss-->
<div class="LowerSection">
    <section>
        <h3 class="TextLowerSection">Nuestras Propiedades</h3>

        <ARTicle class="Promotion">
            <div class="imagenPromotion">
                <img src="src/Image/Home 1.webp" alt="property">
            </div>

            <div class="TextPromotion">
                <h4>Moderna casa en un entorno natural </h4>
                <p>Chicago,<span>Illinois</span></p>
                <p>propiedad de dos pisos, que combina estilo contemporáneo con detalles clásicos. Con 3 habitaciones amplias, 2 baños completos y una construcción de 250 metros cuadrados, con un extenso jardín y la terraza Ubicada en las afueras de Chicago, Illinois</p>
            </div>
        </ARTicle>

        <ARTicle class="Promotion">
            <div class="imagenPromotion">

                <img src="src/Image/Home 2.webp" alt="property">
            </div>

            <div class="TextPromotion">
                <h4>Imponente residencia moderna campestre</h4>
                <p>Chicago,<span>Illinois</span></p>
                <p>Descubre esta propiedad de dos pisos que combina un estilo moderno y rústico. Con 4 habitaciones, 3 baños y 300 metros cuadrados, cuenta con un jardín impecable y una entrada elegante. Ubicada en las afueras de Chicago, es perfecta para disfrutar de la naturaleza.</p>
            </div>
        </ARTicle>
    </section>

    <section class="TestimonialInfo">
        <h3>testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                <img src="src/Image/Comillas.webp" alt="Comillas" class="QuotationMarks">
                <p>Gracias a Key Homes, encontré la casa de mis sueños en el vecindario perfecto. Su equipo me guió en cada paso del proceso, desde la búsqueda hasta la compra. La atención personalizada y el conocimiento del mercado me hicieron sentir respaldado y seguro. ¡Ahora disfruto de mi nuevo hogar, y no podría estar más feliz!</p>
            </blockquote>
            <p class="Review">Camila Díaz</p>
        </div>
    </section>

    <div class="contactContainer">
        <p class="contactMessage">
            ¿Estás interesado en comprar o vender una propiedad? Completa nuestro formulario y un asesor de <strong>KeysHomes</strong> se pondrá en contacto contigo.
        </p>
        <a href="contact.php" class="button-SeaGreen-inline-block">Formulario de contacto</a>
    </div>
</div>


<!--footer.scss-->
<?php
include './includes/templades/footer.php';
?>

<script src="build/js/bundle.min.js"></script>

</body>

</html>