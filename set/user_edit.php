<?php
    include '../includes/config.php';
    extract($_POST);
    $array = [];
$user = $wp->user_edit($userID, '{
    "name": "'.$name.'",
    "lastname": "'.$lastname.'",
    "email": "'.$email.'",
    "address": "'.$address.'",
    "city": "'.$city.'",
    "departamento": "'.$departamento.'",
    "birthday": "'.$birthday.'",
    "doc_type": "'.$typedoc.'",
    "doc_num": "'.$numdoc.'",
    "phone": "'.$phone.'"
}');
$_SESSION["user"] = $user;
$array['resp'] = $user; 
echo json_encode($array);