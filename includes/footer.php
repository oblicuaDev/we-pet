<?if(!isset( $noFooter)){?>
  <footer>
    <div class="container">
      <div class="reder">
      <a href="https://wepet.co/" target="_blank">
        <img src="img/logo.png" alt="logo" class="logo" />
</a>
        <ul class="social">
          <li><a target="_blank" href="https://instagram.com/wepet_co"><img src="img/instagram.svg" alt="instagram"></a></li>
          <li><a target="_blank" href="https://facebook.com/wepetcolombia"><img src="img/facebook.svg" alt="facebook"></a></li>
          <li><a target="_blank" href="https://twitter.com/wepet_co"><img src="img/twitter.svg" alt="twitter"></a></li>
          <li><a target="_blank" href="https://wa.me/573245409846"><img src="img/wa.svg" alt="whatsapp"></a></li>
        </ul>
      </div>
      <div class="menu">
        <div class="left">
          <h2>Información</h2>
          <ul class="info">
          <li><a target="_blank" href="https://wepet.co/terminos-y-condiciones/">Términos y Condiciones</a></li>
          <li><a target="_blank" href="https://wepet.co/aviso-de-privacidad/">Aviso de Privacidad</a></li>
          <li><a target="_blank" href="https://wepet.co/autorizacion-de-uso-de-datos-personales/">Autorización de Uso de Datos Personales</a></li>
          <li><a target="_blank" href="https://wepet.co/politica-de-cookies/">Política de Cookies</a></li>
          </ul>
        </div>
        <div class="center">
          <h2>Marketplace</h2>
          <ul class="marketplace">
            <li><a target="_blank" href="https://wepet.co/vende-tus-productos-con-we-pet-marketplace/">Vende tus Productos</a></li>
            <li><a target="_blank" href="https://wepet.co/dashboard/">Escritorio</a></li>
            <li><a target="_blank" href="https://wepet.co/">Mi cuenta</a></li>
            <li><a target="_blank" href="https://wepet.co/store-listing/">Listado de tiendas</a></li>
            <li><a target="_blank" href="https://wepet.co/guia-de-uso-we-pet-marketplace/">Guía de Uso</a></li>
          </ul>
        </div>
        <div class="right">
          <h2>Miembros</h2>
          <ul class="miembros">
            <li><a target="_blank" href="https://wepet.co/" clas">Home</a></li>
            <li><a target="_blank" href="https://wepet.co/blog/">Blog</a></li>
            <li><a target="_blank" href="https://wepet.co/account/">Mi Cuenta</a></li>
            <li><a target="_blank" href="https://wepet.co/membresias/">Membresías</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>  
<?}?>
  
  <div class="preloader-container">
    <div id="lottie" class="preloader"></div>
  </div>

  <script src="js/jquery.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/additional-methods.min.js"></script>
  <script src="js/splide.min.js"></script>
  <script src="js/lottie.js"></script>
  <script src="js/cookie.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/shepherd.js@5.0.1/dist/js/shepherd.js"></script>
  <script src="js/cookie.js"></script>
  <!-- at the end of BODY -->
  <!-- CSS is included via this JavaScript file -->
  <script src="js/card.js?v=<?=time();?>"></script>
  <script src="js/main.js?v=<?=time();?>"></script>
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
</script>
</body>
</html>