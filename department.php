<? include 'includes/head.php'; ?>
<main>
    <form action="">
        <span>
            <label for="">Departamento</label>
            <div class="autocomplete" style="width: 243px">
            <input
              id="departamento"
              type="text"
              name="departamento"
              autocomplete="off"
              onblur="createCities(event)"
            />
          </div>
        </span>
        <span>
            <label for="">Ciudad</label>
            <div class="autocomplete" style="width: 243px">
            <input
              id="city"
              type="text"
              name="city"
              autocomplete="off"
            />
          </div>
        </span>
    </form>
</main>
<? include 'includes/footer.php'; ?>
<script>
    let allDepartamentos;
    fetch('https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json')
    .then((res) => res.json())
    .then((data) => {
        allDepartamentos = data
        let departamentos = [];
        data.forEach(sing => {
            departamentos.push(sing.departamento);
        });
        return departamentos;
    }).then((depart)=>{
        autocomplete(document.getElementById("departamento"), depart);
    })
    function createCities(event){
        let ciudades = allDepartamentos.find(dep => dep.departamento == 'Antioquia').ciudades;
        console.log({value:event.target.value,ciudades,allDepartamentos});
        autocomplete(document.getElementById("city"), ciudades);
    }
</script>

