<?php
include "../config.php";
include '../function.php';
define_settings();


    
    $Reflector_link =  mysqli_connect($reflector_db_host, $reflector_db_user, $reflector_db_password , $reflector_db_db);
    mysqli_set_charset($Reflector_link,"utf8");
    if($_POST['newuser'] == 1)
    {
        
        
        $Reflector_link->begin_transaction();
        $Reflector_link->autocommit(FALSE);
        
        // prepare statement (for multiple inserts) only once
        
        $username =   $Reflector_link->real_escape_string($_POST['Callsign']);
        $passwd   =   $Reflector_link->real_escape_string($_POST['Password']);
        $mail   =      $Reflector_link->real_escape_string($_POST['email']);
        $description   =   $Reflector_link->real_escape_string($_POST['Description']);
   
        $active=0;
        
        $result = mysqli_query($Reflector_link, "SELECT user FROM `users` where user ='$username'  ");
        $user ="";
        while($row = $result->fetch_assoc())
        {
            $user =  $row['user'];
            
        }
        var_dump($user);
        
        
        
        if(!$user)
        {
        
            $Reflector_link->query("INSERT INTO `users` (`id`, `user`, `password`, `active`,`description`,`e-mail`) VALUES (NULL, '$username', '$passwd', '$active', '$description', '$mail'); ");
            
            $Reflector_link->commit();
            $Reflector_link->close();
        }
    }
    if($_POST['uservalidate'] == 1)
    {
        $username =   $Reflector_link->real_escape_string($_POST['user']);
       

        $result = mysqli_query($Reflector_link, "SELECT user FROM `users` where user ='$username'  limit 1");
        
        while($row = $result->fetch_assoc())
        {
            echo $row['user'];
            
        }
        
        
        
    }


    
    
    
    



?>
