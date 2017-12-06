<?php
session_start();

if (!isset($_SESSION["usuario_activo"])) {
    header("Location: ../index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>
<body>
    <a href="logout.php">Cerrar sesi&oacute;n</a>
    <ul>
        <li>Opciones</li>
        <li>Dependiendo</li>
        <li>Del</li>
        <li>Tipo de</li>
        <li>Ceremonia</li>
    </ul>
</body>
</html>