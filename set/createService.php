<?php 
include '../includes/config.php';
extract($_POST);
define('API_BASE_URL', 'https://agile-sands-59528.herokuapp.com');
function make_curl_request($url, $method, $data = null) {
    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => $data ? json_encode($data) : null,
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}

if (isset($providerselect)) {
    if ($providerselect == "new") {
        $dataProvidernew = array();
        // Primer ejemplo
        $dataProvidernew['name'] = $name_pro;
        $dataProvidernew['subtitle'] = $subtitle;
        $dataProvidernew['barrio'] = $barrio;
        $dataProvidernew['localidad'] = $localidad;
        $dataProvidernew['email'] = $email;
        $dataProvidernew['phone'] = $phone;
        $dataProvidernew['link'] = $link;
        $dataProvidernew['description'] = $desc;
        $dataProvidernew['schedule'] = $schedule;
        $dataProvidernew['places'] = isset($places) ? $places : null;
        $urlProvidernew = API_BASE_URL . '/providers/';
        $provider = make_curl_request($urlProvidernew, "POST", $dataProvidernew);
        echo '<br /><br /><br />';
    }else{
        $urlProvidernew = API_BASE_URL . '/providers/'.$providerselect;
        $provider = make_curl_request($urlProvidernew, "GET", null);
        $response_array = json_decode($provider);
        $new_service = array(
            "id" => 62,
            "service" => 59,
            "id_service" => "1234",
            "link_service" => "https://www.example.com/new-service/",
            "available_country" => true,
            "departments" => array("Cundinamarca"),
            "cities" => array("Bogotá")
        );
        echo '<br /><br /><br />';
    }
    $dataNewService = array();
    $plan_quantity = array(
        array(
            'plan' => 8,
            'quantity' => $free != "" ? $free : 0,
            'available' => true
        ),
        array(
            'plan' => 7,
            'quantity' => $basic != "" ? $basic : 0,
            'available' => true
        ),
        array(
            'plan' => 5,
            'quantity' => $complete != "" ? $complete : 0,
            'available' => true
        ),
        array(
            'plan' => 6,
            'quantity' => $medio != "" ? $medio : 0,
            'available' => true
        )
    );
    $provider = json_decode($provider);
    $providers = array($provider->id);
    $dataNewService['name'] = $name;
    $dataNewService['price'] = $price;
    $dataNewService['available_upgrade'] = $available_upgrade == "on" ? true : false;
    $dataNewService['discount'] = $discount;
    $dataNewService['prefix'] = $prefix;
    $dataNewService['short_name'] = $short_name;
    $dataNewService['plan_quantity'] = $plan_quantity;
    $dataNewService['description'] = $description;
    $dataNewService['providers'] = $providers;
    $urlCreateService = API_BASE_URL . '/services/';

    $service = make_curl_request($urlCreateService, "POST", $dataNewService);
    // 
    $provider_services = $provider->provider_services ?? []; // initialize as empty if null
    $service = json_decode($service);
    $new_service = array(
        "service" => $service->id,
        "id_service" => $serviceid,
        "link_service" => $linksercice,
        "available_country" => false,
        "departments" => array(),
        "cities" => array()
    );
    array_push($provider_services, $new_service);
    $dataPUTProvider['provider_services'] = $provider_services;
    // 
    $urlPUTProvider = API_BASE_URL . '/providers/'.$provider->id;
    $updatedProvider = make_curl_request($urlPUTProvider, "PUT", $dataPUTProvider);
}


?>