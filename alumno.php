<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("php/utils.php");
$configs = include("php/config.php");
session_start();

// Si ningún usuario está activo se regresa a pagina principal
if (!isset($_SESSION["usuario_activo"])) {
    header("Location: " . $configs["urls"]["base"]);
    exit();
}

// De igual manera si no es alumno
else if ($_SESSION["usuario_tipo"] != "alumno") {
    unsetSession();
    header("Location: " . $configs["urls"][base]);
    exit();
}

// Inicialización de variables
$user_name = $_SESSION["usuario_nombre"];
$logout_ref = $configs["urls"]["logout"];

// Ceremonias a las que está invitado el alumno
$ceremonias = obtenerCeremonias($_SESSION["usuario_activo"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/master.css">
    <link rel="stylesheet" type="text/css" href="css/alumno.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400&amp;subset=latin-ext" rel="stylesheet"> 
    <script src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/cambio-seccion-script.js"></script>
    <title>Inicio</title>
</head>
<body>
    <!--menu lateral-->
    <div class="contenedor-menu">
        <ul>
            <li>
                <img class="logo-escom-menu" src="img/logo_escom_blanco.svg">
                Bienvenido, <?php echo $user_name ?>
            </li>
            <li><a id="tab-invitacion">Invitaci&oacute;n</a></li>
            <!-- Si está invitado a la ceremonia de generacion puede ver el anuario -->
            <?php
            if (in_array("generacion", $ceremonias)) {
                echo "<li><a id=\"tab-anuario\">Anuario</a></li>";
            }
            ?>
            <li><a id="tab-perfil">Perfil</a></li>
        </ul>
        <a href="<?php echo $logout_ref ?>" class="op-cerrar-sesion">Cerrar sesi&oacute;n</a>
    </div>

    <!-- __________SECCIONES QUE CAMBIARAN SEGUN LA SELECCION DEL MENU__________ -->
    <div class="contenedor-secciones">
        <!--Aquí está todo lo referente a las invitaciones-->
        <div id="seccion-tab-invitacion">
            <!--Frase introductoria-->
            <p>Has sido invitado a</p>

            <!--Todo esto es el cuadro que muestra la información y debería generarse desde aquí-->
            <?php 
            if (in_array("generacion", $ceremonias)) {
                echo "<div class=\"contenedor-tarjeta-inv\">
                    <div class=\"contenedor-mitad\">
                        <h1>ENTREGA DE DIPLOMAS GENERACIÓN 2013 - 2017</h1>
                        <p>Fecha: 08/Diciembre/2017</p>
                        <p>Hora: 17:30</p>
                        <p>Lugar: Auditorio A “Ing. Alejo Peralta” del Centro Cultural Jaime Torres Bodet</p>
                        <button>Descargar invitaci&oacute;n</button>
                    </div>
                    <!--Este es el mapa de la ubicación del lugar donde se organiza cada evento-->
                    <div class=\"contenedor-mitad\">
                        <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.0585465358336!2d-99.13741708509231!3d19.49611678684827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9b09a806093%3A0x934f6b997bafe6b1!2sAuditorio+Ing.+Alejo+Peralta!5e0!3m2!1ses-419!2smx!4v1513064253103\" width=\"100%\" height=\"100%\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>
                    </div>
                </div>";
            }
            ?>

            <!--En caso de tener las dos invitaciones se generarían ambos, aunque tengo duda sobre la información del segundo-->
            <?php
            if (in_array("excelencia", $ceremonias)) {
                echo "<div class=\"contenedor-tarjeta-inv\">
                    <div class=\"contenedor-mitad\">
                        <h1>ALUMNOS DE EXCELENCIA ACADÉMICA</h1>
                        <p>Fecha: 08/Diciembre/2017</p>
                        <p>Hora: 17:30</p>
                        <p>Lugar: Auditorio A “Ing. Alejo Peralta” del Centro Cultural Jaime Torres Bodet</p>
                        <button>Descargar invitaci&oacute;n</button>
                    </div>
                    <!--Este es el mapa de la ubicación del lugar donde se organiza cada evento-->
                    <div class=\"contenedor-mitad\">
                        <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.0585465358336!2d-99.13741708509231!3d19.49611678684827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9b09a806093%3A0x934f6b997bafe6b1!2sAuditorio+Ing.+Alejo+Peralta!5e0!3m2!1ses-419!2smx!4v1513064253103\" width=\"100%\" height=\"100%\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>
                    </div>
                </div>";
            }
            ?>
        </div>

        <!--Aquí está todo lo referente al anuario-->
        <div id="seccion-tab-anuario">
            <!--Frase introductoria-->
            <p>Tus fotos para el anuario</p>

            <!--CONTENEDOR DE LAS FOTOS-->
            <div class="contenedor-fotos-anuario">
                <!--El usuario deberia dar click y poder cargar una foto que se visualizaría en el mismo contenedor-->
                <!--FOTO 1 (Sugiero 3 fotos)-->
                <div class="contenedor-boton-foto">
                    <!--aquí debería verse la foto-->
                </div>
                <!--FOTO 2-->
                <div class="contenedor-boton-foto">
                    <!--aquí debería verse la foto-->
                </div>
                <!--FOTO 3-->
                <div class="contenedor-boton-foto">
                    <!--aquí debería verse la foto-->
                </div>
            </div>
        </div>

        <!--Aquí está todo lo referente al perfil-->
        <div id="seccion-tab-perfil"></div>
    </div>

    <p><?php
        echo "\n-------------------\n";
        echo var_dump($_SESSION);
        echo "\n-------------------\n";
        echo var_dump($ceremonias);
        ?></p>
</body>
</html>