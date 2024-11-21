<?php
include_once '../config.php';
include_once '../function.php';
set_language();
mysqli_set_charset($link,"utf8");

if(  $_SESSION['loginid'] >0 )
{
    
    if($_POST['station_id'] >= 0 && check_permission_station_RW($_POST['station_id'],$_SESSION['loginid']) >0 )
    {
        
        $link->begin_transaction();
        $link->autocommit(FALSE);
        
        // prepare statement (for multiple inserts) only once
        $stid= $link->real_escape_string($_POST['station_id']);
        $commnd= $link->real_escape_string($_POST['command']);
        $date= $link->real_escape_string($_POST['date']);

        $sql ="SELECT `Callsign` FROM ReflectorStations where ID='$stid'";
        $result = $link->query($sql);
        $station_name ="";

        while($row = $result->fetch_assoc())
        {
            $station_name= $row["Callsign"];
     
        }
        
        
        
        $link->query("INSERT INTO `Commands_to_node` (`Node`, `Command`, `action`, `Execute time`) VALUES ( '$station_name', '$commnd', '1', '$date');");
        
        $link->commit();
        $link->close();
        
    }
    
    
}
      
