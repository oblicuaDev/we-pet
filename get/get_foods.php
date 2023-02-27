<?php 
    include '../includes/config.php';
    $foods = $wp->get_foods();
    echo json_encode($foods);
?>