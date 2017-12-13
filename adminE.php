<?php
$configs = include("php/config.php");
session_start();

if (!isset($_SESSION["usuario_activo"])) {
    header("Location: " . $configs["urls"]["base"]);
    exit();
}

// De igual manera si no es administrador
else if ($_SESSION["usuario_tipo"] != "admin") {
    unset($_SESSION["usuario_activo"]);
    unset($_SESSION["usuario_tipo"]);
    header("Location: " . $configs["urls"]["base"]);
    exit();
}

// Inicialización de variables
$user_name = $_SESSION["usuario_activo"];
$logout_ref = $configs["urls"]["logout"];
?>

<!-- 
    PAGINA PRINCIPAL PARA GESTIONAR EL EVENTO DE ALUMNOS DE EXCELENCIA
    USUARIO(S): ADMINISTRADOR
-->
<!DOCTYPE html>
<html>
<head>
<title>Administrador</title>
</head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/master.css">
    <link rel="stylesheet" type="text/css" href="css/master-admin.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400&amp;subset=latin-ext" rel="stylesheet"> 
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/cambio-seccion-script.js"></script>
    <title>Administrador</title>
<body>
	<!--menu lateral-->
    <div class="contenedor-menu">
        <ul>
            <li>
                <img class="logo-escom-menu" src="img/logo_escom_blanco.svg">
                Bienvenido, <?php $user_name?>
            </li>
            <li><a href="adminE_lista.html" target="objetivo">Alumnos convocados</a></li>
			<li><a href="adminE_invitacion.html" target="objetivo">Invitaciones</a></li>
			<li><a href="adminE_infoalumno.html" target="objetivo">Información alumnos</a></li>
            <li><a href="adminE_mensaje.html" target="objetivo">Mensaje de últmia hora</a></li>
        </ul>
        <a href="<?php echo $logout_ref?>" class="op-cerrar-sesion">Cerrar sesi&oacute;n</a>
    </div>
	
	<!-- __________SECCIONES QUE CAMBIARAN SEGUN LA SELECCION DEL MENU__________ -->
    <div class="contenedor-secciones" id="hola">
        <!-- IFRAME PARA COLOCAR LOS CONTENIDOS EN EL LADO DERECHO DE LA PAGINA -->
        <iframe src="adminE_lista.html" name="objetivo" style="width: 100%; height: 550px" frameborder = "0" allowfullscreen>

        </iframe>
    </div>
</body>
</html>