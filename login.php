<?php   
  
  $bodyClass="loginBody";
  include 'includes/head.php';
?>

    <main>
      <div class="container">
        <form action="s/user_login/" id="login" method="post">
          <h2 class="uppercase"><?=$wp->findUiWord(4)->Name?></h2>
          <span>
            <label for=""><?=$wp->findUiWord(7)?></label>
            <input type="email" name="email" id="email" />
          </span>
          <span>
            <label for=""><?=$wp->findUiWord(8)?></label>
            <input type="password" name="password" id="password" />
            <span class="material-icons" id="togglePassword"> visibility </span>
          </span>
           <div class="loginPlatfform">
            <div class="facebook">
              <button type="button" onclick="fb_login()"> 
                <p><?=$wp->findUiWord(272)?></p>
                <img src="img/f_logo.png" alt="f_logo">
                <!-- <fb:login-button scope="public_profile,email,user_birthday" onlogin="checkLoginState();"></fb:login-button> -->
              </button>
            </div>
            <div class="google">
            <button type="button" id="customBtn">
                <p><?=$wp->findUiWord(272)?></p>
                <img src="img/g_logo.png" alt="g_logo">
              </button>
              <script>startApp();</script>
            </div>
          </div> 
          <button type="submit" class="uppercase"><?=$wp->findUiWord(9)?></button>
          <a href="<?= $lang ?>/planes" class="wait"><?=$wp->findUiWord(5)?></a>
          <a href="<?= $lang ?>/recuperar-contraseña" class="wait"><?=$wp->findUiWord(18)?></a>
        </form>
      </div>
    </main>
    <div id="snackbar"></div>
<? include 'includes/footer.php' ?>