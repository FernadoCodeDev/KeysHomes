document.addEventListener('DOMContentLoaded', function() {
  eventListeners();
  checkScreenSize(); // Chequea el tamaño de la pantalla al cargar
  darkMode(); 
});

  // menu mobile
function eventListeners() {
  const mobileMenu = document.querySelector('.mobile-menu');
  mobileMenu.addEventListener('click', navegacionResponsive);

  window.addEventListener('resize', checkScreenSize);
}

function navegacionResponsive() {
  const navegacion = document.querySelector('.navegacion');
  navegacion.classList.toggle('mostrar');
}

function checkScreenSize() {
  const navegacion = document.querySelector('.navegacion');
  
  // Si la pantalla es más grande que 768px, se elimina la clase 'mostrar'
  if (window.innerWidth >= 1200) {
    navegacion.classList.remove('mostrar');
  }
}

//DARK MODE  
const darkMode = () => {

  const preference = window.matchMedia('(prefers-color-scheme: dark)') //Leer las Preferencias 
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