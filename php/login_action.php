<?php
session_start();

$configs = include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
    // Configuracion de conexion a BD
$dbhost = $configs["db"]["host"];
$dbname = $configs["db"]["name"];
$dbuser = $configs["db"]["user"];
$dbpassw = $configs["db"]["passw"];

$dbconn = pg_connect("host=" . $dbhost . " dbname=" . $dbname . " user=" . $dbuser . " password=" . $dbpassw)
    or die("Could not connect" . pg_last_error());

    // Información del POST
$usuario = $_POST["boleta"];
$contrasena = $_POST["contrasena"];
    
    // Ejecuta query
$query = "SELECT nom_usuario, contrasena, activo, num_intentos FROM usuario WHERE nom_usuario = '" . $usuario . "';";
$result = pg_query($query) or die("Query failed: " . pg_last_error());
    
    // Extraccion de campo nom_usuario y contrasena
$user_array = pg_fetch_array($result, NULL, PGSQL_ASSOC);
if ($user_array["activo"] == "f") {
    echo "Usuario inactivo";
} else if ($user_array["contrasena"] == $contrasena) {
    $_SESSION["usuario_activo"] = $user_array["nom_usuario"];
    echo 0;
} else {
    if ($user_array["num_intentos"] > 4) {
        $update_query = "UPDATE usuario SET activo = FALSE WHERE nom_usuario = '" . $usuario . "';";
        pg_query($update_query) or die("Query failed: " . pg_last_error());
        echo "Usuario bloqueado.";
    } else {
        $update_query = "UPDATE usuario SET num_intentos = num_intentos + 1 WHERE nom_usuario = '" . $usuario . "';";
        pg_query($update_query) or die("Query failed: " . pg_last_error());
        echo "Acceso incorrecto";
    }
}
?>