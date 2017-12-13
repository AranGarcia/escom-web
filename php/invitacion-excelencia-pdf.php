<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("utils.php");
$configs = include("config.php");
session_start();

// Si ningún usuario está activo se regresa a pagina principal
if (!isset($_SESSION["usuario_activo"])) {
	header("Location: " . $configs["urls"]["base"]);
	exit();
}

// Inicialización de variables
$user_name = $_SESSION["usuario_nombre"];
$user_ap = $_SESSION["usuario_ap_pat"];
$user_am = $_SESSION["usuario_ap_mat"];

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/pdf-invitacion.css">
</head>
<body>
	<h3>Escuela Superior De C&oacute;mputo</h3>
	<h1>Entrega de Diplomas a Alumnos de Excelencia</h1>
	<h2>Ing. en Sistemas Computacionales</h2>
	<h2>2013 - 2017</h2>
	<p>Se Otorga la Intitaci&oacute;n A:</p>
	<h2><?php echo $user_name?> <?php echo $user_ap?> <?php echo $user_am?></h2> <!--SALE DE LA BASE-->
	<h4>8 de Diciembre de 2017</h4> <!--SALE DE LA BASE-->
	<h4>17:30</h4> <!--SALE DE LA BASE-->
</body>
</html>