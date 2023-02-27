<?php   
  include 'includes/config.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <base href="/mi-cuenta/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=0"
    />
    <meta name="theme-color" content="#FB883F" />
    <meta name="twitter:card" value="summary" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="WePet" />
    <meta property="og:url" content=" " />
    <meta property="og:image" content="" />
    <meta property="og:description" content="Acercando mascotas y familias" />
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <title>WePet</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    />
    <link rel="stylesheet" href="css/splide.min.css" />
    <link rel="stylesheet" href="css/splide-core.min.css" />
    <link rel="stylesheet" href="css/styles.css?v=<?=time();?>" />
    <link rel="canonical" href="" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <meta name="description" content="Acercando mascotas y familias" />
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="289140913383-rpui9j72gss785bf6q9b02i5m05aue9e.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <script src="https://apis.google.com/js/api:client.js"></script>
  <script>
     window.addEventListener('DOMContentLoaded', async (event) => {
await getAllUiWord();
});
  </script>
    <script>
      let lang = '<?=$lang?>';
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '289140913383-rpui9j72gss785bf6q9b02i5m05aue9e.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

  function attachSignin(element) {
    auth2.attachClickHandler(element, {},
        function(googleUser) {
          console.log(googleUser.Ru.wY);
         console.log(googleUser.Ru.LW);
         console.log(googleUser.Ru.Hv);
         setCookie("username", googleUser.Ru.wY, 15);
      setCookie("userlastname", googleUser.Ru.LW, 15);
      setCookie("useremail", googleUser.Ru.Hv, 15);
      checkUserWepet(
        googleUser.Ru.Hv,
        googleUser.Ru.wY,
        googleUser.Ru.LW
      );
        }, function(error) {
          console.error(error);
        });
  }
  </script>
  </head>
  <body class="<?=$bodyClass?>">
    <?php   
    if(!isset( $noHeader)){
      include 'header.php';
    }
?>

