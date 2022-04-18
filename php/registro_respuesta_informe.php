<?php 
include 'conexion.php';


if (isset($_POST['guardar']) && isset($_POST['guardar']) == 'Guardar') {
    $nombre_medico = $_POST['nombre_medico'];
    $correo_medico = $_POST['correo_medico'];
    $cedula_medico = $_POST['cedula_medico'];
    $id_paciente = $_POST['id_paciente'];
    $nombre_enfermero = $_POST['nombre_enfermero'];
    $correo_enfermero = $_POST['correo_enfermero'];
    $cedula_enfermero = $_POST['cedula_enfermero'];
    $nombre_paciente = $_POST['nombre_paciente'];
    $correo_paciente = $_POST['correo_paciente'];
    $cedula_paciente = $_POST['cedula_paciente'];
    $tipo_examen = $_POST['tipo_examen'];
    $diagnostico = $_POST['diagnostico'];
    $estado_envio = 'enviar';
    // Comprobacion de espacios en blanco
    if (isset($_POST["nombre_medico"]) && !empty($_POST["nombre_medico"]) 
    && isset($_POST["correo_medico"]) && !empty($_POST["correo_medico"]) 
    && isset($_POST["cedula_medico"]) && !empty($_POST["cedula_medico"]) 
    && isset($_POST["nombre_paciente"]) && !empty($_POST["nombre_paciente"]) 
    && isset($_POST["correo_paciente"]) && !empty($_POST["correo_paciente"])
    && isset($_POST["cedula_paciente"]) && !empty($_POST["cedula_paciente"])
    && isset($_POST["id_paciente"]) && !empty($_POST["id_paciente"]) 
    && isset($_POST["diagnostico"]) && !empty($_POST["diagnostico"])) {
        $patron = '/^[a-zA-Z, ]*$/';
        if((preg_match($patron,$nombre_paciente))){
                    // Insertar datos
                    $insert = "INSERT INTO respuesta_informe(nombre_enfermero,correo_enfermero,cedula_enfermero,nombre_medico,correo_medico,cedula_medico,id_paciente,nombre_paciente,correo_paciente,cedula_paciente,tipo_examen,diagnostico,estado_envio) 
                    VALUES ('$nombre_enfermero','$correo_enfermero','$cedula_enfermero','$nombre_medico','$correo_medico','$cedula_medico','$id_paciente','$nombre_paciente','$correo_paciente','$cedula_paciente','$tipo_examen','$diagnostico','$estado_envio');";

                    $resultado = mysqli_query($conexion, $insert) or die("Error: " . mysqli_error($conexion));

                    $update = "UPDATE registro_paciente set estado = 'realizado' where id_paciente = '$id_paciente'";
                    $resultado_update = mysqli_query($conexion, $update) or die("Error: " . mysqli_error($conexion));
                    unset($_POST['nombre_medico']);
                    unset($_POST['correo_medico']); 
                    unset($_POST['cedula_medico']); 
                    unset($_POST['id_paciente']);
                    unset($_POST['nombre_paciente']);
                    unset($_POST['correo_paciente']); 
                    unset($_POST['cedula_paciente']); 
                    unset($_POST['diagnostico']); 
                    
                    
                    if(!$resultado || !$resultado_update){
                        echo'<script>
                            alert("ha acorrido un error en el proceso, intente otra vez");
                        </script>';
                    }else{
                        header("location:../php/enviar_correo_phpMailer/enviar_prueba.php");
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