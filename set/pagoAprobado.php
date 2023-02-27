<?php 
    include '../includes/config.php';
    $userLogin = $wp->get_user($_GET['userID']);
    $_SESSION["user"] =$userLogin;
    header('Location: /mi-cuenta/agregar-mascota?type='.$_GET['type']);