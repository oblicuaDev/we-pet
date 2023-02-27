<?php
    include '../includes/config.php';
    extract($_POST);
    $userLogin = $wp->createReview($provider,$service,$comment,$wepetuser,$rank);
    echo json_encode($userLogin);