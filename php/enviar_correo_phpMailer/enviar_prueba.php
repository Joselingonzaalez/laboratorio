<?php
include_once '../conexion.php';
include_once '../pdf.php';

$sql_selecciona = "SELECT * FROM respuesta_informe WHERE estado_envio = 'enviar';";
$sql_selecciona_ejecutar = mysqli_query($conexion, $sql_selecciona) or die('Error: ' . $mysqli_error($conexion));
$sql_selecciona_array = mysqli_fetch_array($sql_selecciona_ejecutar);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'datos_cuenta.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //para accesar a la cuenta de correo
    $mail->Username   = $cuenta;                     //SMTP username
    $mail->Password   = $clave;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    //desde donde se envia el correo
    $mail->setFrom($cuenta, 'Consulta Express');
    //quien recibe el correo
    $mail->addAddress($sql_selecciona_array['correo_paciente'], $sql_selecciona_array['nombre_paciente']);     //Add a recipient
    /*$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');*/

    //para adjuntar archivos NO LO OLVIDES YO DEL FUTURO
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Respuesta de Estudio Medico';
    $mail->Body    = 'Buenas tardes estimado paciente ' . $sql_selecciona_array['nombre_paciente'] . ', 
                      le adjuntamos su informe medico del examen que pidio';

    $update = "UPDATE respuesta_informe set estado_envio = 'enviado' where estado_envio = 'enviar'";
    $resultado_update = mysqli_query($conexion, $update) or die("Error: " . mysqli_error($conexion));

    $mail->addStringAttachment($pdfdoc, 'informe medico.pdf');

    $mail->send();
        echo 'Mensaje enviado correctamente';
        header("location:../respuesta_informe.php");
    
    
    
} catch (Exception $e) {
    echo "Mensaje no enviado. Mailer Error: {$mail->ErrorInfo}";
}