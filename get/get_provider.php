<?php 
    include '../includes/config.php';
    $provider = $wp->get_provider($_GET['provider_id']);
    echo json_encode($provider);
?>