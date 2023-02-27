<?php   
  $bodyClass="plansBody";
  include 'includes/head.php';
  function cmp($a, $b) {
    return strcmp($b->order, $a->order );
  }
  $plans = $wp->getPlans(); usort($plans, "cmp"); 
 ?>
<main>
  <div class="container">
    <h1><?=$wp->findUiWord(17)?></h1>
    <p><?=$wp->findUiWord(6)?></p>
    <div class="switch">
      <input
        type="radio"
        id="anual"
        name="type"
        checked
        onchange="changePlans(event)"
        value="anual"
      />
      <label for="anual" class="uppercase"><?=$wp->findUiWord(1)?></label>
      <input
        type="radio"
        id="mensual"
        name="type"
        onchange="changePlans(event)"
        value="mensual"
      />
      <label for="mensual" class="uppercase"><?=$wp->findUiWord(10)?></label>
    </div>
    <div class="planes-anuales" style="grid-template-columns: repeat(<?=count($plans)?>,260px);">
      <? for ($i=0; $i < count($plans); $i++) {
        $finalPrice = $plans[$i]->price * $plans[$i]->annual_discount / 100;
        $finalPrice = $plans[$i]->price - $finalPrice; 
        $finalPrice = $finalPrice * 12; 
        if(isset($_GET['offer']) && $_GET['offer'] <= 15){
          $offerPrice = $finalPrice * $_GET['offer'] / 100; 
          $finalPrice = $finalPrice - $offerPrice;
          } 
        ?>
      <div
        class="
          single-plan
          <?=
          $plans[$i]->name
          ==
          'Completo' ||  $plans[$i]->name == 'full'
          ?
          'complete':
          ''?>
        "
      >
      <?=
          $plans[$i]->name
          ==
          'Completo' ||  $plans[$i]->name == 'full'
          ?
          ' <span class="ptBadge">'.$wp->findUiWord(258).'</span>':
          ''?>
     
        <h2><?=$plans[$i]->name?></h2>
        <span class="price"
          ><?="$".number_format($finalPrice, 0, ",", ".")?></span
        >
        <?if($finalPrice != '0'){?>
        <small><?=$wp->findUiWord(276)?></small>
        <?}else{?>
        <small><?=$wp->findUiWord(274)?></small>
        <?}?>
        <?=$plans[$i]->description_anual?>
        <?if($plans[$i]->name != 'Gratuito'){?>
          <span class="txt"
            ><?=$wp->findUiWord(254)?></span
          >
        <?}?>
        <?if($plans[$i]->price != '0'){?>
        <button
          onclick="createFormCard('<?=$wp->findUiWord(11)?>',<?=$plans[$i]->id?>, 'Anual'<?=isset($_GET['offer']) && ','.isset($_GET['offer']).','?> <?=$_GET['offer']?>);"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </button>
        <?}else{
          if(isset($_GET['email'])){
          ?>
        <a
          href="/mi-cuenta/<?= $lang ?>/registro?plan=<?=$plans[$i]->id?>&type=Mensual&email=<?=$_GET['email']?>&name=<?=$_GET['name']?>&lastname=<?=$_GET['lastname']?>"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </a>
        <?}else{?>
          <a
          href="/mi-cuenta/<?= $lang ?>/registro?plan=<?=$plans[$i]->id?>&type=Mensual"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </a>
        <?}}?>
      </div>
      <? } ?>
    </div>
    <div class="planes-mensuales" style="grid-template-columns: repeat(<?=count($plans)?>,260px);">
      <? for ($i=0; $i < count($plans); $i++) { 
        $finalPrice = $plans[$i]->price;
         if(isset($_GET['offer']) && $_GET['offer'] <= 15){
          $offerPrice = $finalPrice * $_GET['offer'] / 100; 
          $finalPrice = $finalPrice - $offerPrice;
          } 
        ?>
      <div
        class="
          single-plan
          <?=
          $plans[$i]->
          name
          ==
          'Completo' ||  $plans[$i]->name == 'full'
          ?
          'complete':
          ''?>
        "
      >
      <?=
          $plans[$i]->name
          ==
          'Completo' ||  $plans[$i]->name == 'full'
          ?
          ' <span class="ptBadge">'.$wp->findUiWord(258).'</span>':
          ''?>
        <h2><?=$plans[$i]->name?></h2>
        <span class="price"
          ><?= "$".number_format($finalPrice, 0, ",", ".")?></span
        >
        <?if($finalPrice != '0'){?>
        <small><?=$wp->findUiWord(256)?></small>
        <?}else{?>
        <small><?=$wp->findUiWord(274)?></small>
        <?}?>
        <?=$plans[$i]->description_mensual?>
        <?if($plans[$i]->name != 'Gratuito'){?>
          <span class="txt"
            ><?=$wp->findUiWord(254)?></span
          >
        <?}?>
        <?if($finalPrice != '0'){?>
        <button
          onclick="createFormCard('<?=$wp->findUiWord(11)?>',<?=$plans[$i]->id?>, 'Mensual' <?=isset($_GET['offer']) && ','.isset($_GET['offer']).','?> <?=$_GET['offer']?>);"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </button>
        <?}else{
          if(isset($_GET['email'])){
          ?>
        <a
          href="/mi-cuenta/<?= $lang ?>/registro?plan=<?=$plans[$i]->id?>&type=Mensual&email=<?=$_GET['email']?>&name=<?=$_GET['name']?>&lastname=<?=$_GET['lastname']?>"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </a>
        <?}else{?>
          <a
          href="/mi-cuenta/<?= $lang ?>/registro?plan=<?=$plans[$i]->id?>&type=Mensual"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </a>
        <?}}?>
      </div>
      <? } ?>
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
    <button type="button" onclick="Fancybox.close()" style="width:100%;"><?=$wp->findUiWord(33)?></button>
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
<script>
 
  function changePlans(event) {
    if (event.target.value == "anual") {
      document.querySelector(".planes-mensuales").style.display = "none";
      document.querySelector(".planes-anuales").style.display = "grid";

    } else {
      document.querySelector(".planes-anuales").style.display = "none";
      document.querySelector(".planes-mensuales").style.display = "grid";
  
    }
  }
  function setPlan(plan) {
    document.querySelector("input#planID").value = plan;
  }
</script>


<? include 'includes/footer.php' ?>
<script>
<?php 
  if($_GET['type'] && $_GET['plan']){
    $planSelected = $wp->getSinglePlan($_GET['plan']);
  ?>
  window.addEventListener('DOMContentLoaded', async (event) => {
    $(".preloader-container").fadeIn();
    await getAllUiWord();
    createFormCard("Para adquirir el plan <?=strtolower($planSelected->name)?> <?=strtolower($_GET['type'])?>, debes ingresar la información de tu tarjeta de credito. Empecemos...",<?=$_GET['plan']?>, "<?=$_GET['type']?>"<? if(isset($_GET['offer'])){echo ',1,'; }?><?=$_GET['offer']?>);
    $(".preloader-container").fadeOut();
});
  <?php 
  }
  ?>
</script>

