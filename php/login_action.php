<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $boleta = $_POST["boleta"];
    $contrasena = $_POST["contrasena"];

    $dbconn = pg_connect("host=localhost dbname=escom 
        user=postgres password=root") or die
        ("Could not connect".pg_last_error());

    $query = "SELECT nombre FROM alumno WHERE boleta = '" . $boleta . "';";
    $result = pg_query($query) or die("Query failed:".pg_last_error());
    
    $num_rows = pg_num_rows($result);
    if($num_rows == 1){
        $_SESSION["active_user"] = "me";
        echo 1;
    }
    else{
        echo 0;
    }
?>