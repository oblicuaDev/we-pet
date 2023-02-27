<?php 
 include '../includes/config.php';
  $array = [];
  extract($_POST);
  $month = trim($month);
  $monthE = explode( '/', $month)[0];
  $yearE = '20'.explode( '/', $month)[1];
  $token = $epayco->token->create(array(
    "card[number]" => str_replace(' ', '', $card_number),
    "card[exp_year]" => trim($yearE),
    "card[exp_month]" => $monthE,
    "card[cvc]" => $secure_code
  ));
  if($token->status){
    $user = $wp->user_edit($userID, '{
        "pay_data":{
            "user_cc": "'.$name.'",
            "card_number": "'.str_replace(' ', '', $card_number).'",
            "secure_code": "'.$secure_code.'",
            "date": "'.$month.'/'.$year.'",
            "token": "'.$token->id.'",
            "mask": "'.$token->card->mask.'",
            "titular": "'.$name.'"
          }
      }');
      $array['message'] = 1;
      $array['info'] = $user;
      $array['token'] = $token;
  }else{
      $array['message'] = 0;
  }
  echo json_encode($array);
?>