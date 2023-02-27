<?php
  $bodyClass="createSub";
  include 'includes/head.php';
  $plans = $wp->getPlans();
?>
<main>
  <form action="s/createsub/" id="createSub" method="POST">
  <h2>Datos de pago</h2>
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
        <label for="month"><?=$wp->findUiWord(45)?></label>
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
    <small><?=$wp->findUiWord(15)?></small>
    <h2>Información personal</h2>
    <div class="flex">
      <span>
        <label for="userName">Nombre</label>
        <input type="text" id="userName" name="userName" />
      </span>
      <span>
        <label for="lastname">Apellidos</label>
        <input type="text" id="lastname" name="lastname" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="email">Correo electrónico</label>
        <input type="text" id="email" name="email" />
      </span>
      <span>
        <label for="city">Ciudad</label>
        <input type="text" id="city" name="city" />
      </span>
    </div>
    <div class="flex">
      
      <span>
        <label for="numdoc">Número de documento</label>
        <input type="text" id="numdoc" name="numdoc" />
      </span>
      <span>
        <label for="phone">Teléfono</label>
        <input type="text" id="phone" name="phone" />
      </span>
    </div>
    <div class="flex">
    <span>
        <label for="address">Dirección</label>
        <input type="text" id="address" name="address" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="type">Plan</label>
        <div class="c-select">
          <select name="plan" id="plan">
            <option value="0">Seleccione un plan</option>
            <? for ($i=0; $i < count($plans); $i++) { 
              if($plans[$i]->price != 0){
              ?>
              <option value="<?=$plans[$i]->id?>"><?=$plans[$i]->name?></option>
            <? }}?>
          </select>
          <div class="c-arrow"></div>
        </div>
      </span>
      <span>
        <label for="type">Periodicidad</label>
        <div class="c-select">
          <select name="type" id="type">
            <option value="0">Seleccione una periodicidad</option>
            <option value="Anual">Anual</option>
            <option value="Mensual">Mensual</option>
          </select>
          <div class="c-arrow"></div>
        </div>
      </span>
    </div>
    <button type="submit" class="uppercase">Crear suscripción</button>
  </form>
</main>
<? include 'includes/footer.php' ?>
