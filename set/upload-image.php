<?php

$imageService = $_FILES['imageService'];

$url = 'https://agile-sands-59528.herokuapp.com/upload';

$chServices = curl_init();

curl_setopt_array($chServices, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => array(
    'files' => new CURLfile($imageService['tmp_name'], $imageService['type'], $imageService['name']),
    'ref' => 'services', // the content type where you want to associate the file
    'refId' => $service->id, // the id of the content where you want to associate the file
    'field' => 'image', // the name of the field where you want to store the file
  ),
));

$responseServices = curl_exec($chServices);

curl_close($chServices);

$resultServices = json_decode($responseServices, true);

$imageProfile = $_FILES['profile_image'];

$url = 'https://agile-sands-59528.herokuapp.com/upload';

$chProfile = curl_init();

curl_setopt_array($chProfile, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => array(
    'files' => new CURLfile($imageProfile['tmp_name'], $imageProfile['type'], $imageProfile['name']),
    'ref' => 'services', // the content type where you want to associate the file
    'refId' => $service->id, // the id of the content where you want to associate the file
    'field' => 'image', // the name of the field where you want to store the file
  ),
));

$responseProfile = curl_exec($chProfile);

curl_close($chProfile);

$resultServices = json_decode($responseProfile, true);