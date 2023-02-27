<?php 
    include '../includes/config.php';
    $codes = $wp->get_codes($_GET['planid']);
    echo json_encode($codes);
?>