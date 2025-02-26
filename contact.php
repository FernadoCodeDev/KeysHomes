<?php
include './includes/templades/Navigation.php';
?>
<!--Contatc.scss-->
<main class="ContactMain">
    <h1>Formulario de Contacto</h1>

    <h2>Rellene el formulario de contacto</h2>

    <form id="contact-form" method="POST" action="/contact">
        <fieldset>
            <legend>Información personal</legend>

            <label for="name">Nombre</label>
            <input type="text" placeholder="Tú nombre" id="name" name="contact[name]" required>

            <label for="message">Mensaje</label>
            <textarea id="message" name="contact[message]" placeholder="Coloca un Mensaje" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="options">Comprar o vender:</label>
            <select id="options" name="contact[options]" onchange="OptionBuySell(event)" required>
                <option value="" disabled selected>-- Seleccionar --</option>
                <option value="Buy">Comprar</option>
                <option value="Sell">Vender</option>
            </select>

            <div id="property-options"></div>
        </fieldset>


        <fieldset>
            <legend>Método de contacto</legend>

            <p>¿Cómo le gustaría que nos comuniquemos con usted?</p>

            <div class="ContactMethod">
                <div>
                    <label for="contact-phone">Teléfono</label>
                    <input name="contact[method]" class="InputContacts" type="radio" value="phone" id="phone" onclick="SelectContact(event)" required>
                </div>

                <div>
                    <label for="contact-email">Email</label>
                    <input name="contact[method]" class="InputContacts" type="radio" value="email" id="email" onclick="SelectContact(event)" required>
                </div>
            </div>

            <div id="contact-method-input"></div>
        </fieldset>

        <input type="submit" value="Enviar Formulario" class="greenbutton" id="Alert-Send-Form">
    </form>
</main>


<?php
include './includes/templades/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="build/js/bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        AlertendForm(); 
});

const AlertendForm = () => {
  const form = document.querySelector("#contact-form"); 

  form.addEventListener("submit", function (e) {
    e.preventDefault(); 

    Swal.fire({
      position: "center",
      icon: "success",
      title: "Tu formulario ha sido enviado",
      text: "Esta es solo una simulación. No se envia ninguna información real. ",
      showConfirmButton: false,
      timer: 5000,
    }).then(() => { 
      window.location.reload();
    });
  });

 // alert("Formulario Funcionando");

};
</script>