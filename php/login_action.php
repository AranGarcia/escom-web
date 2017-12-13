<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
    
include("utils.php");
$configs = include('config.php');

    // Información del POST
$usuario = $_POST["cve"];
$contrasena = $_POST["contrasena"];
    
// Extraccion de campo nom_usuario y contrasena
$user_array = obtenerInfoUsuario($usuario);
    
// Usuario bloqueado
if ($user_array["activo"] == "f") {
    echo 1;
}
// Acceso correcto 
else if ($user_array["contrasena"] == $contrasena) {
    $update_query = "UPDATE usuario SET num_intentos = 0 WHERE cve = '" . $usuario . "';";
    pg_query($update_query) or die("Query failed: " . pg_last_error());

    // Si un administrador inició sesión
    setAlumnoSession($user_array);
    if($_SESSION["usuario_tipo"] == "admin"){
        echo 3;
    }
    else{
        echo 0;
    }
} else {
    // Limite de intentos de acceso alcanzado
    if ($user_array["num_intentos"] > 4) {
        $update_query = "UPDATE usuario SET activo = FALSE WHERE nom_usuario = '" . $usuario . "';";
        pg_query($update_query) or die("Query failed: " . pg_last_error());
        echo 1;
    }
    // Usuario y/o Contraseña incorrecta
    else {
        $update_query = "UPDATE usuario SET num_intentos = num_intentos + 1 WHERE cve = '" . $usuario . "';";
        pg_query($update_query) or die("Query failed: " . pg_last_error());
        echo 2;
    }
}
?>