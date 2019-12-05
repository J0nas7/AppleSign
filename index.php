<?php
define("IN_APP", true);
session_start();
ob_start();

require_once "control/class.Configuration.php";
$Configuration = new Configuration();
?>