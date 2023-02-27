<?php   
  $bodyClass="reviewBody";
  $noHeader = true;
  $noFooter = true;
  include 'includes/head.php';

  $provider = $wp->get_provider($_GET["provider"]);
  $service = $wp->getSingleService($_GET["service"]);
?>
<main>
    <form action="s/user_review/" id="createReview" method="POST">
        <div class="container">
            <h2>Califica tu experiencia</h2>
            <p>Califica de 1 a 5 y deja un comentario sobre el servicio de <strong><?=$provider->name?></strong> recibido por <strong><?=$service->name?></strong> esto nos ayudará a mejorar la experiencia de We Pet.</p>
            <div class="provider_info">
                <div class="basic_info">
                    <img
                        src="<?=$provider->profile_image->url?>"
                        alt="<?=$provider->profile_image->url?>"
                        class="profile_image"
                    />
                    <div class="right">
                        <h2>María José Lizcano </h2>
                        <div class="flex rank">
                            <input type="radio" name="rank" class="rating__control screen-reader" id="rc1" value="1" onchange="viewcomment()">
                            <input type="radio" name="rank" class="rating__control screen-reader" id="rc2" value="2" onchange="viewcomment()">
                            <input type="radio" name="rank" class="rating__control screen-reader" id="rc3" value="3" onchange="viewcomment()">
                            <input type="radio" name="rank" class="rating__control screen-reader" id="rc4" value="4" onchange="viewcomment()">
                            <input type="radio" name="rank" class="rating__control screen-reader" id="rc5" value="5" onchange="viewcomment()">
                            <label for="rc1" class="rating__item">
                                <img src="img/fill_huella.svg" class="active" alt="huella" />
                                <img src="img/huella.svg" alt="huella" class="inactive" />
                            </label>
                            <label for="rc2" class="rating__item">
                                <img src="img/fill_huella.svg" class="active" alt="huella" />
                                <img src="img/huella.svg" alt="huella" class="inactive" />
                            </label>
                            <label for="rc3" class="rating__item">
                                <img src="img/fill_huella.svg" class="active" alt="huella" />
                                <img src="img/huella.svg" alt="huella" class="inactive" />
                            </label>
                            <label for="rc4" class="rating__item">
                                <img src="img/fill_huella.svg" class="active" alt="huella" />
                                <img src="img/huella.svg" alt="huella" class="inactive" />
                            </label>
                            <label for="rc5" class="rating__item">
                                <img src="img/fill_huella.svg" class="active" alt="huella" />
                                <img src="img/huella.svg" alt="huella" class="inactive" />
                            </label>
                    </div>
                    </div>
                </div>
            </div>
            <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Deja un comentario"></textarea>
            <button type="submit" class="uppercase">Enviar mi calificación</button>
        </div>
        <input type="hidden" name="provider" id="provider" value="<?=$_GET["provider"]?>">
        <input type="hidden" name="service" id="service" value="<?=$_GET["service"]?>">
        <input type="hidden" name="wepetuser" id="wepetuser" value="<?=$_GET["wepetuser"]?>">
    </form>
    <div class="successMsg">
      <h2 class="uppercase">Tu calificación ha sido enviada</h2>
      <p>Gracias por dejar tu calificación y comentario</p>
      <a href="/mi-cuenta/" class="await">Volver a We Pet</a>
    </div>
    <img src="images/perro1.jpg" alt="perro" class="right">
</main>
<? include 'includes/footer.php' ?>