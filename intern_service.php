<?php   
  $bodyClass="service";
  include 'includes/head.php';
  if($_SESSION["user"] == ""){
    header('Location: /mi-cuenta/iniciar-sesion');
  }
  function findObjectById($id, $array){
    foreach ( $array as $element ) {
      if ( $id == $element->service->id ) {
        return $element;
      }
    }
    return false;
  }
  $service = $wp->getSingleService($_GET['id']);
  $cities = $wp->getCities();
  $departments = $wp->getDepartments();
?>
    <script>
      let activeUser = <?=json_encode($_SESSION["user"])?>;
      let petActiveService = <?=json_encode($_SESSION["activePet"]->services_rel)?>;
      let activeService = <?=$_GET['id']?>;
      let petPlan =  "<?= isset($_SESSION["activePet"]->plan->id) ? $_SESSION["activePet"]->plan->id : ""?>";
      let petId = <?=$_SESSION["activePet"]->id?>;
    </script>
    <main>
      <div class="container">
      <?php include 'templates/profile-header.php' ?>
      </div>
      <div class="container">
        <ul class="breadcrumb">
          <li><a href="/mi-cuenta/<?= $lang ?>/" class="wait"><img src="img/arrow.svg" alt="arrow" /></a></li>
          <li class="breadcrumb__item"><a href="/mi-cuenta/<?= $lang ?>/" >Dashboard</a></li>
          <li class="breadcrumb__item">
            <a href=""><?=$service->name?></a>
          </li>
        </ul>
        <div class="service__intro">
          <img
            src="<?=$service->image->url?>"
            alt="image"
          />
          <div class="service__info">
            <div class="service__pet">
              <h2 class="uppercase"><?=$service->name?> <?=$wp->findUiWord(262)?></h2>
              <div class="service__pet-active">
                <div class="menu">
                <? if(count($pets->pets) > 1){ ?><a href="" class="change"><?=$wp->findUiWord(74)?> </a><? } ?>
                  <ul class="submenu">
                  <?php 
                    for ($i=0; $i < count($pets->pets); $i++) {
                      if($pets->pets[$i]->id != $_SESSION["activePet"]->id ){
                  ?>
                    <li>
                      <a href="/mi-cuenta/<?= $lang ?>/?activePet=<?=$pets->pets[$i]->id?>" class="wait"><?= $pets->pets[$i]->name ?></a>
                    </li>
                   <?php }} ?>
                  </ul>
                </div>
                  <img
                  src="<?= $_SESSION["activePet"]->image[0]->url?>"
                  alt="pet1"
                  />
                  <h4 class="services__pet-name uppercase"><?=$_SESSION["activePet"]->name?></h4>

              </div>
            </div>
            <p>
            <?=$service->description?>
            </p>
          </div>
        </div>
        <div class="service__veteriarians">
          <h2 class="uppercase"><?=$wp->findUiWord(260)?></h2>
          <form class="filters-provider">
            <div class="c-select">
              <select name="department" id="department" onchange="filterProviders(<?=$_GET['id']?>, this.value, 0);activeCities(this.value)">
                <option value="0">Departamento</option>
                <option value="all">Todo el país</option>
                <?php 
                    for ($i=0; $i < count($departments); $i++) {
                  ?>
                  <option value="<?=$departments[$i]->id?>"><?=$departments[$i]->name?></option>
                <?php } ?>
              </select>
              <div class="c-arrow"></div>
            </div>
           
            <!-- <button id="uselocation" onclick="geoFindMe()" type="button">
              <svg
                width="27"
                height="27"
                viewBox="0 0 27 27"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M13.5 18C14.6935 18 15.8381 17.5259 16.682 16.682C17.5259 15.8381 18 14.6935 18 13.5C18 12.3065 17.5259 11.1619 16.682 10.318C15.8381 9.47411 14.6935 9 13.5 9C12.3065 9 11.1619 9.47411 10.318 10.318C9.47411 11.1619 9 12.3065 9 13.5C9 14.6935 9.47411 15.8381 10.318 16.682C11.1619 17.5259 12.3065 18 13.5 18ZM12.375 4.5675V1.125C12.375 0.826631 12.4935 0.540483 12.7045 0.329505C12.9155 0.118526 13.2016 0 13.5 0C13.7984 0 14.0845 0.118526 14.2955 0.329505C14.5065 0.540483 14.625 0.826631 14.625 1.125V4.5675C16.608 4.81802 18.4513 5.72121 19.8645 7.13477C21.2776 8.54833 22.1803 10.3919 22.4303 12.375H25.875C26.1734 12.375 26.4595 12.4935 26.6705 12.7045C26.8815 12.9155 27 13.2016 27 13.5C27 13.7984 26.8815 14.0845 26.6705 14.2955C26.4595 14.5065 26.1734 14.625 25.875 14.625H22.4303C22.1802 16.6084 21.2772 18.4523 19.8636 19.8659C18.45 21.2795 16.6062 22.1824 14.6228 22.4325L14.625 22.5V25.875C14.625 26.1734 14.5065 26.4595 14.2955 26.6705C14.0845 26.8815 13.7984 27 13.5 27C13.2016 27 12.9155 26.8815 12.7045 26.6705C12.4935 26.4595 12.375 26.1734 12.375 25.875V22.5V22.4325C10.3916 22.1824 8.54774 21.2795 7.13414 19.8659C5.72054 18.4523 4.81755 16.6084 4.5675 14.625C4.545 14.6257 4.52249 14.6257 4.5 14.625H1.125C0.826631 14.625 0.540483 14.5065 0.329505 14.2955C0.118526 14.0845 0 13.7984 0 13.5C0 13.2016 0.118526 12.9155 0.329505 12.7045C0.540483 12.4935 0.826631 12.375 1.125 12.375H4.5C4.52249 12.3743 4.545 12.3743 4.5675 12.375C4.81848 10.3924 5.72188 8.54958 7.1354 7.13688C8.54892 5.72417 10.3922 4.82184 12.375 4.572V4.5675ZM6.75 13.5C6.75 15.2902 7.46116 17.0071 8.72703 18.273C9.9929 19.5388 11.7098 20.25 13.5 20.25C15.2902 20.25 17.0071 19.5388 18.273 18.273C19.5388 17.0071 20.25 15.2902 20.25 13.5C20.25 11.7098 19.5388 9.9929 18.273 8.72703C17.0071 7.46116 15.2902 6.75 13.5 6.75C11.7098 6.75 9.9929 7.46116 8.72703 8.72703C7.46116 9.9929 6.75 11.7098 6.75 13.5Z"
                  fill="#309DA3"
                />
              </svg>
              Usar mi ubicación
            </button> -->
          </form>
          <ul class="service__veteriarians-list">
            <? 
            for ($i=0; $i < count($service->providers); $i++) {
              if(findObjectById($service->id, $service->providers[$i]->provider_services)->id_service && findObjectById($service->id, $service->providers[$i]->provider_services)->link_service){ 
              ?>
              <li class="service__veteriarians-list-item">
                <button type="button" data-quick-view onclick="setlinkProvider('<?=$service->providers[$i]->link?>')">
                  <img src="<?=$service->providers[$i]->images[0]->url?>" alt="veteriarian" />
                  <h3><?=$service->providers[$i]->name?></h3>
                  <h4><?=$service->providers[$i]->subtitle?></h4>
                </button>
              </li>
              <li class="fullwidth is-hidden" id="quickview-0<?=$i?>">
              <!-- <div class="arrow"></div> -->
                <div class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                      <? for ($ima=0; $ima < count($service->providers[$i]->images); $ima++) { ?>
                        <li class="splide__slide">
                          <img
                            src="<?=$service->providers[$i]->images[$ima]->url?>"
                            alt="veteriarian"
                          />
                        </li>
                      <? } ?>
                    </ul>
                  </div>
                </div>
                <div class="info"> 
                  <h3><?=$service->providers[$i]->name?></h3>
                  <h4><?=$service->providers[$i]->subtitle?></h4>
                  <? if($service->providers[$i]->description){ ?>
                    <p>
                      <?=$service->providers[$i]->description?>
                    </p>
 <? } ?>
                  <div class="flex shelude">
                    <? if($service->providers[$i]->schedule){ ?>
                      <div class="shelude-container">
                        <div class="flex">
                          <img src="img/clock.svg" alt="clock" />
                        <?=$service->providers[$i]->schedule?>
                        </div>
                      </div>
                    <? } ?>
                    <? if($service->providers[$i]->places){ ?>
                      <div class="shelude-container">
                        <div class="flex">
                          <img src="img/place.svg" alt="place" />
                          <?=$service->providers[$i]->places?>
                        </div>
                      </div>
                    </div>
<? } ?>
                  <div class="flex actions">
                    <a href="javascript:openUseService('<?=findObjectById($service->id, $service->providers[$i]->provider_services)->id_service?>', '<?=explode("//",findObjectById($service->id, $service->providers[$i]->provider_services)->link_service)[1]?>', '<?=$service->providers[$i]->name?>');" ><?=$wp->findUiWord(268)?></a>
                    <a href="/mi-cuenta/<?= $lang ?>/proveedor/<?=$wp->get_alias($service->providers[$i]->name)?>/<?=$wp->get_alias($service->name)?>-<?=$service->providers[$i]->id?>-<?=$service->id?>" class="invert" >Conocer más </a>

                  </div>
                </div>
              </li>
            <? }} ?>
          </ul>
        </div>
      </div>
    </main>
    
<? include 'includes/footer.php' ?>
<script>createCustomSelect();</script>