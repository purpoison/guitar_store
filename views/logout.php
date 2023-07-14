<?php
session_start();
$_SESSION = array();
session_destroy();
header("location: {$_SERVER['SCRIPT_NAME']}");
