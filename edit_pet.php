<?php   

  $bodyClass="editBody";
  include 'includes/head.php';
  if($_SESSION["user"] == ""){
    header('Location: /mi-cuenta/iniciar-sesion');
  }
  $pet = $wp->get_single_pet($_GET["id"]);
  $wp->setActivePet($pet);
?>
<script>
  let activeService = <?=$_GET['id']?>;
  let petPlan =  "<?= isset($_SESSION["activePet"]->plan->id) ? $_SESSION["activePet"]->plan->id : ""?>";
  let activePet  = "<?=$_SESSION["activePet"]->id?>";
  let activePetSub  = "<?=$_SESSION["activePet"]->id_sub?>";
  let actualType = "<?=$_SESSION["activePet"]->type?>";
  let petActiveService = <?=json_encode($_SESSION["activePet"]->services_rel)?>;
</script>
<main>
<div id="snackbar">Perfil editado</div>
  <div class="container">
    <?php include 'templates/profile-header.php' ?>
  </div>
  <div class="container">
    <form class="petProfile" action="s/pet_edit/" method="post" id="petProfile">
      <div class="petProfile__left">
        <div class="petProfile__photo">
          <span class="petProfile__photo-input">
            <img
              class="petProfile__photo-pet"
              src="<?=$pet->image[0]->url?>"
              alt="pet1"
            />
            <input type="file" name="photo" id="photo" onchange="changePhoto(this)" />
            <img src="img/photo.svg" alt="photo" class="icon" />
          </span>
          <span class="petProfile__photo-name">
            <input type="text" name="name" id="name" value="<?=$pet->name?>" />
          </span>
        </div>
        <div class="flex especie">
          <!-- <span class="customRadio">
            <input type="radio" name="especie" id="e-perro" value="perro" <?= $pet->type == "perro" ? "checked" : "" ?> />
            <label for="e-perro"
              ><svg
                width="100"
                height="97"
                viewBox="0 0 100 97"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12.3618 96.8655C14.2386 96.8655 16.0669 96.4895 17.8466 95.7375C19.6263 94.9856 20.9369 94.265 21.7782 93.5757C22.6195 92.8864 23.6226 91.9778 24.7875 90.8499C28.9295 94.8603 35.1423 96.8655 43.4261 96.8655H90.0225C90.8638 96.8655 91.5919 96.5678 92.2067 95.9725C92.8215 95.3772 93.1289 94.6723 93.1289 93.8577C93.1289 93.0431 92.8215 92.3381 92.2067 91.7428C91.5919 91.1475 90.8638 90.8499 90.0225 90.8499C89.2459 90.8499 88.3237 90.1449 87.2559 88.735C86.188 87.3251 85.1687 85.5392 84.198 83.3773C83.2272 81.2155 82.4021 78.6306 81.7225 75.6228C81.043 72.615 80.7032 69.6698 80.7032 66.7874C80.7032 65.1581 80.9136 63.7795 81.3342 62.6516C81.7549 61.5237 82.2726 60.5524 82.8874 59.7378C83.5023 58.9232 84.1171 58.0302 84.7319 57.059C85.3467 56.0877 85.8644 54.6464 86.2851 52.7352C86.7058 50.824 86.9161 48.4898 86.9161 45.7327C86.9161 44.1034 86.7058 42.7719 86.2851 41.7379C85.8644 40.704 85.3467 39.9207 84.7319 39.3881C84.1171 38.8554 83.5023 38.3071 82.8874 37.7432C82.2726 37.1792 81.7549 36.3176 81.3342 35.1583C80.9136 33.9991 80.7032 32.5108 80.7032 30.6936C80.7032 26.6832 82.7742 24.678 86.9161 24.678C89.8284 24.678 92.6274 23.597 95.3131 21.4352C97.9989 19.2733 99.3418 17.3464 99.3418 15.6545C99.3418 14.2133 98.6461 12.8504 97.2547 11.5658C95.8632 10.2812 94.488 9.63892 93.1289 9.63892C92.0287 9.63892 91.0095 9.3256 90.0711 8.69897C89.1327 8.07235 88.2428 7.32039 87.4015 6.44312C86.5601 5.56584 85.6379 4.68856 84.6348 3.81128C83.6317 2.934 82.2726 2.18205 80.5576 1.55542C78.8426 0.928792 76.8202 0.615479 74.4904 0.615479C71.4487 0.615479 68.9732 0.960124 67.0641 1.64941C65.1549 2.3387 63.7311 3.23165 62.7927 4.32825C61.8543 5.42485 61.0939 6.96008 60.5115 8.93396C59.929 10.9078 59.5245 12.866 59.298 14.8086C59.0715 16.7511 58.667 19.2263 58.0846 22.2341C57.5021 25.2419 56.7579 28.0618 55.8518 30.6936C54.6222 34.2654 51.7261 38.8241 47.1635 44.3698C42.601 49.9154 39.2842 53.3775 37.2133 54.7561C28.9294 60.0824 24.7875 68.1033 24.7875 78.8186C24.7875 81.8891 22.9431 84.6619 19.2542 87.1371C15.5653 89.6123 11.1969 90.8499 6.14898 90.8499C4.46633 90.8499 2.49245 90.5365 0.227356 89.9099C0.809807 92.1031 2.23359 93.8107 4.4987 95.0326C6.76379 96.2545 9.38484 96.8655 12.3618 96.8655ZM68.2775 66.7874C68.4717 67.79 68.7305 69.0902 69.0541 70.6881C69.3777 72.286 70.0734 74.7142 71.1413 77.9727C72.2091 81.2311 73.3255 83.5183 74.4904 84.8342H62.0647C62.0647 82.1397 62.3883 79.8055 63.0354 77.8317C63.6826 75.8578 64.3945 74.4322 65.1711 73.5549C65.9477 72.6777 66.6596 71.6594 67.3068 70.5001C67.9539 69.3409 68.2775 68.1033 68.2775 66.7874Z"
                />
              </svg>
            </label>
          </span>
          <span class="customRadio">
            <input type="radio" name="especie" id="e-gato" value="gato" <?= $pet->type == "gato" ? "checked" : "" ?> />
            <label for="e-gato"
              ><svg
                width="86"
                height="98"
                viewBox="0 0 86 98"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.13452 48.9999C6.13452 51.036 5.11208 55.1081 3.06721 61.2163C1.02234 67.3244 -9.15527e-05 71.3965 -9.15527e-05 73.4326C-9.15527e-05 77.5683 0.622955 81.4814 1.86905 85.1717C3.11514 88.8621 4.93636 91.9003 7.33269 94.2863C9.72902 96.6723 12.3969 97.8653 15.3364 97.8653H58.2788C59.1095 97.8653 59.8284 97.5631 60.4355 96.9586C61.0425 96.3541 61.3461 95.6384 61.3461 94.8112C61.3461 93.9841 61.0425 93.2682 60.4355 92.6638C59.8284 92.0593 59.1095 91.7571 58.2788 91.7571C57.3841 91.7571 56.6492 91.4708 56.0741 90.8982C55.499 90.3255 55.2114 89.5938 55.2114 88.703C55.2114 87.0487 55.8505 85.124 57.1285 82.9289C58.4066 80.7338 59.9402 78.475 61.7295 76.1526C63.5187 73.8303 65.308 71.4284 67.0973 68.9469C68.8865 66.4655 70.4202 63.7295 71.6982 60.739C72.9763 57.7486 73.6153 54.8536 73.6153 52.054C73.6153 47.282 71.6982 43.3371 67.8641 40.2194C68.6309 37.9288 70.548 36.7836 73.6153 36.7836C75.4685 36.7836 77.4015 36.1314 79.4144 34.827C81.4273 33.5227 83.0089 32.1547 84.1592 30.7231C85.3094 29.2915 85.8845 28.2576 85.8845 27.6213C85.8845 26.7942 85.581 26.0784 84.9739 25.4739C84.3668 24.8694 83.6479 24.5672 82.8172 24.5672C82.306 24.5672 81.7628 24.1218 81.1877 23.2311C80.6126 22.3403 79.9576 21.2268 79.2227 19.8906C78.4878 18.5545 77.6411 17.2024 76.6826 15.8344C75.7241 14.4665 74.446 13.1939 72.8485 12.0168C71.2509 10.8397 69.4616 10.0285 67.4807 9.5831V0.134521C66.0109 0.134521 64.2856 1.2639 62.3046 3.52265C60.3236 5.7814 59.0456 8.11969 58.4705 10.5375C55.4032 11.81 53.0707 14.0211 51.4732 17.1706C49.8756 20.3201 49.0768 23.8037 49.0768 27.6213C49.0768 29.4665 48.6774 31.2162 47.8787 32.8705C47.0799 34.5248 45.9456 36.0041 44.4759 37.3085C43.0061 38.6128 41.8079 39.599 40.8814 40.2671C39.9548 40.9352 38.7886 41.6828 37.3827 42.51C37.1271 42.7009 36.9354 42.8281 36.8076 42.8917C33.1013 44.9914 30.034 47.0275 27.6057 48.9999C23.1964 52.6266 19.538 57.1759 16.6305 62.6479C13.7229 68.1198 12.2691 72.7327 12.2691 76.4867C12.2691 76.7412 12.2372 77.0275 12.1733 77.3456C12.1094 77.6638 11.8218 78.1092 11.3106 78.6818C10.7994 79.2544 10.0965 79.5408 9.20183 79.5408C8.3072 79.5408 7.57232 79.0477 6.9972 78.0614C6.42208 77.0752 6.13452 75.5323 6.13452 73.4326C6.13452 71.2057 6.54989 68.9787 7.38062 66.7518C8.21134 64.5248 9.23378 62.4093 10.4479 60.405C11.6621 58.4008 12.8762 56.317 14.0903 54.1537C15.3045 51.9904 16.3269 49.3976 17.1577 46.3753C17.9884 43.353 18.4038 40.1558 18.4038 36.7836C18.4038 33.7295 17.1257 30.9299 14.5696 28.3848C12.0135 25.8397 9.20183 24.5672 6.13452 24.5672C4.40916 24.5672 2.95538 25.1558 1.77319 26.3329C0.591003 27.51 -9.15527e-05 28.9575 -9.15527e-05 30.6754C-9.15527e-05 31.6934 0.191612 32.6001 0.575027 33.3954C0.958443 34.1908 1.45368 34.9225 2.06075 35.5906C2.66782 36.2586 3.00331 36.6563 3.06721 36.7836C5.11208 40.1558 6.13452 44.2279 6.13452 48.9999Z"
                />
              </svg>
            </label>
          </span> -->
        </div>
        <h2 class="uppercase"><?=$wp->findUiWord(34)?></h2>
        <div class="flex">
          <div class="custom-select" style="width: 243px">
            <select id="size" name="size">
              <option value="<?=$pet->size?>"><?=$pet->size?></option>
              <option value="Pequeño ">Pequeño </option>
              <option value="Mediano">Mediano</option>
              <option value="Grande ">Grande </option>
              <option value="Gigante">Gigante</option>
            </select>
          </div>
          <div class="autocomplete" style="width: 243px">
            <input
              id="razaInput"
              type="text"
              name="razaInput"
              autocomplete="off"
              onchange="setRaza(event)"
              value="<?=$pet->breed?>"
            />
          </div>
        </div>
        <h2 class="uppercase"><?=$wp->findUiWord(37)?></h2>
        <div class="flex">
          <div class="custom-select" style="width: 243px">
            <select name="gender" id="gender">
              <option value="<?=$pet->gender?>"><?=$pet->gender?></option>
              <option value="Macho">Macho</option>
              <option value="Hembra">Hembra</option>
            </select>
          </div>
          <span class="age">
            <input type="text" name="age" id="age" value="<?=$pet->age?>" />
          </span>
        </div>
        <h2 class="uppercase"><?=$wp->findUiWord(38)?></h2>
        <div class="flex">
          <div class="custom-select" style="width: 243px">
            <select name="hair_size" id="hair_size">
              <option value="<?=$pet->hair_size?>"><?=$pet->hair_size?></option>
              <option value="Corto">Corto</option>
              <option value="Largo">Largo</option>
            </select>
          </div>
          <div class="custom-select" style="width: 243px">
            <select name="hair_color" id="hair_color">
              <option value="<?=$pet->hair_color?>"><?=$pet->hair_color?></option>
            </select>
          </div>
        </div>
      </div>
      <div class="petProfile__right">
        <div class="save" style="<?=count($pets->pets) <= 1 ? 'max-width: 230px': ''?>">
          <? if(count($pets->pets) > 1){ ?>
            <a href="javascript:;" data-fancybox="dialog" data-src="#dialog-content" class="delete uppercase"><?=$wp->findUiWord(31)?></a>
          <? } ?>
          <a href="/mi-cuenta/<?= $lang ?>/inicio" class="cancel uppercase wait"><?=$wp->findUiWord(32)?></a>
          <button type="submit"><?=$wp->findUiWord(33)?></button>
        </div>
        <h2 class="uppercase"><?=$wp->findUiWord(36)?></h2>
        <div class="flex esterilizado">
          <small><?=$wp->findUiWord(35)?></small>
          <label class="switch">
            <input type="checkbox" name="ster" id="ster" <?= $pet->sterilized ? "checked" : "" ?> />
            <span class="slider round"></span>
          </label>
        </div>
        <h3><?=$wp->findUiWord(40)?></h3>
        <div class="custom-select" style="width: 320px">
          <select name="food" id="food">
            <option value="<?=!$pet->food ? $wp->findUiWord(278):$pet->food?>"><?=!$pet->food ? $wp->findUiWord(278):$pet->food?></option>
          </select>
        </div>
        <div class="flex areas">
          <div class="left">
            <h3><?=$wp->findUiWord(39)?></h3>
            <textarea name="allergies" id="allergies" cols="30" rows="10"><?=$pet->allergies ? $pet->allergies : ""?></textarea>
          </div>
          <div class="right">
            <h3><?=$wp->findUiWord(41)?></h3>
            <textarea name="record" id="record" cols="30" rows="10"><?=$pet->record ? $pet->record : ""?></textarea>
          </div>
        </div>
      </div>
      <input type="hidden" name="pet_id" id="pet_id" value="<?=$_GET['id']?>">
      <div class="tabs">
        <section class="tabs-header">
          <label for="tab-btn-1" class="active"> vacunas </label>
          <label for="tab-btn-2"> desparasitación </label>
        </section>
        <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked />
        <input type="radio" name="tab-btn" id="tab-btn-2" value="" />

        <div id="content-1" class="vacunas">
          <a href="/mi-cuenta/<?= $lang ?>/agregar-registro/vacuna">+ <?=$wp->findUiWord(42)?></a>
          <?php for ($i=0; $i < count($pet->vaccines); $i++) { ?> 
          <div class="table">
            <button type="button" id="notify">
              <img src="img/notification.svg" alt="notification" />
            </button>
              <div class="max">
                <div class="thead">
                  <div class="tr">
                    <div class="th">
                      <h4>
                        <?=$pet->vaccines[$i]->vaccine->name?>
                        Rabia
                        <a href="/mi-cuenta/<?= $lang ?>/agregar-registro/vacuna-<?=$pet->vaccines[$i]->id?>">
                          <img src="img/edit_green.svg" alt="edit" />
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div class="tr">
                    <div class="th"><?=$wp->findUiWord(44)?></div>
                    <div class="th"><?=$wp->findUiWord(45)?></div>
                    <div class="th"><?=$wp->findUiWord(46)?></div>
                    <div class="th"><?=$wp->findUiWord(48)?></div>
                  </div>
                </div>
                <div class="tbody">
                  <div class="tr">
                    <div class="td"><?=$pet->vaccines[$i]->date_application?></div>
                    <div class="td"><?=$pet->vaccines[$i]->due_date?></div>
                    <div class="td"><?=$pet->vaccines[$i]->lote?></div>
                    <div class="td"><?=$pet->vaccines[$i]->veterinarian?></div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          <div class="alert">
            <img src="img/warn.svg" alt="warn" />
            <p>
            <?=$wp->findUiWord(43)?>
            </p>
          </div>
        </div>
        <div id="content-2" class="vacunas">
        <a href="/mi-cuenta/<?= $lang ?>/agregar-registro/desparasitacion">+ Agregar registro de desparasitación</a>
          <?php for ($a=0; $a < count($pet->dewormings); $a++) { ?> 
          <div class="table">
            <button type="button" id="notify">
              <img src="img/notification.svg" alt="notification" />
            </button>
              <div class="max">
                <div class="thead">
                  <div class="tr">
                    <div class="th">
                      <h4>
                        <?=$pet->dewormings[$a]->dewormer->name?>
                        <a href="/mi-cuenta/<?= $lang ?>/agregar-registro/desparasitacion-<?=$pet->dewormings[$a]->id?>">
                          <img src="img/edit_green.svg" alt="edit" />
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div class="tr">
                  <div class="th"><?=$wp->findUiWord(44)?></div>
                    <div class="th"><?=$wp->findUiWord(45)?></div>
                    <div class="th"><?=$wp->findUiWord(46)?></div>
                  </div>
                </div>
                <div class="tbody">
                  <div class="tr">
                    <div class="td"><?=$pet->dewormings[$a]->date_application?></div>
                    <div class="td"><?=$pet->dewormings[$a]->next_application?></div>
                    <div class="td"><?=$pet->dewormings[$a]->lote?></div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
        </div>
      </div>
      <input type="hidden" name="especie" id="especie" value="<?=$_SESSION["activePet"]->type?>">
    </form>
  </div>
</main>
<div
    id="dialog-content"
    style="display: none; max-width: 480px; width: 100%"
  >
  <h2>¿Esta seguro de cancelar la suscripción de tu mascota?</h2>
  <div class="actions">
    <a href="">Cancelar</a>
    <button type="button" onclick="deletePet(<?=$pet->id?>)">Cancelar</button>
  </div>
</div>
<? include 'includes/footer.php' ?>