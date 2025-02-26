const ObjectProperty = {
  property: [],
};

const ImageProperty = "/imagenesBD/";

document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  checkScreenSize();
  darkMode();
  ConsultAPI();
  OptionBuySell();
  SelectContact();
  //AlertendForm(); 
});

// menu mobile
function eventListeners() {
  const mobileMenu = document.querySelector(".mobileMenu");
  mobileMenu.addEventListener("click", ResponsiveNavigation);

  window.addEventListener("resize", checkScreenSize);
}

function ResponsiveNavigation() {
  const navigation = document.querySelector(".navigation");
  navigation.classList.toggle("ShowNavigation");
}

function checkScreenSize() {
  const navigation = document.querySelector(".navigation");

  if (window.innerWidth >= 1200) {
    navigation.classList.remove("ShowNavigation");
  }
}

//DARK MODE
const darkMode = () => {
  const preference = window.matchMedia("(prefers-color-scheme: dark)"); //Read the Preferences prefers-color-scheme: dark
  if (preference.matches) {
    document.body.classList.add("DarkModeFunction");
  } else {
    document.body.classList.remove("DarkModeFunction");
  }

  preference.addEventListener("change", function () {
    if (preference.matches) {
      document.body.classList.add("DarkModeFunction");
    } else {
      document.body.classList.remove("DarkModeFunction");
    }
  });

  const botonDarkMode = document.querySelector(".DarkMode");

  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("DarkModeFunction");
  });
};

async function ConsultAPI() {
  try {
    const url = "/includes/Config/getAPIProperties.php";
    const result = await fetch(url);

    if (!result.ok) {
      throw new Error(`Error en la solicitud: ${result.status}`);
    }

    ObjectProperty.property = await result.json(); // Guardamos los datos

    if (ObjectProperty.property.length > 0) {
      //alert("DATOS EXTRAIDOS CORRECTAMENTE");
      //console.log("DATOS EXTRAIDOS CORRECTAMENTE", ObjectProperty.property);
    } else {
      //alert("No se encontraron datos.");
      //console.warn("No se encontraron datos en la API.");
    }
  } catch (error) {
    //alert("Error al consultar la API. Ver consola.");
    //console.error("Error al consultar la API:", error);
  }
}

const OptionBuySell = (e) => {
  const OptionBuySellMethodDiv = document.querySelector("#property-options");
  const options = e.target.value;

  if (options === "Buy") {
    let optionsHTML = `
      <label for="property">Seleccione una Propiedad</label>
      <select id="property" required>
        <option value="" disabled selected>-- Propiedades Disponibles --</option>
    `;
    ObjectProperty.property.forEach((propiedad) => {
      optionsHTML += `
        <option value="${propiedad.id}">
          ${propiedad.titulo}
        </option>
      `;
    });

    optionsHTML += `</select>`;

    let imagesHTML = `<div class="propertyImages">`;
    ObjectProperty.property.forEach((propiedad) => {
      imagesHTML += `
        <div class="propertyItem" data-id="${propiedad.id}">
          <img src="${ImageProperty}${propiedad.imagen}" alt="${propiedad.titulo}">
          <p>${propiedad.titulo}</p>
        </div>
      `;
    });
    imagesHTML += `</div>`;

    OptionBuySellMethodDiv.innerHTML = optionsHTML + imagesHTML;

    syncSelectWithImages();
  } else if (options === "Sell") {
    OptionBuySellMethodDiv.innerHTML = `
      <label for="property-image">Suba una imagen de su Propiedad</label>
      <input type="file" required>
      <textarea placeholder="Cuéntenos sobre su Propiedad" required></textarea>
    `;
  } else {
    OptionBuySellMethodDiv.innerHTML = "";
  }
};

const syncSelectWithImages = () => {
  const select = document.querySelector("#property");
  const images = document.querySelectorAll(".propertyItem");

  if (!select || images.length === 0) return;
  const updateSelect = (id) => {
    select.value = id;
    highlightSelectedImage(id);
  };

  const highlightSelectedImage = (id) => {
    images.forEach((img) => {
      img.classList.remove("SelectedProperty");
      if (img.dataset.id === id) {
        img.classList.add("SelectedProperty");
      }
    });
  };

  select.addEventListener("change", (e) => {
    updateSelect(e.target.value);
  });

  images.forEach((img) => {
    img.addEventListener("click", () => {
      updateSelect(img.dataset.id);
      select.value = img.dataset.id;
    });
  });
};

const SelectContact = (e) => {
  const contactMethodDiv = document.querySelector("#contact-method-input");
  const options = e.target.value;

  if (options === "phone") {
    contactMethodDiv.innerHTML = `
          <input type="number" placeholder="Tu teléfono" id="phone" name="contact[phone]" required>
      `;
  } else if (options === "email") {
    contactMethodDiv.innerHTML = `
          <input type="email" placeholder="Tu correo electrónico" id="email" name="contact[email]" required>
      `;
  } else {
    contactMethodDiv.innerHTML = "";
  }
};

//Same Function as the contact.php script

/* 
const AlertendForm = () => {
  const form = document.querySelector("#contact-form"); 

  form.addEventListener("click", function (e) {
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

  alert("Formulario Funcionando");

};
*/