<?php   
  $bodyClass="changePayMethod";
  include 'includes/head.php';
?>
<main>
  <div class="container">
    <div
      class="box creditcard change"
      id="dialog-content"
      style="max-width: 480px; width: 100%"
    >
      <form action="s/creditChange/" id="creditcardChange" method="POST">
        <div class="card-wrapper"></div>
       
        <span>
          <label for="card_number"><?=$wp->findUiWord(13)?></label>
          <input
            type="text"
            name="card_number"
            id="card_number"
            placeholder="<?=$wp->findUiWord(13)?>"
          />
        </span>
        <span>
          <label for="name"><?=$wp->findUiWord(12)?></label>
          <input
            type="text"
            name="name"
            id="name"
            placeholder="<?=$wp->findUiWord(298)?>"
          />
        </span>
        <div class="flex">
          <span>
            <label for="month"><?=$wp->findUiWord(14)?></label>
            
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
            <input
              type="text"
              name="secure_code"
              id="secure_code"
              placeholder="CVC"
            />
          </span>
</div>
        <small
          ><?=$wp->findUiWord(15)?></small
        >
        <button type="submit"><?=$wp->findUiWord(33)?></button>
      </form>
    </div>
  </div>
</main>
<div
  class="box valid"
  id="valid"
  style="display: none; max-width: 480px; width: 100%"
>
  <img src="img/check.svg" alt="check" />
  <h2><?=$wp->findUiWord(16)?></h2>
  <p><?=$wp->findUiWord(20)?></p>
  <div class="actions">
    <button type="button" onclick="Fancybox.close()"><?=$wp->findUiWord(21)?></button>
  </div>
</div>
<div
  class="box invalid"
  id="invalid"
  style="display: none; max-width: 480px; width: 100%"
>
  <img src="img/cross.svg" alt="cross" />
  <h2><?=$wp->findUiWord(22)?></h2>
  <p>
    <?=$wp->findUiWord(23)?>
  </p>
</div>
<? include 'includes/footer.php' ?>
