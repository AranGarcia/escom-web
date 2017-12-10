<?php
session_start();
$configs = include('config.php');

if (isset($_SESSION["usuario_activo"])) {
    unset($_SESSION["usuario_activo"]);
}
echo $configs["urls"]["base"];
header("Location: " . $configs["urls"]["base"]);
?>