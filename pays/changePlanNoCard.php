<?php 
    include '../includes/config.php';
    extract($_POST);
    $array = [];
    $uniqid = uniqid();
    $monthE = str_replace(' ', '', explode( ' / ', $month)[0]);
    $yearE = str_replace(' ', '', '20'.explode( ' / ', $month)[1]);
    $planSelected = $wp->getSinglePlan($planID);
    $token = $epayco->token->create(array(
        "card[number]" => str_replace(' ', '', $card_number),
        "card[exp_year]" => trim($yearE),
        "card[exp_month]" => $monthE,
        "card[cvc]" => $secure_code
    ));
    if($planType == 'Anual'){
        $finalPrice = $planSelected->price * $planSelected->annual_discount / 100;
        $finalPrice = $planSelected->price - $finalPrice; 
        $finalPrice = $finalPrice * 12; 
    }else{
        $finalPrice = $planSelected->price; 
    }
    if($token->status){
        $customer = $epayco->customer->create(array(
            "token_card" => $token->id,
            "name" => $_SESSION['user']->name,
            "last_name" => $_SESSION['user']->lastname, //This parameter is optional
            "email" => $_SESSION['user']->email,
            "default" => true,
            //Optional parameters: These parameters are important when validating the credit card transaction
            "city" => $_SESSION['user']->city,
            "address" => $_SESSION['user']->address,
            "phone" => $_SESSION['user']->phone,
            "cell_phone"=> $_SESSION['user']->phone
        ));
        if($customer->status){
            $planEpay = $epayco->plan->create(array(
                "id_plan" => "w-".$planID."-".strtolower($planType)."-".$uniqid,
                "name" => $planSelected->name." ".strtolower($planType),
                "description" => $planSelected->name." ".strtolower($planType),
                "amount" => $finalPrice,
                "currency" => "cop",
                "interval" => $planType == 'Anual' ? 'year' : 'month',
                "interval_count" => 1,
                "trial_days" => 0
            ));
            if( $planEpay->status){
                $subCreate =  $epayco->subscriptions->create(array(
                    "id_plan" => "w-".$planID."-".strtolower($planType)."-".$uniqid,
                    "customer" => $customer->data->customerId,
                    "token_card" =>  $token->id,
                    "doc_type" => "CC",
                    "doc_number" => $_SESSION["user"]->doc_num,
                    "url_confirmation" => "https://wepet.co/mi-cuenta/s/payNotification/"
                ));
                $array['subCreate'] = $subCreate;
                if($subCreate->status){
                    $subCharge =  $epayco->subscriptions->charge(array(
                        "id_plan" => "w-".$planID."-".strtolower($planType)."-".$uniqid,
                        "customer" => $customer->data->customerId,
                        "token_card" =>  $token->id,
                        "doc_type" => "CC",
                        "doc_number" => $_SESSION["user"]->doc_num,
                        "address" => $_SESSION["user"]->address,
                        "phone"=> $_SESSION["user"]->phone,
                        "cell_phone"=> $_SESSION["user"]->phone,
                        "ip" => $_SERVER['REMOTE_ADDR']  // This is the client's IP, it is required
                    ));

                    $array['subCharge'] = $subCharge;
                    if($subCharge){
                        
                        if($subCharge->data->estado == 'Pendiente'){
                            $array['message'] = 2;
                            $user = $wp->user_edit($_SESSION["user"]->id, '{
                                "plan_type":"'.$planType.'",
                                "id_sub":"'.$subCreate->id.'",
                                "plan": '.$planID.'
                            }');
                            $array['resp'] = $user;
                            $_SESSION["user"] = $user;
                        }else if($subCharge->data->estado == 'Fallida' || $subCharge->data->estado == 'Rechazada'){
                            $array['message'] = 3;
                        }else{
                            $user = $wp->user_edit($_SESSION["user"]->id, '{
                                "plan_type":"'.$planType.'",
                                "id_sub":"'.$subCreate->id.'",
                                "plan": '.$planID.'
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
                        
                        $user = $wp->user_edit($_SESSION["user"]->id,'{
                            "pay_data":{
                                "token": "'.$token->id.'"
                            },
                            "customer_id": "'.$customer->data->customerId.'",
                            "plan": "'.$planID.'"
                        }');
                    }
                }else{
                    $array['message'] = 0;
                }
            }else{
                $array['message'] = 0;
            }
        }else if($customer->message == "Cliente ya asociado ó token inexistente"){
            echo 'Cliente ya asociado ó token inexistente';
            $array['message'] = 0;
        }else{
            $array['message'] = 0;
        }
    }else{
        $array['message'] = 0;
        $array['$yearE'] =trim($yearE);
        $array['$monthE'] =$monthE;
    }

    $array['token'] = $token;
    $array['customer'] = $customer;
    $array['type'] = $planType;
    $array['planEpay'] = $planEpay;
   

    echo json_encode($array);