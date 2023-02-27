<?php 
    include '../includes/config.php';
    extract($_POST);
    if(isset($_POST['checkbox_name']) && $_POST['checkbox_name']!=""){
    $sterilizedValue = "true";
    }else{
        $sterilizedValue = "false";
    }
    $pet = $wp->edit_pet($pet_id, '{
        "name": "'.$name.'",
        "type": "'.$especie.'",
        "size": "'.$size.'",
        "age": "'.$age.'",
        "breed": "'.$razaInput.'",
        "gender": "'.$gender.'",
        "hair_size": "'.$hair_size.'",
        "hair_color": "'.$hair_color.'",
        "food": "'.$food.'",
        "allergies": "'.$allergies.'",
        "record": "'.$record.'",
        "sterilized": "'.$sterilizedValue.'"
    }');
    echo json_encode($pet);
