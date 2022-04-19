<?php 
/* Estableciendo conexion usando XAMPP
$conexion = mysqli_connect("localhost","root","","clinica");
if(!$conexion){
    die("error al conectar la base de datos" . mysqli_connect_error());
}*/


// Estableciendo conexion con el hosting
$conexion = mysqli_connect("localhost","root","1234","clinica");
if(!$conexion){
    die("error al conectar la base de datos" . mysqli_connect_error());
}
?>