<?php   
  $bodyClass="loginBody";
  include 'includes/head.php';
?>
    <main>
      <div class="container">
      <div id="snackbar">Cupón copiado</div>
        <form action="s/user_create/" id="registerForm" method="post" autocomplete="off">
          <h2 class="uppercase"><?=isset($_GET['user']) ? 'Finalicemos tu registro':'Registrarme' ?></h2>
          <div class="flex">
            <span>  
              <label for="name"><?=$wp->findUiWord(51)?></label>
              <input type="text" name="name" id="name" value="<?=$_GET['name']?>" />
            </span>
            <span>
              <label for="lastname"><?=$wp->findUiWord(52)?></label>
              <input type="text" name="lastname" id="lastname" value="<?=$_GET['lastname']?>" />
            </span>
          </div>
          <div class="flex">
            <span>
              <label for="email"><?=$wp->findUiWord(53)?></label>
              <input type="email" name="email" id="email" value="<?=$_GET['email']?>"/>
            </span>
            <span>
              <label for="phone"><?=$wp->findUiWord(54)?></label>
              <input type="tel" name="phone" id="phone" />
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
              />
            </div>
          </span>
          </div>
          <div class="flex">
            <span>
              <label for="birthday"><?=$wp->findUiWord(14)?></label>
              <input type="date" name="birthday" id="birthday" />
            </span>
            <span>
            <label for="address"><?=$wp->findUiWord(60)?></label>
            <input type="text" name="address" id="address" />
          </span>
          </div>
          <div class="flex">
            <span>
              <label for="typedoc"><?=$wp->findUiWord(57)?></label>
              <div class="custom-select" style="margin: 0">
                <select name="typedoc" id="typedoc">
                  <option value="0"><?=$wp->findUiWord(57)?></option>
                  <option value="cedula-de-ciudadania">
                    Cédula de Ciudadanía
                  </option>
                  <option value="pasaporte">Pasaporte</option>
                  <option value="cedula-de-extranjeria">
                    Cédula de Extranjería
                  </option>
                  <option value="tarjeta-de-identidad">
                    Tarjeta de Identidad
                  </option>
                </select>
              </div>
            </span>
            <span>
              <label for="numdoc"><?=$wp->findUiWord(59)?></label>
              <input type="tel" name="numdoc" id="numdoc" />
            </span>
          </div>
          <? if(!isset($_GET['email'])){  ?>
            <div class="flex">
              <span>
                <label for="password"><?=$wp->findUiWord(8)?></label>
                <input type="password" name="password" id="password" />
                <span class="material-icons" id="togglePassword">
                  visibility
                </span>
              </span>
              <span>
                <label for="confirmpassword"><?=$wp->findUiWord(242)?></label>
                <input
                  type="password"
                  name="confirmpassword"
                  id="confirmpassword"
                />
                <span class="material-icons" id="togglePasswordConfirm">
                  visibility
                </span>
              </span>
            </div>
          <? }  ?>
          <input
            type="hidden"
            name="plan"
            id="plan"
            value="<?=$_GET['plan']?>"
          />
          <? if(isset($_GET['email'])){  ?>
            <input
              type="hidden"
              name="isLoggin"
              id="isLoggin"
              value="si"
            />
<? }  ?>
          <input
            type="hidden"
            name="userID"
            id="userID"
            value="<?=$_GET['user']?>"
          />
          <input
            type="hidden"
            name="type"
            id="type"
            value="<?=$_GET['type']?>"
          />
          <? if(isset($_GET['offer'])){ ?>
            <input
              type="hidden"
              name="offer"
              id="offer"
              value="<?=$_GET['offer']?>"
            />
          <? } ?>
          <button type="submit" class="uppercase"><?= $_GET['plan'] == 8 || $_GET['plan'] == 44 ? $wp->findUiWord(244) : $wp->findUiWord(246)?></button>
          <a href="/mi-cuenta/<?= $lang ?>/iniciar-sesion" class="wait"><?=$wp->findUiWord(240)?></a>
          <a href="/mi-cuenta/<?= $lang ?>/recuperar-contraseña" class="wait"><?=$wp->findUiWord(18)?></a>
        </form>
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