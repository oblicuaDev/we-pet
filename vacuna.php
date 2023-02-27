<?php 
  $bodyClass="vacuna";
  include 'includes/head.php';
  if($_SESSION["user"] == ""){
    header('Location: /mi-cuenta/iniciar-sesion');
  }  
  if($_GET['type'] == 'vaccines'){
    $vaccines = $wp->vaccines;
  }else{
    $dewormers = $wp->dewormers;
  } 
?>
<main>
  <div class="container">
  <?php include 'templates/profile-header.php' ?>
  </div>
  <div class="vacuna">
    <form action="s/create_v_d/" class="vacuna__content" id="vacuna" method="POST">
      <?php if($_GET['type'] == 'vaccines'){ ?>
        <h2>Agregando vacuna para <span> <?=$_SESSION["activePet"]->name?></span></h2>
        <span>
          <label for="vac">Vacuna</label>
          <div class="c-select">
                <select name="vacu" id="vacu">
                  <option value="0">Selecciona una vacuna</option>
                  <? for ($i=0; $i < count($vaccines); $i++) { 
                  ?>
                    <option value="<?=$vaccines[$i]->id?>"><?=$vaccines[$i]->name?></option>
                  <? } ?>
                 
                </select>
                <div class="c-arrow"></div>
              </div>
        </span>
        <span>
          <label for="init_date">Fecha de aplicación</label>
          <input type="date" name="init_date" id="init_date" />
        </span>
        <span>
          <label for="lote">Lote</label>
          <input type="text" name="lote" id="lote" />
        </span>
        <span>
          <label for="veterinario">Nombres y apellidos del veterinario</label>
          <input type="text" name="veterinario" id="veterinario" />
        </span>
        <span>
          <label for="procard">Tarjeta Profesional</label>
          <input type="text" name="procard" id="procard" />
        </span>
  
        <input type="hidden" name="type" id="type" value="<?=$_GET['type']?>" />
        <input type="hidden" name="pet_id" id="pet_id" value="<?=$_SESSION["activePet"]->id?>" />
        <button type="submit"><?=$wp->findUiWord(47)?></button>
        <?php }else{ ?>
          <h2>Agregando desparasitación para <span> <?=$_SESSION["activePet"]->name?></span></h2>
          <span>
            <label for="desp">Desparasitantes</label>
            <div class="c-select">
                  <select name="desp" id="desp">
                    <option value="0">Selecciona un desparasitante</option>
                    <? for ($i=0; $i < count($dewormers); $i++) { 
                    ?>
                      <option value="<?=$dewormers[$i]->id?>"><?=$dewormers[$i]->name?></option>
                    <? } ?>
                   
                  </select>
                  <div class="c-arrow"></div>
                </div>
          </span>
          <span>
            <label for="init_date">Fecha de aplicación</label>
            <input type="date" name="init_date" id="init_date" />
          </span>
          <span>
            <label for="lote">Lote</label>
            <input type="text" name="lote" id="lote" />
          </span>
          <span>
            <label for="next_application">Fecha nueva desparasitación</label>
            <input type="date" name="next_application" id="next_application" />
          </span>

    
          <input type="hidden" name="type" id="type" value="<?=$_GET['type']?>" />
          <input type="hidden" name="pet_id" id="pet_id" value="<?=$_SESSION["activePet"]->id?>" />
          <button type="submit"><?=$wp->findUiWord(317)?></button>
      <?php } ?>
    </form>
  </div>
</main>
<? include 'includes/footer.php' ?>