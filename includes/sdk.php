<?php
class wepet {
    public $domain = "https://agile-sands-59528.herokuapp.com";
    public $user = array();
    public $language = "es";
    public $ui_words = array();
    function __construct($language, $development = false){
        $this->language = $language;
        $this->ui_words = $this->getWordsUI();
        $this->vaccines = $this->getVacunas();
        $this->dewormers = $this->getDesparasitantes();
    }
    function egoiEmail($email,$subject="Welcome to the Club", $template, $mergeTags){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'slingshot.egoiapp.com/api/v2/email/messages/action/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'[
        {
        "domain": "transactional.wepet.co",
        "senderId": "7",
        "senderName": "We Pet",
        "to": [
        "'.$email.'"
        ],
        "subject": "'.$subject.'",
        "templateId": '.$template.',
        "openTracking": true,
        "clickTracking": true,
        "advancedTemplatingData": '.$mergeTags.',
        "priority": "non-urgent",
        "registered": false,
        "header": {
        "listUnsubscribe": true,
        "optInIpAddress": "https://wepet.co"
        }
        }
        ]',
          CURLOPT_HTTPHEADER => array(
            'ApiKey: fefb6c9187d0aea56b84080f9866005af21185ae',
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
    }
    function campaignMonitorEmail($email,$subject="Welcome to the Club", $template, $mergeTags){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.createsend.com/api/v3.2/transactional/smartemail/'.$template.'/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "To": ["'.$email.'"],
            "Data":'.$mergeTags.',
            "ConsentToTrack": "yes"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic MnZha2dIa1Q2QkpMd0hUejRFREdPVjV4dGI5Qlg2MVl4blQ3S2FUbStqbUhRRTR5anNRT0hFTm9PMXV0U283RTZIbW1vRHpUT1dBaG5DOVkzZHQ0SFRsclB2T2ZMSSt4SlZ0OXNScG4zL0NRQi84U1hnWGc1bmt0ZzY4TEJSbHd5ZE5kTksvZktLMm1qTVhnenkvZUNRPT06'
        ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    function createCodes($numeric, $discount, $desc, $productId){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://wepet.co/wp-json/wc/v3/coupons',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
            'code' => $numeric,
            'amount' => $discount,
            'discount_type' => 'percent',
            'description' => $desc,
            'individual_use' => 'true',
            'product_ids' => $productId,
            'usage_limit' => '1',
            'usage_limit_per_user' => '1'
        ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic Y2tfZDliN2U3NDY4YTdiYjY5NmNjZmU2ZGY5ZmJlNGI1OGQzMjZlYTIxNzpjc19hN2M1ZGI5ZWUyODMyNmE3NDk0ODMyNTI0MDc4NGRjZjQ4ODBkNTM4'
          ),
        ));
        
