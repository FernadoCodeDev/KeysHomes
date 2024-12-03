document.addEventListener('DOMContentLoaded', function() {
  eventListeners();
  checkScreenSize(); // Chequea el tamaño de la pantalla al cargar
  darkMode(); 
});


  // menu mobile
function eventListeners() {
  const mobileMenu = document.querySelector('.mobile-menu');
  mobileMenu.addEventListener('click', navegacionResponsive);

  // Listener para el redimensionamiento de la pantalla
  window.addEventListener('resize', checkScreenSize);

  // Colocar en la funcion eventListeners
const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]')
metodoContacto.forEach(input => input.addEventListener('click', MetodosContacto))
}

function navegacionResponsive() {
  const navegacion = document.querySelector('.navegacion');
  navegacion.classList.toggle('mostrar');
}

function checkScreenSize() {
  const navegacion = document.querySelector('.navegacion');
  
  // Si la pantalla es más grande que 768px, eliminamos la clase 'mostrar'
  if (window.innerWidth >= 1200) {
    navegacion.classList.remove('mostrar');
  }
}

//DARK MODE  
const darkMode = () => {

  const preference = window.matchMedia('(prefers-color-scheme: dark)')
  //console.log(preference.matches)

  if(preference.matches) {
    document.body.classList.add('DarkMode-function')
  } else {
    document.body.classList.remove('DarkMode-function')
  }

  preference.addEventListener('change', function() {
    if(preference.matches) {
      document.body.classList.add('DarkMode-function')
    } else {
      document.body.classList.remove('DarkMode-function')
    }
  })

  const botonDarkMode = document.querySelector('.DarkMode')

  botonDarkMode.addEventListener('click', function() {
    document.body.classList.toggle('DarkMode-function')
  })
}

//Funcion de vista previa 
  /*document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('imagen').addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.getElementById('imagenpreview');
                img.src = e.target.result;
                img.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        }
    });
  });
*/

//Función aparte
const MetodosContacto = (e) => {
  const contactoDiv = document.querySelector('#contacto');

  if(e.target.value === 'telefono') {
    contactoDiv.innerHTML = `
        <label for="telefono" class="label-contacto">Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" class="input-contacto" id="telefono" name="contacto[telefono]"></input>
    
              <p>Elija la fecha y la hora para poder comunicarnos con usted </p>

            <label for="fecha" class="label-contacto">Fecha:</label>
            <input type="date" id="fecha" class="input-contacto" name="contacto[fecha]">

            <label for="hora" class="label-contacto">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" class="input-contacto" name="contacto[hora]">
    
            `;
  } else {
    contactoDiv.innerHTML = `
     <label for="email" class="label-contacto">E-mail</label>
            <input type="email" placeholder="Tu Email" class="input-contacto" id="email" name="contacto[email]" required>
            `;
  }
  
}