<?php
include_once('../php/conexion.php');
session_start();
$email = null;
$pwd = null;
if (isset($_POST['enviar'])) {
    if (isset($_POST['correo']) && isset($_POST['clave']) && !empty($_POST['correo']) && !empty($_POST['clave'])) {
        echo 'Recibio del POST', '<br />';
        $email = $_POST['correo'];
        $pwd = md5($_POST['clave']);

        echo $email, '<br />';
        echo $pwd, '<br />';
        $QUERYLog = "SELECT * FROM registro_empleado WHERE correo='$email' AND clave='$pwd'";
        $rsQUERYLog = mysqli_query($conexion, $QUERYLog) or die('Error: ' . mysqli_error($conexion));
        $fileQUERYLog = mysqli_fetch_array($rsQUERYLog);
        $NofileQUERYLog = mysqli_num_rows($rsQUERYLog);
        echo $QUERYLog;
        if ($NofileQUERYLog > 0) {
            $_SESSION['id_empleado'] = $fileQUERYLog['id_empleado'];
            $_SESSION['fullName'] = $fileQUERYLog['nombre'];
            $_SESSION['nombre_usu'] = $fileQUERYLog['username'];
            $_SESSION['cedula'] = $fileQUERYLog['cedula'];
            $_SESSION['correo'] = $fileQUERYLog['correo'];

            echo '<br />';
            echo 'UsuarioID session:', $_SESSION['id_empleado'], '<br >';
            echo 'fullName session:', $_SESSION['fullName'], '<br >';
            echo 'nombre usuario session:', $_SESSION['nombre_usu'], '<br >';
            
            if($fileQUERYLog['rango'] === "enfermera"){
                header('Location: ../informe.php');
            } else {
                header('Location: ../php/respuesta_informe.php');
            }
        } else {
            session_destroy();
            header('Location: ../login.html');
        }
    } else {
        session_destroy();
        header('Location: ../login.html');
    }
} else {
    session_destroy();
    header('Location: ../login.html');
}

mysqli_close($conexion);
