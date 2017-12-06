<?php
session_start();

if (isset($_SESSION["usuario_activo"])) {
    unset($_SESSION["usuario_activo"]);
}

header("Location: ../index.html");
?>