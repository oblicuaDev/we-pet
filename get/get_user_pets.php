<?php 
    include '../includes/config.php';
    $userPets = $wp->get_user_pets($_GET['user_id']);
    echo json_encode($userPets);
?>