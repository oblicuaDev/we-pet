<?php
    include '../includes/config.php';
    extract($_POST);
    $array = [];
    $array['type'] = $type;
    $planSelected = $wp->getSinglePlan($plan);
    $uniqid = uniqid();
    if($type == 'Anual'){
        $finalPrice = $planSelected->price * $planSelected->annual_discount / 100;
        $finalPrice = $planSelected->price - $finalPrice; 
        $finalPrice = $finalPrice * 12; 
    }else{
        $finalPrice = $planSelected->price; 
    }
    $planEpay = $epayco->plan->create(array(
        "id_plan" => "w-".$plan."-".strtolower($type)."-".$uniqid,
        "name" => $planSelected->name." ".strtolower($type),
        "description" => $planSelected->name." ".strtolower($type),
        "amount" => $finalPrice,
        "currency" => "cop",
        "interval" => $type == 'Anual' ? 'year' : 'month',
        "interval_count" => 1,
        "trial_days" => 0
    ));
    $subCreate =  $epayco->subscriptions->create(array(
        "id_plan" => "w-".$plan."-".strtolower($type)."-".$uniqid,
        "customer" => $_SESSION["user"]->customer_id,
        "token_card" =>  $_SESSION["user"]->pay_data->token,
        "doc_type" => "CC",
        "doc_number" => $_SESSION["user"]->doc_num,
        "url_confirmation" => "https://wepet.co/mi-cuenta/s/payNotification/"
    ));
    //5. Hacer el primer cobro del plan
    $subCharge =  $epayco->subscriptions->charge(array(
        "id_plan" => "w-".$plan."-".strtolower($type)."-".$uniqid,
        "customer" => $_SESSION["user"]->customer_id,
        "token_card" =>  $_SESSION["user"]->pay_data->token,
        "doc_type" => "CC",
        "doc_number" => $_SESSION["user"]->doc_num,
        "address" => $_SESSION["user"]->address,
        "phone"=> $_SESSION["user"]->phone,
        "cell_phone"=> $_SESSION["user"]->phone,
        "ip" => $_SERVER['REMOTE_ADDR']  // This is the client's IP, it is required
    ));

    if($subCharge->data->estado == 'Pendiente'){
        $array['message'] = 2;
        $user = $wp->user_edit($_SESSION["user"]->id, '{
            "plan_type":"'.$type.'",
            "id_sub":"'.$subCreate->id.'",
            "plan": '.$plan.'
        }');
        $array['resp'] = $user;
        $_SESSION["user"] = $user;
    }else if($subCharge->data->estado == 'Fallida' || $subCharge->data->estado == 'Rechazada'){
        $array['message'] = 3;
    }else{
        $user = $wp->user_edit($_SESSION["user"]->id, '{
            "plan_type":"'.$type.'",
            "id_sub":"'.$subCreate->id.'",
            "plan": '.$plan.'
        }');
        $array['resp'] = $user;
        $_SESSION["user"] = $user;
        $array['message'] = 1;
    }
    $transaction = $wp->transaction_create('{
        "reference": "'.$subCharge->data->ref_payco.'",
        "wepetuser":"'.$_SESSION["user"]->id.'",
        "status":"'.$subCharge->data->estado.'",
        "amount":'.$subCharge->data->valor.'
    }');
    $array['transaction'] =  $transaction;
    $array['subCreate'] = $subCreate;
    $array['subCharge'] = $subCharge;
    $array['plan'] = $plan;
    $array['token'] = $_SESSION["user"]->pay_data->token;
    
    echo json_encode($array);