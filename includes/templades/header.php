<?php
if (!isset($_SESSION)) {
    session_start(); // Iniciar sesión
}

$auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<div class="AllContent"> <!--start of the div with the AllContent class. The end is in Footer-->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="src/Image/Keys Homes Logo Web.webp" type="image/webp">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" href="build/css/app.css">
        <title>Keys Homes</title>
    </head>

    <body>

        <!--header.sss-->
        <header class="header">
            <div class="contentHeader">
                <a href="../../Index.php">
                    <img src="src/Image/Keys Homes Logo.webp" class="KeysHomesLogo" alt="Keys Homes Logo">
                </a>

                <div class="mobileMenu">
                    <img src="src/Image/mobile menu.webp" alt="Mobile Menu">
                </div>

                <!-- DARK MODE -->
                <div class="darkModeIcon">
                    <img src="src/Image/Luna Icono.webp" class="DarkMode" alt="Dark Mode">
                </div>

                <nav class="navigation">
                    <a href="../../Properties.php">Propiedades</a>
                    <a href="../../Blog.php">Blog</a>
                    <a href="../../AboutKeysHomes.php">Nosotros</a>
                    <?php if ($auth): ?>
                        <a href="../../CloseSession.php">Cerrar sesión</a>
                    <?php endif ?>
                </nav>

                <div class="generalInformationKeysHomes">
                    <div class="informationKeysHomes">
                        <h3>--Welcome Keys Homes</h3>
                        <h1>Nosotros tomamos el control de su sueño, su hogar & <span class="transparentText">todo es muy fácil</span></h1>
                        <p>Nuestros agentes tienen un amplio conocimiento del mercado inmobiliario local y le brindaremos información valiosa sobre los vecindarios, casas y otros factores importantes que podrían afectar su decisión</p>
                        <div class="InfoButtons">
                            <a href="../../Properties.php">
                                <button class="ViewProperties">Ver propiedades</button>
                            </a>
                            <a href="#Data-KeysHomes">
                                <button class="ReadMore">Leer más</button>
                            </a>
                        </div>
                    </div>
                    <img src="src/Image/Edificio.webp" class="Building" alt="Building">
                </div>
            </div>
            <img src="src/Image/Background Green.webp" alt="main-background" class="MainBackground">

        </header>