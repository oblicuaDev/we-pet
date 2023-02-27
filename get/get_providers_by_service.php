<?php 
    include '../includes/config.php';
    $provider = $wp->get_providers_by_service($_GET['service']);
    echo json_encode($provider);
?>