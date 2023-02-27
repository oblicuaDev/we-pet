<?php 
    include '../includes/config.php';
    extract($_POST);
    $resp = array();
    if($type == 'vaccines'){
        $vaccine = json_decode($_POST["vaccinesArray"]); 
        array_push($vaccine,json_decode('{"card": "'.$procard.'","date_application": "'.$init_date.'","next_application": "'.$init_date.'","fullname": "'.$veterinario.'","lote": "'.$lote.'","vaccine": '.$vacu.',"veterinarian": "'.$veterinario.'","reminder": false,"due_date": "'.$init_date.'"}')); 
        $edit = $wp->create_v_d($pet_id, json_decode('{"vaccines": '.$vaccine.'}')); 
        $resp['vaccine'] = $vaccine;
    }else{
         if($dewormings){
            $deworming = json_decode($dewormings);
        }else{
            $deworming = array();

        }
           $resp['vaccine'] = $vaccine;
        array_push($deworming,json_decode('{"date_application":"'.$init_date.'""lote":"'.$lote.'""next_application":"'.$next_application.'""dewormer":"'.$desp.'"}')); 
        $resp['deworming'] = $deworming;
        $edit = $wp->create_v_d($pet_id, json_decode('{"dewormings ": '.$deworming.'}')); 
    }
    $resp['edit'] = $edit;
    $resp['editdewormings'] = $edit->dewormings;
    $resp['editVaccines'] = $edit->vaccines;

echo json_encode($resp);