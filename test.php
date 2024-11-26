<?php
// Test the proxy connection
$serveraddress = "http://192.168.1.213:8181/status";
$ctx = stream_context_create();
try {
$json_test = file_get_contents($serveraddress, false, $ctx);
if ($json_test === false) {
    throw new Exception('Failed to fetch data');
}
echo "Proxy connection status: ";
echo "<br>";
echo "Source address: http://192.168.1.213:8181/status";
echo "<br>";
echo "Data received through proxy: ";
var_dump($json_test);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}