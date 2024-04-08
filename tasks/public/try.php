<?php
  include('db.php');
  $animal = $con->prepare("SELECT * FROM `organizations` WHERE `ministry_id` = '$_REQUEST[animal]'") or die(mysqli_error());
    echo '<option value = "">Select state Agency</option>';
  if($animal->execute()){
    $a_result = $animal->get_result();
  }
    while($f_animal = $a_result->fetch_array()){
      echo '<option value = "'.$f_animal['id'].'">'.$f_animal['organization_name'].'</option>';
    }

   
?>