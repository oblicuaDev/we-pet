<?php
include '../includes/config.php';
$pets = $wp->get_user_pets($_SESSION["user"]->id);
foreach ($pets as $pet) {
    if($pet->id == $_GET['pet']){
        $wp->setActivePet($pet);
    }
}