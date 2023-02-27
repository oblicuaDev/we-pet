<?php 
    session_start();
    include "sdk.php";
    require "epayco/vendor/autoload.php";
    $epayco = new Epayco\Epayco(array(
        "apiKey" => "2e02f0bf16a00d4c3b2a3376b6091ab2",
        "privateKey" => "600282ceffad2b25f4c292b425f475e8",
        "lenguage" => "ES",
        "test" => false
    ));
    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'es'; //Idiomas disponibles: es, en-US
    $wp = new wepet($lang);
?>