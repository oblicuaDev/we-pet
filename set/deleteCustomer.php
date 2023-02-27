<?php
    include '../includes/config.php';
    $customer = $epayco->customer->delete(array("franchise" => "mastercard","mask" => "530691******8740","customer_id" => "18adac3ce24c607bc126394"));
    echo '<br>';
    print_r($customer);
    echo '<br>';