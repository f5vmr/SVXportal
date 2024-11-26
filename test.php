<?php
// Test the proxy connection
$serveraddress = "http://192.168.1.213:8181/status";
$ctx = stream_context_create();
$json_test = file_get_contents($serveraddress, false, $ctx);
echo "Proxy connection status: ";
echo "<br>";
echo "Source address: http://192.168.1.213:8181/status";
echo "<br>";
echo "Data received through proxy: ";
var_dump($json_test);