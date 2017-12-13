<?php
return array(
    "db" => array(
        "host" => "localhost",
        "name" => "escom_sseis",
        "user" => "postgres",
        "passw" => "root"
    ),
    "path" => array(
        "img" => "/var/www/webtest/img/",
        "docs" => "/var/www/webtest/docs/"
    ),
    "urls" => array(
        "base" => "http://localhost",
        "alumno" => "http://localhost/alumno.php",
        "logout" => "http://localhost/php/logout.php"
    ),
    "plugins" => array(
        "excel_reader" => "/var/www/webtest/vendor/excel_reader/excel_reader.php"
    )
);
?>