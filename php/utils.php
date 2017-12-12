<?php
function crearInvitacion($nombre)
{
        //  TODO 
}

function leerHojaDeCalculo()
{
        // TODO
}

/* 
obtenerInfoUsuario -> usuario[...]

Accede al origen de datos para obtener información del usuario.
*/
function obtenerInfoUsuario($clave)
{
    $configs = include("config.php");

    $dbhost = $configs["db"]["host"];
    $dbname = $configs["db"]["name"];
    $dbuser = $configs["db"]["user"];
    $dbpassw = $configs["db"]["passw"];

    $dbconn = pg_connect("host=" . $dbhost . " dbname=" . $dbname . " user=" . $dbuser . " password=" . $dbpassw)
        or die("Could not connect" . pg_last_error());

    $query = "SELECT nom_usuario, nom, email, contrasena, rol_usuario, activo, num_intentos 
        FROM usuario WHERE nom_usuario = '" . $clave . "' AND rol_usuario = 'alumno';";
    $result = pg_query($query) or die("Query failed: " . pg_last_error());
    return pg_fetch_array($result, NULL, PGSQL_ASSOC);
}

/* 
obtenerCeremonias(claveUsuario) -> ceremonias[...]

Obtiene las ceremonias a las cuales está invitado el alumno.
- Ceremonia
- Excelencia
 */
function obtenerCeremonias($clave)
{
    $configs = include("config.php");

    $dbhost = $configs["db"]["host"];
    $dbname = $configs["db"]["name"];
    $dbuser = $configs["db"]["user"];
    $dbpassw = $configs["db"]["passw"];

    $dbconn = pg_connect("host=" . $dbhost . " dbname=" . $dbname . " user=" . $dbuser . " password=" . $dbpassw)
        or die("Could not connect" . pg_last_error());

    $query = "SELECT tipo FROM asistencia_evento WHERE boleta = '" . $clave . "';";
    $result = pg_query($query) or die("Query failed: " . pg_last_error());
    return pg_fetch_all_columns($result);
}

/* 
Establece la sesion con los valores del origen de datos:
- Clave de usuairo
- Rol
- Primer nombre
- Correo electrónico
*/
function setAlumnoSession($user_array){
    $_SESSION["usuario_activo"] = $user_array["nom_usuario"];
    $_SESSION["usuario_tipo"] = $user_array["rol_usuario"];
    $_SESSION["usuario_nombre"] = $user_array["nom"];
    $_SESSION["usuario_email"] = $user_array["email"];
}

function unsetAlumnoSession(){
    unset($_SESSION["usuario_activo"]);
    unset($_SESSION["usuario_tipo"]);
    unset($_SESSION["usuario_nombre"]);
    unset($_SESSION["usuario_email"]);
}
?>