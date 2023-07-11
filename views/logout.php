<?php
session_start();
$_SESSION = array();
session_destroy();
var_dump($_SESSION);
// exit;
header("location: {$_SERVER['SCRIPT_NAME']}");
