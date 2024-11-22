<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST["nombreUsuario"], $_POST["mailUsuario"], $_POST["mensajeUsuario"])) {
    $nombreUsuario = $_POST["nombreUsuario"];
    $mailUsuario = $_POST["mailUsuario"];
    $mensajeUsuario = $_POST["mensajeUsuario"];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true; 
        $mail->Username = 'testcursada@gmail.com'; 
        $mail->Password = 'olos mxau abra bvto'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587;
        $mail->setFrom('testcursada@gmail.com', 'TestCursada');
        $mail->addAddress('aguantesantoro@gmail.com', 'Nombre del destinatario');
        $mail->addReplyTo($mailUsuario, $nombreUsuario);
        $mail->Subject = 'Este es el asunto del mail';
        $mail->Body = "Mensaje de: $nombreUsuario\nCorreo: $mailUsuario\n\n$mensajeUsuario";

        // Enviar el correo
        $mail->send();
        echo '<script>window.location.href="mensajeEnviado.html"</script>';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
        echo "<br>Detalles del error: " . $e->getMessage();
    }
} else {
    echo 'Faltan datos en el formulario.';
}


