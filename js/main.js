document.addEventListener("DOMContentLoaded", () => {
  $(".preloader-container").fadeOut();
  getSizeServiceImage();
  if (document.querySelector(".splide")) {
    new Splide(".splide", { type: "loop", arrows: false }).mount();
  }
  if (document.querySelector(".splideCupones")) {
    new Splide(".splideCupones", {
      type: "loop",
      arrows: false,
    }).mount();
  }
});
$(".wait").click(function () {
  $(".preloader-container").fadeIn();
});
window.addEventListener("resize", () => {
  getSizeServiceImage();
});
function getSizeServiceImage() {
  document
    .querySelectorAll(".services__list li .image")
    .forEach((image, index) => {
      var hTxt = document.querySelector(
        `.services__list li:nth-of-type(${index + 1}) p`
      ).clientHeight;
      var total = hTxt - image.clientWidth;
      image.style.height = total + "px";
    });
}

function createCustomSelect() {
  var x, i, j, l, ll, selElmnt, a, b, c;
  /*look for any elements with the class "custom-select":*/
  x = document.getElementsByClassName("custom-select");
  l = x.length;
  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
      /*for each option in the original select element,
      create a new DIV that will act as an option item:*/
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function (e) {
        /*when an item is clicked, update the original select box,
          and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
      });
      b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function (e) {
      /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
  }
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x,
    y,
    i,
    xl,
    yl,
    arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i);
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
document.addEventListener("click", closeAllSelect);
function copyText(input) {
  var copyText = document.getElementById(input);
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  showSnackBar();
}
function copyToClipboard(elem) {
  // create hidden text element, if it doesn't already exist
  var targetId = "_hiddenCopyText_";
  var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
  var origSelectionStart, origSelectionEnd;
  if (isInput) {
    // can just use the original source element for the selection and copy
    target = elem;
    origSelectionStart = elem.selectionStart;
    origSelectionEnd = elem.selectionEnd;
  } else {
    // must use a temporary form element for the selection and copy
    target = document.getElementById(targetId);
    if (!target) {
      var target = document.createElement("textarea");
      target.style.position = "absolute";
      target.style.left = "-9999px";
      target.style.top = "0";
      target.id = targetId;
      document.body.appendChild(target);
    }
    target.textContent = elem.textContent;
  }
  // select the content
  var currentFocus = document.activeElement;
  target.focus();
  target.setSelectionRange(0, target.value.length);

  // copy the selection
  var succeed;
  try {
    succeed = document.execCommand("copy");
  } catch (e) {
    succeed = false;
  }
  // restore original focus
  if (currentFocus && typeof currentFocus.focus === "function") {
    currentFocus.focus();
  }

  if (isInput) {
    // restore prior selection
    elem.setSelectionRange(origSelectionStart, origSelectionEnd);
  } else {
    // clear temporary content
    target.textContent = "";
  }
  showSnackBar();
  return succeed;
}
var actualStep = 1;
var nextStep = 2;
var totalSteps = 6;
function setStepBack() {
  if (actualStep < totalSteps) {
    document.querySelector(`.steps__content-${nextStep - 1}`).style.display =
      "none";
    document.querySelector(`.steps__content-${nextStep - 2}`).style.display =
      "block";
    actualStep = actualStep - 1;
    nextStep = nextStep - 1;
  }
}
function setStep() {
  if (actualStep < totalSteps) {
    document.querySelector(`.steps__content-${actualStep}`).style.display =
      "none";
    document.querySelector(`.steps__content-${nextStep}`).style.display =
      "block";
    actualStep = actualStep + 1;
    nextStep = nextStep + 1;
  }
}
function closeSteps() {
  document.querySelector(`.steps`).style.display = "none";
}
function verifyType(e) {
  let value = e.target.value;
  if (value == "perro") {
    document.querySelector(".dog").style.opacity = 1;
    document.querySelector(".cat").style.opacity = 0;
    // document.querySelector(".steps__content-2 h2 span").innerHTML = "perro";
    document.querySelector("#image").value = "10";
    document.querySelector("#type").value = "perro";
  } else {
    document.querySelector(".cat").style.opacity = 1;
    document.querySelector(".dog").style.opacity = 0;
    // document.querySelector(".steps__content-2 h2 span").innerHTML = "gato";
    document.querySelector("#image").value = "43";
    document.querySelector("#type").value = "gato";
  }
  const fetchPetsData = () => {
    const urls = [
      "https://agile-sands-59528.herokuapp.com/colors",
      "https://agile-sands-59528.herokuapp.com/breeds?_limit=350",
    ];
    const allRequests = urls.map(async (url) => {
      let response = await fetch(url);
      return response.json();
    });
    return Promise.all(allRequests);
  };
  fetchPetsData()
    .then((arrayOfResponses) => {
      return arrayOfResponses;
    })
    .then((data) => {
      let colors = data[0];
      let breeds = data[1];
      let names = [];
      breeds.forEach((breed) => {
        if (breed.type == value.toLowerCase()) {
          names.push(breed.name);
        }
      });
      if (document.getElementById("razaInput")) {
        autocomplete(document.getElementById("razaInput"), names);
      }
      if (document.getElementById("hair_color")) {
        colors.forEach((color) => {
          document.getElementById(
            "hair_color"
          ).innerHTML += `<option value="${color.name}">${color.name}</option>`;
        });
      }
    })
    .then(() => createCustomSelect());
}
function verifyGender(e) {
  let value = e.target.value;
  if (value == "hembra") {
    document.querySelector(".dog .especie .hembra").style.display = "block";
    document.querySelector(".dog .especie .hembra").style.opacity = 1;
    document.querySelector(".cat .especie .hembra").style.display = "block";
    document.querySelector(".cat .especie .hembra").style.opacity = 1;

    document.querySelector(".dog .especie .macho").style.display = "none";
    document.querySelector(".dog .especie .macho").style.opacity = 0;
    document.querySelector(".cat .especie .macho").style.display = "none";
    document.querySelector(".cat .especie .macho").style.opacity = 0;
  } else {
    document.querySelector(".dog .especie .macho").style.display = "block";
    document.querySelector(".dog .especie .macho").style.opacity = 1;
    document.querySelector(".cat .especie .macho").style.display = "block";
    document.querySelector(".cat .especie .macho").style.opacity = 1;

    document.querySelector(".dog .especie .hembra").style.display = "none";
    document.querySelector(".dog .especie .hembra").style.opacity = 0;
    document.querySelector(".cat .especie .hembra").style.display = "none";
    document.querySelector(".cat .especie .hembra").style.opacity = 0;
  }
}
function setName(e) {
  let value = e.target.value;
  document.querySelector(".steps__header .dog .name").innerHTML = value;
  document.querySelector(".steps__header .cat .name").innerHTML = value;
  document.querySelector(".steps__header .dog .name").style.opacity = 1;
  document.querySelector(".steps__header .cat .name").style.opacity = 1;
  if (value != "") {
    document
      .querySelector(".steps__content-3 button")
      .removeAttribute("disabled");
  }
}
if (
  document.querySelector("#editProfile") ||
  document.querySelector("#registerForm") ||
  document.querySelector(".plansBody")
) {
  createCustomSelect();
}

function setRaza() {
  document.querySelector(".steps__header .dog .raza").innerHTML =
    document.querySelector("#razaInput").value;
  document.querySelector(".steps__header .cat .raza").innerHTML =
    document.querySelector("#razaInput").value;
  document.querySelector(".steps__header .dog .raza").style.opacity = 1;
  document.querySelector(".steps__header .cat .raza").style.opacity = 1;
  if (document.querySelector("#razaInput").value != "") {
    setStep();
  }
}
function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function (e) {
    var a,
      b,
      i,
      val = this.value;
    closeAllLists();
    if (!val) {
      return false;
    }
    currentFocus = -1;
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");

    this.parentNode.appendChild(a);
    var reg = new RegExp(val.toLowerCase());
    return arr.filter(function (term) {
      if (term.toLowerCase().match(reg)) {
        b = document.createElement("DIV");

        b.innerHTML = "<strong>" + term + "</strong>";
        b.innerHTML += "<input type='hidden' value='" + term + "'>";

        b.addEventListener("click", function (e) {
          inp.value = this.getElementsByTagName("input")[0].value;

          closeAllLists();
        });
        a.appendChild(b);
        return term;
      }
    });
  });

  inp.addEventListener("keydown", function (e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
      currentFocus++;

      addActive(x);
    } else if (e.keyCode == 38) {
      currentFocus--;

      addActive(x);
    } else if (e.keyCode == 13) {
      e.preventDefault();
      if (currentFocus > -1) {
        if (x) x[currentFocus].click();
      }
    }
  });
  function addActive(x) {
    if (!x) return false;

    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = x.length - 1;

    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }

  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}
function showSnackBar() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function () {
    x.className = x.className.replace("show", "");
  }, 3000);
}
function getChild(parent, className) {
  var notes = null;
  for (var i = 0; i < parent.childNodes.length; i++) {
    if (parent.childNodes[i].className == className) {
      notes = parent.childNodes[i];
      break;
    }
  }
  return notes;
}
var getNextSibling = function (elem, selector) {
  // Get the next sibling element
  var sibling = elem.nextElementSibling;

  // If there's no selector, return the first sibling
  if (!selector) return sibling;

  // If the sibling matches our selector, use it
  // If not, jump to the next sibling and continue the loop
  while (sibling) {
    if (sibling.matches(selector)) return sibling;
    sibling = sibling.nextElementSibling;
  }
};
if (document.querySelector("form#login")) {
  $("form#login").validate({
    rules: {
      email: { required: true, email: true },
      password: "required",
    },
    messages: {
      email: {
        required: "Campo Obligatorio*",
        email: "El correo no es válido",
      },
      password: "Campo Obligatorio*",
    },
    submitHandler: function (form) {
      $("#login button[type='submit']").attr("disabled", true);
      $("#login button[type='submit']").text("Iniciando sesión...");
      $("#login").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          if (data.message == "Not Found") {
            $("#login button[type='submit']").text("Reintentar");
            $("#login button[type='submit']").attr("disabled", false);
            document.querySelector("#snackbar").innerHTML =
              "Usuario no encontrado";
            showSnackBar();
          } else if (data.message == "Email or password incorrect") {
            $("#login button[type='submit']").text("Reintentar");
            $("#login button[type='submit']").attr("disabled", false);
            document.querySelector("#snackbar").innerHTML =
              "El correo o la contraseña no son correctos";
            showSnackBar();
          } else {
            $(".preloader-container").fadeIn();
            $("#login button[type='submit']").text("Enviado");
            $("#login button[type='submit']").attr("disabled", false);
            $("#login button[type='submit']").text("Iniciar Sesión");
            window.location.href = `/mi-cuenta/${lang}/`;
          }
        },
      });
    },
  });
}
if (document.querySelector("form#recover")) {
  $.validator.methods.email = function (value, element) {
    return (
      this.optional(element) ||
      /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(
        value
      )
    );
  };
  $("form#recover").validate({
    rules: {
      recover_email: { required: true, email: true },
    },
    messages: {
      recover_email: {
        required: "Campo Obligatorio*",
        email: "El correo no es válido",
      },
    },
    submitHandler: function (form) {
      $("#recover button").attr("disabled", true);
      $("#recover button").text("Enviando");
      $("#recover").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          if (data.msg == "There is no user with this email") {
            $("#recover button").text("Reintentar");
            $("#recover button").attr("disabled", false);
            document.querySelector("#snackbar").innerHTML =
              "El correo no esta registrado.";
            showSnackBar();
          } else {
            if (data.statusCode == 500) {
              $("#recover button").text("Reintentar");
              $("#recover button").attr("disabled", false);
              document.querySelector("#snackbar").innerHTML =
                "El correo no esta registrado.";
              showSnackBar();
            } else {
              console.log(data);
              $("#recover button").attr("disabled", false);
              $("#recover button").text("Enviado");
              let user = {
                token: data.token.token,
                email: data.email,
                fullname: `${data.name} ${data.lastname}`,
              };
              console.log({ user });
              form.reset();
              $("#recover button").text("Enviar");
              $("#recover").fadeOut();
              $(".successMsg").fadeIn("slow");
              $("img.left").fadeOut();
              $("img.right").fadeIn();
            }
          }
        },
      });
    },
  });
}
if (document.querySelector("form#vacuna")) {
  $.validator.methods.email = function (value, element) {
    return (
      this.optional(element) ||
      /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(
        value
      )
    );
  };
  $("form#vacuna").validate({
    rules: {
      init_date: { required: true },
      e_date: { required: true },
      lote: { required: true },
      veterinario: { required: true },
    },
    messages: {
      init_date: { required: "Campo Obligatorio*" },
      e_date: { required: "Campo Obligatorio*" },
      lote: { required: "Campo Obligatorio*" },
      veterinario: { required: "Campo Obligatorio*" },
    },
    submitHandler: function (form) {
      $("#vacuna button").attr("disabled", true);
      $("#vacuna button").text("Enviando");
      $("#vacuna").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          console.log(data);
          if (data) {
            setTimeout(() => {
              $("form#vacuna button").text("Crear vacuna");
              $("form#vacuna button").attr("disabled", false);
            }, 500);
          }
        },
      });
    },
  });
}
if (document.querySelector("form#newpass")) {
  $.validator.methods.email = function (value, element) {
    return (
      this.optional(element) ||
      /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(
        value
      )
    );
  };
  $("form#newpass").validate({
    rules: {
      password: { required: true },
      confirmpassword: { required: true, equalTo: "#password" },
    },
    messages: {
      password: { required: "Campo obligatorio." },
      confirmpassword: {
        required: "Campo obligatorio.",
        equalTo: "Las contraseñas no coinciden.",
      },
    },
    submitHandler: function (form) {
      $("#newpass button").attr("disabled", true);
      $("#newpass button").text("Enviando");
      $("#newpass").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          $(".newPassMain img.left").fadeOut();
          $(".newPassMain img.right").fadeIn();
          $("#newpass").fadeOut();
          $(".successMsg").fadeIn("slow");
        },
      });
    },
  });
}
document.querySelectorAll(".tabs label").forEach((tab) => {
  tab.addEventListener("click", () => {
    if (document.querySelector(".tabs label.active")) {
      document.querySelector(".tabs label.active").classList.remove("active");
    }
    tab.classList.add("active");
  });
});
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");
if (togglePassword) {
  togglePassword.addEventListener("click", function (e) {
    // toggle the type attribute
    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    // toggle the eye / eye slash icon
    this.innerHTML =
      password.getAttribute("type") === "password"
        ? "visibility"
        : "visibility_off";
  });
}
const togglePasswordConfirm = document.querySelector("#togglePasswordConfirm");
const confirmpassword = document.querySelector("#confirmpassword");
if (togglePasswordConfirm) {
  togglePasswordConfirm.addEventListener("click", function (e) {
    // toggle the type attribute
    const type =
      confirmpassword.getAttribute("type") === "password" ? "text" : "password";
    confirmpassword.setAttribute("type", type);
    // toggle the eye / eye slash icon
    this.innerHTML =
      confirmpassword.getAttribute("type") === "password"
        ? "visibility"
        : "visibility_off";
  });
}

$.validator.methods.email = function (value, element) {
  return (
    this.optional(element) ||
    /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(
      value
    )
  );
};
function pagoExitosoBox() {
  const fancybox = new Fancybox([
    {
      src: `
      <div
      class="box valid"
      id="valid"
      style=" max-width: 480px; width: 100%"
    >
      <img src="img/check.svg" alt="check" />
      <h2>Pago aprobado</h2>
      <p>Tu pago ha sido aprobado, ahora podrás crear tu mascota</p>
      <div class="actions">
      <button type="button" onclick="Fancybox.close()">Continuar</button>
  </div>
    </div>`,
      type: "html",
    },
  ]);
  fancybox.on("closing", (fancybox, slide) => {
    location.href = "https://wepet.co/mi-cuenta/agregar-mascota";
  });
}
function pagoPendienteBox(actions = true) {
  if (actions) {
    const fancybox = new Fancybox([
      {
        src: `
          <div
          class="box invalid"
          id="invalid"
          style=" max-width: 480px; width: 100%"
        >
          <img src="img/pendiente.svg" alt="pendiente" />
          <h2>Pago pendiente</h2>
          <p>
           Tu pago está siendo confirmado por tu banco, esto puede tradar varios minutos.En cuanto sea aprobado te enviaremos un correo electrónico, para que finalices tu proceso de inscripción.
          </p>
              <div class="actions">
                <button
                  type="button"
                  onclick="Fancybox.close()"
                  style="width:100%;"
                >
                  Aceptar
                </button>
              </div>
        </div>`,
        type: "html",
      },
    ]);
    fancybox.on("closing", (fancybox, slide) => {
      location.href = "https://wepet.co/mi-cuenta/iniciar-sesion";
    });
  } else {
    const fancybox = new Fancybox([
      {
        src: `
          <div
          class="box invalid"
          id="invalid"
          style=" max-width: 480px; width: 100%"
        >
          <img src="img/pendiente.svg" alt="pendiente" />
          <h2>Pago pendiente</h2>
          <p>
           Tu pago está siendo confirmado por tu banco, esto puede tradar varios minutos.En cuanto sea aprobado te enviaremos un correo electrónico, para que finalices tu proceso de inscripción.
          </p>
        </div>`,
        type: "html",
      },
    ]);
    fancybox.on("closing", (fancybox, slide) => {
      location.href = "https://wepet.co/mi-cuenta/iniciar-sesion";
    });
  }
}
function pagoRechazadoBox(plan, type) {
  const fancybox = new Fancybox([
    {
      src: `
        <div
        class="box invalid"
        id="invalid"
        style=" max-width: 480px; width: 100%"
      >
        <img src="img/cross.svg" alt="cross" />
        <h2>Pago rechazado</h2>
        <p>
         Tu pago ha sido rechazado, intenta con otro medio de pago.
        </p>
      </div>`,
      type: "html",
    },
  ]);
  fancybox.on("closing", (fancybox, slide) => {
    createFormCard(findUiWord(11), plan, type);
  });
}

$("form#registerForm").validate({
  rules: {
    name: { required: true },
    lastname: { required: true },
    email: { required: true, email: true },
    phone: { required: true, digits: true },
    city: { required: true },
    birthday: { required: true },
    typedoc: { required: true },
    typedoc: { required: true },
    numdoc: { required: true },
    address: { required: true },
    password: { required: true },
    confirmpassword: { required: true, equalTo: "#password" },
  },
  messages: {
    name: { required: "Este campo es obligatorio." },
    lastname: { required: "Este campo es obligatorio." },
    email: {
      required: "Este campo es obligatorio.",
      email: "No es un correo válido.",
    },
    phone: {
      required: "Este campo es obligatorio.",
      digits: "Este campo solo acepta números",
    },
    city: { required: "Este campo es obligatorio." },
    birthday: { required: "Este campo es obligatorio." },
    typedoc: { required: "Este campo es obligatorio." },
    typedoc: { required: "Este campo es obligatorio." },
    numdoc: { required: "Este campo es obligatorio." },
    address: { required: "Este campo es obligatorio." },
    password: { required: "Este campo es obligatorio." },
    confirmpassword: {
      required: "Este campo es obligatorio.",
      equalTo: "Las contraseñas no coinciden",
    },
  },
  submitHandler: function (form) {
    $("form#registerForm button").attr("disabled", true);
    $("form#registerForm button").text("Enviando");
    $("#registerForm").ajaxSubmit({
      dataType: "json",
      clearForm: false,
      success: function (data) {
        if (data.resp) {
          if (data.resp.msg === "User already exist") {
            showSnackBar();
            document.querySelector("#snackbar").innerHTML =
              "Ya existe un usuario con este correo.";
            $("form#registerForm button").attr("disabled", false);
            $("form#registerForm button").text("Reintentar");
          } else {
            showSnackBar();
            document.querySelector("#snackbar").innerHTML =
              "El usuario fue creado correctamente.";
            $("form#registerForm button").text("Creado");
            if (data.message == 1) {
              $("form#registerForm button").text("Registrarme");
              $("form#registerForm button").attr("disabled", false);
              pagoExitosoBox();

              console.log(data.resp.user.id);
              if (!data.isLoggin) {
                window.location.href = `/mi-cuenta/${lang}/agregar-mascota?type=${data.type}`;
              } else {
                window.location.href = `https://wepet.co/mi-cuenta/s/userLoginFB/?userID=${data.resp.user.id}&firstTime=1&type=${data.type}`;
              }
              console.log("/mi-cuenta/agregar-mascota?type=" + data.type);
            } else if (data.message == 2) {
              pagoPendienteBox();
            } else if (data.message == 3) {
              $("form#registerForm button").attr("disabled", false);
              $("form#registerForm button").text("Reintentar");
              pagoRechazadoBox(data.type, data.plan);
            }
          }
        } else {
          if (data.message == 1) {
            $("form#registerForm button").text("Registrarme");
            $("form#registerForm button").attr("disabled", false);
            console.log(data.resp.user.id);
            if (!data.isLoggin) {
              window.location.href = `/mi-cuenta/${lang}/agregar-mascota?type=${data.type}`;
            } else {
              window.location.href = `https://wepet.co/mi-cuenta/s/userLoginFB/?userID=${data.resp.user.id}&firstTime=1&type=${data.type}`;
            }
            console.log("/mi-cuenta/agregar-mascota?type=" + data.type);
          } else if (data.message == 2) {
            pagoPendienteBox();
          } else if (data.message == 3) {
            $("form#registerForm button").attr("disabled", false);
            $("form#registerForm button").text("Reintentar");
            pagoRechazadoBox(data.type, data.plan);
          }
        }
      },
    });
  },
});
$("form#editProfile").validate({
  rules: {
    name: { required: true },
    lastname: { required: true },
    email: { required: true, email: true },
    phone: { required: true, digits: true },
    city: { required: true },
    birthday: { required: true },
    typedoc: { required: true },
    numdoc: { required: true },
    address: { required: true },
  },
  messages: {
    name: { required: "Este campo es obligatorio." },
    lastname: { required: "Este campo es obligatorio." },
    email: {
      required: "Este campo es obligatorio.",
      email: "No es un correo válido.",
    },
    phone: {
      required: "Este campo es obligatorio.",
      digits: "Este campo solo acepta números",
    },
    city: { required: "Este campo es obligatorio." },
    birthday: { required: "Este campo es obligatorio." },
    typedoc: { required: "Este campo es obligatorio." },
    typedoc: { required: "Este campo es obligatorio." },
    numdoc: { required: "Este campo es obligatorio." },
    address: { required: "Este campo es obligatorio." },
  },
  submitHandler: function (form) {
    $("form#editProfile button").attr("disabled", true);
    $("form#editProfile button").text("Enviando");
    $("#editProfile").ajaxSubmit({
      dataType: "json",
      clearForm: false,
      success: function (data) {
        console.log(data);
        $("form#editProfile button").text("Guardado");
        $("form#editProfile button").text("Guardar");
        $("form#editProfile button").attr("disabled", false);
        document.querySelector("#snackbar").innerHTML = "Información editada";
        showSnackBar();
        setTimeout(() => {
          location.reload();
        }, 600);
      },
    });
  },
});
$("form#stepsForm").validate({
  rules: {},
  messages: {},
  submitHandler: function (form) {
    $("form#stepsForm button").attr("disabled", true);
    $("form#stepsForm button").text("Creando...");
    $("#stepsForm").ajaxSubmit({
      dataType: "json",
      clearForm: false,
      success: function (data) {
        console.log(data);
        console.log(data.resp);
        showSnackBar();
        $("form#stepsForm button").text("Creada");
        setTimeout(() => {
          $("form#stepsForm button").attr("disabled", false);
          $("form#stepsForm button").text("Crear");
          window.location.href = `/mi-cuenta/editar-mascota-${data.resp.id}`;
        }, 500);
      },
    });
  },
});
$("form#petProfile").validate({
  rules: {},
  messages: {},
  submitHandler: function (form) {
    $("form#petProfile button").attr("disabled", true);
    $("form#petProfile button").text("Guardando...");
    $("#petProfile").ajaxSubmit({
      dataType: "json",
      clearForm: false,
      success: function (data) {
        $(".preloader-container").fadeIn();
        $("form#petProfile button").text("Guardado");
        $("form#petProfile button").attr("disabled", false);
        $("form#petProfile button").text("Guardar");
        window.location.href = `/mi-cuenta/${lang}/`;
      },
    });
  },
});
let quickViewButtons = document.querySelectorAll("[data-quick-view]");
let closeButtons = document.querySelectorAll("[data-close");
let fullwidthCards = document.querySelectorAll(".fullwidth");
let toggle; // Quick view <button>.
let toggleParent; // <li>.
let fullwidth; // Fullwidth card to be "injected".
const openQuickView = (toggle, toggleParent, fullwidth) => {
  toggle.setAttribute("aria-expanded", "true");
  toggleParent.classList.toggle("is-selected");
  fullwidth.classList.toggle("is-hidden");
  // Make fullwidth card keyboard focusable.
  fullwidth.setAttribute("tabIndex", "0");
};
const closeQuickView = (toggle, toggleParent, fullwidth) => {
  toggle.setAttribute("aria-expanded", "false");
  toggleParent.classList.toggle("is-selected");
  fullwidth.classList.toggle("is-hidden");
  fullwidth.removeAttribute("tabIndex");
};
quickViewButtons.forEach((quickView) => {
  // Add appropriate ARIA attributes for "toggle" behaviour.
  fullwidth = quickView.parentElement.nextElementSibling;
  quickView.setAttribute("aria-expanded", "false");
  quickView.setAttribute("aria-controls", fullwidth.id);

  quickView.addEventListener("click", (e) => {
    toggle = e.target;
    toggleParent = toggle.parentElement;
    fullwidth = toggleParent.nextElementSibling;

    // Open (or close) fullwidth card.
    if (toggle.getAttribute("aria-expanded") === "false") {
      // Do we have another fullwidth card already open? If so, close it.
      fullwidthCards.forEach((fullwidthOpen) => {
        if (!fullwidthOpen.classList.contains("is-hidden")) {
          toggleParentOpen = fullwidthOpen.previousElementSibling;
          toggleOpen = toggleParentOpen.querySelector("[data-quick-view");

          closeQuickView(toggleOpen, toggleParentOpen, fullwidthOpen);
        }
      });

      openQuickView(toggle, toggleParent, fullwidth);
    } else {
      closeQuickView(toggle, toggleParent, fullwidth);
    }
  });
});
closeButtons.forEach((close) => {
  close.addEventListener("click", (e) => {
    fullwidth = e.target.parentElement;
    toggleParent = e.target.parentElement.previousElementSibling;
    toggle = toggleParent.querySelector("[data-quick-view");

    closeQuickView(toggle, toggleParent, fullwidth);
    toggle.focus(); // Return keyboard focus to "toggle" button.
  });
});
document.querySelectorAll(".fullwidth .splide").forEach((el) => {
  new Splide(el, {
    type: "loop",
    perPage: 1,
    width: 460,
    arrows: false,
  }).mount();
});
async function query(
  url,
  body = "",
  method = "GET",
  callback,
  translate = false
) {
  var finalUrl;
  const domain = "https://agile-sands-59528.herokuapp.com/";
  if (translate) {
    finalUrl = `${domain}${url}?_locale=${lang}&_limit=500`;
  } else {
    finalUrl = `${domain}${url}`;
  }

  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");
  if (method == "GET") {
    var requestOptions = {
      method: method,
      headers: myHeaders,
    };
    const fetchReady = await fetch(finalUrl, requestOptions)
      .then(function (response) {
        return response.json();
      })
      .then((text) => {
        return callback(text);
      })
      .catch(function (error) {
        console.log(error);
      });
    return fetchReady;
  } else {
    var raw = JSON.stringify(body);
    var requestOptions = {
      method: method,
      headers: myHeaders,
      body: raw,
      redirect: "follow",
    };
    const fetchReady = await fetch(finalUrl, requestOptions)
      .then(function (response) {
        return response.json();
      })
      .then((text) => {
        return callback(text);
      })
      .then((text) => {
        return true;
      })
      .catch(function (error) {
        console.log(error);
      });
    return fetchReady;
  }
}
function deletePet(id) {
  fetch("s/cancelSuscription/?id_subscription=" + activePetSub)
    .then(function (text) {
      query(`pets/${id}`, "", "DELETE", (text) => {
        console.log(JSON.stringify(text));
        setTimeout(() => {
          window.location.href = `/mi-cuenta/${lang}`;
        }, 2000);
      });
    })
    .catch(function (error) {
      console.log(error);
    });
}
function setActivePet(pet) {
  fetch("g/activePet/?pet=" + pet)
    .then(function (response) {
      return response.json();
    })
    .then(function (text) {
      console.log(text);
      window.location.href = `/mi-cuenta/${lang}`;
    })
    .catch(function (error) {
      console.log(error);
    });
}
let activeLink = "";
function setlinkProvider(link) {
  activeLink = link;
}

function addSingle() {
  objIndex = petActiveService.findIndex(
    (obj) => obj.service.id == activeService
  );
  petActiveService[objIndex].quantity = petActiveService[objIndex].quantity + 1;
  var raw = { services_rel: petActiveService };
  query(`pets/${petId}`, raw, "PUT", (resp) => {
    if (resp.statusCode != 400 && resp.statusCode != 500) {
      window.location.href = `/mi-cuenta/${lang}/?activePet=${petId}`;
    }
  });
}
if (document.querySelector("#petProfile")) {
  const fetchPetsData = () => {
    const urls = [
      "https://agile-sands-59528.herokuapp.com/colors",
      "https://agile-sands-59528.herokuapp.com/foods?_type=" +
        actualType +
        "&_sort=name:ASC",
      "https://agile-sands-59528.herokuapp.com/breeds?_limit=350",
    ];
    const allRequests = urls.map(async (url) => {
      let response = await fetch(url);
      return response.json();
    });
    return Promise.all(allRequests);
  };
  fetchPetsData()
    .then((arrayOfResponses) => {
      return arrayOfResponses;
    })
    .then((data) => {
      let colors = data[0];
      let foods = data[1];
      let breeds = data[2];
      let names = [];
      breeds.forEach((breed) => {
        if (breed.type == actualType.toLowerCase()) {
          names.push(breed.name);
        }
      });
      if (document.getElementById("razaInput")) {
        autocomplete(document.getElementById("razaInput"), names);
      }
      colors.forEach((color) => {
        document.querySelector(
          "#petProfile #hair_color"
        ).innerHTML += `<option value="${color.name}">${color.name}</option>`;
      });
      foods.forEach((food) => {
        document.querySelector(
          "#petProfile #food"
        ).innerHTML += `<option value="${food.name}">${food.name}</option>`;
      });
    })
    .then(() => createCustomSelect());
}
function formatBytes(bytes, decimals = 2) {
  if (bytes === 0) return "0 Bytes";

  const k = 1024;
  const dm = decimals < 0 ? 0 : decimals;
  const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];

  const i = Math.floor(Math.log(bytes) / Math.log(k));

  return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
}
function changePhoto(e) {
  document.querySelector(".petProfile__photo-input").classList.add("loading");
  var formdata = new FormData();
  formdata.append("files", e.files[0], e.files[0].name);
  let size = formatBytes(e.files[0].size);
  if (size < "2 MB") {
    var requestOptions = {
      method: "POST",
      body: formdata,
      redirect: "follow",
    };

    fetch("https://agile-sands-59528.herokuapp.com/upload", requestOptions)
      .then((response) => response.json())
      .then((result) => {
        return result[0];
      })
      .then((image) => {
        document.querySelector(".petProfile__photo-pet").src = image.url;
        document.querySelector(
          ".profile-header__right-pets li.active img"
        ).src = image.url;
        query(`pets/${activePet}`, { image: image.id }, "PUT", (text) => {
          console.log(text);
          document
            .querySelector(".petProfile__photo-input")
            .classList.remove("loading");
        });
      })
      .catch((error) => console.log("error", error));
  } else {
    document.querySelector("#snackbar").innerHTML =
      "La imagen supera los 2 MB, prueba con otra foto.";
    showSnackBar();
    document
      .querySelector(".petProfile__photo-input")
      .classList.remove("loading");
  }
}
var animation = bodymovin.loadAnimation({
  container: document.getElementById("lottie"), // Required
  path: "data.json", // Required
  renderer: "svg", // Required
  loop: true, // Optional
  autoplay: true, // Optional
  name: "Hello World", // Name for future reference. Optional.
});
const tour = new Shepherd.Tour({
  defaultStepOptions: {
    cancelIcon: {
      enabled: true,
    },
    scrollTo: { behavior: "smooth", block: "center" },
  },
});
let stepActive = 1;
async function getTourWords() {
  let word62 = await findUiWord(62);
  let word63 = await findUiWord(63);
  let word64 = await findUiWord(64);
  let word65 = await findUiWord(65);
  let word69 = await findUiWord(69);
  let word68 = await findUiWord(68);
  let word70 = await findUiWord(70);
  let word71 = await findUiWord(71);
  let word72 = await findUiWord(72);
  let word73 = await findUiWord(73);
  let word248 = await findUiWord(248);
  let word250 = await findUiWord(250);
  let word76 = await findUiWord(76);
  let word77 = await findUiWord(77);
  if (window.innerWidth >= 768) {
    tour.addStep({
      title: word62,
      text: word63,
      attachTo: {
        element: ".profile-header__left-edit",
        on: "right",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: word64,
      text: word65,
      attachTo: {
        element: ".profile-header__right-pets",
        on: "bottom",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: word69,
      text: word68,
      attachTo: {
        element: ".addPet",
        on: "left",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: word70,
      text: word71,
      attachTo: {
        element: ".todayWepet",
        on: "right",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: word72,
      text: word73,
      attachTo: {
        element: ".cupones",
        on: "right",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: word72,
      text: word73,
      attachTo: {
        element: ".services",
        on: "right",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: word248,
      text: word250,
      attachTo: {
        element: ".service__pet-active .menu",
        on: "right",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: word76,
      text: word77,
      attachTo: {
        element: ".services__list-item-quantity",
        on: "right",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Finalizar",
        },
      ],
    });
  } else {
    tour.addStep({
      title: "Edita tu perfil",
      text: `Este ícono te permitirá configurar tu información personal, contraseña y otros datos como usuario de We Pet.`,
      attachTo: {
        element: ".profile-header__left-edit",
        on: "bottom",
      },
      buttons: [
        {
          action() {
            activeNextStep();
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: "Lista mascotas",
      text: `Las mascotas que afilies a un plan We Pet saldrán en estos circulos. Haz clic en su foto para modificar su foto y otra información importante.`,
      attachTo: {
        element: ".profile-header__right-pets",
        on: "bottom",
      },
      buttons: [
        {
          action() {
            activeNextStep();
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: "Agregar mascota",
      text: `Con este botón puedes agregar tantas mascotas como desees, cada una puede tener suscripción a un plan de forma independiente.`,
      attachTo: {
        element: ".addPet a",
        on: "top",
      },
      buttons: [
        {
          action() {
            activeNextStep();
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: "Hoy en WEPET",
      text: `En esta área encontrarás novedades de la comunidad de We Pet constantemente. Haz clic para ver más.`,
      attachTo: {
        element: ".todayWepet",
        on: "bottom",
      },
      buttons: [
        {
          action() {
            activeNextStep();
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: "Cupones",
      text: `Al ser miembro de We Pet, verás constantemente nuevos códigos de descuentos en nuestra tienda en línea. Úsalos y disfruta de más productos y servicios pensados para ti y tus mascotas.`,
      attachTo: {
        element: ".cupones",
        on: "top",
      },
      buttons: [
        {
          action() {
            activeNextStep();
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: "Servicios de la mascota",
      text: `En esta área verás los servicios disponibles en el plan de tu mascota, puedes hacer clic en cada uno para usarlos. ¿Están agotados? no te preocupes, puedes adquirir servicios extra que no hagan parte del plan habitual de tu mascota.`,
      attachTo: {
        element: ".services",
        on: "top",
      },
      buttons: [
        {
          action() {
            activeNextStep();
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: "Cambiar mascota",
      text: `Si tienes varias mascotas configuradas en We Pet, puedes usar este botón para navegar entre los planes de cada una de ellas. ¡Inténtalo!`,
      attachTo: {
        element: ".service__pet-active .menu",
        on: "bottom",
      },
      buttons: [
        {
          action() {
            activeNextStep();
            return this.next();
          },
          text: "Siguiente",
        },
      ],
    });
    tour.addStep({
      title: "Contador de servicios disponibles",
      text: `Este número indica cuántos servicios del mismo tipo te quedan por usar dentro del plan de una mascota.`,
      attachTo: {
        element: ".services__list-item-quantity",
        on: "bottom",
      },
      buttons: [
        {
          action() {
            return this.next();
          },
          text: "Finalizar",
        },
      ],
    });
    if (document.querySelector("#startTour")) {
      document.querySelector("#startTour").addEventListener("click", () => {
        tour.start();
        document.querySelector(`.stepBox.step-${stepActive}`).style.display =
          "block";
      });
    }
  }
}
if (document.querySelector("#startTour")) {
  document.querySelector("#startTour").addEventListener("click", async () => {
    await getTourWords();
    tour.start();
  });
}
function activeNextStep() {
  document.querySelector(`.stepBox.step-${stepActive}`).style.display = "none";
  stepActive++;
  document.querySelector(`.stepBox.step-${stepActive}`).style.display = "block";
}

function sendEmail(
  email,
  subject = "Welcome to the Club",
  templateId,
  mergeTags
) {
  var settings = {
    url: "slingshot.egoiapp.com/api/v2/email/messages/action/send",
    method: "POST",
    timeout: 0,
    headers: {
      ApiKey: "fefb6c9187d0aea56b84080f9866005af21185ae",
      "Content-Type": "application/json",
    },
    data: JSON.stringify([
      {
        domain: "wepet.co",
        senderId: "5",
        senderName: "We Pet",
        to: [`${email}`],
        subject: `${subject}`,
        templateId: `${templateId}`,
        openTracking: true,
        clickTracking: true,
        mergeTags: [`${mergeTags}`],
        priority: "non-urgent",
        registered: false,
        header: {
          listUnsubscribe: true,
          optInIpAddress: "https://wepet.co",
        },
      },
    ]),
  };

  $.ajax(settings).done(function (response) {
    console.log(response);
  });
}

function createFormCard(
  title = findUiWord(11),
  plan,
  type,
  offer = false,
  offerValue = 0
) {
  const fancybox = new Fancybox([
    {
      src: `
      <div
        class="box creditcard"
        id="dialog-content"
        style="max-width: 480px; width: 100%"
      >
        <form action="s/credit/" id="creditcard" method="POST">
          <h2>${title}</h2>
          <div class="card-wrapper"></div>
 
  <span>
    <label for="card_number">${getsingleWord(13, 169)}</label>
    <input
      type="text"
      name="card_number"
      id="card_number"
      placeholder="${getsingleWord(13, 169)}"
    />
  </span>
  <span>
  <label for="name">${getsingleWord(12, 168)}</label>
  <input type="text" name="name" id="name" placeholder="${getsingleWord(
    298,
    300
  )}" />
</span>
<div class="flex">
<span>
  <label for="month">${getsingleWord(56, 211)}</label>
  
    <input
      type="text"
      name="month"
      id="month"
      placeholder="MM/AA"
      style="flex: 1; margin: 0"
    />
  
</span>
<span>
  <label for="secure_code">CVV</label>
  <input type="text" name="secure_code" id="secure_code" placeholder="CVC" />
</span>
</div>
  <small
    >${getsingleWord(15, 171)}</small
  >
          <input type="hidden" name="planID" id="planID" value="${plan}" />
          <input type="hidden" name="planType" id="planType" value="${type}" />
          <button type="submit">${getsingleWord(33, 187)}</button>
        </form>
      </div>`,
      type: "html",
    },
  ]);
  fancybox.on("done", (fancybox, slide) => {
    var card = new Card({
      form: "#creditcard",
      container: ".card-wrapper",
      formSelectors: {
        numberInput: "input#card_number",
        expiryInput: "input#month",
        cvcInput: "input#secure_code",
        nameInput: "input#name",
      },
      formatting: true,
      placeholders: {
        name: getsingleWord(12, 168),
        expiry: "••/••",
        cvc: "•••",
      },
      messages: {
        validDate: "expire\ndate",
        monthYear: "mm/yy",
      },
      debug: true,
    });
    $("form#creditcard").validate({
      rules: {
        name: "required",
        mascara: "required",
        month: "required",
        year: "required",
        cvv: "required",
      },
      messages: {
        name: "required",
        mascara: "required",
        month: "required",
        year: "required",
        cvv: "required",
      },
      submitHandler: function (form) {
        $("#creditcard button").attr("disabled", true);
        $("#creditcard button").text("Validando...");
        $("#creditcard").ajaxSubmit({
          dataType: "json",
          success: function (data) {
            if (data.message == 0) {
              Fancybox.show([{ src: "#invalid", type: "inline" }]);
              $("#creditcard button").text("Reintentar");
              $("#creditcard button").attr("disabled", false);
            } else {
              Fancybox.show([{ src: "#valid", type: "inline" }]);
              $("#creditcard button").text("Enviado");
              $("#creditcard button").attr("disabled", false);
              setTimeout(() => {
                $("#creditcard button").text("Enviar");
                if (offer) {
                  location.href =
                    "/mi-cuenta/registro?plan=" +
                    data.info.user.plan.id +
                    "&user=" +
                    data.info.user.id +
                    "&type=" +
                    data.type +
                    "&offer=" +
                    offerValue;
                } else {
                  location.href =
                    "/mi-cuenta/registro?plan=" +
                    data.info.user.plan.id +
                    "&user=" +
                    data.info.user.id +
                    "&type=" +
                    data.type;
                }
              }, 500);
            }
          },
        });
      },
    });
    createCustomSelect();
  });
}
function methodSelector(price, service, email = "", name = "") {
  const fancybox = new Fancybox([
    {
      src: `<div class="box method" id="method" style="max-width: 480px; width: 100%">
      <h2>Escoge el método de pago que usaras para esta compra</h2>
      <div class="flex">
        <button type="button" onclick="cardMethod(${price}, '${service}')">
          <img src="img/card.svg" alt="card">
          <small>Tu tarjeta de crédito actual</small>
        </button>
        <a href="/mi-cuenta/pago-servicio/pse?ServicePrice=${price}&ServiceName=${service}&email=${email}&name=${name}">
          <img src="img/pse.svg" alt="pse">
        </a>
      </div>
    </div>`,
      type: "html",
    },
  ]);
}
const formatter = new Intl.NumberFormat("en-US", {
  style: "currency",
  currency: "USD",
  minimumFractionDigits: 0,
});
function cardMethod(price, service) {
  const fancybox = new Fancybox([
    {
      src: `
      <div
        class="box creditcard"
        id="dialog-content"
        style="max-width: 480px; width: 100%"
      >
      <h2>Vas a usar tu método de pago actual</h2>
      <p>Haremos un cobro de ${formatter.format(
        price
      )} dinero a tu tarjeta de crédito actual, ¿estás seguro?</p>
      <div class="actions">
      <form action="s/payService/" id="payService" method="POST">
      <input type="hidden" id="value" name="value" value="${price}" />
      <input type="hidden" id="service" name="service" value="${service}" />
      <button type="submit" class="uppercase">Pagar</button>
      </form>
      <a href="javascript:Fancybox.close();" class="uppercase">Cancelar</button>
      </div>
      </div>`,
      type: "html",
    },
  ]);
  $("form#payService").validate({
    rules: {},
    messages: {},
    submitHandler: function (form) {
      $("#payService button").attr("disabled", true);
      $("#payService button").text("Validando...");
      $("#payService").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          console.log(data);
          if (data.pay.data.respuesta == "Aprobada") {
            addSingle();
            payValid();
          } else if (data.pay.data.respuesta == "Pendiente") {
            pagoPendienteBox();
          } else {
            payInvalid();
          }
        },
      });
    },
  });
}
function payValid() {
  const fancybox = new Fancybox([
    {
      src: `
      <div class="box valid" id="valid" style=" max-width: 480px; width: 100%">
      <img src="img/check.svg" alt="check" />
      <h2>Pago aprobado</h2>
      <p>Tu pago ha sido aprobado puedes usar nuevamente tu servicio</p>
      <div class="actions">
      <button type="button" onclick="Fancybox.close()" style="width:100%;">Continuar</button>
      </div>
      </div>`,
      type: "html",
    },
  ]);
  fancybox.on("closing", (fancybox, slide) => {
    // location.reload();
  });
}
function payInvalid() {
  const fancybox = new Fancybox([
    {
      src: `
      <div
      class="box invalid"
      id="invalid"
      style=" max-width: 480px; width: 100%"
    >
      <img src="img/cross.svg" alt="cross" />
      <h2>Pago rechazado</h2>
      <p>
       Tu pago ha sido rechazado, intentalo nuevamente más tarde.
      </p>
    </div>`,
      type: "html",
    },
  ]);
}
function openBoxPayPlan(plan, type, price) {
  const fancybox = new Fancybox([
    {
      src: `<div
      class="box creditcard"
      id="dialog-content"
      style="max-width: 480px; width: 100%"
    >
    <h2>Vas a usar tu método de pago actual</h2>
    <p>Haremos un cobro de ${formatter.format(price)} cada ${
        type == "Anual" ? "año" : "mes"
      } a tu tarjeta de crédito actual, ¿estás seguro?</p>
    <div class="actions">
    <form action="s/addPetPay/" method="POST" id="newPetPay">
    <input type="hidden" name="plan" id="plan" value="${plan}">
    <input type="hidden" name="type" id="type" value="${type}">
    <button type="submit" class="uppercase">Pagar</button>
    </form>
    <a href="javascript:Fancybox.close();" class="uppercase">Cancelar</button>
    </div>
    </div>`,
      type: "html",
    },
  ]);
  $("form#newPetPay").validate({
    rules: {},
    messages: {},
    submitHandler: function (form) {
      $("#newPetPay button").attr("disabled", true);
      $("#newPetPay button").text("Validando...");
      $("#newPetPay").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          console.log(data);
          if (data.message == 1) {
            $("form#newPetPay button").text("Registrarme");
            $("form#newPetPay button").attr("disabled", false);
            pagoExitosoBox();
            setTimeout(() => {
              window.location.href =
                "/mi-cuenta/agregar-mascota?type=" + data.type;
              console.log("/mi-cuenta/agregar-mascota?type=" + data.type);
            }, 800);
          } else if (data.message == 2) {
            pagoPendienteBox();
            window.location.href = `/mi-cuenta/${lang}/`;
          } else if (data.message == 3) {
            $("form#newPetPay button").attr("disabled", false);
            $("form#newPetPay button").text("Reintentar");
            pagoRechazadoBox(data.type, data.plan);
          }
        },
      });
    },
  });
}
function payValidPlan(plan, type) {
  const fancybox = new Fancybox([
    {
      src: `
      <div
  class="box valid"
  id="valid"
  style=" max-width: 480px; width: 100%"
>
  <img src="img/check.svg" alt="check" />
  <h2>Pago aprobado</h2>
  <p>Tu pago ha sido aprobado</p>
  <div class="actions">
  <button type="button" onclick="Fancybox.close()" style="width:100%;">Continuar</button>
  </div>
</div>`,
      type: "html",
    },
  ]);
  fancybox.on("closing", (fancybox, slide) => {
    console.log(`closing!`);
    // location.href = "/mi-cuenta/agregar-mascota?plan=" + plan + "&type=" + type;
  });
}
function payInvalidPlan() {
  const fancybox = new Fancybox([
    {
      src: `
      <div
      class="box invalid"
      id="invalid"
      style=" max-width: 480px; width: 100%"
    >
      <img src="img/cross.svg" alt="cross" />
      <h2>Pago rechazado</h2>
      <p>
       Tu pago ha sido rechazado, intentalo nuevamente más tarde.
      </p>
    </div>`,
      type: "html",
    },
  ]);
}
async function openBoxChangePlan(plan, type, price) {
  const uiwordsFetch = await getAllUiWord();
  if (uiwordsFetch) {
    console.log(uiwords.es);
    const fancybox = new Fancybox([
      {
        src: `
      <div class="box creditcard" id="dialog-content" style="max-width: 480px; width: 100%" >
        <h2>${getsingleWord(316)}</h2>
        <p>${getsingleWord(309)} ${formatter.format(price)} ${getsingleWord(
          310
        )} ${
          type == "Anual" ? getsingleWord(312, 314) : getsingleWord(313, 315)
        } ${getsingleWord(311)}</p>
        
          <form action="s/changePlan/" method="POST" id="changeplanForm">
            <input type="hidden" name="plan" id="plan" value="${plan}">
            <input type="hidden" name="type" id="type" value="${type}"> 
            <input type="hidden" name="price" id="price" value="${price}">
            <div class="flex actions">
            <a href="javascript:Fancybox.close();" class="uppercase">${getsingleWord(
              32,
              186
            )}</a>
            <button type="submit" class="uppercase">Pagar</button>
            </div>
          </form>
        
      </div>
      `,
        type: "html",
      },
    ]);
    $("form#changeplanForm").validate({
      rules: {},
      messages: {},
      submitHandler: function (form) {
        $("#changeplanForm button").attr("disabled", true);
        $("#changeplanForm button").text("Validando...");
        $("#changeplanForm").ajaxSubmit({
          dataType: "json",
          success: function (data) {
            Fancybox.close();
            if (data.message == 1) {
              $("form#changeplanForm button").text("Registrarme");
              $("form#changeplanForm button").attr("disabled", false);
              changeValidPlan(plan, type);
            } else if (data.message == 2) {
              pagoPendienteBox();
            } else if (data.message == 3) {
              $("form#changeplanForm button").attr("disabled", false);
              $("form#changeplanForm button").text("Reintentar");
              pagoRechazadoBox(data.type, data.plan);
            }
          },
        });
      },
    });
  }
}
Date.prototype.addDays = function (days) {
  const date = new Date(this.valueOf());
  date.setDate(date.getDate() + days);
  return date;
};
function changeValidPlan(plan, type) {
  query(`services/planquantity/${plan}`, "", "GET", (services_rel) => {
    let sub_end = "";
    const date = new Date();
    if (type == "Anual") {
      sub_end =
        date.addDays(365).getFullYear() +
        "-" +
        ("0" + (date.addDays(365).getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + date.addDays(365).getDate()).slice(-2);
    } else {
      sub_end =
        date.addDays(30).getFullYear() +
        "-" +
        ("0" + (date.addDays(30).getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + date.addDays(30).getDate()).slice(-2);
    }
    var raw = { plan, services_rel, sub_end };
    query(`pets/${petId}`, raw, "PUT", (text) => {
      if (text.statusCode != 400 && text.statusCode != 500) {
        setTimeout(() => {
          window.location.href = "/mi-cuenta/?activePet=" + petId;
        }, 500);
      }
    });
    pagoExitosoBox();
  });
}
function changeInvalidPlan() {
  const fancybox = new Fancybox([
    {
      src: `
      <div
      class="box invalid"
      id="invalid"
      style=" max-width: 480px; width: 100%"
    >
      <img src="img/cross.svg" alt="cross" />
      <h2>${getsingleWord(308)}</h2>
      <p>
      ${getsingleWord(307)}
      </p>
    </div>`,
      type: "html",
    },
  ]);
}
if (document.querySelector("form#creditcardChange")) {
  $("form#creditcardChange").validate({
    rules: {
      name: "required",
      mascara: "required",
      month: "required",
      year: "required",
      cvv: "required",
    },
    messages: {
      name: "required",
      mascara: "required",
      month: "required",
      year: "required",
      cvv: "required",
    },
    submitHandler: function (form) {
      $("#creditcardChange button").attr("disabled", true);
      $("#creditcardChange button").text("Validando...");
      $("#creditcardChange").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          console.log(data);
          if (data.message == 1) {
            $("form#registerForm button").text("Enviar");
            $("form#registerForm button").attr("disabled", false);
            pagoExitosoBox();
            setTimeout(() => {
              window.location.href =
                "/mi-cuenta/agregar-mascota?type=" + data.type;
              console.log("/mi-cuenta/agregar-mascota?type=" + data.type);
            }, 800);
          } else if (data.message == 2) {
            pagoPendienteBox();
          } else if (data.message == 3) {
            $("form#registerForm button").attr("disabled", false);
            $("form#registerForm button").text("Reintentar");
            pagoRechazadoBox(data.type, data.plan);
          } else {
            $("form#registerForm button").attr("disabled", false);
            $("form#registerForm button").text("Reintentar");
          }
        },
      });
    },
  });
}
async function creadeCodeStore(prefix, discount, desc, productId) {
  var myHeaders = new Headers();
  myHeaders.append(
    "Authorization",
    "Basic Y2tfZDliN2U3NDY4YTdiYjY5NmNjZmU2ZGY5ZmJlNGI1OGQzMjZlYTIxNzpjc19hN2M1ZGI5ZWUyODMyNmE3NDk0ODMyNTI0MDc4NGRjZjQ4ODBkNTM4"
  );
  var formdata = new FormData();
  formdata.append("code", `${prefix}${randomString()}`);
  // formdata.append("code", "AHG20LP2");
  formdata.append("amount", discount);
  formdata.append("discount_type", "percent");
  formdata.append("description", desc);
  formdata.append("individual_use", "true");
  formdata.append("product_ids", productId);
  formdata.append("usage_limit", "1");
  formdata.append("usage_limit_per_user", "1");
  formdata.append("exclude_sale_items", "false");
  formdata.append("minimum_amount", "0");
  var requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: formdata,
    redirect: "follow",
  };

  const coupon = await fetch(
    "https://wepet.co/wp-json/wc/v3/coupons",
    requestOptions
  )
    .then((response) => response.json())
    .then((result) => result)
    .catch((error) => console.log("error", error));
  var myHeadersedit = new Headers();
  myHeadersedit.append(
    "Authorization",
    "Basic Y2tfZDliN2U3NDY4YTdiYjY5NmNjZmU2ZGY5ZmJlNGI1OGQzMjZlYTIxNzpjc19hN2M1ZGI5ZWUyODMyNmE3NDk0ODMyNTI0MDc4NGRjZjQ4ODBkNTM4"
  );
  myHeadersedit.append("Content-Type", "application/json");

  var raw = JSON.stringify({
    description: `${coupon.description} editada`,
    meta_data: [{ key: "coupon_commissions_type", value: "default" }],
  });

  var requestOptions = {
    method: "PUT",
    headers: myHeadersedit,
    body: raw,
    redirect: "follow",
  };

  const final = await fetch(
    "https://wepet.co/wp-json/wc/v3/coupons/" + coupon.id,
    requestOptions
  )
    .then((response) => response.json())
    .then((result) => result)
    .catch((error) => console.log("error", error));
  return final;
}
async function sendEmail(email, mergeTags) {
  var requestOptions = {
    method: "POST",
    redirect: "follow",
  };

  const emailSended = await fetch(
    `s/sendEmail/?email=${email}&mergeTags=${mergeTags}`,
    requestOptions
  )
    .then((response) => response.json())
    .then((result) => result)
    .catch((error) => console.log("error", error));

  return emailSended;
}
async function removeSingle(productId, serviceLink, providerName) {
  document.querySelector("button.useService").innerHTML = "cargando...";
  objIndex = petActiveService.findIndex(
    (obj) => obj.service.id == activeService
  );
  petActiveService[objIndex].quantity = petActiveService[objIndex].quantity - 1;
  const code = await creadeCodeStore(
    `${petActiveService[objIndex].service.prefix}`,
    petActiveService[objIndex].service.discount,
    `Generado automaticamente por - ${petActiveService[objIndex].service.name}`,
    productId
  );

  if (code.id > 0) {
    await sendEmail(
      activeUser.email,
      `{"cupon":"${code.code}","linkproduct":"${serviceLink}","serv":"${petActiveService[objIndex].service.name}","prov":"${providerName}"}`
    );
    var raw = { services_rel: petActiveService };
    query(`pets/${petId}`, raw, "PUT", (text) => {
      if (text.statusCode != 400 && text.statusCode != 500) {
        document.querySelector("button.useService").innerHTML =
          "Usar este servicio";
        Fancybox.close();
        const fancybox = new Fancybox([
          {
            src: `
              <div
                class="box creditcard"
                id="dialog-content"
                style="max-width: 480px; width: 100%"
              >
              <h2>${getsingleWord(305)}</h2>
              <p>${getsingleWord(306)}</p>
              </div>`,
            type: "html",
          },
        ]);
        fancybox.on("closing", (fancybox, slide) => {
          window.location.href = "/mi-cuenta/?activePet=" + petId;
        });
      }
    });
  }
}
function openUseService(productId, serviceLink, provName) {
  const fancybox = new Fancybox([
    {
      src: `<div id="dialog-content" class="dialog" style="max-width: 480px; width: 100%">
        <h2>${getsingleWord(301)}</h2>
        <p>${getsingleWord(302)}</p>
        <div class="actions">
          <a href="" >${getsingleWord(303)}</a>
          <button type="button" onclick="removeSingle('${productId}','${serviceLink}', '${provName}')" class="useService">${getsingleWord(
        304
      )}</button>
        </div>
      </div>`,
      type: "html",
    },
  ]);
}
function randomString(
  length = 5,
  chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
) {
  var result = "";
  for (var i = length; i > 0; --i)
    result += chars[Math.floor(Math.random() * chars.length)];
  return result;
}
var rString = randomString();
if (document.querySelector("form#creditcard")) {
  $("form#creditcard").validate({
    rules: {
      name: "required",
      mascara: "required",
      month: "required",
      year: "required",
      cvv: "required",
    },
    messages: {
      name: "required",
      mascara: "required",
      month: "required",
      year: "required",
      cvv: "required",
    },
    submitHandler: function (form) {
      $("#creditcard button").attr("disabled", true);
      $("#creditcard button").text("Validando...");
      $("#creditcard").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          console.log(data);
          if (data.message == 0) {
            Fancybox.show([{ src: "#invalid", type: "inline" }]);
            $("#creditcard button").text("Reintentar");
            $("#creditcard button").attr("disabled", false);
          } else {
            Fancybox.show([{ src: "#valid", type: "inline" }]);
            $("#creditcard button").text("Enviado");
            $("#creditcard button").attr("disabled", false);
            setTimeout(() => {
              $("#creditcard button").text("Enviar");
              location.href =
                "/mi-cuenta/registro?plan=" +
                data.info.user.plan.id +
                "&user=" +
                data.info.user.id +
                "&type=" +
                data.type;
            }, 500);
          }
        },
      });
    },
  });
}
if (document.querySelector("form#creditcardChangeProfile")) {
  $("form#creditcardChangeProfile").validate({
    rules: {
      name: "required",
      mascara: "required",
      month: "required",
      year: "required",
      cvv: "required",
    },
    messages: {
      name: "required",
      mascara: "required",
      month: "required",
      year: "required",
      cvv: "required",
    },
    submitHandler: function (form) {
      $("#creditcardChangeProfile button").attr("disabled", true);
      $("#creditcardChangeProfile button").text("Validando...");
      $("#creditcardChangeProfile").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          console.log(data);
          console.log(data.user);
          if (data.message == 0) {
            Fancybox.show([{ src: "#invalid", type: "inline" }]);
            $("#creditcardChangeProfile button").text("Reintentar");
            $("#creditcardChangeProfile button").attr("disabled", false);
          } else {
            Fancybox.show([{ src: "#valid", type: "inline" }]);
            $("#creditcardChangeProfile button").text("Enviado");
            $("#creditcardChangeProfile button").attr("disabled", false);
            $("#creditcardChangeProfile button").text("Enviar");
            window.location =
              "https://wepet.co/mi-cuenta/s/getUser/?userID=" + data.user.id;
          }
        },
      });
    },
  });
}
function changePlanAndAddPay(title = findUiWord(11), plan, type) {
  const fancybox = new Fancybox([
    {
      src: `
        <div
          class="box creditcard"
          id="dialog-content"
          style="max-width: 480px; width: 100%"
        >
          <form action="p/changePlanNoCard/" id="creditcard" method="POST">
            <h2>${title}</h2>
            <div class="card-wrapper"></div>
           
            <span>
              <label for="card_number">${getsingleWord(13, 169)}</label>
              <input
                type="text"
                name="card_number"
                id="card_number"
                placeholder="${getsingleWord(13, 169)}"
              />
            </span>
            <span>
            <label for="name">${getsingleWord(12, 168)}</label>
            <input type="text" name="name" id="name" placeholder="${getsingleWord(
              298,
              300
            )}" />
          </span>
          <div class="flex" style="margin: 30px">
          <span>
            <label for="month">${getsingleWord(56, 211)}</label>
            
              <input
                type="text"
                name="month"
                id="month"
                placeholder="MM/AA"
                style="flex: 1; margin: 0"
              />
            
          </span>
          <span>
            <label for="secure_code">CVV</label>
            <input type="text" name="secure_code" id="secure_code" placeholder="CVC" />
          </span>
</div>
            <small
              >${getsingleWord(15, 171)}</small
            >
            <input type="hidden" name="planID" id="planID" value="${plan}" />
            <input type="hidden" name="planType" id="planType" value="${type}" />
            <button type="submit">${getsingleWord(33, 187)}</button>
          </form>
        </div>`,
      type: "html",
    },
  ]);
  fancybox.on("done", (fancybox, slide) => {
    var card = new Card({
      form: "#creditcard",
      container: ".card-wrapper",

      formSelectors: {
        numberInput: "input#card_number",
        expiryInput: "input#month",
        cvcInput: "input#secure_code",
        nameInput: "input#name",
      },
      formatting: true,
      placeholders: {
        name: getsingleWord(12, 168),
        expiry: "••/••",
        cvc: "•••",
      },
      messages: {
        validDate: "expire\ndate",
        monthYear: "mm/yy",
      },
      debug: true,
    });
    $("form#creditcard").validate({
      rules: {
        name: "required",
        mascara: "required",
        month: "required",
        year: "required",
        cvv: "required",
      },
      messages: {
        name: "required",
        mascara: "required",
        month: "required",
        year: "required",
        cvv: "required",
      },
      submitHandler: function (form) {
        $("#creditcard button").attr("disabled", true);
        $("#creditcard button").text("Validando...");
        $("#creditcard").ajaxSubmit({
          dataType: "json",
          success: function (data) {
            if (data.message == 1) {
              query(
                `services/planquantity/${plan}`,
                "",
                "GET",
                (services_rel) => {
                  let sub_end = "";
                  const date = new Date();
                  if (type == "Anual") {
                    sub_end =
                      date.addDays(365).getFullYear() +
                      "-" +
                      ("0" + (date.addDays(365).getMonth() + 1)).slice(-2) +
                      "-" +
                      ("0" + date.addDays(365).getDate()).slice(-2);
                  } else {
                    sub_end =
                      date.addDays(30).getFullYear() +
                      "-" +
                      ("0" + (date.addDays(30).getMonth() + 1)).slice(-2) +
                      "-" +
                      ("0" + date.addDays(30).getDate()).slice(-2);
                  }
                  var raw = { plan, services_rel, sub_end };
                  query(`pets/${petId}`, raw, "PUT", (text) => {
                    if (text.statusCode != 400 && text.statusCode != 500) {
                      window.location.href = "/mi-cuenta/?activePet=" + petId;
                    }
                  });
                }
              );
            } else if (data.message == 2) {
              pagoPendienteBox();
            } else if (data.message == 3) {
              pagoRechazadoBox(data.type, data.plan);
            }
            if (data.message == 0) {
              Fancybox.show([{ src: "#invalid", type: "inline" }]);
              $("#creditcard button").text("Reintentar");
              $("#creditcard button").attr("disabled", false);
            }
          },
        });
      },
    });
    createCustomSelect();
  });
}
function addPayMethodAndPayService(title = findUiWord(11), price, service) {
  const fancybox = new Fancybox([
    {
      src: `
        <div
          class="box creditcard"
          id="dialog-content"
          style="max-width: 480px; width: 100%"
        >
          <form action="p/buyServiceNoCard/" id="creditcard" method="POST">
            <h2>${title}</h2>
            <div class="card-wrapper"></div>
            <span>
              <label for="card_number">${getsingleWord(13, 169)}</label>
              <input
                type="text"
                name="card_number"
                id="card_number"
                placeholder="${getsingleWord(13, 169)}"
              />
            </span>
  <span>
    <label for="name">${getsingleWord(12, 168)}</label>
    <input type="text" name="name" id="name" placeholder="${getsingleWord(
      298,
      300
    )}" />
  </span>
  <div class="flex" style="margin: 30px">
  <span>
    <label for="month">${getsingleWord(56, 211)}</label>
    
      <input
        type="text"
        name="month"
        id="month"
        placeholder="MM/AA"
        style="flex: 1; margin: 0"
      />
   
  </span>
  <span>
    <label for="secure_code">CVV</label>
    <input type="text" name="secure_code" id="secure_code" placeholder="CVC" />
  </span>
 </div>
  <small
    >${getsingleWord(15, 171)}</small
  >
            <input type="hidden" id="value" name="value" value="${price}" />
            <input type="hidden" id="service" name="service" value="${service}" />
            <button type="submit">${getsingleWord(33, 187)}</button>
          </form>
        </div>`,
      type: "html",
    },
  ]);
  fancybox.on("done", (fancybox, slide) => {
    var card = new Card({
      form: "#creditcard",
      container: ".card-wrapper",
      formSelectors: {
        numberInput: "input#card_number",
        expiryInput: "input#month",
        cvcInput: "input#secure_code",
        nameInput: "input#name",
      },

      formatting: true,
      placeholders: {
        name: getsingleWord(12, 168),
        expiry: "••/••",
        cvc: "•••",
      },
      messages: {
        validDate: "expire\ndate",
        monthYear: "mm/yy",
      },
      debug: true,
    });
    $("form#creditcard").validate({
      rules: {
        name: "required",
        mascara: "required",
        month: "required",
        year: "required",
        cvv: "required",
      },
      messages: {
        name: "required",
        mascara: "required",
        month: "required",
        year: "required",
        cvv: "required",
      },
      submitHandler: function (form) {
        $("#creditcard button").attr("disabled", true);
        $("#creditcard button").text("Validando...");
        $("#creditcard").ajaxSubmit({
          dataType: "json",
          success: function (data) {
            if (data.message == 1) {
              addSingle();
              payValid();
            } else if (data.message == 2) {
              pagoPendienteBox(false);
            } else if (data.message == 3) {
              pagoRechazadoBox(data.type, data.plan);
            }
            if (data.message == 0) {
              Fancybox.show([{ src: "#invalid", type: "inline" }]);
              $("#creditcard button").text("Reintentar");
              $("#creditcard button").attr("disabled", false);
            }
          },
        });
      },
    });
    createCustomSelect();
  });
}
let allDepartamentos = [];
if (document.querySelector("#departamento")) {
  fetch(
    "https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json"
  )
    .then((res) => res.json())
    .then((data) => {
      allDepartamentos = data;
      let departamentos = [];
      data.forEach((sing) => {
        departamentos.push(sing.departamento);
      });
      return departamentos;
    })
    .then((depart) => {
      autocomplete(document.getElementById("departamento"), depart);
    });
}

function createCities(event) {
  setTimeout(() => {
    let ciudades = allDepartamentos.find(
      (dep) => dep.departamento == event.target.value
    ).ciudades;
    console.log({ value: event.target.value, ciudades, allDepartamentos });
    document.querySelector("#city").value = "";
    autocomplete(document.getElementById("city"), ciudades);
  }, 200);
}

if (document.querySelector("#creditcardChange")) {
  var card = new Card({
    form: "#creditcardChange",
    container: ".card-wrapper",
    formSelectors: {
      numberInput: "input#card_number",
      expiryInput: "input#month",
      cvcInput: "input#secure_code",
      nameInput: "input#name",
    },
    formatting: true,
    placeholders: {
      name: "",
      expiry: "••/••",
      cvc: "•••",
    },
    messages: {
      validDate: "expire\ndate",
      monthYear: "mm/yy",
    },
    debug: true,
  });
}
if (document.querySelector("#creditcard")) {
  var card = new Card({
    form: "#creditcard",
    container: ".card-wrapper",
    formSelectors: {
      numberInput: "input#card_number",
      expiryInput: "input#month",
      cvcInput: "input#secure_code",
      nameInput: "input#name",
    },
    formatting: true,
    placeholders: {
      name: "",
      expiry: "••/••",
      cvc: "•••",
    },
    messages: {
      validDate: "expire\ndate",
      monthYear: "mm/yy",
    },
    debug: true,
  });
}
if (document.querySelector("#createSub")) {
  var card = new Card({
    form: "#createSub",
    container: ".card-wrapper",
    formSelectors: {
      numberInput: "input#card_number",
      expiryInput: "input#month",
      cvcInput: "input#secure_code",
      nameInput: "input#name",
    },
    formatting: true,
    placeholders: {
      name: "",
      expiry: "••/••",
      cvc: "•••",
    },
    messages: {
      validDate: "expire\ndate",
      monthYear: "mm/yy",
    },
    debug: true,
  });
}

// LOGIN FACEBOOK N GOOGLE
var googleUser = {};
var startApp = function () {
  gapi.load("auth2", function () {
    // Retrieve the singleton for the GoogleAuth library and set up the client.
    auth2 = gapi.auth2.init({
      client_id:
        "289140913383-rpui9j72gss785bf6q9b02i5m05aue9e.apps.googleusercontent.com",
      cookiepolicy: "single_host_origin",
      // Request scopes in addition to 'profile' and 'email'
      //scope: 'additional_scope'
    });
    attachSignin(document.getElementById("customBtn"));
  });
};

function attachSignin(element) {
  console.log(element.id);
  auth2.attachClickHandler(
    element,
    {},
    function (googleUser) {
      // Useful data for your client-side scripts:
      var profile = googleUser.getBasicProfile();
      console.log("ID: " + profile.getId()); // Don't send this directly to your server!
      // console.log('Full Name: ' + profile.getName());
      // console.log('Given Name: ' + profile.getGivenName());
      // console.log('Family Name: ' + profile.getFamilyName());
      // console.log("Image URL: " + profile.getImageUrl());
      // console.log("Email: " + profile.getEmail());

      // The ID token you need to pass to your backend:
      var id_token = googleUser.getAuthResponse().id_token;
      // console.log("ID Token: " + id_token);
      setCookie("username", profile.getGivenName(), 15);
      setCookie("userlastname", profile.getFamilyName(), 15);
      setCookie("useremail", profile.getEmail(), 15);
      checkUserWepet(
        profile.getEmail(),
        profile.getGivenName(),
        profile.getFamilyName()
      );
    },
    function (error) {
      console.error(error);
    }
  );
}

window.fbAsyncInit = function () {
  FB.init({
    appId: "1795860513946369",
    cookie: true,
    xfbml: true,
    version: "v12.0",
  });

  FB.AppEvents.logPageView();
};
function revokeAllScopes() {
  gapi.auth2.getAuthInstance().disconnect();
  document.location.reload();
  deleteCookie("username");
  deleteCookie("userlastname");
  deleteCookie("useremail");
}

function testAPI() {
  console.log("Welcome!  Fetching your information.... ");
  FB.api("/me?fields=name,email,birthday", function (response) {
    checkUserWepet(response.email);
  });
}

function checkUserWepet(email, name, lastname) {
  fetch(`https://agile-sands-59528.herokuapp.com/wepetusers/?_email=${email}`)
    .then((response) => response.json())
    .then((data) => {
      if (data.length > 0) {
        const userfind = data[0];
        if (userfind.pets.length > 0) {
          location.href = `https://wepet.co/mi-cuenta/s/userLoginFB/?userID=${userfind.id}`;
        } else {
          if (userfind.plan.price == "0" && !userfind.transaction) {
            location.href = `https://wepet.co/mi-cuenta/s/userLoginFB/?userID=${userfind.id}&firstTime=1`;
          } else {
            if (userfind.transaction.status == "Pendiente") {
              pagoPendienteBox(false);
            } else {
              console.log(
                `El estado de su última transacción es <b>${userfind.transaction.status}</b> con referencia <b>${userfind.transaction.reference}</b>`
              );
            }
          }
        }
      } else {
        location.href = `https://wepet.co/mi-cuenta/planes?email=${email}&name=${
          name ? name : ""
        }&lastname=${lastname ? lastname : ""}`;
      }
    })
    .catch((err) => console.error(err));
}

function logOutFB() {
  if (FB.getAccessToken()) {
    FB.logout(function (response) {
      console.log(response);
      // document.location.reload();
    });
  }
  deleteCookie("username");
  deleteCookie("userlastname");
  deleteCookie("useremail");
}

function fb_login() {
  FB.login(
    function (response) {
      if (response.authResponse) {
        console.log("Welcome!  Fetching your information.... ");
        //console.log(response); // dump complete info
        access_token = response.authResponse.accessToken; //get access token
        user_id = response.authResponse.userID; //get FB UID

        FB.api("/me?fields=name,email,birthday", function (response) {
          checkUserWepet(response.email);
        });
      } else {
        //user hit cancel button
        console.log("User cancelled login or did not fully authorize.");
      }
    },
    {
      scope: "public_profile,email",
    }
  );
}

async function findUiWord(id) {
  if (lang != "es") {
    const b = await query("ui-words/" + id, "", "GET", (result) => {
      result.localizations.forEach(async (localization) => {
        if (localization.locale == lang) {
          return await query(
            "ui-words/" + localization.id,
            "",
            "GET",
            (result) => {
              return result.Name;
            }
          );
        }
      });
    });
    return b;
  } else {
    const a = await query("ui-words/" + id, "", "GET", (result) => {
      return result.Name;
    });
    return a;
  }
}
let uiwords = {
  "en-US": [],
  es: [],
};
async function getAllUiWord() {
  const a = await query(
    "ui-words",
    "",
    "GET",
    (result) => {
      uiwords.es = result;
      return true;
    },
    true
  );
  const b = await query(
    "ui-words",
    "",
    "GET",
    (result) => {
      uiwords["en-US"] = result;
      return true;
    },
    true
  );
  console.log({ a, b });
  if (a) {
    return true;
  }
  if (b) {
    return true;
  }
}

function getsingleWord(esID, enID) {
  let word;
  if (lang == "es") {
    if (uiwords.es.find((x) => x.id === esID)) {
      word = uiwords.es.find((x) => x.id === esID).Name;
    }
  } else {
    if (uiwords["en-US"].find((x) => x.id === enID)) {
      word = uiwords["en-US"].find((x) => x.id === enID).Name;
    }
  }
  return word;
}

let button = document.querySelectorAll(".single-provider .filter-rank li a");
button.forEach((btn) => {
  btn.addEventListener("click", () => {
    let buttonActive = document.querySelector(
      ".single-provider .filter-rank li a.active"
    );
    if (buttonActive) {
      buttonActive.classList.remove("active");
      btn.classList.add("active");
    } else {
      btn.classList.add("active");
    }
  });
});

function checkParent(parent, child) {
  if (parent.contains(child)) return true;
  return false;
}

let plansContainersLi = document.querySelectorAll(".plansBody .single-plan li");
let strong = document.querySelector("strong");
plansContainersLi.forEach((plansContainerLi) => {
  if (checkParent(plansContainerLi, strong)) {
    plansContainerLi.classList.add("has_tooltip");
  }
});

function viewcomment() {
  let textarea = document.querySelector(".reviewBody form textarea");
  let button = document.querySelector(".reviewBody form button");
  textarea.style.display = "block";
  button.style.display = "block";
  $("form#createReview").validate({
    rules: {
      comment: { required: true },
    },
    messages: {
      comment: "Campo Obligatorio*",
    },
    submitHandler: function (form) {
      $("#createReview").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          console.log(data);
          $("#createReview button").attr("disabled", false);
          $("#createReview button").text("Enviado");
          $(".reviewBody img.right").fadeIn();
          $("#createReview").fadeOut();
          $(".successMsg").fadeIn("slow");
        },
      });
    },
  });
}

function timeSince(date) {
  date = new Date(Date.parse(date));
  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = seconds / 31536000;

  if (interval > 1) {
    return Math.floor(interval) + " años";
  }
  interval = seconds / 2592000;
  if (interval > 1) {
    return Math.floor(interval) + " meses";
  }
  interval = seconds / 86400;
  if (interval > 1) {
    return Math.floor(interval) + " dias";
  }
  interval = seconds / 3600;
  if (interval > 1) {
    return Math.floor(interval) + " horas";
  }
  interval = seconds / 60;
  if (interval > 1) {
    return Math.floor(interval) + " minutos";
  }
  return Math.floor(seconds) + " segundos";
}

async function getReviews(id, rank, page = 0, limit = true) {
  document
    .querySelector(".single-provider .users_comments")
    .classList.add("loading");
  const container = document.querySelector(".single-provider .users_comments");
  let url = `reviews?provider=${id}&_start=${page}`;
  if (rank) url += `&rank=${rank}`;
  if (limit) url += `&_limit=4`;
  await query(url, "", "GET", (response) => {
    console.log(response);
    response.forEach((review) => {
      let template = ` <li>
        <div class="comment_info">
          <div class="comment_info_left">
            <img src="${review.wepetuser.photo.formats.small.url}" alt="${
        review.wepetuser.name
      }" />
            <div class="cont">
              <h5 class="uppercase">${review.wepetuser.name}</h5>
              <small>Hace ${timeSince(review.created_at)}</small>
            </div>
          </div>
          <div class="comment_info_right rank">
            
            ${(function fun() {
              templateFinal = "";
              fill_huella =
                '<img src="img/fill_huella.svg" alt="fill_huella.svg">';
              huella = '<img src="img/huella.svg" alt="huella.svg">';
              for (let i = 0; i < review.rank; i++) {
                templateFinal += fill_huella;
              }
              for (let i = 0; i < 5 - review.rank; i++) {
                templateFinal += huella;
              }
              return templateFinal;
            })()}
          </div>
        </div>
        <p>
        ${review.comment}
        </p>
        <div class="reaction">
          <button type="button"><svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12.1358 4.78239L12.3798 2.41339C12.4764 1.46139 13.4194 0.81539 14.3721 1.04739C15.8052 1.39739 16.812 2.65239 16.812 4.09139V7.12639C16.812 7.80139 16.812 8.13939 16.9668 8.38639C17.0549 8.52739 17.1758 8.64639 17.3201 8.73139C17.5747 8.88239 17.9216 8.88239 18.6143 8.88239H19.0344C20.841 8.88239 21.7437 8.88239 22.2996 9.27239C22.7165 9.56539 23.0104 9.99439 23.1271 10.4804C23.2819 11.1304 22.935 11.9434 22.2402 13.5674L21.8944 14.3774C21.6938 14.8465 21.6117 15.3532 21.6546 15.8574C21.9007 18.7314 19.4831 21.1524 16.5277 20.9934L5.46961 20.3944C4.26133 20.3294 3.65772 20.2964 3.11246 19.8414C2.56613 19.3864 2.46323 18.9174 2.25849 17.9804C1.82274 15.987 1.84263 13.929 2.31684 11.9434C2.61705 10.6954 3.88156 10.0234 5.18743 10.1834C8.64997 10.6034 11.7889 8.16439 12.1358 4.78339V4.78239Z" stroke="#309DA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Útil</button>
                        <button type="button"><svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12.1444 17.2175L11.9004 19.5865C11.8038 20.5385 10.8608 21.1845 9.90813 20.9525C8.47496 20.6025 7.46823 19.3475 7.46823 17.9085V14.8735C7.46823 14.1985 7.46823 13.8605 7.31335 13.6135C7.22642 13.4736 7.10531 13.3553 6.9601 13.2685C6.7055 13.1175 6.35861 13.1175 5.66589 13.1175H5.24581C3.43922 13.1175 2.53646 13.1175 1.98058 12.7275C1.56071 12.4308 1.26723 12.0023 1.15314 11.5195C0.99826 10.8695 1.34515 10.0565 2.03999 8.4325L2.38688 7.6225C2.58632 7.1545 2.668 6.6475 2.62557 6.1425C2.37946 3.2685 4.79708 0.847504 7.75254 1.0075L18.8106 1.6055C20.0189 1.6705 20.6225 1.7035 21.1677 2.1585C21.7141 2.6135 21.817 3.0825 22.0217 4.0195C22.4577 6.01287 22.4378 8.07096 21.9634 10.0565C21.6631 11.3045 20.3986 11.9765 19.0928 11.8165C15.6302 11.3965 12.4912 13.8355 12.1444 17.2165V17.2175Z" stroke="#309DA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Poco Útil</button>
        </div>
      </li>`;
      container.innerHTML += template;
    });
  });
  document
    .querySelector(".single-provider .users_comments")
    .classList.remove("loading");
}

function filterComments(rank) {
  document.querySelector(".single-provider .users_comments").innerHTML = "";
  getReviews(providerID, rank, 0, false);
  document.querySelector(".single-provider button.moreComments").style.display =
    "none";
}

if (document.querySelector(".single-provider .users_comments")) {
  query("reviews/count?provider=" + providerID, "", "GET", (response) => {
    let totalPages = Math.round(response / 4);
    if (totalPages > 0) {
      document.querySelector(
        ".single-provider button.moreComments"
      ).style.display = "flex";
      document
        .querySelector(".single-provider button.moreComments")
        .addEventListener("click", () => {
          actualPage++;
          pageitem = 4 * actualPage;
          getReviews(providerID, false, pageitem);
          console.log({ actualPage, totalPages });
          console.log(actualPage == totalPages);
          if (actualPage == totalPages) {
            document.querySelector(
              ".single-provider button.moreComments"
            ).style.display = "none";
          }
        });
    } else {
      document.querySelector(
        ".single-provider button.moreComments"
      ).style.display = "none";
    }
  });
}

var latitude;
var longitude;
// Ubicación
function geoFindMe() {
  if (!navigator.geolocation) {
    return;
  }
  function success(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
  }
  function error() {
    console.log("error");
  }
  navigator.geolocation.getCurrentPosition(success, error);
}

async function filterProviders(servId, depId = 0, cityId = 0) {
  let providerContainer = document.querySelector(".service__veteriarians-list");
  providerContainer.classList.add("loading");
  providerContainer.innerHTML = "";
  if (depId == 0 && cityId == 0) {
    await query(`services/${servId}`, "", "GET", (service) => {
      service.providers.map((provider, i) => {
        let service = provider.provider_services.find(
          (provider_service) => provider_service.service.id == servId
        );
        console.log(provider);

        let template = `
            <li class="service__veteriarians-list-item">
                <button
                  type="button"
                  data-quick-view
                  onclick="setlinkProvider('${service.link_service}')"
                >
                  <img src="${provider.profile_image.url}" alt="veteriarian" />
                  <h3>${provider.name}</h3>
                  <h4>${provider.subtitle}</h4>
                </button>
              </li>
              <li class="fullwidth is-hidden" id="quickview-0<?=i?>">
                <!-- <div class="arrow"></div> -.
                <div class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                    ${(function createImages() {
                      let images = "";
                      provider.images.map((image) => {
                        let imgTemp = ` <li class="splide__slide">
                        <img
                          src="${image.url}"
                          alt="veteriarian"
                        />
                      </li>`;
                        images += imgTemp;
                      });
                      return images;
                    })()}
                    </ul>
                  </div>
                </div>
                <div class="info">
                  <h3>${provider.name}</h3>
                  <h4>${provider.subtitle}</h4>
                  <p>${provider.description}</p>
                  <div class="flex shelude">
                    <div class="shelude-container">
                      <div class="flex">
                        <img src="img/clock.svg" alt="clock" />
                        ${provider.schedule}
                      </div>
                    </div>
                    <div class="shelude-container">
                      <div class="flex">
                        <img src="img/place.svg" alt="place" />
                        ${provider.places}
                      </div>
                    </div>
                  </div>
                  <div class="flex actions">
                  <a href='javascript:openUseService("${
                    service.id_service
                  }", "${service.link_service.split("//")[1]}", "${get_alias(
          provider.name
        )}");'>Usar servicio</a>
                    <a
                    href="/mi-cuenta/${lang}/proveedor/${get_alias(
          provider.name
        )}/${get_alias(service.service.name)}-${provider.id}-${
          service.service.id
        }"
                      class="invert"
                      >Conocer más
                    </a>
                  </div>
                </div>
              </li> `;
        if (service.link_service) {
          providerContainer.innerHTML += template;
        }
      });
    });
  } else if (depId == "all") {
    await query(`services/${servId}`, "", "GET", (service) => {
      service.providers.map((provider, i) => {
        let service = provider.provider_services.find(
          (provider_service) => provider_service.service.id == servId
        );
        if (service.link_service && service.available_country) {
          let template = `
            <li class="service__veteriarians-list-item">
                <button
                  type="button"
                  data-quick-view
                  onclick="setlinkProvider('${service.link_service}')"
                >
                  <img src="${provider.profile_image.url}" alt="veteriarian" />
                  <h3>${provider.name}</h3>
                  <h4>${provider.subtitle}</h4>
                </button>
              </li>
              <li class="fullwidth is-hidden" id="quickview-0<?=i?>">
                <!-- <div class="arrow"></div> -.
                <div class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                    ${(function createImages() {
                      let images = "";
                      provider.images.map((image) => {
                        let imgTemp = ` <li class="splide__slide">
                        <img
                          src="${image.url}"
                          alt="veteriarian"
                        />
                      </li>`;
                        images += imgTemp;
                      });
                      return images;
                    })()}
                     
                    </ul>
                  </div>
                </div>
                <div class="info">
                  <h3>${provider.name}</h3>
                  <h4>${provider.subtitle}</h4>
                  <p>${provider.description ? provider.description : ""}</p>
                  <div class="flex shelude">
                  ${(() => {
                    if (provider.schedule) {
                      return `<div class="shelude-container">
                            <div class="flex">
                              <img src="img/clock.svg" alt="clock" />
                              ${provider.schedule}
                            </div>
                          </div>`;
                    } else {
                      return ``;
                    }
                  })()}
                  ${(() => {
                    if (provider.places) {
                      return `<div class="shelude-container">
                            <div class="flex">
                              <img src="img/place.svg" alt="place" />
                              ${provider.places}
                            </div>
                          </div>`;
                    } else {
                      return ``;
                    }
                  })()}
                  </div>
                  <div class="flex actions">
                  <a href='javascript:openUseService("${
                    service.id_service
                  }", "${service.link_service.split("//")[1]}", "${get_alias(
            provider.name
          )}");'>Usar servicio</a>
                    <a
                    href="/mi-cuenta/${lang}/proveedor/${get_alias(
            provider.name
          )}/${get_alias(service.service.name)}-${provider.id}-${
            service.service.id
          }"
                      class="invert"
                      >Conocer más
                    </a>
                  </div>
                </div>
              </li> `;

          providerContainer.innerHTML += template;
        }
      });
    });
  } else {
    await query(
      `providers/department/${servId}/${depId}/${cityId}`,
      "",
      "GET",
      (providers) => {
        providers.map((provider, i) => {
          let service = provider.provider_services.find(
            (provider_service) => provider_service.service.id == servId
          );
          let template = `
            <li class="service__veteriarians-list-item">
                <button
                  type="button"
                  data-quick-view
                  onclick="setlinkProvider('${service.link_service}')"
                >
                  <img src="${provider.profile_image.url}" alt="veteriarian" />
                  <h3>${provider.name}</h3>
                  <h4>${provider.subtitle}</h4>
                </button>
              </li>
              <li class="fullwidth is-hidden" id="quickview-0<?=i?>">
                <div class="arrow"></div>
                <div class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                    ${(function createImages() {
                      let images = "";
                      provider.images.map((image) => {
                        let imgTemp = ` <li class="splide__slide">
                        <img
                          src="${image.url}"
                          alt="veteriarian"
                        />
                      </li>`;
                        images += imgTemp;
                      });
                      return images;
                    })()}
                    </ul>
                  </div>
                </div>
                <div class="info">
                  <h3>${provider.name}</h3>
                  <h4>${provider.subtitle}</h4>
                  <p>${provider.description ? provider.description : ""}</p>
                  <div class="flex shelude">
                  ${(() => {
                    if (provider.schedule) {
                      return `<div class="shelude-container">
                            <div class="flex">
                              <img src="img/clock.svg" alt="clock" />
                              ${provider.schedule}
                            </div>
                          </div>`;
                    } else {
                      return ``;
                    }
                  })()}
                  ${(() => {
                    if (provider.places) {
                      return `<div class="shelude-container">
                            <div class="flex">
                              <img src="img/place.svg" alt="place" />
                              ${provider.places}
                            </div>
                          </div>`;
                    } else {
                      return ``;
                    }
                  })()}
                  </div>
                  <div class="flex actions">
                  <a href='javascript:openUseService("${
                    service.id_service
                  }", "${service.link_service.split("//")[1]}", "${get_alias(
            provider.name
          )}");'>Usar servicio</a>
                    <a
                      href="/mi-cuenta/${lang}/proveedor/${get_alias(
            provider.name
          )}/${get_alias(service.service.name)}-${provider.id}-${
            service.service.id
          }"
                      class="invert"
                      >Conocer más
                    </a>
                  </div>
                </div>
              </li> `;
          if (service.link_service) {
            providerContainer.innerHTML += template;
          }
        });
      }
    );
  }
  providerContainer.classList.remove("loading");
  quickViewButtons = document.querySelectorAll("[data-quick-view]");
  closeButtons = document.querySelectorAll("[data-close");
  fullwidthCards = document.querySelectorAll(".fullwidth");
  quickViewButtons.forEach((quickView) => {
    // Add appropriate ARIA attributes for "toggle" behaviour.
    fullwidth = quickView.parentElement.nextElementSibling;
    quickView.setAttribute("aria-expanded", "false");
    quickView.setAttribute("aria-controls", fullwidth.id);

    quickView.addEventListener("click", (e) => {
      toggle = e.target;
      toggleParent = toggle.parentElement;
      fullwidth = toggleParent.nextElementSibling;

      // Open (or close) fullwidth card.
      if (toggle.getAttribute("aria-expanded") === "false") {
        // Do we have another fullwidth card already open? If so, close it.
        fullwidthCards.forEach((fullwidthOpen) => {
          if (!fullwidthOpen.classList.contains("is-hidden")) {
            toggleParentOpen = fullwidthOpen.previousElementSibling;
            toggleOpen = toggleParentOpen.querySelector("[data-quick-view");

            closeQuickView(toggleOpen, toggleParentOpen, fullwidthOpen);
          }
        });

        openQuickView(toggle, toggleParent, fullwidth);
      } else {
        closeQuickView(toggle, toggleParent, fullwidth);
      }
    });
  });
  closeButtons.forEach((close) => {
    close.addEventListener("click", (e) => {
      fullwidth = e.target.parentElement;
      toggleParent = e.target.parentElement.previousElementSibling;
      toggle = toggleParent.querySelector("[data-quick-view");

      closeQuickView(toggle, toggleParent, fullwidth);
      toggle.focus(); // Return keyboard focus to "toggle" button.
    });
  });
  document.querySelectorAll(".fullwidth .splide").forEach((el) => {
    new Splide(el, {
      type: "loop",
      perPage: 1,
      width: 460,
      arrows: false,
    }).mount();
  });
}
if (document.querySelector("#creditcardChangeProfile")) {
  var card = new Card({
    form: "#creditcardChangeProfile",
    container: ".card-wrapper",
    formSelectors: {
      numberInput: "input#card_number",
      expiryInput: "input#month",
      cvcInput: "input#secure_code",
      nameInput: "input#name",
    },
    formatting: true,
    placeholders: {
      name: "",
      expiry: "••/••",
      cvc: "•••",
    },
    messages: {
      validDate: "expire\ndate",
      monthYear: "mm/yy",
    },
    debug: true,
  });
}

async function activeCities(depId) {
  if (depId != "all") {
    let filtersProvider = document.querySelector(".filters-provider");
    if (!document.querySelector("#city")) {
      filtersProvider.innerHTML += `<div class="c-select"><select name="city" id="city" onchange="filterProviders(${activeService}, document.querySelector('#department').value, this.value)"><option value="0">Ciudad</option></select><div class="c-arrow"></div></div>`;
    } else {
      document.querySelector(
        "#city"
      ).innerHTML = `<option value="0">Ciudad</option>`;
    }

    await query(`cities?department=${depId}`, "", "GET", (cities) => {
      cities.map((city) => {
        let selectElement = ` <option value="${city.id}">${city.name}</option>`;
        document.querySelector("#city").innerHTML += selectElement;
      });
    });
  } else if (
    (depId == "all" && document.querySelector("#city")) ||
    (depId == 0 && document.querySelector("#city"))
  ) {
    document.querySelector("#city").parentElement.remove();
  }
}

$("form#createSub").validate({
  rules: {
    userName: { required: true },
    lastname: { required: true },
    email: { required: true, email: true },
    phone: { required: true, digits: true },
    city: { required: true },
    numdoc: { required: true },
    address: { required: true },
  },
  messages: {
    userName: { required: "Este campo es obligatorio." },
    lastname: { required: "Este campo es obligatorio." },
    email: {
      required: "Este campo es obligatorio.",
      email: "No es un correo válido.",
    },
    phone: {
      required: "Este campo es obligatorio.",
      digits: "Este campo solo acepta números",
    },
    city: { required: "Este campo es obligatorio." },
    numdoc: { required: "Este campo es obligatorio." },
    address: { required: "Este campo es obligatorio." },
  },
  submitHandler: function (form) {
    $("form#createSub button").attr("disabled", true);
    $("form#createSub button").text("Enviando");
    $("#createSub").ajaxSubmit({
      dataType: "json",
      clearForm: false,
      success: function (data) {
        if (data) {
          if (data.message == 1) {
            $("form#createSub button").text("Registrarme");
            $("form#createSub button").attr("disabled", false);
            pagoExitosoBox();
          } else if (data.message == 2) {
            pagoPendienteBox();
          } else if (data.message == 3) {
            $("form#createSub button").attr("disabled", false);
            $("form#createSub button").text("Reintentar");
            pagoRechazadoBox(data.type, data.plan);
          }
        } else {
          if (data.message == 1) {
            $("form#createSub button").text("Registrarme");
            $("form#createSub button").attr("disabled", false);
          } else if (data.message == 2) {
            pagoPendienteBox();
          } else if (data.message == 3) {
            $("form#createSub button").attr("disabled", false);
            $("form#createSub button").text("Reintentar");
            pagoRechazadoBox(data.type, data.plan);
          }
        }
      },
    });
  },
});

function get_alias(str) {
  str = str.replace(/¡/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/'/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/!/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/¢/g, "-", str); //Signo de centavo.&cent;
  str = str.replace(/£/g, "-", str); //Signo de libra esterlina.&pound;
  str = str.replace(/¤/g, "-", str); //Signo monetario.&curren;
  str = str.replace(/¥/g, "-", str); //Signo del yen.&yen;
  str = str.replace(/¦/g, "-", str); //Barra vertical partida.&brvbar;
  str = str.replace(/§/g, "-", str); //Signo de sección.&sect;
  str = str.replace(/¨/g, "-", str); //Diéresis.&uml;
  str = str.replace(/©/g, "-", str); //Signo de derecho de copia.&copy;
  str = str.replace(/ª/g, "-", str); //Indicador ordinal femenino.&ordf;
  str = str.replace(/«/g, "-", str); //Signo de comillas francesas de apertura.&laquo;
  str = str.replace(/¬/g, "-", str); //Signo de negación.&not;
  str = str.replace(/®/g, "-", str); //Signo de marca registrada.&reg;
  str = str.replace(/¯/g, "&-", str); //Macrón.&macr;
  str = str.replace(/°/g, "-", str); //Signo de grado.&deg;
  str = str.replace(/±/g, "-", str); //Signo de más-menos.&plusmn;
  str = str.replace(/²/g, "-", str); //Superíndice dos.&sup2;
  str = str.replace(/³/g, "-", str); //Superíndice tres.&sup3;
  str = str.replace(/´/g, "-", str); //Acento agudo.&acute;
  str = str.replace(/µ/g, "-", str); //Signo de micro.&micro;
  str = str.replace(/¶/g, "-", str); //Signo de calderón.&para;
  str = str.replace(/·/g, "-", str); //Punto centrado.&middot;
  str = str.replace(/¸/g, "-", str); //Cedilla.&cedil;
  str = str.replace(/¹/g, "-", str); //Superíndice 1.&sup1;
  str = str.replace(/º/g, "-", str); //Indicador ordinal masculino.&ordm;
  str = str.replace(/»/g, "-", str); //Signo de comillas francesas de cierre.&raquo;
  str = str.replace(/¼/g, "-", str); //Fracción vulgar de un cuarto.&frac14;
  str = str.replace(/½/g, "-", str); //Fracción vulgar de un medio.&frac12;
  str = str.replace(/¾/g, "-", str); //Fracción vulgar de tres cuartos.&frac34;
  str = str.replace(/¿/g, "-", str); //Signo de interrogación abierta.&iquest;
  str = str.replace(/×/g, "-", str); //Signo de multiplicación.&times;
  str = str.replace(/÷/g, "-", str); //Signo de división.&divide;
  str = str.replace(/À/g, "a", str); //A mayúscula con acento grave.&Agrave;
  str = str.replace(/Á/g, "a", str); //A mayúscula con acento agudo.&Aacute;
  str = str.replace(/Â/g, "a", str); //A mayúscula con circunflejo.&Acirc;
  str = str.replace(/Ã/g, "a", str); //A mayúscula con tilde.&Atilde;
  str = str.replace(/Ä/g, "a", str); //A mayúscula con diéresis.&Auml;
  str = str.replace(/Å/g, "a", str); //A mayúscula con círculo encima.&Aring;
  str = str.replace(/Æ/g, "a", str); //AE mayúscula.&AElig;
  str = str.replace(/Ç/g, "c", str); //C mayúscula con cedilla.&Ccedil;
  str = str.replace(/È/g, "e", str); //E mayúscula con acento grave.&Egrave;
  str = str.replace(/É/g, "e", str); //E mayúscula con acento agudo.&Eacute;
  str = str.replace(/Ê/g, "e", str); //E mayúscula con circunflejo.&Ecirc;
  str = str.replace(/Ë/g, "e", str); //E mayúscula con diéresis.&Euml;
  str = str.replace(/Ì/g, "i", str); //I mayúscula con acento grave.&Igrave;
  str = str.replace(/Í/g, "i", str); //I mayúscula con acento agudo.&Iacute;
  str = str.replace(/Î/g, "i", str); //I mayúscula con circunflejo.&Icirc;
  str = str.replace(/Ï/g, "i", str); //I mayúscula con diéresis.&Iuml;
  str = str.replace(/Ð/g, "d", str); //ETH mayúscula.&ETH;
  str = str.replace(/Ñ/g, "n", str); //N mayúscula con tilde.&Ntilde;
  str = str.replace(/Ò/g, "o", str); //O mayúscula con acento grave.&Ograve;
  str = str.replace(/Ó/g, "o", str); //O mayúscula con acento agudo.&Oacute;
  str = str.replace(/Ô/g, "o", str); //O mayúscula con circunflejo.&Ocirc;
  str = str.replace(/Õ/g, "o", str); //O mayúscula con tilde.&Otilde;
  str = str.replace(/Ö/g, "o", str); //O mayúscula con diéresis.&Ouml;
  str = str.replace(/Ø/g, "o", str); //O mayúscula con barra inclinada.&Oslash;
  str = str.replace(/Ù/g, "u", str); //U mayúscula con acento grave.&Ugrave;
  str = str.replace(/Ú/g, "u", str); //U mayúscula con acento agudo.&Uacute;
  str = str.replace(/Û/g, "u", str); //U mayúscula con circunflejo.&Ucirc;
  str = str.replace(/Ü/g, "u", str); //U mayúscula con diéresis.&Uuml;
  str = str.replace(/Ý/g, "y", str); //Y mayúscula con acento agudo.&Yacute;
  str = str.replace(/Þ/g, "b", str); //Thorn mayúscula.&THORN;
  str = str.replace(/ß/g, "b", str); //S aguda alemana.&szlig;
  str = str.replace(/à/g, "a", str); //a minúscula con acento grave.&agrave;
  str = str.replace(/á/g, "a", str); //a minúscula con acento agudo.&aacute;
  str = str.replace(/â/g, "a", str); //a minúscula con circunflejo.&acirc;
  str = str.replace(/ã/g, "a", str); //a minúscula con tilde.&atilde;
  str = str.replace(/ä/g, "a", str); //a minúscula con diéresis.&auml;
  str = str.replace(/å/g, "a", str); //a minúscula con círculo encima.&aring;
  str = str.replace(/æ/g, "a", str); //ae minúscula.&aelig;
  str = str.replace(/ç/g, "a", str); //c minúscula con cedilla.&ccedil;
  str = str.replace(/è/g, "e", str); //e minúscula con acento grave.&egrave;
  str = str.replace(/é/g, "e", str); //e minúscula con acento agudo.&eacute;
  str = str.replace(/ê/g, "e", str); //e minúscula con circunflejo.&ecirc;
  str = str.replace(/ë/g, "e", str); //e minúscula con diéresis.&euml;
  str = str.replace(/ì/g, "i", str); //i minúscula con acento grave.&igrave;
  str = str.replace(/í/g, "i", str); //i minúscula con acento agudo.&iacute;
  str = str.replace(/î/g, "i", str); //i minúscula con circunflejo.&icirc;
  str = str.replace(/ï/g, "i", str); //i minúscula con diéresis.&iuml;
  str = str.replace(/ð/g, "i", str); //eth minúscula.&eth;
  str = str.replace(/ñ/g, "n", str); //n minúscula con tilde.&ntilde;
  str = str.replace(/ò/g, "o", str); //o minúscula con acento grave.&ograve;
  str = str.replace(/ó/g, "o", str); //o minúscula con acento agudo.&oacute;
  str = str.replace(/ô/g, "o", str); //o minúscula con circunflejo.&ocirc;
  str = str.replace(/õ/g, "o", str); //o minúscula con tilde.&otilde;
  str = str.replace(/ö/g, "o", str); //o minúscula con diéresis.&ouml;
  str = str.replace(/ø/g, "o", str); //o minúscula con barra inclinada.&oslash;
  str = str.replace(/ù/g, "o", str); //u minúscula con acento grave.&ugrave;
  str = str.replace(/ú/g, "u", str); //u minúscula con acento agudo.&uacute;
  str = str.replace(/û/g, "u", str); //u minúscula con circunflejo.&ucirc;
  str = str.replace(/ü/g, "u", str); //u minúscula con diéresis.&uuml;
  str = str.replace(/ý/g, "y", str); //y minúscula con acento agudo.&yacute;
  str = str.replace(/þ/g, "b", str); //thorn minúscula.&thorn;
  str = str.replace(/ÿ/g, "y", str); //y minúscula con diéresis.&yuml;
  str = str.replace(/Œ/g, "d", str); //OE Mayúscula.&OElig;
  str = str.replace(/œ/g, "-", str); //oe minúscula.&oelig;
  str = str.replace(/Ÿ/g, "-", str); //Y mayúscula con diéresis.&Yuml;
  str = str.replace(/ˆ/g, "", str); //Acento circunflejo.&circ;
  str = str.replace(/˜/g, "", str); //Tilde.&tilde;
  str = str.replace(/–/g, "", str); //Guiún corto.&ndash;
  str = str.replace(/—/g, "", str); //Guiún largo.&mdash;
  str = str.replace(/'/g, "", str); //Comilla simple izquierda.&lsquo;
  str = str.replace(/'/g, "", str); //Comilla simple derecha.&rsquo;
  str = str.replace(/,/g, "", str); //Comilla simple inferior.&sbquo;
  str = str.replace(/"/g, "", str); //Comillas doble derecha.&rdquo;
  str = str.replace(/"/g, "", str); //Comillas doble inferior.&bdquo;
  str = str.replace(/†/g, "-", str); //Daga.&dagger;
  str = str.replace(/‡/g, "-", str); //Daga doble.&Dagger;
  str = str.replace(/…/g, "-", str); //Elipsis horizontal.&hellip;
  str = str.replace(/‰/g, "-", str); //Signo de por mil.&permil;
  str = str.replace(/‹/g, "-", str); //Signo izquierdo de una cita.&lsaquo;
  str = str.replace(/›/g, "-", str); //Signo derecho de una cita.&rsaquo;
  str = str.replace(/€/g, "-", str); //Euro.&euro;
  str = str.replace(/™/g, "-", str); //Marca registrada.&trade;
  str = str.replace(/ & /g, "-", str); //Marca registrada.&trade;
  str = str.replace(/\(/g, "-", str);
  str = str.replace(/\)/g, "-", str);
  str = str.replace(/�/g, "-", str);
  str = str.replace(/\//g, "-", str);
  str = str.replace(/ de /g, "-", str); //Espacios
  str = str.replace(/ y /g, "-", str); //Espacios
  str = str.replace(/ a /g, "-", str); //Espacios
  str = str.replace(/ DE /g, "-", str); //Espacios
  str = str.replace(/ A /g, "-", str); //Espacios
  str = str.replace(/ Y /g, "-", str); //Espacios
  str = str.replace(/ /g, "-", str); //Espacios
  str = str.replace(/  /g, "-", str); //Espacios
  str = str.replace(/\./g, "", str); //Punto
  str = str.replace("%", "", str); //Punto

  //Mayusculas
  str = str.toLowerCase();

  return str;
}
