<?php
ob_start();
session_start();

include 'includes/Config/DataBases.php';
$DB = conectarDB();

include './includes/templades/Navigation.php';

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: Admin/administration/Administrator.php');
                exit;
            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El Usuario No Existe";
        }
    }
}

if (!empty($errores)) {
    foreach ($errores as $error) {
        echo "<p class='ErrorAlert'>$error</p>";
    }
}
?>

<!-- Login.scss-->
<h2>Iniciar Sesión</h2>
<div class="Login">
    <form action="#" method="POST">

        <div class="user-box">
            <input type="email" id="email" name="email" placeholder="">
            <label for="email">Coloca Tú Email</label>
        </div>

        <div class="user-box">
            <input type="password" id="password" name="password" placeholder="">
            <label for="password">Coloca Tú Password</label>
        </div>

        <button type="submit" class="Send">Iniciar sesión</button>
    </form>
</div>
<?php
include './includes/templades/footer.php';
?>

<script src="/build/js/bundle.min.js"></script>

</body>

</html>