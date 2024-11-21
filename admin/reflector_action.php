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
        
        $username =   $Reflector_link->real_escape_string($_POST['usern']);
        $passwd   =   $Reflector_link->real_escape_string($_POST['password']);
        $active   =   $Reflector_link->real_escape_string($_POST['Enable']);
        $mail   =      $Reflector_link->real_escape_string($_POST['mail']);
        $description   =   $Reflector_link->real_escape_string($_POST['description']);
        if($active !="1")
        {
            $active=0;
        }

        
        
        
        $Reflector_link->query("INSERT INTO `users` (`id`, `user`, `password`, `active`,`description`,`e-mail`) VALUES (NULL, '$username', '$passwd', '$active', '$description', '$mail'); ");

        $Reflector_link->commit();
        $Reflector_link->close();
    }
    if($_POST['userdel'] == 1)
    {
        if($_SESSION['is_admin'] >0 && $_SESSION['loginid'] >0 ){
            $Reflector_link->begin_transaction();
            $Reflector_link->autocommit(FALSE);
            
            // prepare statement (for multiple inserts) only once
            
            $urid= $link->real_escape_string($_POST['userid']);
    
            
            
            
            $Reflector_link->query("DELETE FROM `users` WHERE `users`.`id` = '$urid'");
            
            $Reflector_link->commit();
            $Reflector_link->close();
        }
        
    }
    if($_POST['change_password'] == 1)
    {
        if($_SESSION['is_admin'] >0 && $_SESSION['loginid'] >0 ){
        
            $Reflector_link->begin_transaction();
            $Reflector_link->autocommit(FALSE);
            
            // prepare statement (for multiple inserts) only once
            
            $urid= $Reflector_link->real_escape_string($_POST['user_id']);
            $passwd= $Reflector_link->real_escape_string($_POST['password']);
    
           
            
            $Reflector_link->query("UPDATE `users` SET `password` = '$passwd' WHERE `id` = '$urid'; ");
            
            $Reflector_link->commit();
            $Reflector_link->close();
        }
        
    }
    if($_POST['change_active'] == 1)
    {
        if($_SESSION['is_admin'] >0 && $_SESSION['loginid'] >0 ){
            
      
            $Reflector_link->begin_transaction();
            $Reflector_link->autocommit(FALSE);
            
            // prepare statement (for multiple inserts) only once
            
            $urid = $Reflector_link->real_escape_string($_POST['user_id']);
            $active = $Reflector_link->real_escape_string($_POST['Enable']);
            echo $active;
    
            if($active !="1")
            {
                $active=0;
            }
            
            
            
            
            $Reflector_link->query("UPDATE `users` SET `active` = '$active' WHERE `id` = '$urid'; ");
            
            $Reflector_link->commit();
            $Reflector_link->close();
        
        }
        
    }

    if($_POST['send_msg'] == "1")
    {
        if($_SESSION['is_admin'] >0 && $_SESSION['loginid'] >0 )
        {
            
        
            $userid =   $Reflector_link->real_escape_string($_POST['user_id']);
            
            $email_address ="";
            
            $result = mysqli_query($Reflector_link, "SELECT `e-mail` FROM `users` WHERE `id` = $userid ");
            
            while($row = $result->fetch_assoc())
            {
    
                $email_address = $row['e-mail'];
                
            }
            
            
            
            $subject = 'Mesage from svxportal Admin';
            $message = $_POST['msg'];
            $headers = 'From: '.SYSTEM_MAIL.'' . "\r\n" .
                'Reply-To: '.SYSTEM_MAIL.'' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            
            mail($email_address, $subject, $message, $headers);
            echo "success";
        }
        
        
    }
    
    if($_POST['Send_password'] == 1)
    {
        if($_SESSION['is_admin'] >0 && $_SESSION['loginid'] >0 )
        {
            
            
            $userid =   $Reflector_link->real_escape_string($_POST['user_id']);
            
            
            $result = mysqli_query($Reflector_link, "SELECT * FROM `users` WHERE `id` = $userid ");
            
            while($row = $result->fetch_assoc())
            {
                $server =REFLECTOR_SERVER_ADDRESS;
                $user =$row['user'];
                $password = $row['password'];
                $port =REFLECTOR_SERVER_PORT;
                
                $msg = "This mail contains login credentials for the svxreflector \r\n";
                $msg.="Server address : $server       \r\n";
                $msg.="Server port   : $port       \r\n";
                
                $msg.="Username: $user \r\n";
                $msg.="Password: $password \r\n\r\n";
         
    
    
    
    
    
    
    
    
                EOT;
                
                
                $subject = 'Login credentials from svxportal Admin';
                $message = $msg;
                $headers = 'From: '.SYSTEM_MAIL.'' . "\r\n" .
                    'Reply-To: '.SYSTEM_MAIL.'' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                
                mail($row['e-mail'], $subject, $message, $headers);
                echo "success";
                
                
                
                
                
            }
        }
        
        
    }
    
    
    


?>
