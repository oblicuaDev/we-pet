<?php
    include '../includes/config.php';
    $array = [];
    extract($_POST);
    $uniqid = uniqid();
    $user = $wp->user_edit($userID, '{
        "doc_num":"'.$doc_num.'"
    }');
    $pay = $epayco->charge->create(array(
        "token_card" => $token,
        "customer_id" => $customer_id,
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
        "ip" => $_SERVER['REMOTE_ADDR'],  // This is the client's IP, it is required
        // "url_response" => "https://tudominio.com/respuesta.php",
        "url_confirmation" => "https://wepet.co/mi-cuenta/s/payNotificationService/",
        "use_default_card_customer" => true/*if the user wants to be charged with the card that the customer currently has as default = true*/
    ));
    $bill = $wp->createBill('{
        "estado":"'.$pay->data->estado.'",
        "factura":"'.$pay->data->factura.'",
        "recibo":"'.$pay->data->recibo.'",
        "ref_payco":"'.$pay->data->ref_payco.'",
        "respuesta":"'.$pay->data->respuesta.'",
        "valor":"'.$pay->data->valor.'"

    }');
    $array['billData'] = '{
        "estado":"'.$pay->data->estado.'"
        "factura":"'.$pay->data->factura.'"
        "recibo":"'.$pay->data->recibo.'"
        "ref_payco":"'.$pay->data->ref_payco.'"
        "respuesta":"'.$pay->data->respuesta.'"
        "valor":"'.$pay->data->valor.'"

    }';
    $array['bill'] = $bill;
    $array['pay'] = $pay;
    echo json_encode($array);