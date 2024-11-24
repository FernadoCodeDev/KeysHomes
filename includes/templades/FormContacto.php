<?php
// Incluimos el autoload de Composer
require __DIR__ . '/../../vendor/autoload.php'; // Ajusta la ruta según tu estructura de archivos

// Usamos la clase PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

function Formcontacto(){

    // Inicializar un array para almacenar los errores
    $errores = []; // Variable para el mensaje de error
    $exito = ''; // Variable para el mensaje de éxito

    $Respuestas = $_POST['contacto'];

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer();

    // Configurar SMTP
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'e82815a8b88a79';
    $mail->Password = 'dc2f2f4d7a3f5e';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    // Configurar el contenido del Email
    $mail->setFrom('admin@KeyHomes.com');
    $mail->addAddress('admin@KeyHomes.com', 'KeysHomes.com');
    $mail->Subject = 'Tienes un nuevo Mensaje';

    // Habilitar HTML
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    // Definir el contenido
    $contenido = '<html>';
    $contenido .= '<p>Tienes un Nuevo mensaje</p>';
    $contenido .= '<p>Nombre: ' . $Respuestas['nombre'] . ' </p>';
    $contenido .= '<p>Mensaje: ' . $Respuestas['mensaje'] . ' </p>';



    //Enviar datos de forma condicional

    if ($Respuestas['contacto'] === 'telefono') {
        $contenido .= 'Ha selecionado en contacto por Teléfono ';
        $contenido .= '<p>Telefono: ' . $Respuestas['telefono'] . ' </p>';
        $contenido .= '<p>fecha: ' . $Respuestas['fecha'] . ' </p>';
        $contenido .= '<p>hora: ' . $Respuestas['hora'] . ' </p>';
    } else {
        $contenido .= 'Ha selecionado en contacto por Email';
        $contenido .= '<p>Email: ' . $Respuestas['email'] . ' </p>';
    }

    $contenido .= '<p>Vende o comprar: ' . $Respuestas['tipo'] . ' </p>';
    $contenido .= '<p>Precio o Presupuesto: ' . $Respuestas['precio'] . ' </p>';
    $contenido .= '<p>Como desea ser contactado: ' . $Respuestas['contacto'] . ' </p>';
    $contenido .= '</html>';

    $mail->Body = $contenido;
    $mail->AltBody = 'Esto es texto alternativo sin HTML';

    // Enviar el Email


    if ($mail->send()) {
        $exito = "Formulario enviado correctamente, Gracias por tú mensaje :)"; // Mensaje de éxito
    } else {
        $errores[] = "Error al enviar enviar  :( ";
    }

     // Mostrar los mensajes de error o éxito
     if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p class='mensaje-error'>$error</p>";
        }
    } else if ($exito) {
        echo "<p class='mensaje-exito'>$exito</p>"; // Mostrar mensaje de éxito
    }
 
}
