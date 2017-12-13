<?php
function crearInvitacion($nombre)
{
        //  TODO 
}
/* 
Agrega alumnos a la base de datos desde una hoja de calculos
 */
function leerHojaDeCalculo()
{
    $configs = include("../php/config.php");
    include($configs["plugins"]["excel_reader"]);

    $excel = new PhpExcelReader;

    // Extraccion de informacion de hoja de calculo
    $excel->read($configs["path"]["docs"] . "alumnos_generacion.xls");
    $alumnos = array_slice($excel->sheets[0]["cells"], 1);

    //Si no existen renglones con informacion, no hay alumno que insertar
    if (count($alumnos) == 0) {
        return;
    }

    $dbconn = connectDB();
    if (!$dbconn) {
        return;
    }

    $query_insert = "INSERT INTO usuario VALUES ('";

    foreach ($alumnos as $alumno) {
        $boleta = $alumno[1];
        $nombre = explode(" ", $alumno[2]);
        $ultimo = count($nombre) - 1;
        $nombres = array_slice($nombre, 0, $ultimo - 1);
        $nom = implode(" ", $nombres);
        $ap = $nombre[$ultimo - 1];
        $am = $nombre[$ultimo];
        $email = $alumno[21];

        $resultado = pg_query($query_insert . $boleta . "','" . $nom . "','" . $ap . "','" . $am .
            "','password', 'alumno','" . $email . "',true);");

        if (!$resultado) {
            echo "No se pudo insertar " . $boleta . "<br>";
        } else {
            echo "<br>OK<br>";
        }
    }
}

/* 
obtenerInfoUsuario -> usuario[...]

Accede al origen de datos para obtener información del usuario.
 */
function obtenerInfoUsuario($clave)
{
    $dbconn = connectDB();

    $query = "SELECT cve, nom, ap, am, email, contrasena, rol_usuario, activo, num_intentos 
        FROM usuario WHERE cve = '" . $clave . "' AND rol_usuario = 'alumno';";
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
function setAlumnoSession($user_array)
{
    $_SESSION["usuario_activo"] = $user_array["cve"];
    $_SESSION["usuario_tipo"] = $user_array["rol_usuario"];
    $_SESSION["usuario_nombre"] = $user_array["nom"];
    $_SESSION["usuario_ap_pat"] = $user_array["ap"];
    $_SESSION["usuario_ap_mat"] = $user_array["am"];
    $_SESSION["usuario_email"] = $user_array["email"];
}

function unsetAlumnoSession()
{
    unset($_SESSION["usuario_activo"]);
    unset($_SESSION["usuario_tipo"]);
    unset($_SESSION["usuario_nombre"]);
    unset($_SESSION["usuario_email"]);
}

/* 
Cambia la contraseña de un usuario
- Clave de usuario / Boleta de alumno
- Password anterior
- Password nueva
 */
function cambiarPassword($cve_usu, $passw_ant, $passw_nueva)
{
    $dbconn = connectDB();

    $query = "SELECT COUNT(*) FROM usuario WHERE " .
        "cve = '" . $cve_usu . "' and contrasena = '" . $passw_ant . "'";

    $result = pg_query($query);
    $r = pg_fetch_array($result);
    if ($r["count"] == 0) {
        return false;
    }

    $update_query = "UPDATE usuario SET contrasena = '" . $passw_nueva ."'" .
        "WHERE cve = '" . $cve_usu . "'";

    $result = pg_query($update_query);

    return true;
}
/* 
Conecta a la base de datos especificada por la configuracion
 */
function connectDB()
{
    $configs = include("config.php");

    $dbhost = $configs["db"]["host"];
    $dbname = $configs["db"]["name"];
    $dbuser = $configs["db"]["user"];
    $dbpassw = $configs["db"]["passw"];

    return pg_connect("host=" . $dbhost . " dbname=" . $dbname . " user=" . $dbuser . " password=" . $dbpassw)
        or die("Could not connect" . pg_last_error());
}
?>