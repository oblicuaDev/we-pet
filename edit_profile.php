<?php   
  $bodyClass="editBody";
  include 'includes/head.php';
  if($_SESSION["user"] == ""){
    header('Location: /mi-cuenta/iniciar-sesion');
  }
  $pet = $wp->get_single_pet($_GET["id"]); $wp->setActivePet($pet); 
  ?>

<main>
  <div class="container">
    <?php include 'templates/profile-header.php' ?>
  </div>
  <div class="container">
  <ul class="breadcrumb">
          <li><a href="/mi-cuenta/<?= $lang ?>/" class="wait"><img src="img/arrow.svg" alt="arrow" /></a></li>
          <li class="breadcrumb__item"><a href="/mi-cuenta/<?= $lang ?>/" >Dashboard</a></li>
          <li class="breadcrumb__item">
            <a href=""><?=$wp->findUiWord(61)?></a>
          </li>
        </ul>
  <div class="tabs">
        <section class="tabs-header">
          <label for="tab-btn-1" class="active"> <?=$wp->findUiWord(49)?> </label>
          <label for="tab-btn-2"><?=$wp->findUiWord(50)?></label>
        </section>
        <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked />
        <input type="radio" name="tab-btn" id="tab-btn-2" value="" />
        <div id="content-1" class="vacunas">
          <form
            class="editProfile"
            action="s/user_edit/"
            method="post"
            id="editProfile"
          >
            <div class="flex">
              <span>
                <label for="name"><?=$wp->findUiWord(51)?></label>
                <input type="text" name="name" id="name" value="<?=$_SESSION["user"]->name?>"
                />
              </span>
              <span>
                <label for="lastname"><?=$wp->findUiWord(52)?></label>
                <input type="text" name="lastname" id="lastname" value="<?=$_SESSION["user"]->lastname?>"
                />
              </span>
            </div>
            <div class="flex">
              <span>
                <label for="email"><?=$wp->findUiWord(53)?></label>
                <input type="email" name="email" id="email" value="<?=$_SESSION["user"]->email?>"
                />
              </span>
              <span>
                <label for="phone"><?=$wp->findUiWord(54)?></label>
                <input type="tel" name="phone" id="phone" value="<?=$_SESSION["user"]->phone?>"
                />
              </span>
            </div>
            <div class="flex">
            <span>
              <label for=""><?=$wp->findUiWord(55)?></label>
              <div class="autocomplete" style="width: 100%">
              <input
                id="departamento"
                type="text"
                name="departamento"
                autocomplete="off"
                onblur="createCities(event)"
                value="<?=$_SESSION["user"]->departamento?>"
              />
            </div>
          </span>
          <span>
              <label for=""><?=$wp->findUiWord(58)?></label>
              <div class="autocomplete" style="width: 100%">
              <input
                id="city"
                type="text"
                name="city"
                autocomplete="off"
                value="<?=$_SESSION["user"]->city?>"
              />
            </div>
          </span>
          </div>
            <div class="flex">
              <span>
                <label for="birthday"><?=$wp->findUiWord(14)?></label>
                <input type="date" name="birthday" id="birthday" value="<?=$_SESSION["user"]->birthday?>" />
              </span>
              <span>
              <label for="address"><?=$wp->findUiWord(60)?></label>
              <input type="text" name="address" id="address" value="<?=$_SESSION["user"]->address?>" />
            </span>
            </div>
            <div class="flex">
              <span>
                <label for="typedoc"><?=$wp->findUiWord(57)?></label>
                <div class="custom-select" style="margin: 0">
                  <select name="typedoc" id="typedoc">
                    <option value="<?=$_SESSION["user"]->doc_type?>"><?=$_SESSION["user"]->doc_type?></option>
                    <option value="cedula de ciudadania">Cédula de Ciudadanía</option>
                    <option value="pasaporte">Pasaporte</option>
                    <option value="cedula de extranjeria">
                      Cédula de Extranjería
                    </option>
                    <option value="tarjeta-de-identidad">Tarjeta de Identidad</option>
                  </select>
                </div>
              </span>
              <span>
                <label for="numdoc"><?=$wp->findUiWord(59)?></label>
                <input type="tel" name="numdoc" id="numdoc" value="<?=$_SESSION["user"]->doc_num?>" />
              </span>
            </div>
           

            <input
              type="hidden"
              name="userID"
              id="userID"
              value="<?=$_SESSION["user"]->id?>"
            />
            <button type="submit" class="uppercase"><?=$wp->findUiWord(33)?></button>
          </form>
        </div>
        <div id="content-2" class="vacunas">
          <div class="flex">
          

                <form id="actualCard" style="margin-bottom: 50px">
                    <h2 style="margin-bottom:15px">Tu método de pago actual</h2>
                    <span>
                    <label for="card_number"><?=$wp->findUiWord(13)?></label>
                    <p><?=$_SESSION["user"]->pay_data->mask?></p>
                    </span>
                    <span>
                      <label for="name"><?=$wp->findUiWord(12)?></label>
                      <p><?=$_SESSION["user"]->pay_data->titular?></p>
                    </span>
                    <button type="button" onclick="document.querySelector('#creditcardChangeProfile').classList.toggle('hide')" style="    background: #ff9700;
    border-radius: 20px;
    color: #fff;
    font-size: 16px;
    font-style: normal;
    font-weight: bold;
    height: 37px;
    line-height: 16px;
    margin-top: 30px;
    text-align: center;
    text-transform: uppercase;
    padding: 0 30px;
    transition: transform .6s cubic-bezier(0.25, 1, 0.5, 1);">Actualizar método de pago</button>
                </form>
                <form action="s/creditChange/" id="creditcardChangeProfile" method="POST" class="hide">
                  <h2><?=$wp->findUiWord(11)?></h2>
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
                  <input type="text" name="name" id="name" placeholder="Nombre como aparece en la tarjeta" value="<?=$customer->data->name?>" />
                  </span>
                  <div class="flex" >
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
                  <input type="text" name="secure_code" id="secure_code" placeholder="CVC" />
                  </span>
                  </div>
                  <input type="hidden" name="userID" id="userID" value="<?=$_SESSION["user"]->id?>" />
                  <small
                  ><?=$wp->findUiWord(15)?></small
                  >
                  <div class="flex" style="align-items: center;flex-direction:column">
                    <button type="submit" style="margin: 0"><?=$wp->findUiWord(33)?></button>
                    <a href="javascript:document.querySelector('#creditcardChangeProfile').classList.toggle('hide');" style="margin: 0">Cancelar</a>
                  </div>
                </form>

          </div>
        </div>
  </div>
  <div id="snackbar">Perfil editado</div>
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

