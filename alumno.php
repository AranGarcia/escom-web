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
else if ($_SESSION["usuario_tipo"] != "alumno") {
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
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/alumno.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400&amp;subset=latin-ext" rel="stylesheet"> 
    <script src="js/jquery-3.2.1.js"></script>
    <title>Inicio</title>
</head>
<body>
    <div class="contenedor-menu">
        <ul>
            <?php
            <li>
                <img class="logo-escom-menu" src="../img/logo_escom_blanco.svg">
                Bienvenido, $user_name
            </li>
            ?>
            <li><a id="tab-invitacion">Invitaci&oacute;n</a></li>
            <li><a id="tab-invitacion">Anuario</a></li>
            <li><a id="tab-invitacion">Perfil</a></li>
        </ul>
        <a href="<?php echo $logout_ref?>" class="op-cerrar-sesion">Cerrar sesi&oacute;n</a>
    </div>
</body>
</html>