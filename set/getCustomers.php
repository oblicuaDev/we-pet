<?php
    include '../includes/config.php';
    $jsondata = $epayco->customer->getList();
    $allCustomers = array();
    $custom = array();
    foreach ($jsondata->data as $customer) {
        $singleCustomer = $epayco->customer->get($customer->id_customer);
        if(count($singleCustomer->data->cards) > 0){
            $sing = array(
                "franchise" => $singleCustomer->data->cards[0]->franchise,
                "mask" => $singleCustomer->data->cards[0]->mask,
                "customer_id" => $singleCustomer->data->id_customer
            );
            array_push($allCustomers, $sing);
            array_push($custom, $singleCustomer);
        }
    }
    file_put_contents('simple_customers.txt', print_r($allCustomers, true));
    file_put_contents('single_customers.txt', print_r($custom, true));
    