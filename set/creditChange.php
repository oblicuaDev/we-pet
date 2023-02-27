<?php 
    include '../includes/config.php';
    $array = [];
    extract($_POST);
    $monthE = str_replace(' ', '', explode( ' / ', $month)[0]);
    $yearE = str_replace(' ', '', '20'.explode( ' / ', $month)[1]);
    $token = $epayco->token->create(array(
        "card[number]" => str_replace(' ', '', $card_number),
        "card[exp_year]" => trim($yearE),
        "card[exp_month]" => $monthE,
        "card[cvc]" => $secure_code
    ));
    $array['$token'] = $token;
    if($token->status){
        $user = $wp->user_edit($userID, '{
            "pay_data":{
                "token": "'.$token->id.'",
                "mask": "'.$token->card->mask.'",
                "titular": "'.$name.'"
            }
        }');
        $array['user'] = $user;
        $array['message'] = 1;
    }else{
        $array['message'] = 0;
    }
    echo json_encode($array);
