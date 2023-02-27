<?php 
    include '../includes/config.php';
    extract($_POST);
    $array = [];
    $array['type'] = $type;
    $planSelected = $wp->getSinglePlan($plan);
    $planEpay;
    $user;
    $uniqid = uniqid();
    
    if($type == 'Anual'){
        $finalPrice = $planSelected->price * $planSelected->annual_discount / 100;
        $finalPrice = $planSelected->price - $finalPrice; 
        $finalPrice = $finalPrice * 12; 
    }else{
        $finalPrice = $planSelected->price; 
    }
    if(isset($offer)){
        $offerPrice = $finalPrice * $offer / 100; 
        $finalPrice = $finalPrice - $offerPrice;
    }
    if(!$userID){
        $user = $wp->user_create( '{
            "name": "'.$name.'",
            "lastname": "'.$lastname.'",
            "email": "'.$email.'",
            "password": "'.$password.'",
            "address": "'.$address.'",
            "city": "'.$city.'",
            "departamento":"'.$departamento.'",
            "birthday": "'.$birthday.'",
            "doc_type": "'.$typedoc.'",
            "doc_num": "'.$numdoc.'",
            "phone": "'.$phone.'",
            "plan": "'.$plan.'",
            "plan_type":"'.$type.'",
            "apple_user":"'.$apple_user.'",
            "facebook_user":"'.$facebook_user.'"

        }');
        if(isset($isLoggin)){ 
            // header('Location: https://wepet.co/mi-cuenta/s/userLoginFB/?userID='. $user->id.'&firstTime=1&type='.$type);
            $array['isLoggin'] = $isLoggin;
            }else{
                $wp->user_login($email, $password);
            }
        $array['resp'] = $user;
        $array['message'] = 1;
    }else{
        $customer = $epayco->customer->create(array(
            "token_card" => $_SESSION["token"]->id,
            "name" => $name,
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
            if(isset($offer)){
                $subCreate = $epayco->subscriptions->create(array(
                    "id_plan" => "w-".$plan."-".strtolower($type)."-".$uniqid,
                    "customer" => $customer->data->customerId,
                    "token_card" =>  $_SESSION["token"]->id,
                    "doc_type" => "CC",
                    "doc_number" => $numdoc,
                    "url_confirmation" => "https://wepet.co/mi-cuenta/s/payNotification/?offer=".$offer
                ));
            }else{

                $subCreate = $epayco->subscriptions->create(array(
                    "id_plan" => "w-".$plan."-".strtolower($type)."-".$uniqid,
                    "customer" => $customer->data->customerId,
                    "token_card" =>  $_SESSION["token"]->id,
                    "doc_type" => "CC",
                    "doc_number" => $numdoc,
                    "url_confirmation" => "https://wepet.co/mi-cuenta/s/payNotification/"
                ));
            }
            //5. Hacer el primer cobro del plan
            $subCharge = $epayco->subscriptions->charge(array(
                "id_plan" => "w-".$plan."-".strtolower($type)."-".$uniqid,
                "customer" => $customer->data->customerId,
                "token_card" =>  $_SESSION["token"]->id,
                "doc_type" => "CC",
                "doc_number" => $numdoc,
                "address" => $address,
                "phone"=> $phone,
                "cell_phone"=> $phone,
                "ip" => $_SERVER['REMOTE_ADDR']  // This is the client's IP, it is required
            ));

            if($subCharge->data->estado == 'Pendiente'){
                $array['message'] = 2;
                $user = $wp->user_edit($userID, '{
                    "name": "'.$name.'",
                    "lastname": "'.$lastname.'",
                    "email": "'.$email.'",
                    "password": "'.$password.'",
                    "address": "'.$address.'",
                    "departamento":"'.$departamento.'",
                    "city": "'.$city.'",
                    "birthday": "'.$birthday.'",
                    "doc_type": "'.$typedoc.'",
                    "doc_num": "'.$numdoc.'",
                    "phone": "'.$phone.'",
                    "plan": "'.$plan.'",
                    "customer_id": "'.$customer->data->customerId.'",
                    "plan_type":"'.$type.'",
                    "id_sub":"'.$subCreate->id.'"
                }');
                $wp->user_login($email, $password);
            }else if($subCharge->data->estado == 'Fallida' || $subCharge->data->estado == 'Rechazada'){
                $wp->campaignMonitorEmail($email,"Pago Rechazado", "f5a6d61b-12d0-4ca6-87b0-c885954d893a ", '{"link":"wepet.co/mi-cuenta/s/pagoCambiar/?userID='.$userID.'","amount":"'.$finalPrice.'", "details":"'.$planSelected->name.'"}');
                $user = $wp->user_edit($userID, '{
                    "name": "'.$name.'",
                    "lastname": "'.$lastname.'",
                    "email": "'.$email.'",
                    "password": "'.$password.'",
                    "address": "'.$address.'",
                    "city": "'.$city.'",
                    "birthday": "'.$birthday.'",
                    "doc_type": "'.$typedoc.'",
                    "doc_num": "'.$numdoc.'",
                    "phone": "'.$phone.'",
                    "plan": "'.$plan.'",
                    "departamento":"'.$departamento.'",
                    "customer_id": "'.$customer->data->customerId.'",
                    "plan_type":"'.$type.'",
                    "id_sub":"'.$subCreate->id.'"
                }');
                $array['resp'] = $user; 
                $array['message'] = 3;
            }else{
                $user = $wp->user_edit($userID, '{
                    "name": "'.$name.'",
                    "lastname": "'.$lastname.'",
                    "email": "'.$email.'",
                    "password": "'.$password.'",
                    "address": "'.$address.'",
                    "departamento":"'.$departamento.'",
                    "city": "'.$city.'",
                    "birthday": "'.$birthday.'",
                    "doc_type": "'.$typedoc.'",
                    "doc_num": "'.$numdoc.'",
                    "phone": "'.$phone.'",
                    "plan": "'.$plan.'",
                    "customer_id": "'.$customer->data->customerId.'",
                    "plan_type":"'.$type.'",
                    "id_sub":"'.$subCreate->id.'",
                    "apple_user":"'.$apple_user.'",
                    "facebook_user":"'.$facebook_user.'"
                }');
                $wp->user_login($email, $password);
                $array['resp'] = $user; 
                $wp->campaignMonitorEmail($email,"Pago Aprobado", "493e6018-c0cc-40fb-b56c-73919a16591", '{"link":"wepet.co/mi-cuenta/s/pagoAprobado/?type='.$type.'&userID='.$userID.'","amount":"'.$finalPrice.'", "details":"'.$planSelected->name.'"}');
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
        $array['plan'] = $plan;
        $array['token'] = $_SESSION["token"];
        $array['data'] = array(
            'token' => $_SESSION["token"]->id,
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'city' => $city,
            'address' => $address,
            'phone' => $phone,
            'apple_user' => $apple_user,
        );
        $array['resp'] = $user;
    }
 
    echo json_encode($array);
