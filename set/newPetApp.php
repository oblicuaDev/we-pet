<?php 
    include '../includes/config.php';
    $userLogin = $wp->get_user($_GET['userID']);
    $_SESSION["user"] =$userLogin;
    header('Location: https://wepet.co/mi-cuenta/es/nueva-mascota');
