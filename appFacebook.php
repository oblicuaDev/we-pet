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
  #facebookloginbtn {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #1a77f2;
    padding: 10px;
    border-radius: 5px;
    gap: 10px;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
  }
  #facebookloginbtn:hover {
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
  <button id="facebookloginbtn" type="button" onclick="login()" style="">
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
        d="M0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16ZM16 8C20.4 8 24 11.6 24 16C24 20 21.1 23.4 17.1 24V18.3H19L19.4 16H17.2V14.5C17.2 13.9 17.5 13.3 18.5 13.3H19.5V11.3C19.5 11.3 18.6 11.1 17.7 11.1C15.9 11.1 14.7 12.2 14.7 14.2V16H12.7V18.3H14.7V23.9C10.9 23.3 8 20 8 16C8 11.6 11.6 8 16 8Z"
        fill="white"
      />
    </svg>
    Continuar con el inicio de sesión de Facebook
  </button>
</main>

<? include 'includes/footer.php' ?>
<script>
  function login() {
    FB.login(
      function (response) {
        if (response.authResponse) {
          //console.log(response); // dump complete info
          access_token = response.authResponse.accessToken; //get access token
          user_id = response.authResponse.userID; //get FB UID
          FB.api("/me?fields=name,email,birthday", function (response) {
            window.location.href = `com.wepet.wepet-app://?email=${response.email}&idFB=${response.id}`;
            // window.location.href = `exp://192.168.1.20:19000?email=${response.email}&idFB=${response.id}`;
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
</script>
