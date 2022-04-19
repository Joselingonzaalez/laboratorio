<?php 
include 'conexion.php';


if (isset($_POST['guardar']) && isset($_POST['guardar']) == 'Guardar') {
    $rango = $_POST["rango"];
    $nombre = $_POST['nombre'];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $cedula = $_POST["cedula"];
    $clave = $_POST["clave"];
    $clavecifrada = md5($clave);

    // Comprobacion de espacios en blanco
    if (isset($_POST["rango"]) && !empty($_POST["rango"]) 
    && isset($_POST["nombre"]) && !empty($_POST["nombre"]) 
    && isset($_POST["usuario"]) && !empty($_POST["usuario"]) 
    && isset($_POST["correo"]) && !empty($_POST["correo"]) 
    && isset($_POST["cedula"]) && !empty($_POST["cedula"]) 
    && isset($_POST["clave"]) && !empty($_POST["clave"])) {
        $patron = '/^[a-zA-Z, ]*$/';
        if((preg_match($patron,$nombre))){
            // Verificacion de existencia del nombre de usuario
            $usuarioExiste = mysqli_query($conexion, "SELECT count(*) FROM registro_empleado WHERE username = '$usuario';");
            $correoExiste = mysqli_query($conexion, "SELECT count(*) FROM registro_empleado WHERE correo = '$correo';");
            if(mysqli_num_rows($usuarioExiste) > 0 || mysqli_num_rows($correoExiste) > 0){
                /*Verificacion de existencia de correo
                $correoExiste = mysqli_query($conexion, "SELECT count(*) FROM registro_empleado WHERE correo = '$correo';");
                if(mysqli_num_rows($correoExiste) > 0){*/
                    // Insertar datos
                    $insert = "INSERT INTO registro_empleado(rango,nombre,username,correo,cedula,clave) 
                    VALUES ('$rango','$nombre','$usuario','$correo','$cedula','$clavecifrada');";

                    $resultado = mysqli_query($conexion, $insert) or die("Error: " . mysqli_error($conexion));
                    unset($_POST['rango']);
                    unset($_POST['nombre']);
                    unset($_POST['username']);
                    unset($_POST['correo']); 
                    unset($_POST['cedula']); 
                    unset($_POST['clave']); 
                    header("location:../index.html");

                    if(!$resultado){
                        echo'<script>
                            alert("ha acorrido un error en el proceso, intente otra vez");
                            window.history.go(-1);
                        </script>';
                    }else{
                        header("location:../login.html");
                        echo"se ha registrado de forma satisfactoria";
                    }
                /*}else{
                    echo'<script>
                        alert("el correo ya existe, ingrese otro");
                        window.history.go(-1);
                    </script>';
                }*/
            }else{
                echo'<script>
                    alert("el nombre de usuario  y/o correo ya existe, eliga otro");
                    window.history.go(-1);
                </script>';
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