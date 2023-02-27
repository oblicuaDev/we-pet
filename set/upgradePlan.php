<?php 
    include '../includes/config.php';
    $userLogin = $wp->get_user($_GET['userID']);
    $activePet = $wp->setActivePetId($_GET['petID']);
    $_SESSION["user"] =$userLogin;
    if(isset($_GET['nosub'])){
        header('Location: https://wepet.co/mi-cuenta/es/mejorar-plan?nosub=1');
    }else{
        header('Location: https://wepet.co/mi-cuenta/es/mejorar-plan');
    }
