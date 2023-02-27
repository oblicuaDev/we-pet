<?php 
    include '../includes/config.php';
    extract($_POST);
    $resp = array();
    if($type == 'vaccines'){
        $vaccine = json_decode($_SESSION["activePet"]->vaccines); 
        array_push($vaccine,json_decode('{"card": "'.$procard.'","date_application": "'.$init_date.'","next_application": "'.$init_date.'","fullname": "'.$veterinario.'","lote": "'.$lote.'","vaccine": '.$vacu.',"veterinarian": "'.$veterinario.'","reminder": false,"due_date": "'.$init_date.'"}')); 
        $edit = $wp->create_v_d($pet_id, json_decode('{"vaccines": '.$vaccine.'}')); 
        $resp['vaccine'] = $vaccine;
    }else{
        if($_SESSION["activePet"]->dewormings){
            $deworming = json_decode($_SESSION["activePet"]->dewormings);
        }else{
            $deworming = array();

        }
           $resp['vaccine'] = $vaccine;
        array_push($deworming,json_decode('{"date_application":"'.$init_date.'""lote":"'.$lote.'""next_application":"'.$next_application.'""dewormer":"'.$desp.'"}')); 
        $resp['deworming'] = $deworming;
        $edit = $wp->create_v_d($pet_id, json_decode('{"dewormings ": '.$deworming.'}')); 
    }

  
 
  
    $resp['type'] = $type;
    $resp['edit'] = $edit;

echo json_encode($resp);