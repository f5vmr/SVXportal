<?php
$Svx_reflector_address = "http://192.168.1.213:8181/status";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$data = file_get_contents('http://192.168.1.213:8181/status');
var_dump($data);

?>
