<?php
include_once '../config.php';
include_once '../function.php';
set_language();
mysqli_set_charset($link,"utf8");

if($_SESSION['is_admin'] >0 && $_SESSION['loginid'] >0 ){
    
    $result = mysqli_query($link, "SELECT * FROM `users` ");
    
    
    
    while($row = $result->fetch_assoc()) {
        $idarray= array();
        ?>
          
          <tr>
          <th scope="row"><?php echo $row['id']?></th>
          <?php 
          if($row['image_url'] == null)
              $row['image_url'] ="user.svg"; 
           
          ?>
          <td><img onclick="expand_image(this.src)" class"img-fluid" src="<?php echo $row['image_url']?>" width="30px;"></td>
      
          <td><?php echo $row['Firstname']?></td>
          <td><?php echo $row['lastname']?></td>
          <td><?php echo $row['Username']?></td>
          <td><a  class="link-primary"  target="_blank" href="mailto:<?php echo $row['email']?>"><?php echo $row['email']?></a></td>
        <?php   if($row['Is_admin'] == 1){?>
          <td><?php echo _('Yes')?></td>
        <?php }else{?>
          <td><?php echo _('No')?></td>
        <?php }?>
        
       <td>

<select  name="station" class="form-control" id="station_permission" onchange="change_permission(this.value,<?php echo $row['id']?>)">
 <option value=""> <?php echo _('- Select station -')?></option>
  <optgroup label="<?php echo _('User granted'); ?>">
  
<?php 
$user_id= $row['id'];
$result1 = mysqli_query($link, "SELECT * FROM User_Permission LEFT JOIN ReflectorStations ON ReflectorStations.ID = User_Permission.station_id WHERE User_Permission.User_id ='$user_id' ");



// Associative array
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) 
{    
    
    $idarray[]=$row1['station_id'];
    
    if($row1['RW'] == 0)
    {
        $rostr = ' ('._('Read only').')';
    }
    else
    {
        $rostr="";
    }
    
    
?>
    <option value="<?php echo $row1['ID'];?>"> <?php echo $row1['Callsign'].'' .$rostr;?></option>
<?php }?>
   <optgroup label="<?php echo _('User not granted'); ?>">
   
<?php 

  $idin= join(",",$idarray);

if(sizeof ($idarray) == 0)
    $result2 = mysqli_query($link, "SELECT * FROM `ReflectorStations`  WHERE Callsign !='' ");
else
{
    $result2 = mysqli_query($link, "SELECT * FROM `ReflectorStations`  WHERE ID NOT IN(".$idin.") AND Callsign !='' ");
    unset($idarray);
}

// Associative array
while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) 
{    
?>
<option value="<?php echo $row2['ID'];?>"> <?php echo $row2['Callsign'];?></option>

<?php }?>
  </optgroup>
</select>

  
     </td>
          <td><i class="fas fa-trash" onclick="Delete_user(<?php echo $row['id']?>)"></i> <i onclick="change_password(<?php echo $row['id']?>)" class="fas fa-key"></i> </td>
          </tr>
          
          
    <?php }?>
      
   <?php }?>