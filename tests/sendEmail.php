<?php
include '../includes/config.php';
$email = $wp->campaignMonitorEmail('dreinovcorp@gmail.com',"Pago Aprobado", "af699301-bb2e-434c-9f54-3520a214d624", '{"link":"wepet.co/mi-cuenta/s/pagoAprobado/?type=Anual&userID=407"}');
echo $email;