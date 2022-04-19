<?php 
include 'conexion.php';

$correo = $_POST["correo"];
$clave = $_POST["clave"];
$clavecifrada = md5($clave);

// Comprobacion de espacios en blanco
if ($correo === "" || $clave === "") {
    echo '<script>
        alert("debe rellenar todos los requerisitos");
        window.history.go(-1);
        </script>';
    exit;
}

//conectar a la base de datos
$confirmar="select * from registro_empleado where correo='$correo' and clave='$clavecifrada';";

$resultado=mysqli_query($conexion, $confirmar);

$filas=mysqli_num_rows($resultado);

if($filas>0){
    header("location:index.html");
}
else{
    echo'<script>
        alert("error en el usuario o contraseña");
        window.history.go(-1);
    </script>';
}

mysqli_free_result($resultado);
mysqli_close($conexion);