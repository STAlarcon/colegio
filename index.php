<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio - Registros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 40px;
    }
    footer {
      margin-top: 30px;
      padding: 15px;
      background-color: #0d6efd;
      color: white;
      text-align: center;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">Colegio</a>
    </div>
  </nav>

  <div class="container">
    <h1 class="text-center mb-4">Listado de Estudiantes</h1>

    <form method="get" class="mb-4">
      <div class="input-group">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o apellido">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </form>

    <?php
    $servername = "mysql-alarcon.alwaysdata.net";
    $username   = "alarcon";
    $password   = "Santanalarcon12";
    $database   = "alarcon_colegio";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
      die("<div class='alert alert-danger'>Error de conexión: " . $conn->connect_error . "</div>");
    }

    $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : "";
    if ($buscar != "") {
      $sql = "SELECT * FROM personas WHERE nombre LIKE '%$buscar%' OR apellido LIKE '%$buscar%' LIMIT 100";
    } else {
      $sql = "SELECT * FROM personas LIMIT 100";
    }

    $resultado = $conn->query($sql);
    ?>

    <table class="table table-striped table-hover text-center">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Ciudad</th>
          <th>Promedio</th>
          <th>Correo</th>
          <th>Teléfono</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($resultado && $resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['id']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['apellido']}</td>
                    <td>{$fila['ciudad']}</td>
                    <td>{$fila['promedio']}</td>
                    <td>{$fila['correo']}</td>
                    <td>{$fila['telefono']}</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='7' class='text-muted'>No se encontraron registros</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>

  <footer>
    Proyecto Colegio — Base de datos en AlwaysData (usuario: alarcon)
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>