<?php 
include '../includes/config.php';
if(isset($_GET['id']) && isset($_GET['service'])){
$pet = $wp->get_single_pet($_GET["id"]);
?>
<script>
    let petActiveService = json_encode($pet->services_rel);
    let activeService = <?=$_GET['service']?> 
    function query(url, body = "", method = "GET", callback) {
        const domain = "https://agile-sands-59528.herokuapp.com/";
        var finalUrl = `${domain}${url}`;
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        if (method == "GET") {
            var requestOptions = {
            method: method,
            headers: myHeaders,
            };
            fetch(finalUrl, requestOptions)
            .then(function (response) {
                return response.json();
            })
            .then((text) => {
                console.log(text);
                return callback(text);
            })
            .catch(function (error) {
                console.log(error);
            });
        } else {
            var raw = JSON.stringify(body);
            var requestOptions = {
            method: method,
            headers: myHeaders,
            body: raw,
            redirect: "follow",
            };
            fetch(finalUrl, requestOptions)
            .then(function (response) {
                return response.json();
            })
            .then((text) => {
                console.log(text);
                return callback(text);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
        }
    function addSingle() {
        objIndex = petActiveService.findIndex((obj) => obj.service.id == activeService);
        petActiveService[objIndex].quantity = petActiveService[objIndex].quantity + 1;
        var raw = { services_rel: petActiveService };
        query(`pets/${petId}`, raw, "PUT", (resp) => {console.log(resp);});
    }
    console.log('Script desde php');
</script>
<?php 
}
?>