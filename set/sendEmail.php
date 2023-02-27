<?php
include '../includes/config.php';
 $sended = $wp->campaignMonitorEmail($_GET['email'],"¡Tu cupón está listo!", "cf7b7713-069b-47b8-b4ae-aefd416d1b09", $_GET['mergeTags']);
 echo json_encode($sended);