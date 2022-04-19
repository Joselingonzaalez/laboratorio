<?php
include_once('php/conexion.php');
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
  <link rel="stylesheet" href="style.css">

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
            <a class="nav-link p-2" href="php_pruebas/pruebaLogout.php" rel="noopener">
              <button class="btn btn-outline-light" type="button">Log Out</button>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <main>
    <div class="container formulario">
      <form class="row  g-3 text-white justify-content-center pt-5" action="php/registro_informe.php" method="post">
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre del enfermero</label>
          <input type="text" class="form-control" name="nombre_enfermero" id="nombre_enfermero" value="<?php echo $_SESSION['fullName']; ?>" readonly>
        </div>
        <div class="col-md-4">
          <label for="inputPassword4" class="form-label">Cedula del enfermero</label>
          <input type="text" class="form-control" name="cedula_enfermero" id="cedula_enfermero" value="<?php echo $_SESSION['cedula']; ?>" readonly>
        </div>
        <div class="col-8">
          <label for="inputAddress" class="form-label">Correo del enfermero</label>
          <input type="text" class="form-control" name="correo_enfermero" id="correo_enfermero" value="<?php echo $_SESSION['correo']; ?>" readonly>
        </div>

        <br>
        <hr class="col-md-9 my-4" style="color: white;">
        <br>

        <div class="col-md-4">
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
            <option value="Salud General">Examen de Salud general</option>
            <option value="Sangre">Examen de Sangre</option>
            <option value="Orina">Examen de Orina</option>
            <option value="Heces">Examen de Heces</option>
            <option value="Glucosa">Examen de Glucosa</option>
            <option value="Trigliceridos">Examen de trigliceridos</option>
            <option value="Glicemia">Examen de Glicemia</option>
            <option value="Electrocardiograma">Electrocardiograma</option>
            <option value="Ultrasonido">Ultrasonido</option>
            <option value="Rayos X">Rayos X</option>
          </select>
        </div>
        <div class="col-8">
          <button type="submit" class="btn btn-primary" style="width: 100%;" id="guardar" name="guardar" value="Guardar">enviar informe</button>
        </div>
      </form>
    </div>






    <footer class="container-fluid bg-dark cosas-footer ">
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