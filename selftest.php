<?php
header('Access-Control-Allow-Origin: <?php echo $serveraddress ?>');

include "config.php";
include 'function.php';
$fault_counter =0;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> SVX Portal Self test</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="icon" type="image/png" href="tower.svg">
<link	href="https://fonts.googleapis.com/css?family=Architects+Daughter&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css.css">
<link href="dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="lib/jquery.min.js"></script>
<script type="text/javascript" src="dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="dist/add-on/jplayer.playlist.min.js"></script>
<link rel="stylesheet" href="lib/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">
<!-- Optional theme -->

<!-- Latest compiled and minified JavaScript -->

<script src="./lib/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="lib/css/bootstrap.min.css">


<link rel="stylesheet" href="jquery-ui.css">
<script src="jquery-ui.js"></script>

<script
	src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
<link rel="stylesheet"
	href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css">
<!-- fontawesome.com iconpac -->
<link href="./fontawesome/css/all.css" rel="stylesheet">
<!--load all styles -->
<script src="./js/chart/Chart.min.js"></script>

<style type="text/css">
.hideMe {
    display: none;
}




</style>




   <header>
 <nav class="navbar   navbar-dark sidebar_colour">
 <div>
   <a class="navbar-brand" href="#">
    <img src="logo.png" alt="Logo" style="width:40px;">

  </a>

   <a class="navbar-brand wite_font" href="#">
   
     SVX Portal Selftest
   </a>
   
   </div>

  <div class="topnav-right" >
  <a href=""" onclick="window.close()" class="btn btn-outline-success my-2 my-sm-0" id="menu-toggle"><?php echo _('Back')?></a>
  </div>
</nav> 
    </header>
    

<div class="container-fluid">





<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<h2>Test 1 Database</h2><br />";

if ($result = $link->query("SELECT Define FROM `Settings`")) {
    
    /* determine number of rows result set */
    $row_cnt = $result->num_rows;
    
    printf("Test <b class='text-success'>Success</b> found %d rows in settings.\n", $row_cnt);
    
    /* close result set */
    $result->close();
}
else
{
    
    echo "Test <b class='text-danger'>Fail</b> Check database<br />";
    $fault_counter++;
}

echo "<h2>Test 2 Reflector </h2><br />";
$serveraddress = "http://192.168.1.213:8181/status";

$ctx = stream_context_create([
    'http' => [
        'timeout' => 10,
        'ignore_errors' => true
    ]
]);

try {
    $json_test = file_get_contents($serveraddress, false, $ctx);
    echo "Connection to reflector: ";
    
    if($json_test) {
        $data = json_decode($json_test);
        if ($data !== null) {
            echo "<b class='text-success'>Success</b><br>";
            echo "<p>Found following stations:</p>";
            echo "<ul>";
            foreach($data->nodes as $st => $station) {
                echo "<li>".$st."</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "<b class='text-danger'>Failed to connect to reflector</b><br>";
        $fault_counter++;
    }
} catch (Exception $e) {
    echo "<b class='text-danger'>Error: " . $e->getMessage() . "</b>";
    $fault_counter++;
}

if($fault_counter == 0)
{
    echo "<p> All test <b class='text-success'>success</b> go to admin to change settings </p>";
}













?>

</div>

</body>
</html>


