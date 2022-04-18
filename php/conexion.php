<?php 
/* Estableciendo conexion usando XAMPP
$conexion = mysqli_connect("localhost","root","","clinica");
if(!$conexion){
    die("error al conectar la base de datos" . mysqli_connect_error());
}*/


// Estableciendo conexion con el hosting
$conexion = mysqli_connect("sql306.epizy.com","epiz_30541973","hdZONlnyRtkg7uj","epiz_30541973_clinica");
if(!$conexion){
    die("error al conectar la base de datos" . mysqli_connect_error());
}
?>