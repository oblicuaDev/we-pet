<?php   
  include 'includes/head.php';
?>
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
    <input type="text" name="name" id="name" placeholder="<?=$wp->findUiWord(298)?>" />
  </span>
  <div class="flex">
    <span>
      <label for="month"><?=$wp->findUiWord(56)?></label>
      
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
      <input type="text" name="secure_code" id="secure_code" placeholder="CVC" />
    </span>
</div>
  <small
    ><?=$wp->findUiWord(15)?></small
  >
  <button type="submit"><?=$wp->findUiWord(33)?></button>
</form>

<? include 'includes/footer.php' ?>
