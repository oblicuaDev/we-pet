<?php   
  $bodyClass="recoverBody";
  include 'includes/head.php';
?>
<main class="newPassMain">
  <div class="container">
    <form action="s/changepass/" id="newpass" method="POST">
      <h2 class="uppercase">Reestablecer CONTRASEña</h2>
      <span>
        <label for="recover_email">Nueva contraseña</label>
        <input
          type="password"
          name="password"
          id="password"
        /> </span
      >
      <span>
        <label for="recover_email">Repetir contraseña</label>
        <input
          type="password"
          name="confirmpassword"
          id="confirmpassword"
        /> </span
      >
      <input type="hidden" name="token" id="token" value="<?=$_GET['token']?>">
      <button type="submit" class="uppercase">Reestablecer contraseña</button>
    </form>
    <div class="successMsg">
      <h2 class="uppercase">Tu contraseña ha sido modificada </h2>
      <a href="/mi-cuenta/<?= $lang ?>/iniciar-sesion" class="await">Inicia sesión</a>
    </div>
  </div>
  <img src="images/gato1.jpg" alt="gato" class="left">
  <img src="images/perro1.jpg" alt="perro" class="right">
</main>
<? include 'includes/footer.php' ?>