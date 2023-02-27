<?php
include '../includes/config.php';
extract($_POST);
$changePass = $wp->changepass($token, $password);
echo json_encode($changePass);