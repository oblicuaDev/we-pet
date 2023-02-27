<?php
    include '../includes/config.php';
    extract($_POST);
    $array = [];
    $array['type'] = "Anual";
    $planSelected = $wp->getSinglePlan(8);
    $uniqid = uniqid();
    if($plan_type == 'Anual' ){
        $end = date('Y-m-d', strtotime('+1 years')); 
    }else{
        $end = date('Y-m-d', strtotime('+1 month')); 
    }
    $services = $wp->service_planquantity($planSelected->id);
    $dateOfBirth = $e_date;
    $pet = $wp->edit_pet($petID, '{
        "plan": "8",
        "plan_type":"Anual",
        "services_rel": '.json_encode($services).'
    }');
    echo json_encode($pet);