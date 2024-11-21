<?php
$host = "%DB_HOST%";
$user ="%DB_USER%";
$password ="%DB_PASSWORD%";
$db="%DB_DB%";

$link =  mysqli_connect($host, $user, $password , $db);

// Live link
$livelink="%Stream_url%";

#$livelink_station[0]["Name"] ="Example1";
#$livelink_station[0]["URL"] ="https://icecast_url:8443/stream";
#$livelink_station[0]["Node"] ="STREAM23";

#$livelink_station[1]["Name"] ="SM2/SM3 Area";
#$livelink_station[1]["URL"] ="https://icecast_url:8443/stream";
#$livelink_station[1]["Node"] ="STREAM23";

// Svx recording folder
$dir="%recording_folder%";

// svxreflector server address;
$serveraddress ="%proxy_serveraddress%";

// login form recording
//$use_logein= true;
// Iframe under system description
$iframe_documentation_url  ="";

// Default Position
$default_lat ="50.0";
$default_long ="0.0";
$default_zoom =5;

// default tg player
$default_tg_player = 240;
// Mysql_Reflector
$reflector_db = 0;

// Default date
$start_date_defined ="2020-01-12";


#$reflector_db_host =	 	"127.0.0.1";
#$reflector_db_user = 	"svxreflector";
#$reflector_db_password = 	"%DB_ref%";
#$reflector_db_db = 		"svxreflector";

#ini_set("SMTP", "MYSMTP.dns.org");

#$use_mqtt=True;
#$mqtt_host = "";
#$mqtt_port = "10001";
#$mqtt_TLS = "True";

$Use_translate_on_info_page = true;
$Use_translate_default_lang = "en_US";

//define("USE_REDIS", true);
//define("USE_REDIS_Multiuite_index", "HAMRadio");

// redis host
//$red_Host = '127.0.0.1';
//$red_Port = 6379;
//$red_Auth ='';

$defined_qsy_tg  = array(
    "23500" => "QSY",
    "123" => "SIP",
);





?>