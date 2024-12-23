<?php
include_once  'config.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// Create connection
$conn = new mysqli($host, $user, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$json_array=array();
function secondsToDHMS($seconds) {
    $s = (int)$seconds;
    if($s >0)
        return sprintf('%d:%02d:%02d:%02d', $s/86400, $s/3600%24, $s/60%60, $s%60);
        else
            return "0:00:00:00";
            
}
function get_time($station,$day)
{
    global $link;

    $station_query =" AND Callsign ='".$station."' ";
    
    
    $time_string ="`Time` BETWEEN '$day 00:00:00.000000' AND '$day 23:59:59.000000'";
    
    //$sql_active ="SELECT sum(UNIX_TIMESTAMP(`Time`)),Callsign FROM ReflectorNodeLog WHERE `Type` = '1' $station_query AND  `Active` ='1' AND $time_string group by  `Callsign`";
    
    $sql_nonactive ="SELECT sum(Talktime), Callsign FROM ReflectorNodeLog WHERE `Type` = '1'$station_query AND `Active` ='0' AND $time_string group by  `Callsign` ";
    
//     echo $sql_active;
//      echo "<br>";
     
    //$sqlref = $link->query($sql_active);
    $sqla = $link->query($sql_nonactive);
    $timesum =array();
    
    while($row = $sqla->fetch_assoc()) {
        $timesum[$row["Callsign"]] =$timesum[$row["Callsign"]]+$row["sum(Talktime)"];
    }

    return $timesum[$station];
    
}
$most_used_station = array();
function get_most_use_receiver($day)
{
    global $link;
    global $most_used_station;
    

    
    
    $time_string ="`Time` BETWEEN '$day 00:00:00.000000' AND '$day 23:59:00.000000'";
    $quvery =" SELECT MAX(`Nodename`),`Callsign` FROM `ReflectorNodeLog`  WHERE  $time_string  AND`Type` = 2 AND `Active` = 1  GROUP BY Callsign";
    echo $quvery;


    $sqla = $link->query($quvery);
    
    $count_array= array();
 
    while($row2 = $sqla->fetch_assoc())
    {
        //echo '<pre>';
        //var_dump($row2);
        $count_array[$row2['Callsign']][$row2['MAX(`Nodename`)']]++;
        
        $most_used_station[$row2['Callsign']] = $row2['MAX(`Nodename`)'];
    }
    
    //echo '<pre>';
    arsort($count_array);
    while($row2 = $sqla->fetch_assoc())
    {

        
        $most_used_station[$row2['Callsign']] =$count_array[$row2['Callsign']][0];
    }



    

}


$day= $_GET['date'];
$station = $_GET['st'];
$qrv = $_GET['qrv'];
$link->set_charset("utf8");
/*
 * Detect if station data
 * 
 */
if($station != "")
{
    $station = $link->real_escape_string($station);
    $station_query =" AND Callsign ='".$station."' ";
    
}
else
{
    $station_query ="";
}

if($qrv != "")
{
    $qrv = $link->real_escape_string($qrv);
    $day = $link->real_escape_string($day);
    $time_string ="`Time` BETWEEN '$day 00:00:00.000000' AND '$day 23:59:59.000000'";
    
    $sql_stations ="SELECT Callsign , sum(Talktime)  FROM ReflectorNodeLog WHERE `Type` = '1' and Active='0'  AND $time_string group by  `Callsign`";

    echo 
    $sqlstat = $link->query($sql_stations);
    $outarray = array();
    $i =0;
    
    
    get_most_use_receiver($day);
    
    
    $time_total_usage=0;
    while($row = $sqlstat->fetch_assoc()) {
        $outarray['data'][$i]['call']=$row["Callsign"];
        //$outarray['data'][$i]['time'] =get_time($row["Callsign"],$day);
        $outarray['data'][$i]['time'] = $row['sum(Talktime)'];
        $time_total_usage = $time_total_usage+$outarray['data'][$i]['time'] ;
        //$outarray['data'][$i]["Second"] = secondsToDHMS(get_time($row["Callsign"],$day));
        $outarray['data'][$i]["Second"] = secondsToDHMS($row['sum(Talktime)']);
        
        $outarray['data'][$i]["receiver"] = $most_used_station[$row["Callsign"]];
        
        
        $i++;
    }
    $outarray['total_seconds'] = $time_total_usage;
    
    
    echo json_encode ($outarray);
    
    
    
}
else if( $_GET['time'] == "true")
{
    
    $day = $link->real_escape_string($day);
    
    
    //$time_string ="`Time` BETWEEN '$day $timel:00:00.000000' AND '$day $timel:59:59.000000'";
    $time_string ="`Time` BETWEEN '$day 00:00:00.000000' AND '$day 23:59:59.000000'";
    
    //$sql_active ="SELECT sum(UNIX_TIMESTAMP(`Time`)), `Talkgroup` FROM ReflectorNodeLog WHERE `Type` = '1' $station_query AND  `Active` ='1' AND $time_string group by  `Talkgroup`";
    
    $sql_nonactive ="SELECT UNIX_TIMESTAMP(Time), Talktime, `Talkgroup` FROM ReflectorNodeLog WHERE `Type` = '1' $station_query AND `Active` ='0' AND $time_string  ";
    $sqla = $link->query($sql_nonactive);
    $data = array();
    while($row = $sqla->fetch_assoc()) {
        $data[] = $row;
        
    }
    
    


    for($timel =0; $timel <= 24;$timel++)
    {
        $filterdate = strtotime($day);
        $low_time =$filterdate+ ($timel*3600);
        $high_time =$filterdate+ ($timel*3600)+(59*60)+59;
        
        $timesum =array();
        $timesums  =array();
        $timesums[$timel] =0;
        
        // loop throu remove row if match is found 
        foreach ($data as & $row) {
       
            if(  $row['UNIX_TIMESTAMP(Time)'] >=   $low_time    &&    $row['UNIX_TIMESTAMP(Time)']  <=$high_time  )
            {
            
                $timesum[$row['Talkgroup']] = $timesum[$row['Talkgroup']]+$row["Talktime"];
                $timesums[$timel] =$timesums[$timel] +$row["Talktime"];
                unset($row);
            }
            
            
            
        }
        
        

        
       
        
//               echo $sql_active;
//          echo "<br>";
         
       // $sqlref = $link->query($sql_active);
       

        
      
        
     

        
        
        /*
        while($row = $sqlref->fetch_assoc()) 
        {
            
            $timesum[$row['Talkgroup']] =$timesum[$row['Talkgroup']] -$row["sum(UNIX_TIMESTAMP(`Time`))"];
            
//             echo $row['Talkgroup'];
//             echo "<pre>";
//             var_dump($timesum[$row['Talkgroup']] );
            
            
            
            if ($timesum[$row['Talkgroup']] > 3600)
            {
                $correction =  strtotime($day);
                $correction = $correction+ mktime(($timel),0,0,01,01,1970);
                
                $timesum[$timel] = $timesum[$timel]- $correction;
                
            }
            
            if($timesum[$row['Talkgroup']] <0 )
            {
                $correction =  strtotime($day);
                
                $correction = $correction+ mktime(($timel),0,0,01,01,1970);
                $timesum[$row['Talkgroup']] = $timesum[$row['Talkgroup']] + $correction;
                // check if time is db erroer correct          
            }
           
            
            
            

            if($timesum[$row['Talkgroup']] >= 0 && $timesum[$row['Talkgroup']] <= 3600)
            {
                $timesums[$timel] =$timesums[$timel] + $timesum[$row['Talkgroup']];
                
            }
            else
            {
                // clear incorect data disable if debuging
                $timesum[$row['Talkgroup']]=0;
            }
            
          

            
            
        }
         */

            
        $json_array[$timel] ["Second"] = secondsToDHMS($timesums[$timel]);
        $json_array[$timel] ["unixtime"] = $timesums[$timel];
        $json_array[$timel] ["TG"]= $timesum;
        
        
        

    }


    
    echo json_encode ($json_array);

    


    
}
else 
{
        
    
    
    $json_array= array();
    $day = $link->real_escape_string($day);
    $time_string ="`Time` BETWEEN '$day 00:00:00.000000' AND '$day 23:59:59.000000'";
    
    //$sql_active ="SELECT sum(Talktime), `Talkgroup` FROM ReflectorNodeLog WHERE `Type` = '1' $station_query AND  `Active` ='1' AND $time_string group by  `Talkgroup`";
    
    $sql_nonactive ="SELECT sum(Talktime), `Talkgroup` FROM ReflectorNodeLog WHERE `Type` = '1'$station_query AND `Active` ='0' AND $time_string group by  `Talkgroup` ";
    
    /*echo $sql_active;
    echo "<br>";
    */

    $sqla = $link->query($sql_nonactive);
    $timesum =array();
    
    while($row = $sqla->fetch_assoc()) {
        $timesum[$row["Talkgroup"]] =$row["sum(Talktime)"];
    }

    $result = mysqli_query($link, "SELECT `Talkgroup` FROM `ReflectorNodeLog` GROUP BY `Talkgroup` ");
    
    
    
    // Numeric array
    //echo "<br />";
    // Associative array
    $json_array = array();
    
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $json_array[$row["Talkgroup"]] ["Second"] = secondsToDHMS($timesum[ $row["Talkgroup"]]);
        $json_array[$row["Talkgroup"]] ["unixtime"] = $timesum[ $row["Talkgroup"]];
    
    }
    echo json_encode ($json_array);
}

?>