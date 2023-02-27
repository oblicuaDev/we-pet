
<?php
session_start();
unset($_SESSION["user"]);
header('Location: /mi-cuenta/iniciar-sesion');
?>
  <script src="js/main.js"></script>
<script>
    FB.logout(function (response) {
      console.log(response);
      // document.location.reload();
    });

  deleteCookie("username");
  deleteCookie("userlastname");
  deleteCookie("useremail");
    revokeAllScopes();
</script>