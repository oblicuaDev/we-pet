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
