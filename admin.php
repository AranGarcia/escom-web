<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$configs = include("php/config.php");
session_start();

// Si ningún usuario está activo se regresa a pagina principal
if (!isset($_SESSION["usuario_activo"])) {
    header("Location: " . $configs["urls"][base]);
    exit();
}

// De igual manera si no es administrador
else if ($_SESSION["usuario_tipo"] != "admin") {
    unset($_SESSION["usuario_activo"]);
    unset($_SESSION["usuario_tipo"]);
    header("Location: " . $configs["urls"][base]);
    exit();
}

// Inicialización de variables
$user_name = $_SESSION["usuario_activo"];
$logout_ref = $configs["urls"]["logout"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>
<body>

    <?php
    echo "<h1>Bienvenido $user_name</h1>";
    ?>

    <button type="submit">Alumnos de excelencia</button>
    <button type="submit">Alumnos de generacion</button>

    <ul>
        <li><a href="<?php echo $logout_ref?>">Cerrar sesi&oacute;n</a></li>
    </ul>
</body>
</html>