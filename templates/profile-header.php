<?php $pets = $wp->get_user_pets($_SESSION["user"]->id); ?>
<section class="profile-header">
    <div class="profile-header__left">
    <div class="profile-header__left-info">
    <span class="welcome">Bienvenido</span>
    <h1 class="uppercase"><?=$_SESSION["user"]->name?></h1>
    <h1 class="uppercase"><?=$_SESSION["user"]->lastname?>  <a href="/mi-cuenta/<?= $lang ?>/perfil" class="profile-header__left-edit"
        ><img src="img/edit.svg" alt="edit"
    /></a></h1>
        <? if(isset($home)){ ?>
            <a href="javascript:;" id="startTour">
            <small
                ><img src="img/help.svg" alt="help" /> <?=$wp->findUiWord(25)?></small
            >
            </a>
        <? } ?>
    </div>
   
    </div>
    <div class="profile-header__right">
    <ul class="profile-header__right-pets"> 
        <?php for ($i=0; $i < count($pets->pets); $i++) { 
            ?>
            <li class="<?= $_SESSION["activePet"]->id == $pets->pets[$i]->id ? 'active' : '' ?>">
            <a href="/mi-cuenta/<?= $lang ?>/?activePet=<?=$pets->pets[$i]->id?>" class="wait">
                <img
                src="<?=  $pets->pets[$i]->image[0]->url ?>"
                alt="pet1"
                />
                <span class="name uppercase"><?= $pets->pets[$i]->name ?></span>
            </a>
            </li>
        <?php } ?>
        <li class="addPet">
        <a href="/mi-cuenta/<?= $lang ?>/nueva-mascota" class="wait">
            <img src="img/add.svg" alt="pet1" />
        </a>
        </li>
    </ul>
    </div>
</section>
<hr />