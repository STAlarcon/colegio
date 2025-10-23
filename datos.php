<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Estudiantes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Listado de Estudiantes</h2>

    <?php
    // 🔹 Conexión con AlwaysData
    $servername = "mysql-alarcon.alwaysdata.net";
    $username   = "alarcon";
    $password   = "tu_contraseña_mysql"; // Cambiar por tu contraseña real
    $database   = "alarcon_colegio";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
      die("<div class='alert alert-danger'>Error de conexión: " . $conn->connect_error . "</div>");
    }

    // 🔹 Consulta de registros
    $sql = "SELECT * FROM personas LIMIT 100";
    $resultado = $conn->query($sql);
    ?>

    <table class="table table-bordered table-hover">
      <thead class="table-primary text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Ciudad</th>
          <th>Promedio</th>
          <th>Correo</th>
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
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='6' class='text-center text-muted'>No hay registros disponibles</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>

    <div class="text-center mt-4">
      <a href="index.html" class="btn btn-secondary">Regresar al inicio</a>
    </div>
  </div>

  <footer class="text-center mt-5 p-3 bg-primary text-white">
    Proyecto Colegio — Base de datos en AlwaysData
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>