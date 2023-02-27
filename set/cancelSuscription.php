<?php
  include '../includes/config.php';
  $sub = $epayco->subscriptions->cancel($_GET["id_subscription"]);
  echo json_encode($sub);