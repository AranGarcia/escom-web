<?php
session_start();
include("utils.php");

$anterior = $_POST["passw"];
$nueva = $_POST["old_passw"];

echo cambiarPassword($_SESSION["usuario_activo"], $anterior, $nueva);
?>