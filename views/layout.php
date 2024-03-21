<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Full Stack</title>
    <link rel="stylesheet" href="app.css">
</head>

<body>

    <?php

    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {

        include __DIR__ . "/header.php";
    }

    ?>

    <?php echo $contenido ?>

    <footer class="footer">
        <!-- <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/home">Inicio</a>
            </nav>
        </div> -->

        <p class="copyright">Axel Cruz <?php echo date('Y'); ?> &copy;</p>
    </footer>

</body>

</html>