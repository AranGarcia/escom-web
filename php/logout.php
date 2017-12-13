<?php
session_start();
$configs = include('config.php');
include("utils.php");
unsetSession();

header("Location: " . $configs["urls"]["base"]);
?>