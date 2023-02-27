<?php   
  $noFooter = 1;
  $noHeader = 1;
  include 'includes/head.php';
?>
<style>
  header .container {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  header .logo {
    width: 60px;
  }
  #customBtn2, .customBtn2 {
    background-color: #4285f4;
    padding: 10px;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
  }
  .customBtn2:hover, #customBtn2:hover {
    opacity: 0.6;
  }
</style>

<header>
  <div class="container">
    <a href="https://wepet.co/" target="_blank">
      <img src="img/huella.png" alt="logo" class="logo" />
    </a>
  </div>
</header>
<main style="display: flex; align-items: center; justify-content: center">
  <button type="button" id="customBtn2">
    <svg
      width="32"
      height="32"
      viewBox="0 0 32 32"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        fill-rule="evenodd"
        clip-rule="evenodd"
        d="M16 0C24.8366 0 32 7.16344 32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16C0 7.16344 7.16344 0 16 0ZM19.2078 12.3782C18.3787 11.5855 17.3241 11.1818 16.1496 11.1818C14.066 11.1818 12.3026 12.589 11.6735 14.48C11.5135 14.96 11.4226 15.4727 11.4226 16C11.4226 16.5272 11.5132 17.04 11.6732 17.52C12.3023 19.4109 14.066 20.8181 16.1496 20.8181C17.226 20.8181 18.1426 20.5346 18.859 20.0546C19.7063 19.4873 20.2699 18.64 20.4554 17.64H16.1499V14.5455H23.6845C23.779 15.0691 23.8299 15.6146 23.8299 16.1818C23.8299 18.6182 22.9572 20.6691 21.4445 22.0619C20.1208 23.2837 18.3096 24 16.1496 24C13.0223 24 10.3169 22.2072 9.00049 19.5927C8.45867 18.5127 8.1499 17.2909 8.1499 16C8.1499 14.709 8.45899 13.4872 9.00081 12.4072C10.3172 9.79268 13.0223 8 16.1496 8C18.306 8 20.1169 8.79273 21.5023 10.0836L19.2078 12.3782Z"
        fill="white"
      />
    </svg>

    Continuar con el inicio de sesión de Google
  </button>

</main>

<script>
  window.addEventListener("DOMContentLoaded", (event) => {
    startAppApp();
  });
  var startAppApp = function () {
    gapi.auth2.init({
      client_id: "289140913383-rpui9j72gss785bf6q9b02i5m05aue9e.apps.googleusercontent.com",
      cookiepolicy: "single_host_origin",
    }).then(auth2=>{
      auth2.attachClickHandler(document.getElementById('customBtn2'), {},
            onSuccess,
            onError)
        });

  }

  let onSuccess = (googleUser) => {
    let profile = googleUser.getBasicProfile();
    console.log(profile);
    console.log(googleUser);
    console.log('Token || ' + googleUser.getAuthResponse().id_token);
    console.log('ID: ' + profile.getId());
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());
    document.querySelector('main').innerHTML ="";
    document.querySelector('main').innerHTML =`<a href="com.wepet.wepet-app://?email=${profile.getEmail()}" class="customBtn2">Volver a la app</a>`;
  }

  let onError = (error) => { console.log(error) }

</script>
<? include 'includes/footer.php' ?>
