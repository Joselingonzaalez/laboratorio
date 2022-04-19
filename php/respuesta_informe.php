<?php
include_once('../php/conexion.php');
session_start();
if (isset($_SESSION['id_empleado'])) {
  $ID = $_SESSION['id_empleado'];
  $QUERY = "SELECT * FROM registro_empleado WHERE id_empleado ='$ID'";
  $rsQUERY = mysqli_query($conexion, $QUERY) or die('Error: ' . mysqli_error($conexion));
  $countQUERY = mysqli_num_rows($rsQUERY);
  if ($countQUERY <= 0) {
    header('Location: login.html');
  }
} else {
  header('Location: login.html');
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../style.css">

  <title>Consulta Express</title>
</head>

<body>
  <header class="navbar navbar-expand-md navbar-dark bd-navbar bg-dark">
    <nav class="container-xxl flex-wrap flex-md-nowrap">
      <a class="navbar-brand" href="#">Consulta Express</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="bi" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
      </button>

      <div class="collapse navbar-collapse" id="bdNavbar">
        <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav pt-2 py-md-0">
          <li class="nav-item col-6 col-md-auto">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>
        </ul>

        <hr class="d-md-none text-white-50">

        <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
          <li class="nav-item col-6 col-md-auto">
            <a class="nav-link p-2 fs-4 text-white disabled" href="#" rel="noopener">
              hola <?php echo $_SESSION['nombre_usu']; ?>
            </a>
          </li>
          <li class="nav-item col-6 col-md-auto">
            <a class="nav-link p-2" href="../php_pruebas/pruebaLogout.php" rel="noopener">
              <button class="btn btn-outline-light" type="button">Log Out</button>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <main>
    <div class="container formulario">
      <form class="row  g-3 text-white justify-content-center pt-5" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="col-8">
          <select class="form-select" aria-label="Default select example" name="ver_info">
            <option selected>--Seleccione un Paciente--</option>
            <?php

            $consulta = "SELECT id_paciente, nombre_paciente, tipo_examen FROM registro_paciente WHERE estado = 'en proceso' ORDER BY id_paciente ASC;";


            if ($resultado = $conexion->query($consulta)) {

              while ($fila = $resultado->fetch_assoc()) {
            ?>
                <option value="<?php echo $fila["id_paciente"]; ?>">
                  <?php echo $fila["nombre_paciente"] . " | tipo de examen a realizar: de " . $fila["tipo_examen"]; ?>
                </option>
            <?php
              }

              $resultado->free();
            }
            ?>
          </select>
          <div class="marco_btn pt-4">
            <input type="submit" value="responder" name="Responder" class="btn btn-primary" style="width: 100%;">
          </div>
        </div>
      </form>
    </div>

    <div class="container formulario">
      <form class="row  g-3 text-white justify-content-center pt-5" action="registro_respuesta_informe.php" method="post">
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre del medico</label>
          <input type="text" class="form-control" name="nombre_medico" id="nombre_medico" value="<?php echo $_SESSION['fullName']; ?>" readonly>
        </div>
        <div class="col-md-4">
          <label for="inputPassword4" class="form-label">Cedula del medico</label>
          <input type="text" class="form-control" name="cedula_medico" id="cedula_medico" value="<?php echo $_SESSION['cedula']; ?>" readonly>
        </div>
        <div class="col-8">
          <label for="inputAddress" class="form-label">Correo del medico</label>
          <input type="text" class="form-control" name="correo_medico" id="correo_medico" value="<?php echo $_SESSION['correo']; ?>" readonly>
        </div>

        <br>
        <hr class="col-md-9 my-4" style="color: white;">
        <br>

        <?php


        if (isset($_POST['Responder']) && $_POST['Responder'] == "responder") {
          $ver_info = $_POST["ver_info"];
          $consulta2 = "SELECT * FROM registro_paciente WHERE id_paciente = '$ver_info';";
          if ($resultado2 = $conexion->query($consulta2)) {
            $fila = $resultado2->fetch_assoc();
        ?>
            
            <div class="col-md-4" style="display: none;">
              <label for="inputEmail4" class="form-label">Nombre del paciente</label>
              <input type="text" class="form-control" name="nombre_enfermero" id="nombre_enfermero" value="<?php echo $fila['nombre_enfermero'] ?>" readonly>
            </div>
            <div class="col-md-4" style="display: none;">
              <label for="inputEmail4" class="form-label">Nombre del paciente</label>
              <input type="text" class="form-control" name="correo_enfermero" id="correo_enfermero" value="<?php echo $fila['correo_enfermero'] ?>" readonly>
            </div>
            <div class="col-md-4" style="display: none;">
              <label for="inputEmail4" class="form-label">Nombre del paciente</label>
              <input type="text" class="form-control" name="tipo_examen" id="tipo_examen" value="<?php echo $fila['tipo_examen'] ?>" readonly>
            </div>
            <div class="col-md-4" style="display: none;">
              <label for="inputEmail4" class="form-label">Nombre del paciente</label>
              <input type="text" class="form-control" name="cedula_enfermero" id="cedula_enfermero" value="<?php echo $fila['cedula_enfermero'] ?>" readonly>
            </div>
            <div class="col-md-4" style="display: none;">
              <label for="inputEmail4" class="form-label">Nombre del paciente</label>
              <input type="text" class="form-control" name="id_paciente" id="id_paciente" value="<?php echo $fila['id_paciente'] ?>" readonly>
            </div>
            <div class="col-md-4">
              <label for="inputEmail4" class="form-label">Nombre del paciente</label>
              <input type="text" class="form-control" name="nombre_paciente" id="nombre_paciente" value="<?php echo $fila['nombre_paciente'] ?>" readonly>
            </div>
            <div class="col-md-4">
              <label for="inputPassword4" class="form-label">Cedula del paciente</label>
              <input type="number" class="form-control" name="cedula_paciente" id="cedula_paciente" value="<?php echo $fila['cedula_paciente'] ?>" readonly>
            </div>
            <div class="col-8">
              <label for="inputAddress" class="form-label">Correo del paciente</label>
              <input type="email" class="form-control" name="correo_paciente" id="correo_paciente" value="<?php echo $fila['correo_paciente'] ?>" readonly>
            </div>
            <div class="col-8">
              <textarea class="form-control" name="diagnostico" id="diagnostico" style="height: 400px; width: 100%;" placeholder="ingrese el diagnostico"></textarea>
            </div>
            <div class="col-8">
              <button type="submit" class="btn btn-primary" style="width: 100%;" id="guardar" name="guardar" value="Guardar">enviar diagnostico</button>
            </div>
        <?php
          }
        }
        ?>
        <!--<div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre del paciente</label>
          <input type="text" class="form-control" name="nombre_paciente" id="nombre_paciente">
        </div>
        <div class="col-md-4">
          <label for="inputPassword4" class="form-label">Cedula del paciente</label>
          <input type="number" class="form-control" name="cedula_paciente" id="cedula_paciente">
        </div>
        <div class="col-8">
          <label for="inputAddress" class="form-label">Correo del paciente</label>
          <input type="email" class="form-control" name="correo_paciente" id="correo_paciente">
        </div>
        <div class="col-8">
          <label for="inputAddress" class="form-label">Tipo de Examen</label>
          <select class="form-select" aria-label="Default select example" id="tipo_examen" name="tipo_examen">
            <option selected>seleccione el tipo de examen</option>
            <option value="general">Examen de Salud general</option>
            <option value="sangre">Examen de Sangre</option>
            <option value="orina">Examen de Orina</option>
          </select>
        </div>-->
        
      </form>
    </div>






    <footer class="container-fluid bg-dark cosas-footer sticky-bottom">
      © 2021. Todos los derechos reservados por Consulta Express
      <br>
      Gracias por su visita
    </footer>
  </main>

  <!-- JavaScript de bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>