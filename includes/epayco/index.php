<?php
    include '../config.php';

    //1. Crear token
    $token = $epayco->token->create(array(
        "card[number]" => '373118856457642',
        "card[exp_year]" => "2025",
        "card[exp_month]" => "12",
        "card[cvc]" => "123"
    ));
    echo "<br><br>Token tarjeta <br>";
    print_r($token);

    // Crear cliente
    $customer = $epayco->customer->create(array(
        "token_card" => $token->id,
        "name" => "Nestor",
        "last_name" => "Goyes", //This parameter is optional
        "email" => "fff@gmail.com",
        "default" => true,
        //Optional parameters: These parameters are important when validating the credit card transaction
        "city" => "Bogota",
        "address" => "Cr 4 # 55 36",
        "phone" => "3192274281",
        "cell_phone"=> "3192274281",
    ));
    echo "<br>Customer <br>";
    print_r($customer);


    //3. Create Plan
//     $plan = $epayco->plan->create(array(
//         "id_plan" => "wepet-33-month", //month o year
//         "name" => "Plan Pruebas",
//         "description" => "Plan Pruebas",
//         "amount" => 10000,
//         "currency" => "cop",
//         "interval" => "day",
//         "interval_count" => 1,
//         "trial_days" => 0
//    ));
//    echo "<br><br>Plan <br>";
//    print_r($plan);
   //Remover Plan $plan = $epayco->plan->remove("wepet-33-month");

   //4. Crear suscripción del cliente a un plan
   $sub = $epayco->subscriptions->create(array(
    "id_plan" => "wepet-33-month",
    "customer" => $customer->data->customerId,
    "token_card" =>  $token->id,
    "doc_type" => "CC",
    "doc_number" => "1020751420",
    "url_confirmation" => "https://wepet.co/mi-cuenta/s/payNotification/",
    /*
     //Optional parameter: if these parameter it's not send, system get ePayco dashboard's url_confirmation
     "method_confirmation" => "POST"
     */
  ));
  echo "<br><br>Suscripción <br>";
  //$sub->id  debe guardarse en el usuario de Strapi
  print_r($sub);

  //5. Hacer el primer cobro del plan
  $sub = $epayco->subscriptions->charge(array(
    "id_plan" => "wepet-33-month",
    "customer" => $customer->data->customerId,
    "token_card" =>  $token->id,
    "doc_type" => "CC",
    "doc_number" => "1020751420",
    "address" => "cr 44 55 66",
    "phone"=> "2550102",
    "cell_phone"=> "3192274281",
    "ip" => $_SERVER['REMOTE_ADDR']  // This is the client's IP, it is required
  ));
  echo "<br><br>Cobro <br>";
  print_r($sub);

  $transaction = $wp->transaction_create('{
    "reference": "'.$sub->data->ref_payco.'",
    "status":"'.$sub->data->estado.'",
    "amount":'.$sub->data->valor.'
}');
echo "<br><br>Transacción<br>";
print_r($transaction);
echo "<br><br>reference<br>";
print_r($sub->data->ref_payco);
echo "<br><br>status<br>";
print_r($sub->data->estado);
echo "<br><br>amount<br>";
print_r($sub->data->valor);
?>