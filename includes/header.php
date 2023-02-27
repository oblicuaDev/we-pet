<header>
  <? if(isset($bodyClass) && $bodyClass != 'home'){ ?>
  <div class="container">
    <? } ?>
    <div class="flex">
      <a href="https://wepet.co/" target="_blank">
        <img src="img/logo.png" alt="logo" class="logo" />

      </a>
    </div>
    <div class="column">
      <h2><?=$wp->findUiWord(2)?></h2>
      <ul class="lang">
        <li>
          <img src="img/lang.svg" alt="lang">
          <ul>
            <li><a href="/mi-cuenta/es/">ESP</a></li>
            <li><a href="/mi-cuenta/en-US/">EN</a></li>
          </ul>
        </li>
      </ul>
      <?if($_SESSION["user"] && $_SESSION["user"] != ""){?>
      <ul class=" logout">
        <li>
          <?=substr($_SESSION["user"]->name, 0, 1); ?>
          <?=substr($_SESSION["user"]->lastname, 0, 1); ?>
          <ul>
            <li><a href="s/logout/" class="uppercase"><?=$wp->findUiWord(232)?></a></li>
          </ul>
        </li>
      </ul>
        <?}?>
      </div>
    <? if(isset($bodyClass) && $bodyClass != 'home'){ ?>
  </div>
  <? } ?>
</header>