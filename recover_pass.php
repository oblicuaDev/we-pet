<?php   
  $bodyClass="recoverBody";
  include 'includes/head.php';
?>
<main>
  <div class="container">
    <form action="s/recoverPass/" id="recover" method="POST">
      <h2 class="uppercase"><?=$wp->findUiWord(234)?></h2>
      <span>
        <label for="recover_email"><?=$wp->findUiWord(53)?></label>
        <input
          type="email"
          name="recover_email"
          id="recover_email"
        /> </span
      >´
      <button type="submit" class="uppercase"><?=$wp->findUiWord(19)?></button>
      <a href="<?= $lang ?>/planes"><?=$wp->findUiWord(236)?></a>
    </form>
    <div class="successMsg">
      <h2 class="uppercase"><?=$wp->findUiWord(238)?></h2>
    </div>
  </div>
</main>
<div id="snackbar"></div>
<img src="images/gato1.jpg" alt="gato" class="left">
  <img src="images/perro1.jpg" alt="perro" class="right">
<? include 'includes/footer.php' ?>