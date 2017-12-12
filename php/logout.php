<?php

session_start();
$configs = include('config.php');

if (isset($_SESSION["usuario_activo"])) {
    unset($_SESSION["usuario_activo"]);
    unset($_SESSION["usuario_tipo"]);
    unset($_SESSION["usuario_nombre"]);
    unset($_SESSION["usuario_email"]);
}

header("Location: " . $configs["urls"]["base"]);
?>