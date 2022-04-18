<?php 
include 'conexion.php';


if (isset($_POST['guardar']) && isset($_POST['guardar']) == 'Guardar') {
    $nombre_enfermero = $_POST['nombre_enfermero'];
    $correo_enfermero = $_POST['correo_enfermero'];
    $cedula_enfermero = $_POST['cedula_enfermero'];
    $nombre_paciente = $_POST['nombre_paciente'];
    $correo_paciente = $_POST['correo_paciente'];
    $cedula_paciente = $_POST['cedula_paciente'];
    $tipo_examen = $_POST['tipo_examen'];
    $estado = 'en proceso';

    // Comprobacion de espacios en blanco
    if (isset($_POST["nombre_enfermero"]) && !empty($_POST["nombre_enfermero"]) 
    && isset($_POST["correo_enfermero"]) && !empty($_POST["correo_enfermero"]) 
    && isset($_POST["cedula_enfermero"]) && !empty($_POST["cedula_enfermero"]) 
    && isset($_POST["nombre_paciente"]) && !empty($_POST["nombre_paciente"]) 
    && isset($_POST["correo_paciente"]) && !empty($_POST["correo_paciente"])
    && isset($_POST["cedula_paciente"]) && !empty($_POST["cedula_paciente"]) 
    && isset($_POST["tipo_examen"]) && !empty($_POST["tipo_examen"])) {
        $patron = '/^[a-zA-Z, ]*$/';
        if((preg_match($patron,$nombre_paciente))){
                    // Insertar datos
                    $insert = "INSERT INTO registro_paciente(nombre_enfermero,correo_enfermero,cedula_enfermero,nombre_paciente,correo_paciente,cedula_paciente,tipo_examen,estado) 
                    VALUES ('$nombre_enfermero','$correo_enfermero','$cedula_enfermero','$nombre_paciente','$correo_paciente','$cedula_paciente','$tipo_examen','$estado');";

                    $resultado = mysqli_query($conexion, $insert) or die("Error: " . mysqli_error($conexion));
                    unset($_POST['nombre_enfermero']);
                    unset($_POST['correo_enfermero']); 
                    unset($_POST['cedula_enfermero']); 
                    unset($_POST['nombre_paciente']);
                    unset($_POST['correo_paciente']); 
                    unset($_POST['cedula_paciente']); 
                    unset($_POST['tipo_examen']); 
                    unset($_POST['estado']); 
                    
                    
                    if(!$resultado){
                        echo'<script>
                            alert("ha acorrido un error en el proceso, intente otra vez");
                        </script>';
                    }else{
                        echo"producto registrado satisfactoriamente";
                        header("location:../informe.php");
                    }
        }else{
            echo'<script>
                alert("el nombre no puede llevar caracteres especiales");
                window.history.go(-1);
            </script>';
        }
    }/*else{
        echo'<script>
            alert("Por favor llene todos los campos");
            window.history.go(-1);
        </script>';
    }*/
}





/* Verificacion de existencia de correo
$correoExiste = mysqli_query($conexion, "SELECT * FROM registro_vendedor WHERE correo = '$correo'");
if(mysqli_num_rows($correoExiste) > 0){}
    echo '<script>
        alert("El correo ya se encuentra registrado");
        window.history.go(-1);
        </script>';
    exit;
}*/

mysqli_close($conexion);
?>