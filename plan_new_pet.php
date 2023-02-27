<?php   
  $bodyClass="plansBody";
  include 'includes/head.php';
  if($_SESSION["user"] == ""){
    header('Location: /mi-cuenta/iniciar-sesion');
  }
  $plans = $wp->getPlans(); sort($plans); ?>
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
      <? 
      for ($i=0; $i < count($plans); $i++) { 
        $finalPrice = $plans[$i]->price * $plans[$i]->annual_discount / 100;
        $finalPrice = $plans[$i]->price - $finalPrice; 
        $finalPrice = $finalPrice * 12;
          ?>
      <div
        class="
          single-plan
          <?=
          $plans[$i]->name
          ==
          'Completo'
          ?
          'complete':
          ''?>
        "
      >
      <?=
          $plans[$i]->name
          ==
          'Completo'
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
            onclick="openBoxPayPlan(<?=$plans[$i]->id?>,'Anual', <?=$finalPrice?>)"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </button>
        <?}else{?>
        <a
          href="/mi-cuenta/<?= $lang ?>/agregar-mascota?plan=<?=$plans[$i]->id?>&type=Anual"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </a>
        <?}?>
      </div>
      <? } ?>
    </div>
    <div class="planes-mensuales" style="grid-template-columns: repeat(<?=count($plans)?>,260px);">
      <? for ($i=0; $i < count($plans); $i++) { 
          ?>
      <div
        class="
          single-plan
          <?=
          $plans[$i]->
          name
          ==
          'Completo'
          ?
          'complete':
          ''?>
        "
      >
      <?=
          $plans[$i]->name
          ==
          'Completo'
          ?
          ' <span class="ptBadge">'.$wp->findUiWord(258).'</span>':
          ''?>
        <h2><?=$plans[$i]->name?></h2>
        <span class="price"
          ><?= "$".number_format($plans[$i]->price, 0, ",", ".")?></span
        >
        <?if($plans[$i]->price != '0'){?>
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
        <?if($plans[$i]->price != '0'){?>
        <button
        onclick="openBoxPayPlan(<?=$plans[$i]->id?>,'Mensual', <?=$plans[$i]->price?>)"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </button>
        <?}else{?>
        <a
          href="/mi-cuenta/<?= $lang ?>/agregar-mascota?plan=<?=$plans[$i]->id?>&type=Mensual"
          class="btn_action"
        >
          <?=$wp->findUiWord(3)?>
        </a>
        <?}?>
      </div>
      <? } ?>
    </div>
  </div>
</main>
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
