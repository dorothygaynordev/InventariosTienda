<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost&family=Montserrat:wght@300&family=Poppins:wght@200&family=Raleway:wght@600&display=swap" rel="stylesheet">
<link href="nouislider.min.css" rel="stylesheet">
@vite(['resources/css/home/home.css', 'resources/js/app.js'])
@livewireStyles
<!-- In <body> -->
</head>
<body>
    <script src="nouislider.min.js"></script>
    <div class="container">
      <div class="menu">
        <div class="sidebar">
          <div>
            <img class="img"
              src="https://dorothygaynor.vtexassets.com/assets/vtex.file-manager-graphql/images/11f79ae5-9e46-4181-a35c-3de1e355443f___2eb680bd97c5dbc302eb74d88d39ad31.jpg" alt="">
              <h1>Panel de Control</h1>
          </div>

          <div class="ins">
              <div class="check">
                <h2>Criterios - Rangos</h2>
                <div class="checks">
                    <input type="checkbox" placeholder="a"><label  for="checks">Modelo-Color</label>
                </div>
                <div class="checks">
                    <input type="checkbox" placeholder="a"><label for="checks">General</label>
                </div>
              </div>
            <div class="dro">
              <h2>Zonas</h2>
                <div class="drop">
                    <label>De:</label>
                    <select class="select" name="livery" id="livey" title="liver">
                        <option value="Local">Local</option>
                        <option value="Foranea">Foranea</option>
                    </select>
                </div>
                <div class="drop">
                    <label>A:</label>
                    <select class="select" name="livery" id="liver" title="livery">
                        <option value="Local">Local</option>
                        <option value="Foranea">Foranea</option>
                    </select>
                </div>
            </div>
          </div>
          <div class="controllers">
            <h1>Reforzar tallas</h1>
            <div class="">
              <p>Dama</p>
              <label for="slider">Min</label>
              <input id="multi" class="multi-range" type="range" title="livery" />
            <label for="slider">Max</label>
            </div>
            <div class="">
                <p>Caballero</p>
                <form class="multi-range-field my-5 ">
                    <label for="slider">Min</label>
                      <input id="multi3" class="multi-range" type="range" title="livery" />
                    <label for="slider">Max</label>
                 </form>
            </div>
          </div>
          <div class="filter">
            <div class="sales">
              <p>Quitar mercancía a partir de:</p>
              <select class="select" name="livery" id="liery" title="livery">
                <option value="3">3 Ventas</option>
                <option value="2">2 Ventas</option>
                <option value="1">1 Ventas</option>
              </select>
            </div>
            <div class="sales">
              <p>Estatus de tienda:</p>
              <select class="select" name="livery" id="lvery" title="livery">
                <option value="3">Sin restricciones</option>
                <option value="2">Con restriccion legal</option>
                <option value="1">Restricción de operaciones</option>
              </select>
            </div>
          </div>
          <div class="filter">
            <div class="service">
              <p>Nivel de servicio a partir de:</p>
              <select class="select" name="livery" id="livery" title="livery">
                <option value="3">50%</option>
                <option value="2">50%-75%</option>
                <option value="1">75%-100%</option>
              </select>
            </div>
            <div class="sales">
              <p>Tiendas con restricción</p>
              
            </div>
          </div>

  
          </div>
        </div>
        <div class="table">
          <div class="title">
            <h2 class="subtitle">LOTECOM</h2>
            <div>
              <form name="sku" action="/" method="POST">
                <select name="sku" id="sku" title="sku">
                  
                    <option name="sku" value="sku "> sku </option>
                  
                </select>
                <button name="submit" type="submit" class=" btn btn-primary">Lotificar</button>
              </form>

            
            <div class="alert alert-danger mt-3">
            
            </div>

            
                <div class="form-group">
                    <input type="file" class="form-control-file" name="csv_file" accept=".csv" required title="livery">
                </div>
                <button type="submit" class="btn btn-primary">Cargar</button>
            
            
          </div>
          <div class="tab">
            <table class="t">
              <tr>
                  <th>SKU</th>
                  <th>Cantidad</th>
              </tr>

                  <tr>
                      <td> sku </td>
                      <td> qty </td>
                  </tr>

          </table>
      
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
var slider = document.getElementById('slider');

noUiSlider.create(slider, {
    start: [20, 80],
    connect: true,
    range: {
        'min': 0,
        'max': 100
    }
});
</script>
