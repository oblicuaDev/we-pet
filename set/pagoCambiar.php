<?php 
    include '../includes/config.php';
    $userLogin = $wp->get_user($_GET['userID']);
    $_SESSION["user"] =$userLogin;
    if(isset($_GET['offer'])){
        header('Location: /mi-cuenta/cambiar-medio-pago?offer='.$_GET['offer']);
    }else{
        header('Location: /mi-cuenta/cambiar-medio-pago');
   }