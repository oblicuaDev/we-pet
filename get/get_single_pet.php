<?php 
    include '../includes/config.php';
    $pet = $wp->get_single_pet($_GET['pet_id']);
    echo json_encode($pet);
?>