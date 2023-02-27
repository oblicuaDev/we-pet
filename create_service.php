<?php
  $bodyClass="home";
  include 'includes/head.php';
  $providers = $wp->get_provider("");
?>
<main>
    <form id="createservice" method="POST" action="/mi-cuenta/s/createService/" enctype="multipart/form-data">
        <h2>CREAR NUEVO SERVICIO</h2>
        <h3>Información del servicio</h3>
        <div class="flex">
            <span>
            <input type="file" name="image" />
            </span>
        </div>
        <div class="flex">
            <span>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name">
            </span>
            <span>
                <label for="price">Precio:</label>
                <input type="text" id="price" name="price">
            </span>
        </div>
        <div class="flex">
            <span>
                <div class="flex esterilizado">
                    <small>¿Disponible para mejorar plan?</small>
                    <label class="switch" for="available_upgrade">
                        <input type="checkbox" name="available_upgrade" id="available_upgrade" />
                        <span class="slider round"></span>
                    </label>
                </div>
            </span>

            <span>
                <label for="discount">Descuento:</label>
                <input type="text" id="discount" name="discount">
            </span>
        </div>
        <div class="flex">

            <span>
                <label for="prefix">Prefijo para código:</label>
                <input type="text" id="prefix" name="prefix">
            </span>
            <span>
                <label for="short_name">Nombre corto:</label>
                <input type="text" id="short_name" name="short_name">
            </span>
        </div>
        <div class="flex">

            <span>
                <label for="complete">Cantidad Plan Completo:</label>
                <input type="text" id="complete" name="complete">
            </span>
            <span>
                <label for="medio">Cantidad Plan Medio:</label>
                <input type="text" id="medio" name="medio">
            </span>
        </div>
        <div class="flex">

            <span>
                <label for="basic">Cantidad Plan Básico:</label>
                <input type="text" id="basic" name="basic">
            </span>
            <span>
                <label for="free">Cantidad Plan Gratuito:</label>
                <input type="text" id="free" name="free">
            </span>
        </div>
        <div class="flex">

            <span>
                <label for="serviceid">ID del Servicio:</label>
                <input type="text" id="serviceid" name="serviceid">
            </span>
            <span>
                <label for="linksercice">Link servicio:</label>
                <input type="text" id="linksercice" name="linksercice">
            </span>
        </div>
        <div class="flex">
            <span>
                <label for="comment">Descripción:</label>
                <textarea id="description" name="description"></textarea>
            </span>
        </div>
        <h3>Información del proveedor</h3>
        <span>
            <label for="providerselect">Selecciona un proveedor o crea uno nuevo</label>
            <div class="c-select">
                <select id="providerselect" name="providerselect" onchange="toggleFields()">
                    <option value="">Selecciona un proveedor</option>
                    <option value="new">Nuevo Proveedor</option>
                    <?php 
                    for ($i=0; $i < count($providers); $i++) { 
                        $provider = $providers[$i];
                    ?>
                    <option value="<?=$provider->id?>"><?=$provider->name?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>
        </span>
        <div id="new-fields" style="display:none;">
            <div class="flex">
                <span>
                    <label for="name_pro">Nombre:</label>
                    <input type="text" id="name_pro" name="name_pro">
                </span>
                <span>
                    <label for="subtitle">Subtitulo:</label>
                    <input type="text" id="subtitle" name="subtitle">
                </span>
            </div>
            <div class="flex">
                <span>
                    <label for="barrio">Barrio:</label>
                    <input type="text" id="barrio" name="barrio">
                </span>
                <span>
                    <label for="localidad">Localidad:</label>
                    <input type="text" id="localidad" name="localidad">
                </span>
            </div>
            <div class="flex">
                <span>
                    <label for="email">Correo electrónico:</label>
                    <input type="text" id="email" name="email">
                </span>
                <span>
                    <label for="phone">Teléfono:</label>
                    <input type="text" id="phone" name="phone">
                </span>
            </div>
            <div class="flex">
                <span>
                    <label for="link">Link:</label>
                    <input type="text" id="link" name="link">
                </span>
                <span>
                    <label for="desc">Descripción:</label>
                    <textarea id="desc" name="desc"></textarea>
                </span>
            </div>
            <div class="flex">
                <span>
                    <label for="schedule">Horarios:</label>
                    <textarea id="schedule" name="schedule"></textarea>
                </span>
                <span>
                    <label for="places">Lugares:</label>
                    <textarea id="places" name="places"></textarea>
                </span>
            </div>
        </div>
        <button type="submit">Submit</button>
    </form>
</main>
<? include 'includes/footer.php' ?>

<script>
    function toggleFields() {
        var purposeSelect = document.getElementById("providerselect");
        var contactFields = document.getElementById("new-fields");

        if (purposeSelect.value === "new") {
            contactFields.style.display = "block";
        } else {
            contactFields.style.display = "none";
        }
    }
</script>