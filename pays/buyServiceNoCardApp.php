<?php
include '../includes/config.php';
extract($_POST);
$array = [];
$uniqid = uniqid();
$monthE = explode( '/', $month)[0];
$yearE = '20'.explode( '/', $month)[1];
$array['month'] = $month;
$token = $epayco->token->create(array(
    "card[number]" => str_replace(' ', '', $card_number),
    "card[exp_year]" => trim($yearE),
    "card[exp_month]" => $monthE,
    "card[cvc]" => $secure_code
));
if($token->status){
    $customer = $epayco->customer->create(array(
        "token_card" => $token->id,
        "name" => $name,
        "last_name" => $lastname, //This parameter is optional
        "email" => $email,
        "default" => true,
        //Optional parameters: These parameters are important when validating the credit card transaction
        "city" => $city,
        "address" => $address,
        "phone" => $phone,
        "cell_phone"=> $phone
    ));
    if($customer->status){
        $user = $wp->user_edit($id,'{
            "pay_data":{
                "token": "'.$token->id.'",
                "mask": "'.$token->card->mask.'",
                "titular": "'.$name.'"
            },
            "customer_id": "'.$customer->data->customerId.'"
        }');
        $pay = $epayco->charge->create(array(
            "token_card" => $token->id,
            "customer_id" => $customer->data->customerId,
            "doc_type" => "CC",
            "doc_number" => $doc_num,
            "name" => $name,
            "last_name" => $lastname,
            "email" => $email,
            "bill" => "WP-" . $uniqid,
            "description" => "Pago Servicio Extra -> " . $service,
            "value" => $value,
            "tax" => "0",
            "tax_base" => "0",
            "currency" => "COP",
            "dues" => "12",
            "address" => $address,
            "phone"=> $phone,
            "cell_phone"=> $phone,
            "ip" => $_SERVER['REMOTE_ADDR'],
            "url_confirmation" => "https://wepet.co/mi-cuenta/s/payNotificationService/",
            "use_default_card_customer" => true/*if the user wants to be charged with the card that the customer currently has as default = true*/
        ));
       
        if($pay->data->estado == 'Aceptada'){
            $bill = $wp->createBill('{
                "estado":"'.$pay->data->estado.'",
                "factura":"'.$pay->data->factura.'",
                "recibo":"'.$pay->data->recibo.'",
                "ref_payco":"'.$pay->data->ref_payco.'",
                "respuesta":"'.$pay->data->respuesta.'",
                "valor":"'.$pay->data->valor.'"
            }');
            $array['bill'] = $bill;
            $array['pay'] = $pay;
            $array['message'] = 1;
        }else if($pay->data->estado == 'Pendiente'){
            $bill = $wp->createBill('{
                "estado":"'.$pay->data->estado.'",
                "factura":"'.$pay->data->factura.'",
                "recibo":"'.$pay->data->recibo.'",
                "ref_payco":"'.$pay->data->ref_payco.'",
                "respuesta":"'.$pay->data->respuesta.'",
                "valor":"'.$pay->data->valor.'"
            }');
            $array['bill'] = $bill;
            $array['pay'] = $pay;
            $array['message'] = 2;
        }else{
            $bill = $wp->createBill('{
                "estado":"'.$pay->data->estado.'",
                "factura":"'.$pay->data->factura.'",
                "recibo":"'.$pay->data->recibo.'",
                "ref_payco":"'.$pay->data->ref_payco.'",
                "respuesta":"'.$pay->data->respuesta.'",
                "valor":"'.$pay->data->valor.'"
            }');
            $array['bill'] = $bill;
            $array['message'] = 3;
        }
}else if($customer->message == "Cliente ya asociado ó token inexistente"){
        echo 'Cliente ya asociado ó token inexistente';
    }else{
        $array['message'] = 0;
    }
}else{
    $array['message'] = 0;
}

$array['token'] = $token;
$array['customer'] = $customer;
$array['user'] = $user;
$_SESSION["user"] = $user;

echo json_encode($array);