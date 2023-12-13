<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Empresas de Alquiler de Vehículos</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 1em;
    }

    main {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .filtro {
      margin-bottom: 10px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #333;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    form {
      display: flex;
      flex-wrap: wrap;
    }

    form div {
      flex: 1 0 30%;
      margin-right: 10px;
    }

    form input[type="submit"] {
      background-color: #333;
      color: #fff;
      cursor: pointer;
    }
  </style>
</head>
<body>

<header>
  <h1>Listado de Empresas de Alquiler de Vehículos</h1>
</header>

<main>
  <?php
  $archivo = "CP.xml";

  // Intentar cargar el archivo XML
  if (!$xml = simplexml_load_file($archivo)) {
      die("No se pudo cargar el archivo XML");
  }

  var_dump($xml);

  $empresas = $xml->xpath('//empresa'); // Suponiendo que las empresas están bajo la etiqueta <empresa>

  $codigoPostalFiltro = $_GET['codigoPostal'] ?? '';
  $municipioFiltro = $_GET['municipio'] ?? '';
  $nombreFiltro = strtolower($_GET['nombreFiltro'] ?? '');
  ?>

  <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="filtro">
      <label for="codigoPostal">Filtrar por Código Postal:</label>
      <select name="codigoPostal">
        <option value="">Todos</option>
      </select>
    </div>

    <div class="filtro">
      <label>Filtrar por Municipio:</label>
      <select name="municipio">
        <option value="">Todos</option>
      </select>
    </div>

    <div class="filtro">
      <label for="nombreFiltro">Filtrar por Nombre:</label>
      <input type="text" name="nombreFiltro" value="<?= $_GET['nombreFiltro'] ?? '' ?>">
    </div>

    <input type="submit" value="Filtrar">
  </form>

  <div id="empresas-lista">
    <table>
      <thead>
        <tr>
          <th>Licencia de rentacar</th>
          <th>Nombre comercial</th>
          <th>Dirección completa</th>
          <th>Número de vehículos</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($empresas as $empresa) {
          $empresaData = $empresa->children(); // Obtener datos de la empresa
          $empresaCodigoPostal = (string)$empresaData->{'codigo-postal'};
          $empresaMunicipio = (string)$empresaData->municipio;
          $empresaNombre = strtolower((string)$empresaData->{'nombre-comercial'});

          if (
            ($codigoPostalFiltro === '' || $empresaCodigoPostal === $codigoPostalFiltro) &&
            ($municipioFiltro === '' || strtolower($empresaMunicipio) === strtolower($municipioFiltro)) &&
            ($nombreFiltro === '' || strpos($empresaNombre, $nombreFiltro) !== false)
          ) {
            echo '<tr>';
            echo '<td>' . $empresaData->{'licencia-rentacar'} . '</td>';
            echo '<td>' . $empresaNombre . '</td>';
            echo '<td>' . $empresaData->{'direccion-completa'} . '</td>';
            echo '<td>' . $empresaData->{'numero-vehiculos'} . '</td>';
            echo '</tr>';
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</main>

</body>
</html>
