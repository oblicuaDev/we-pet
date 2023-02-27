<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="289140913383-rpui9j72gss785bf6q9b02i5m05aue9e.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

</head>
<body>
<div id="status"></div>
<fb:login-button 
  scope="public_profile,email,user_birthday"
  onlogin="checkLoginState();">
</fb:login-button>
<button type="button" onclick="logOutFB()">Cerrar Sesión</button>
<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      }
    </script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1795860513946369',
      cookie     : true,
      xfbml      : true,
      version    : 'v12.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
function statusChangeCallback(response) {  
   if (response.status === 'connected') {   
     testAPI();  
   } else {                                 
     document.getElementById('status').innerHTML = 'Please log ' +
       'into this webpage.';
   }
 }

 function checkLoginState() {
 FB.getLoginStatus(function(response) {
   statusChangeCallback(response);
 });
}

 window.fbAsyncInit = function() {
   FB.init({
     appId      : '1795860513946369',
     cookie     : true,                     
     xfbml      : true,                     
     version    : 'v12.0'           
   });


   FB.getLoginStatus(function(response) {   
     statusChangeCallback(response);        
   });
 };

 function testAPI() {                      
   console.log('Welcome!  Fetching your information.... ');
   FB.api('/me?fields=name,email,birthday', function(response) {
     console.log(response);
     fetch(`https://agile-sands-59528.herokuapp.com/wepetusers/?_email=${response.email}`)
     .then((response) => response.json())
     .then((data) => {
       if(data.length > 0){
         console.log(data);
         if(data[0].pets.length > 0){
        //  location.href = `https://wepet.co/mi-cuenta/s/userLoginFB/?userID=${data[0].id}`;
         }else{
         }
        }else{
        //  location.href = `https://wepet.co/mi-cuenta/planes`;
       }
     })
     .catch((err) => console.error(err))
   });
 }

 function logOutFB(){
  FB.logout(function(response) {
   console.log(response);
   document.location.reload();
  });
 }

</script>
<script src="js/cookie.js"></script>
</body>
</html>