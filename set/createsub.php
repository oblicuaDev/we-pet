<?php 
    include '../includes/config.php';
    $array = [];
    extract($_POST);
    $array['type'] = $type;
    $planEpay;
    $planSelected = $wp->getSinglePlan($plan);
    $uniqid = uniqid();
    $monthE = str_replace(' ', '', explode( ' / ', $month)[0]);
    $yearE = str_replace(' ', '', '20'.explode( ' / ', $month)[1]);
    if($type == 'Anual'){
        $finalPrice = $planSelected->price * $planSelected->annual_discount / 100;
        $finalPrice = $planSelected->price - $finalPrice; 
        $finalPrice = $finalPrice * 12; 
    }else{
        $finalPrice = $planSelected->price; 
    }
    // CREAR TOKEN DE TARJETA DE CREDITO
    $token = $epayco->token->create(array(
        "card[number]" => str_replace(' ', '', $card_number),
        "card[exp_year]" => trim($yearE),
        "card[exp_month]" => $monthE,
        "card[cvc]" => $secure_code
    ));
    $array['token'] = $token;
    if($token->status){
        // CREAR UN CUSTOMER EN EPAYCO
        $customer = $epayco->customer->create(array(
            "token_card" => $token->id,
            "name" => $userName,
            "last_name" => $lastname, //This parameter is optional
            "email" => $email,
            "default" => true,
            //Optional parameters: These parameters are important when validating the credit card transaction
            "city" => $city,
            "address" => $address,
            "phone" => $phone,
            "cell_phone"=> $phone,
        ));
        if($customer->status){
            // CREAR PLAN EN EPAYCO
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
            // CREAR SUSCRIPCION EPAYCO A ESE PLAN CREADO
            $subCreate = $epayco->subscriptions->create(array(
                "id_plan" => "w-".$plan."-".strtolower($type)."-".$uniqid,
                "customer" => $customer->data->customerId,
                "token_card" =>  $token->id,
                "doc_type" => "CC",
                "doc_number" => $numdoc,
                "url_confirmation" => "https://wepet.co/mi-cuenta/s/payNotificationSub/"
            ));
            //5. Hacer el primer cobro del plan
            $subCharge = $epayco->subscriptions->charge(array(
                "id_plan" => "w-".$plan."-".strtolower($type)."-".$uniqid,
                "customer" => $customer->data->customerId,
                "token_card" =>  $token->id,
                "doc_type" => "CC",
                "doc_number" => $numdoc,
                "address" => $address,
                "phone"=> $phone,
                "cell_phone"=> $phone,
                "ip" => $_SERVER['REMOTE_ADDR']
            ));

            if($subCharge->data->estado == 'Pendiente'){
                $array['message'] = 2;
            }else if($subCharge->data->estado == 'Fallida' || $subCharge->data->estado == 'Rechazada'){
                $array['message'] = 3;
            }else{
                $array['message'] = 1;
            }
            $transaction = $wp->transaction_create('{
                "reference": "'.$subCharge->data->ref_payco.'",
                "wepetuser":"'.$userID.'",
                "status":"'.$subCharge->data->estado.'",
                "amount":'.$subCharge->data->valor.'
            }');
            $array['transaction'] =  $transaction;
        }else if($customer->message == "Cliente ya asociado ó token inexistente"){
            echo 'Cliente ya asociado ó token inexistente';
        }
        else{
            $array['message'] = 0;
        }
        $array['customer'] = $customer;
        $array['subCreate'] = $subCreate;
        $array['subCharge'] = $subCharge;
        $array['type'] = $type;
        $array['plan'] = $plan;
    }
    echo json_encode($array);
    ?>