<?php
ob_start(); // Inicia el buffer de salida
session_start(); // Inicia la sesión

// Conexión a la base de datos
include 'includes/Config/DataBases.php';
$DB = conectarDB(); // Base de datos conectada 

// Navegación
include './includes/templades/Navegacion.php';

// Autenticar el usuario
$errores = []; // Variable para el mensaje de error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar email
    $email = mysqli_real_escape_string($DB, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($DB, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }

    if (!$password) {
        $errores[] = "El password es obligatorio";
    }

    if (empty($errores)) {
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($DB, $query);

        if ($resultado && $resultado->num_rows) {
            $usuario = mysqli_fetch_assoc($resultado);
            $auth = password_verify($password, $usuario['password']);
            if ($auth) {
                // Establecer las variables de sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                // Redirigir al administrador
                header('Location: Admin/propiedades/Administrador.php');
                exit;
            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El Usuario No Existe";
        }
    }
}

// Mostrar los mensajes de error
if (!empty($errores)) {
    foreach ($errores as $error) {
        echo "<p class='mensaje-error'>$error</p>";
    }
}
?>


<section class="nosotros">

    <!-- Formulario-->
    <div class="formulario-sugerencias">
        <h2>Iniciar Sesión</h2>
        <form action="#" method="POST">

            <div class="user-box">
                <input type="email" id="email" name="email">
                <label for="email">Coloca Tú Email</label>
            </div>

            <div class="user-box">
                <input type="password" id="password" name="password">
                <label for="password">Coloca Tú Password</label>
            </div>

            <button type="submit" class="Enviar">Iniciar sesión</button>
        </form>
    </div>

</section>

<?php
include './includes/templades/footer.php';
?>

<script src="/build/js/bundle.min.js"></script>

</body>

</html>