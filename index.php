<?php
  $bodyClass="home";
  include 'includes/head.php';
  if(!isset($_SESSION["user"])){
      header('Location: /mi-cuenta/iniciar-sesion');
    }
  if(isset($_GET['activePet'])){
    $wp->setActivePetId($_GET['activePet']);
    $name = $wp->getNamePlan($_SESSION["activePet"]->plan->id);
    $news = $wp->get_news();
    $codes = $wp->get_codes($_SESSION["activePet"]->plan->id);
  }else{
    $wp->setActivePetId($wp->get_user_pets($_SESSION["user"]->id)->pets[0]->id);
    $name = $wp->getNamePlan($_SESSION["activePet"]->plan->id);
    $news = $wp->get_news();
    $codes = $wp->get_codes($_SESSION["activePet"]->plan->id);
  }
?>
    <script>
      let petActiveService = <?=json_encode($_SESSION["activePet"]->services_rel)?>;
      let petPlan = "<?= isset($_SESSION["activePet"]->plan->id) ? $_SESSION["activePet"]->plan->id : ''?>";
      let petId = <?=$_SESSION["activePet"]->id?>;
      let activeService = 0;
    </script>
    <main>
      <?php $home =1; include 'templates/profile-header.php' ?>
      <section class="grid">
        <aside>
          <div class="todayWepet">
            <h2><?=$wp->findUiWord(26)?></h2>
            <div class="splide">
              <div class="splide__track">
                <ul class="todayWepet__slider splide__list">
                  <?php for ($i=0; $i < count($news); $i++) { ?>
                    <li class="todayWepet__slider-item splide__slide">
                      <a href="<?=$news[$i]->link?>" target="_blank">
                        <img
                          src="<?=$news[$i]->image->url?>"
                          alt=""
                        />
                        <span class="todayWepet__slider-text"
                          ><?=$news[$i]->name?></span
                        >
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <? if($_SESSION["activePet"]->plan->order > 0){ ?>
            <div class="cupones">
              <h2><?=$wp->findUiWord(264)?></h2>
              <p>
              <?=$wp->findUiWord(266)?>
              </p>
              <div class="splideCupones">
                <div class="splide__track">
                  <div class="cupones__list splide__list">
                    <div class="splide__slide">
                      <?php for ($i=0; $i < count($codes); $i++) { ?>
                        <div class="cupones__list-item ">
                          <a href="javascript:copyToClipboard(document.querySelector('#code_<?=$i?>'))">
                          <img src="img/copy.svg" alt="copy" style="position: absolute;top: 10px;left: 10px;z-index: 5;">
                          <div class="cupones__list-item-left">
                            <input type="tel" value="<?=$codes[$i]->code?>" class="cupones__list-code" id="code_<?=$i?>" readonly>
                            <p> <?=$wp->findUiWord(270)?></p>
                          </div>
                          <div class="cupones__list-item-right">
                            <h3 class="cupones__list-percentaje">-<?=$codes[$i]->discount?>%</h3>
                            <p>En la categoría <b><?=$codes[$i]->category?></b></p>
                          </div>
                          </a>
                        </div>
                        <?php if($i % 5 == 0 && $i > 0 && $i < count($codes) - 1){echo '</div><div class="splide__slide">';} ?>
                      <?php } ?>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          <? } ?>
        </aside>
        <div class="services">
          <?php
            if (count($_SESSION["user"]->pets) == 0){
          ?>
    <div class="overlay-mora">
                <h2>Aún no tienes suscripciones activas</h2>
            <a href="/mi-cuenta/es/nueva-mascota" class="btn renovar"><p>Empieza agregando una mascota</p></a>
              </div>
          <?php
           }else if(date("Y-m-d") > $_SESSION["activePet"]->sub_end){

            if ($_SESSION["activePet"]->id_sub){
          ?>
          <div class="overlay-mora">
            <h2><?=$wp->findUiWord(252)?></h2>
          </div>
          <?php
            }else if($_SESSION["activePet"]->plan->id != 8){
              ?>
              <div class="overlay-mora">

                <h2>La suscripción de esta mascota está vencida, cambia tu método de
            pago para poder renovarla y seguir usando tus servicios</h2>
            <a href="https://wepet.co/mi-cuenta/s/upgradePlan/?userID=<?=$_SESSION["user"]->id?>&petID=<?=$_SESSION["activePet"]->id?>&nosub=1" class="btn renovar"><p>Renovar suscripción</p></a>
            <h2>ó pásala a nuestro plan gratuito</h2>
            <a href="https://wepet.co/mi-cuenta/s/petFreeDesktop/?petID=<?=$_SESSION["activePet"]->id?>" class="btn renovar"><p>Cambiar al plan gratuito</p></a>
              </div>
          <?php
            }
          }
          ?>
          <div class="services__pet">
            <h2 class="uppercase"><?=$wp->findUiWord(28)?></h2>
            <div class="service__pet-active">
                <div class="menu">
                  <a href="/mi-cuenta/<?= $lang ?>/editar-mascota-<?=$_SESSION["activePet"]->id?>" class="change"><?=$wp->findUiWord(248)?></a>
                </div>
                  <img
                  src="<?= $_SESSION["activePet"]->image[0]->url?>"
                  alt="pet1"
                  />
                  <h4 class="services__pet-name uppercase"><?=$_SESSION["activePet"]->name?></h4>

              </div>
          </div>
          <ul class="services__list">
            <?php for ($i=0; $i < count($_SESSION["activePet"]->services_rel); $i++) { 
               $serv = $wp->getSingleService($_SESSION["activePet"]->services_rel[$i]->service->id);
               for ($a=0; $a < count($serv->plan_quantity); $a++) {
                 if($serv->plan_quantity[$a]->plan->order == $_SESSION["activePet"]->plan->order + 1 && $serv->plan_quantity[$a]->available){
              ?>
              <?php if(!$_SESSION["activePet"]->services_rel[$i]->available && $_SESSION["activePet"]->services_rel[$i]->quantity === NULL){ ?>
                <li class="services__list-item other-plan">
                  <div class="image">
                    <div class="plan">
                      <p><?=$wp->findUiWord(30)?></p>
                      <div class="actions">
                        <a href="/mi-cuenta/<?= $lang ?>/mejorar-plan" class="uppercase">
                          <img src="img/up_plan.svg" alt="upPlan" />
                          <?=$wp->findUiWord(27)?>
                        </a>
                        <? if(isset($_SESSION["user"]->pay_data->token) && $_SESSION["user"]->pay_data->token != ''){ ?>
                          <button type="button" class="uppercase" onclick="methodSelector(<?=$serv->price?>, '<?=$serv->name?>', `<?=$_SESSION['user']->email?>`, `<?=$_SESSION['user']->name?>`);activeService = <?=$serv->id?>">
                            <img src="img/money.svg" alt="money" />
                            <?=$wp->findUiWord(29)?>
                          </button>
                          <? }else{ ?>
                            <button type="button" class="uppercase" onclick="addPayMethodAndPayService('<?=$wp->findUiWord(11)?>',<?=$serv->price?>,<?=$serv->id?>);activeService = <?=$serv->id?>">
                              <img src="img/money.svg" alt="money" />
                              <?=$wp->findUiWord(29)?>
                            </button>
                        <? } ?>
                      </div>
                    </div>
                    <img
                      src="<?= $serv->image->url?>"
                      alt="<?=$serv->name?>"
                    />
                  </div>
                  <p class="name"><?=$serv->name?></p>
                </li>
              <?php }}} ?>
              <?php if($_SESSION["activePet"]->services_rel[$i]->available && $_SESSION["activePet"]->services_rel[$i]->quantity == 0){ ?>
                <li class="services__list-item soldout">
                  <div class="image">
                    <div class="soldout-content">
                      <p>Agotaste este servicio</p>
                      <? if(isset($_SESSION["user"]->pay_data->token) && $_SESSION["user"]->pay_data->token != ''){ ?>
                        <button type="button" class="uppercase" onclick="methodSelector(<?=$serv->price?>, '<?=$serv->name?>');activeService = <?=$serv->id?>">
                        <img src="img/money.svg" alt="money" />
                        <?=$wp->findUiWord(29)?>
                        </button>
                      <? }else{ ?>
                        <button type="button" class="uppercase" onclick="addPayMethodAndPayService('<?=$wp->findUiWord(11)?>',<?=$serv->price?>,<?=$serv->id?>);activeService = <?=$serv->id?>">
                        <img src="img/money.svg" alt="money" />
                        <?=$wp->findUiWord(29)?>
                        </button>
                      <? } ?>
                    </div>
                    <img
                      src="<?= $serv->image->url?>"
                      alt="<?=$serv->name?>"
                    />
                  </div>
                  <p class="name"><?=$serv->name?></p>
                </li>
              <?php } ?>
              <?php if($_SESSION["activePet"]->services_rel[$i]->quantity > 0){ ?>
                <li class="services__list-item">
                  <a href="/mi-cuenta/<?= $lang ?>/servicios/<?=$wp->get_alias($serv->name)?>-<?=$serv->id?>" class="wait">
                    <div class="services__list-item-quantity"><?=$_SESSION["activePet"]->services_rel[$i]->quantity?></div>
                    <div class="image">
                      <img
                        src="<?= $serv->image->url?>"
                        alt="<?=$serv->name?>"
                      />
                    </div>
                    <p class="name"><?=$serv->name?></p>
                  </a>
                </li>
              <?php } ?>
                
                <?}?>
              
          </ul>
        </div>
      </section>
    </main>
    <div id="snackbar">Cupón copiado <a href="https://wepet.co/?ref=dashboard">Ir al marketplace de Wepet</a></div>
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
<? include 'templates/tour.php' ?>
<? include 'includes/footer.php' ?>