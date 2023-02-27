<?php   
  
  $bodyClass="loginBody";
  include 'includes/head.php';
?>

<div class="pseForm">
  <form>
    <script
      src="https://checkout.epayco.co/checkout.js"
      class="epayco-button"
      data-epayco-key="2e02f0bf16a00d4c3b2a3376b6091ab2"
      data-epayco-amount="<?=$_GET["ServicePrice"]?>"
      data-epayco-name="<?=$_GET["ServiceName"]?>"
      data-epayco-description="<?=$_GET["ServiceName"]?>"
      data-epayco-currency="cop"
      data-epayco-country="co"
      data-epayco-test="true"
      data-epayco-external="false"
      data-epayco-response="https://ejemplo.com/respuesta.html"
      data-epayco-confirmation="https://ejemplo.com/confirmacion"
      data-epayco-methodconfirmation="get"
      data-epayco-email-billing="<?=$_GET["email"]?>"
      data-epayco-name-billing="<?=$_GET["name"]?>"
    ></script>
  </form>
</div>
<? include 'includes/footer.php' ?>