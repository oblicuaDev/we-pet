<?php
error_reporting(E_ALL ^ E_NOTICE);
include '../includes/config.php';
/*En esta página se reciben las variables enviadas desde ePayco hacia el servidor.
Antes de realizar cualquier movimiento en base de datos se deben comprobar algunos valores
Es muy importante comprobar la firma enviada desde ePayco
Ingresar  el valor de p_cust_id_cliente lo encuentras en la configuración de tu cuenta ePayco
Ingresar  el valor de p_key lo encuentras en la configuración de tu cuenta ePayco
*/
$p_cust_id_cliente = '89608';
$p_key             = '100ddf894e8c0041eb8c328483f6d623778c8902';

   $x_ref_payco      = $_REQUEST['x_ref_payco'];
   $x_transaction_id = $_REQUEST['x_transaction_id'];
   $x_amount         = $_REQUEST['x_amount'];
   $x_currency_code  = $_REQUEST['x_currency_code'];
   $x_signature      = $_REQUEST['x_signature'];
   
   $signature = hash('sha256', $p_cust_id_cliente . '^' . $p_key . '^' . $x_ref_payco . '^' . $x_transaction_id . '^' . $x_amount . '^' . $x_currency_code);
   // obtener invoice y valor en el sistema del comercio
   $numOrder = $x_ref_payco ; // Este valor es un ejemplo se debe reemplazar con el número de orden que tiene registrado en su sistema
   $x_response     = $_REQUEST['x_response'];
   $x_motivo       = $_REQUEST['x_response_reason_text'];
   $x_id_invoice   = $_REQUEST['x_id_invoice'];
   $x_autorizacion = $_REQUEST['x_approval_code'];
   $x_extra1 = $_REQUEST['x_extra1'];
   $x_cod_response = $_REQUEST['x_cod_response'];
   if(strlen($x_extra1) > 0){
      $transaction = $wp->get_transaction($_REQUEST['x_ref_payco']);
      if(count($transaction) > 0){
         error_log($transaction[0]->wepetuser->email, true);
         // Es un pago por primera vez
         switch ((int) $x_cod_response) {
            case 1:
               if(isset($offer)){
                  $wp->campaignMonitorEmail($transaction[0]->wepetuser->email,"Pago Aprobado", "af699301-bb2e-434c-9f54-3520a214d624", '{"link":"wepet.co/mi-cuenta/s/pagoAprobado/?type='.$transaction[0]->wepetuser->plan_type.'&userID='.$transaction[0]->wepetuser->id.'&offer='.$offer.'"}');
               }else{
                  $wp->campaignMonitorEmail($transaction[0]->wepetuser->email,"Pago Aprobado", "af699301-bb2e-434c-9f54-3520a214d624", '{"link":"wepet.co/mi-cuenta/s/pagoAprobado/?type='.$transaction[0]->wepetuser->plan_type.'&userID='.$transaction[0]->wepetuser->id.'"}');
               }
               $transactionEdited = $wp->edit_transaction($transaction[0]->id,'{"status":"Aprobada"}');
               break;
            case 3:
               $transactionEdited = $wp->edit_transaction($transaction[0]->id,'{"status":"Pendiente"}');
               break;
            default:
            if(isset($offer)){
               $wp->campaignMonitorEmail($transaction[0]->wepetuser->email,"Pago Rechazado", "1de4af38-bd7a-4f55-9977-eaee7884ee8e", '{"link":"wepet.co/mi-cuenta/s/pagoCambiar/?userID='.$transaction[0]->wepetuser->id.'&offer='.$offer.'"}');
            }else{
               $wp->campaignMonitorEmail($transaction[0]->wepetuser->email,"Pago Rechazado", "1de4af38-bd7a-4f55-9977-eaee7884ee8e", '{"link":"wepet.co/mi-cuenta/s/pagoCambiar/?userID='.$transaction[0]->wepetuser->id.'"}');
            }
               $transactionEdited = $wp->edit_transaction($transaction[0]->id,'{"status":"Rechazada"}');
               break;
         }
      }else{
         // No es un pago por primera vez
         $petFound = $wp->get_single_pet_by_subID($x_extra1);
         if(count($petFound) > 0){
            if($petFound[0]->plan_type == 'Anual'){
               $end = date('Y-m-d', strtotime('+1 years')); 
            }else{
               $end = date('Y-m-d', strtotime('+1 month')); 
            }
            switch ((int) $x_cod_response) {
               case 1:
               // APROBADO
               $pet = $wp->edit_pet($petFound[0]->id, '{"sub_end":"'.$end.'"}');
               // CREAR CORREO DE RENOVACION DE SUSCRIPCION
               break;
               case 3:
               // PENDIENTE
               break;
               default:
                  // RECHAZADO
                  // CREAR CORREO DE RECHAZO DE SUSCRIPCION
               break;
            }
         }else{
            switch ((int) $x_cod_response) {
               case 1:
               // APROBADO
               // CREAR CORREO DE RENOVACION DE SUSCRIPCION
               $wp->campaignMonitorEmail($transaction[0]->wepetuser->email,"Retoma la inscripción de tu mascota", "af699301-bb2e-434c-9f54-3520a214d624", '{"link":"wepet.co/mi-cuenta/s/pagoCambiar/?userID='.$transaction[0]->wepetuser->id.'&offer='.$offer.'"}');
               break;
               case 3:
               // PENDIENTE
               break;
               default:
                  // RECHAZADO
                  $wp->campaignMonitorEmail($transaction[0]->wepetuser->email,"Retoma la inscripcion de tu mascota en plan gratuito", "f5a6d61b-12d0-4ca6-87b0-c885954d893a", '{"link":"wepet.co/mi-cuenta/s/pagoCambiar/?userID='.$transaction[0]->wepetuser->id.'&offer='.$offer.'"}');
                  // CREAR CORREO DE RECHAZO DE SUSCRIPCION
               break;
            }
         }
      }
   }


   // PENDIENTE -> RECHAZADO
   // PENDIENTE -> APROBADO