        $response = curl_exec($curl);
        $this->editCodes($response->id);
        curl_close($curl);
        return $response;
    }
    function editCodes($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://wepet.co/wp-json/wc/v3/coupons'.$id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'PUT',
          CURLOPT_POSTFIELDS => array(
            'meta_data' => array(array(key=>'coupon_commissions_type',value=>"default" ))
        ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic Y2tfZDliN2U3NDY4YTdiYjY5NmNjZmU2ZGY5ZmJlNGI1OGQzMjZlYTIxNzpjc19hN2M1ZGI5ZWUyODMyNmE3NDk0ODMyNTI0MDc4NGRjZjQ4ODBkNTM4'
          ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    function query($url, $body = "", $method="GET", $translate = false) {
        // Variable en false para contenido
        if($translate){
            $endpoint = $this->domain . "/" . $url . '?_locale=' . $this->language;
        }else{
            $endpoint = $this->domain . "/" . $url;
        }
        //echo $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $output = curl_exec($ch);
        $response = json_decode($output);
        curl_close($ch);
        return $response;
    }
    // GNRL FUNCTIONS
    function setActivePet($pet = ''){
        if($pet == ''){
            $_SESSION["activePet"] = $_SESSION["user"]->pets[0];
        }else{
            $_SESSION["activePet"] = $pet;
        }
    }
    function setActivePetId($id){
        $pet = $this->get_single_pet($id);
        $this->setActivePet($pet);
    }
    function upload_image($img){
        $result = $this->query("upload", array('files'=> new CURLFILE($img)));
        return $result;
    }
    function get_codes($plan){
        $result = $this->query("codes?plan=".$plan);
        return $result;
    }
    function get_news(){
        $result = $this->query("informations",'','GET',true);
        return $result;
    }
    function get_foods(){
        $result = $this->query("foods");
        return $result;
    }
    // AUTH FUNCTIONS
    function user_login($email, $password){
        $result = $this->query("wepetusers/login", '{"email":"'.$email.'","password": "'.$password.'"}', 'POST');
        $_SESSION["user"] = $result->response;
        $this->user = $result->response;
        if($result->response->pets){
            $this->setActivePetId($result->response->pets[0]->id);
        }
        return $result;
    }
    function user_soporte($email){
        $result = $this->query("wepetusers?_email=" . $email);
        $_SESSION["user"] = $result[0];
        $this->user = $result->response;
        if($result->response->pets){
            $this->setActivePetId($result[0]->pets[0]->id);
        }
        return $result[0];
    }
    
    function user_recover_password($email){
        $result = $this->query("tokens/".$email, '', 'POST');
        $this->egoiEmail($email,"Restablecer contraseña", "1", '{"link":"wepet.co/mi-cuenta/nueva-contraseña?token='.$result->token->token.'"}');
        return $result;
    }
   
    function changepass($token, $password){
        $result = $this->query("wepetusers/change-password/".$token, '{"password": "'.$password.'"}', 'POST');
        return $result;
    }
    // CREATE TRANSACTIONS
    function transaction_create($data){
        $result = $this->query("transactions",$data,'POST');
        return $result;
    }
    function get_transaction($ref){
        $result = $this->query("transactions?_reference=".$ref);
        return $result;
    }
    function edit_transaction($id, $data){
        $result = $this->query("transactions/".$id, $data, 'PUT');
        return $result;
    }
    // BILL FUNCTION
    function createBill($data){
        $result = $this->query("bills",$data,'POST');
        return $result;
    }
    // USER FUNCTIONS
    function user_create($userData){
        $result = $this->query("wepetusers",$userData,'POST');
        return $result;
    }
    function user_create_first($userData){
        $result = $this->query("wepetusers/firstRegister",$userData,'POST');
        return $result;
    }
    function user_edit($user_id, $data){
        $result = $this->query("wepetusers/".$user_id,  $data, 'PUT');
        return $result;
    }
    function get_user($user_id){
        $result = $this->query("wepetusers/".$user_id);
        return $result;
    }
    function get_user_pets($user_id){
        $result = $this->query("wepetusers/pets/".$user_id);
        return $result;
    }
    // PETS FUNCTIONS
    function create_pet($data){
        $result = $this->query("pets", $data, 'POST');
        return $result;
    }
    function edit_pet($pet_id, $data){
        $result = $this->query("pets/".$pet_id, $data, 'PUT');
        return $result;
    }
    function delete_pet($pet_id){
        $result = $this->query("pets/".$pet_id, '', 'DELETE');
        return $result;
    }
    function get_single_pet($pet_id){
        $result = $this->query("pets/".$pet_id);
        return $result;
    }
    function get_single_pet_by_subID($subId){
        $result = $this->query("pets?_id_sub=".$subId);
        return $result;
    }
    function create_v_d($pet_id, $data){
       
        $ch = curl_init();

        curl_setopt_array($ch, array(
        CURLOPT_URL => 'https://agile-sands-59528.herokuapp.com/pets/'.$pet_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>$data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $output = curl_exec($ch);
        $response = json_decode($output);
        curl_close($ch);
        return $response;
    }
    function edit_v_d($pet_id, $data){
        $result = $this->query("pets/".$pet_id, $data, 'PUT');
        return $result;
    }
    // SERVICES FUNCTIONS
    function getService(){
        $result = $this->query("services",'','GET',true);
        return $result;
    }
    function getSingleService($id){
        if($this->language != 'es'){
            $result = $this->query("services/".$id,'', "GET");
            foreach ( $result->localizations as $localization ) {
                if($localization->locale == $this->language){
                    $result = $this->query("services/".$localization->id,'', "GET");
                } 
            }
        }else{
            $result = $this->query("services/". $id,'','GET',true);
        }
        return $result;
    }
    function getPlans(){
        $result = $this->query("plans",'','GET',true);
        return $result;
    }
    function getSinglePlan($id){
        $result = $this->query("plans/".$id,'','GET',true);
        return $result;
    }
    function edit_plan($id, $data){
        $result = $this->query("plans/".$id, $data, 'PUT');
        return $result;
    }
    function getNamePlan($id){
        $result = $this->query("plans/".$id,'','GET',true);
        return $result->name;
    }
    function service_planquantity($plan_id){
        $result = $this->query("services/planquantity/".$plan_id);
        return $result;
    }
    // PROVIDERS FUNCTIONS
    function get_providers_by_service($service){
        $result = $this->query("providers?services=".$service,'','GET',true);
        return $result;
    }
    function get_provider($provider_id){
        $result = $this->query("providers/".$provider_id,'','GET',true);
        return $result;
    }
    function testCronJob(){
        $result = $this->query("codes",'{"code": "testCronJob"}', "POST");
        return $result;
    }
    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    function delete_all_between($string, $beginning, $end) {
        $beginningPos = strpos($string, $beginning);
        $endPos = strpos($string, $end);
        if ($beginningPos === false || $endPos === false) {
          return $string;
        }
        $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
        return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string)); // recursion to ensure all occurrences are replaced
      }
    function get_alias($String){
        $String = html_entity_decode($String); // Traduce codificación

        $String = str_replace("¡", "", $String); //Signo de exclamación abierta.&iexcl;
        $String = str_replace("'", "", $String); //Signo de exclamación abierta.&iexcl;
        $String = str_replace("!", "", $String); //Signo de exclamación cerrada.&iexcl;
        $String = str_replace("¢", "-", $String); //Signo de centavo.&cent;
        $String = str_replace("£", "-", $String); //Signo de libra esterlina.&pound;
        $String = str_replace("¤", "-", $String); //Signo monetario.&curren;
        $String = str_replace("¥", "-", $String); //Signo del yen.&yen;
        $String = str_replace("¦", "-", $String); //Barra vertical partida.&brvbar;
        $String = str_replace("§", "-", $String); //Signo de sección.&sect;
        $String = str_replace("¨", "-", $String); //Diéresis.&uml;
        $String = str_replace("©", "-", $String); //Signo de derecho de copia.&copy;
        $String = str_replace("ª", "-", $String); //Indicador ordinal femenino.&ordf;
        $String = str_replace("«", "-", $String); //Signo de comillas francesas de apertura.&laquo;
        $String = str_replace("¬", "-", $String); //Signo de negación.&not;
        $String = str_replace("", "-", $String); //Guión separador de sílabas.&shy;
        $String = str_replace("®", "-", $String); //Signo de marca registrada.&reg;
        $String = str_replace("¯", "&-", $String); //Macrón.&macr;
        $String = str_replace("°", "-", $String); //Signo de grado.&deg;
        $String = str_replace("±", "-", $String); //Signo de más-menos.&plusmn;
        $String = str_replace("²", "-", $String); //Superíndice dos.&sup2;
        $String = str_replace("³", "-", $String); //Superíndice tres.&sup3;
        $String = str_replace("´", "-", $String); //Acento agudo.&acute;
        $String = str_replace("µ", "-", $String); //Signo de micro.&micro;
        $String = str_replace("¶", "-", $String); //Signo de calderón.&para;
        $String = str_replace("·", "-", $String); //Punto centrado.&middot;
        $String = str_replace("¸", "-", $String); //Cedilla.&cedil;
        $String = str_replace("¹", "-", $String); //Superíndice 1.&sup1;
        $String = str_replace("º", "-", $String); //Indicador ordinal masculino.&ordm;
        $String = str_replace("»", "-", $String); //Signo de comillas francesas de cierre.&raquo;
        $String = str_replace("¼", "-", $String); //Fracción vulgar de un cuarto.&frac14;
        $String = str_replace("½", "-", $String); //Fracción vulgar de un medio.&frac12;
        $String = str_replace("¾", "-", $String); //Fracción vulgar de tres cuartos.&frac34;
        $String = str_replace("¿", "-", $String); //Signo de interrogación abierta.&iquest;
        $String = str_replace("×", "-", $String); //Signo de multiplicación.&times;
        $String = str_replace("÷", "-", $String); //Signo de división.&divide;
        $String = str_replace("À", "a", $String); //A mayúscula con acento grave.&Agrave;
        $String = str_replace("Á", "a", $String); //A mayúscula con acento agudo.&Aacute;
        $String = str_replace("Â", "a", $String); //A mayúscula con circunflejo.&Acirc;
        $String = str_replace("Ã", "a", $String); //A mayúscula con tilde.&Atilde;
        $String = str_replace("Ä", "a", $String); //A mayúscula con diéresis.&Auml;
        $String = str_replace("Å", "a", $String); //A mayúscula con círculo encima.&Aring;
        $String = str_replace("Æ", "a", $String); //AE mayúscula.&AElig;
        $String = str_replace("Ç", "c", $String); //C mayúscula con cedilla.&Ccedil;
        $String = str_replace("È", "e", $String); //E mayúscula con acento grave.&Egrave;
        $String = str_replace("É", "e", $String); //E mayúscula con acento agudo.&Eacute;
        $String = str_replace("Ê", "e", $String); //E mayúscula con circunflejo.&Ecirc;
        $String = str_replace("Ë", "e", $String); //E mayúscula con diéresis.&Euml;
        $String = str_replace("Ì", "i", $String); //I mayúscula con acento grave.&Igrave;
        $String = str_replace("Í", "i", $String); //I mayúscula con acento agudo.&Iacute;
        $String = str_replace("Î", "i", $String); //I mayúscula con circunflejo.&Icirc;
        $String = str_replace("Ï", "i", $String); //I mayúscula con diéresis.&Iuml;
        $String = str_replace("Ð", "d", $String); //ETH mayúscula.&ETH;
        $String = str_replace("Ñ", "n", $String); //N mayúscula con tilde.&Ntilde;
        $String = str_replace("Ò", "o", $String); //O mayúscula con acento grave.&Ograve;
        $String = str_replace("Ó", "o", $String); //O mayúscula con acento agudo.&Oacute;
        $String = str_replace("Ô", "o", $String); //O mayúscula con circunflejo.&Ocirc;
        $String = str_replace("Õ", "o", $String); //O mayúscula con tilde.&Otilde;
        $String = str_replace("Ö", "o", $String); //O mayúscula con diéresis.&Ouml;
        $String = str_replace("Ø", "o", $String); //O mayúscula con barra inclinada.&Oslash;
        $String = str_replace("Ù", "u", $String); //U mayúscula con acento grave.&Ugrave;
        $String = str_replace("Ú", "u", $String); //U mayúscula con acento agudo.&Uacute;
        $String = str_replace("Û", "u", $String); //U mayúscula con circunflejo.&Ucirc;
        $String = str_replace("Ü", "u", $String); //U mayúscula con diéresis.&Uuml;
        $String = str_replace("Ý", "y", $String); //Y mayúscula con acento agudo.&Yacute;
        $String = str_replace("Þ", "b", $String); //Thorn mayúscula.&THORN;
        $String = str_replace("ß", "b", $String); //S aguda alemana.&szlig;
        $String = str_replace("à", "a", $String); //a minúscula con acento grave.&agrave;
        $String = str_replace("á", "a", $String); //a minúscula con acento agudo.&aacute;
        $String = str_replace("â", "a", $String); //a minúscula con circunflejo.&acirc;
        $String = str_replace("ã", "a", $String); //a minúscula con tilde.&atilde;
        $String = str_replace("ä", "a", $String); //a minúscula con diéresis.&auml;
        $String = str_replace("å", "a", $String); //a minúscula con círculo encima.&aring;
        $String = str_replace("æ", "a", $String); //ae minúscula.&aelig;
        $String = str_replace("ç", "a", $String); //c minúscula con cedilla.&ccedil;
        $String = str_replace("è", "e", $String); //e minúscula con acento grave.&egrave;
        $String = str_replace("é", "e", $String); //e minúscula con acento agudo.&eacute;
        $String = str_replace("ê", "e", $String); //e minúscula con circunflejo.&ecirc;
        $String = str_replace("ë", "e", $String); //e minúscula con diéresis.&euml;
        $String = str_replace("ì", "i", $String); //i minúscula con acento grave.&igrave;
        $String = str_replace("í", "i", $String); //i minúscula con acento agudo.&iacute;
        $String = str_replace("î", "i", $String); //i minúscula con circunflejo.&icirc;
        $String = str_replace("ï", "i", $String); //i minúscula con diéresis.&iuml;
        $String = str_replace("ð", "i", $String); //eth minúscula.&eth;
        $String = str_replace("ñ", "n", $String); //n minúscula con tilde.&ntilde;
        $String = str_replace("ò", "o", $String); //o minúscula con acento grave.&ograve;
        $String = str_replace("ó", "o", $String); //o minúscula con acento agudo.&oacute;
        $String = str_replace("ô", "o", $String); //o minúscula con circunflejo.&ocirc;
        $String = str_replace("õ", "o", $String); //o minúscula con tilde.&otilde;
        $String = str_replace("ö", "o", $String); //o minúscula con diéresis.&ouml;
        $String = str_replace("ø", "o", $String); //o minúscula con barra inclinada.&oslash;
        $String = str_replace("ù", "o", $String); //u minúscula con acento grave.&ugrave;
        $String = str_replace("ú", "u", $String); //u minúscula con acento agudo.&uacute;
        $String = str_replace("û", "u", $String); //u minúscula con circunflejo.&ucirc;
        $String = str_replace("ü", "u", $String); //u minúscula con diéresis.&uuml;
        $String = str_replace("ý", "y", $String); //y minúscula con acento agudo.&yacute;
        $String = str_replace("þ", "b", $String); //thorn minúscula.&thorn;
        $String = str_replace("ÿ", "y", $String); //y minúscula con diéresis.&yuml;
        $String = str_replace("Œ", "d", $String); //OE Mayúscula.&OElig;
        $String = str_replace("œ", "-", $String); //oe minúscula.&oelig;
        $String = str_replace("Ÿ", "-", $String); //Y mayúscula con diéresis.&Yuml;
        $String = str_replace("ˆ", "", $String); //Acento circunflejo.&circ;
        $String = str_replace("˜", "", $String); //Tilde.&tilde;
        $String = str_replace("%", "", $String); //Guiún corto.&ndash;
        $String = str_replace("-", "", $String); //Guiún corto.&ndash;
        $String = str_replace("–", "", $String); //Guiún corto.&ndash;
        $String = str_replace("—", "", $String); //Guiún largo.&mdash;
        $String = str_replace("'", "", $String); //Comilla simple izquierda.&lsquo;
        $String = str_replace("'", "", $String); //Comilla simple derecha.&rsquo;
        $String = str_replace("‚", "", $String); //Comilla simple inferior.&sbquo;
        $String = str_replace("\"", "", $String); //Comillas doble derecha.&rdquo;
        $String = str_replace("\"", "", $String); //Comillas doble inferior.&bdquo;
        $String = str_replace("†", "-", $String); //Daga.&dagger;
        $String = str_replace("‡", "-", $String); //Daga doble.&Dagger;
        $String = str_replace("…", "-", $String); //Elipsis horizontal.&hellip;
        $String = str_replace("‰", "-", $String); //Signo de por mil.&permil;
        $String = str_replace("‹", "-", $String); //Signo izquierdo de una cita.&lsaquo;
        $String = str_replace("›", "-", $String); //Signo derecho de una cita.&rsaquo;
        $String = str_replace("€", "-", $String); //Euro.&euro;
        $String = str_replace("™", "-", $String); //Marca registrada.&trade;
        $String = str_replace(":", "-", $String); //Marca registrada.&trade;
        $String = str_replace(" & ", "-", $String); //Marca registrada.&trade;
        $String = str_replace("(", "-", $String);
        $String = str_replace(")", "-", $String);
        $String = str_replace("?", "-", $String);
        $String = str_replace("¿", "-", $String);
        $String = str_replace(",", "-", $String);
        $String = str_replace(";", "-", $String);
        $String = str_replace("�", "-", $String);
        $String = str_replace("/", "-", $String);
        $String = str_replace(" ", "-", $String); //Espacios
        $String = str_replace(".", "", $String); //Punto
        $String = str_replace("&", "-", $String);

        //Mayusculas
        $String = strtolower($String);

        return ($String);
    }
    function getWordsUI(){
        if (isset($_SESSION['ui_words'][$this->language])) {
            $gnrl = $_SESSION['ui_words'][$this->language];
        } else {
            $result = $this->query("ui-words",'', "GET",true);
            $gnrl = $result;
            $_SESSION['ui_words'][$this->language] = $gnrl;
        }
        return $gnrl;
    }
    function findUiWord($id){
        if($this->language != 'es'){
            $result = $this->query("ui-words/".$id,'', "GET");
            foreach ( $result->localizations as $localization ) {
                if($localization->locale == $this->language){
                    $result = $this->query("ui-words/".$localization->id,'', "GET");
                } 
            }
        }else{
            $result = $this->query("ui-words/".$id,'', "GET");
        }
        return $result->Name;
    }
    function createReview($provider,$service,$comment,$wepetuser,$rank){
        $result = $this->query("reviews", '{"provider":"'.$provider.'","service": "'.$service.'","comment":"'.$comment.'","wepetuser":"'.$wepetuser.'","rank":'.$rank.'}', 'POST');
        return $result;
    }
    function getReviewsByProvider($id){
        $result = $this->query("reviews/provider/".$id,'', "GET");
        return $result;
    }
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'año',
            'm' => 'mes',
            'w' => 'semana',
            'd' => 'día',
            'h' => 'hora',
            'i' => 'minutos',
            's' => 'segundo',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? 'Hace ' . implode(', ', $string)  : 'justo ahora';
    }
    function getCities(){
        $result = $this->query("cities",'', "GET");
        return $result;
    }
    function getDepartments(){
        $result = $this->query("departments",'', "GET");
        return $result;
    }
    function getVacunas(){
         if (isset($_SESSION['vaccines'])) {
            $result = $_SESSION['vaccines'];
        } else {
            $result = $this->query("vaccines",'', "GET");
            $_SESSION['vaccines'] =  $result;
        }
        return $result;
    }
    function getDesparasitantes(){
        if (isset($_SESSION['dewormers'])) {
            $result = $_SESSION['dewormers'];
        } else {
            $result = $this->query("dewormers",'', "GET");
            $_SESSION['dewormers'] =  $result;
        }
        return $result;
    }

    function editRegisterEgoi($user_id){
        $user = $this->get_user($user_id);
        return $user;
    }
    function getAgeGroup($specie,$months)
    {
        $group = 0;
        if($specie == "Gato" || $specie == "gato")
        {
            if($months<7)
            {
                $group = 1;//cachorro
            }
            if($months>6 && $months<25)
            {
                $group = 2;//joven
            }
            if($months>24 && $months<72)
            {
                $group = 3;//adulto
            }
            if($months>72 && $months<121)
            {
                $group = 4;//maduro
            }
            if($months>120 && $months<169)
            {
                $group = 5; //senior
            }
            if($months>169)
            {
                $group = 6; //anciano
            }
        }else
        {
            if($months<13)
            {
                $group = 1;//cachorro
            }
            if($months>12 && $months<85)
            {
                $group = 3;//adulto
            }
            if($months>84)
            {
                $group = 5; //senior
            }
            
        }
        return $group;
    }
    function outdatedPets($days)
    {
        
    }
    function sendReminders($date = "")
    {
        if($date == ""){ $date = date("Y-m-d"); }
        $qstr = "reminders/?_fecha=".$date;
        //echo $this->query($qstr);
        $itemsToSend = $this->query($qstr);
        
        for($i=0;$i<count($itemsToSend);$i++)
        {
            
            $to = $itemsToSend[$i]->wepetuser->email;
            switch(strtolower($itemsToSend[$i]->type))
            {
                case "vacuna":
                    $action = "vacunar";
                    break;
                case "bano":
                    $action = "bañar";
                        break;
                case "desparasitacion":
                    $action = "desaparasitar";
                        break;
                
            }
            $petname = $itemsToSend[$i]->pet->name;
            $link = "https://wepet.co/mi-cuenta";
            $message = $itemsToSend[$i]->message;
            $mergeTags = '{
                "wpaction": "'.$action.'",
                "petname": "'.$petname.'",
                "type": "'.$itemsToSend[$i]->type.'",
                "wpmsg": "'.$message.'",
                "link": "'.$link.'"
            }';
            $this->campaignMonitorEmail($to,"Recordatorio", "dee46205-a182-4146-b16c-70bd7e16e275", $mergeTags);
        }
    }
}