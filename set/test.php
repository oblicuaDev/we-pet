<?php 
$array = [];
$array['resp'] = 'Test php function'; 
$array['planID'] = $_GET['id']; 
echo json_encode($array);