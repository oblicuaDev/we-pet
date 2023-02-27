<?php
include '../includes/config.php';
extract($_POST);
$token = $wp->user_recover_password($recover_email);
echo json_encode($token);