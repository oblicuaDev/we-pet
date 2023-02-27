<?php
include '../includes/config.php';
$token = $wp->user_recover_password($_GET['recover_email']);
echo json_encode($token);