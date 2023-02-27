<?php 
    include '../includes/config.php';
    extract($_POST);
    $array = [];
    $array['plan_type'] = $plan_type;
    if($plan_type == 'Anual' ){
        $end = date('Y-m-d', strtotime('+1 years')); 
    }else{
        $end = date('Y-m-d', strtotime('+1 month')); 
    }

    $services = $wp->service_planquantity($plan);
    $finalDate='';
    $dateOfBirth = $e_date;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    if($diff->y == 0){
        if($diff->m == 1){
            $finalDate = $diff->m . " mes.";
        }else{
            $finalDate = $diff->m . " meses.";
        }
    }else{
        $finalDate = $diff->y . " años.";
    }
    $petmonths = $diff->m + $diff->y*12;
    $agegroup = $wp->getAgeGroup($especie,$petmonths);
    $user = $wp->create_pet('{
        "name": "'.$name.'",
        "type": "'.$especie.'",
        "size": "Pequeño",
        "breed": "'.$razaInput.'",
        "gender": "'.$gender.'",
        "age":  "'. $finalDate .'",
        "hair_size": "'.$hair_size.'",
        "hair_color": "'.$hair_color.'",
        "sterilized": false,
        "food": "",
        "allergies": "",
        "record": "",
        "wepetuser": "'.$user_id.'",
        "plan": "'.$plan.'",
        "image":["'.$image.'"],
        "sub_end":"'.$end.'",
        "id_sub":"'.$id_sub.'",
        "plan_type":"'.$plan_type.'",
        "services_rel": '.json_encode($services).',
        "age_groups":'.$agegroup.'
    }');

    $wp->campaignMonitorEmail($user_email,"¡Estas registrado!", "b0fe3bce-267b-47db-b120-5991a9d0379b", '{
        "name":"'.$user_name.'",
        "lastname":"'.$user_lastname.'",
        "petname":"'.$name.'",
        "plan":"'.$plan_name.'",
        "link": "wepet.co/mi-cuenta/"
    }');
    $array['$planEpay'] = $planEpay; 
    $array['$sub'] = $sub; 
    $array['resp'] = $user; 
    echo json_encode($array);