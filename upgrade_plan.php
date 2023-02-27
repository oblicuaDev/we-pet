<?php   
  $bodyClass="plansBody";
  include 'includes/head.php';
  function cmp($a, $b) {
    return strcmp($b->order, $a->order );
  }
  if($_SESSION["user"] == ""){
    header('Location: /mi-cuenta/iniciar-sesion');
  }
  $plans = $wp->getPlans(); usort($plans, "cmp"); 
  $countPlansAnual = 0;
  $countPlansMensual = 0;
  for ($i=0; $i < count($plans); $i++) { 
    if(isset($_GET["nosub"])){

        $countPlansAnual++;
        $countPlansMensual++;


    }else{
      if($plans[$i]->order > $_SESSION["activePet"]->plan->order){
        $countPlansAnual++;
        $countPlansMensual++;
      }

    }
    
  }
  ?>
<script>
    let petActiveService = <?=json_encode($_SESSION["activePet"]->services_rel)?>;
    let petPlan = "<?= isset($_SESSION["activePet"]->plan->id) ? $_SESSION["activePet"]->plan->id : ''?>";
    let petId = <?=$_SESSION["activePet"]->id?>;
    let activeService = 0;
    function setPlan(id){
      document.querySelector('#plan').value = id;
    }
</script>
<main>
  
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
    <div class="container">
      <div class="planes-anuales" style="grid-template-columns: repeat(<?=$countPlansAnual?>,260px);">
      <?php if(isset($_GET["nosub"])){ ?>
        <? 
        for ($i=0; $i < count($plans); $i++) { 

            $countPlansAnual++;
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
          <small><?=$wp->findUiWord(276)?></small>
         <?=$plans[$i]->description_anual?>
          <?if($plans[$i]->name != 'Gratuito'){?>
            <span class="txt"
              ><?=$wp->findUiWord(254)?></span
            >
          <?}?>
          <?php if(!$_SESSION['user']->pay_data->token){ ?>
            <button
                type="button" onclick="changePlanAndAddPay('<?=$wp->findUiWord(11)?>',<?=$plans[$i]->id?>, 'Anual',<?=$finalPrice?>);"
              class="btn_action"
            >
              <?=$wp->findUiWord(3)?>
            </button>
          <?php }else{ ?>
            <button
                type="button" onclick="openBoxChangePlan(<?=$plans[$i]->id?>, 'Anual',<?=$plans[$i]->price?>);"
              class="btn_action"
            >
              <?=$wp->findUiWord(3)?>
            </button>
          <?php } ?>
        </div>
        <?php } ?>
        <?php }else{ ?>
          <? 
          for ($i=0; $i < count($plans); $i++) { 
            if($plans[$i]->order > $_SESSION["activePet"]->plan->order){
              $countPlansAnual++;
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
            <small><?=$wp->findUiWord(276)?></small>
           <?=$plans[$i]->description_anual?>
            <?if($plans[$i]->name != 'Gratuito'){?>
              <span class="txt"
                ><?=$wp->findUiWord(254)?></span
              >
            <?}?>
            <?php if(!$_SESSION['user']->pay_data->token){ ?>
              <button
                  type="button" onclick="changePlanAndAddPay('<?=$wp->findUiWord(11)?>',<?=$plans[$i]->id?>, 'Anual',<?=$finalPrice?>);"
                class="btn_action"
              >
                <?=$wp->findUiWord(3)?>
              </button>
            <?php }else{ ?>
              <button
                  type="button" onclick="openBoxChangePlan(<?=$plans[$i]->id?>, 'Anual',<?=$finalPrice?>);"
                class="btn_action"
              >
                <?=$wp->findUiWord(3)?>
              </button>
            <?php } ?>
          </div>
          <?php }} ?>
        </div>
        <?php } ?>
      </div>
      <div class="planes-mensuales" style="grid-template-columns: repeat(<?=$countPlansMensual?>,260px);">
      <?php if(isset($_GET["nosub"])){ ?>
        <? 
        for ($i=0; $i < count($plans); $i++) {  

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
            ><?= "$".number_format($plans[$i]->price, 0, ",", ".")?></span
          >
          <small><?=$wp->findUiWord(256)?></small>
          <?=$plans[$i]->description_mensual?>
          <?if($plans[$i]->name != 'Gratuito'){?>
            <span class="txt"
              ><?=$wp->findUiWord(254)?></span
            >
          <?}?>
          <?php if(!$_SESSION['user']->pay_data->token){ ?>
            <button
            type="button" onclick="changePlanAndAddPay('<?=$wp->findUiWord(11)?>',<?=$plans[$i]->id?>, 'Mensual',<?=$plans[$i]->price?>);"
            class="btn_action"
            >
            <?=$wp->findUiWord(3)?>
            </button>
          <?php }else{ ?>
            <button
            type="button" onclick="openBoxChangePlan(<?=$plans[$i]->id?>, 'Mensual',<?=$plans[$i]->price?>);"
            class="btn_action"
            >
            <?=$wp->findUiWord(3)?>
            </button>
          <?php } ?>
        </div>
        <? } ?>
      </div>
      <?php }else{ ?>
        <? 
        for ($i=0; $i < count($plans); $i++) { 
          if($plans[$i]->order > $_SESSION["activePet"]->plan->order){
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
            ><?= "$".number_format($plans[$i]->price, 0, ",", ".")?></span
          >
          <small><?=$wp->findUiWord(256)?></small>
          <?=$plans[$i]->description_mensual?>
          <?if($plans[$i]->name != 'Gratuito'){?>
            <span class="txt"
              ><?=$wp->findUiWord(254)?></span
            >
          <?}?>
          <?php if(!$_SESSION['user']->pay_data->token){ ?>
            <button
            type="button" onclick="changePlanAndAddPay('<?=$wp->findUiWord(11)?>',<?=$plans[$i]->id?>, 'Mensual',<?=$plans[$i]->price?>);"
            class="btn_action"
            >
            <?=$wp->findUiWord(3)?>
            </button>
          <?php }else{ ?>
            <button
            type="button" onclick="openBoxChangePlan(<?=$plans[$i]->id?>, 'Mensual',<?=$plans[$i]->price?>);"
            class="btn_action"
            >
            <?=$wp->findUiWord(3)?>
            </button>
          <?php } ?>
        </div>
        <? }} ?>
      </div>
      <?php } ?>
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
    <button type="button" onclick="Fancybox.close()" style="width:100%;"><?=$wp->findUiWord(21)?></button>
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