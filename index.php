<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$configs = include('php/config.php');

if (isset($_SESSION["usuario_activo"])) {
    header("Location: " . $configs["urls"]["alumno"]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/master.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400&amp;subset=latin-ext" rel="stylesheet"> 
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/login_form.js"></script>
    <title>Inicio de sesi&oacute;n</title>
</head>

<body>
    <!-- Slider -->
    <div class="contenedor-slider">
    	<img src="img/slider-index/01-ceremonia.jpg">
    </div>

     <!-- Contenedor que centra el login -->
    <div class="cien-cien centrar-verticalmente">
        <div class="contenedor-login">
            <!-- Logo de escom, esquina superior derecha -->
            <img class="logo-escom" src="img/logo_escom_blanco.svg">
            <!-- Nombre del sistema -->
            <div class="titulo-escom-sseis">ESCOM-SSEIS</div>
            <h2>Iniciar Sesi&oacute;n</h2>
            <!-- Formulario -->
            <form id="form_login">
                <label for="boleta">Boleta</label>
                <input type="text" name="boleta" id="boleta" placeholder="N&uacute;mero de boleta">
                <label for="contrasena">Contrase&ntilde;a</label>
                <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
                <button type="submit">Iniciar Sesi&oacute;n</button>
            </form>
            <!-- Enlace en caso de tener problemas con el login -->
            <a href="#">No puedo acceder a mi cuenta</a>
        </div>
    </div>
</body>
</html>