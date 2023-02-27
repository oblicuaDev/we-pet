<?php 
    include '../includes/config.php';
    $array = [];
    extract($_POST);
    $month = trim($month);
    $monthE = str_replace(' ', '', explode( ' / ', $month)[0]);
    $yearE = str_replace(' ', '', '20'.explode( ' / ', $month)[1]);
    $token = $epayco->token->create(array(
        "card[number]" => str_replace(' ', '', $card_number),
        "card[exp_year]" => $yearE,
        "card[exp_month]" => $monthE,
        "card[cvc]" => $secure_code
    ));
    if($token->status){
        $user = $wp->user_create_first('{
            "pay_data":{
                "token": "'.$token->id.'",
                "mask": "'.$token->card->mask.'",
                "titular": "'.$name.'"
            },
            "plan": "'.$planID.'"
        }');
        $_SESSION["token"] = $token;
        $array['message'] = 1;
        $array['info'] = $user;
        $array['token'] = $token;
        $array['type'] = $planType;
    }else{
        $array["yearE"] = trim($yearE);
        $array["monthE"] = $monthE;
        $_SESSION["token"] = $token;
        $array['message'] = 1;
        $array['info'] = $user;
        $array['token'] = $token;
        $array['type'] = $planType;
        $array['message'] = 0;
    }
    echo json_encode($array);
