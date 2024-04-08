<?php
  require('db.php');
  $animal = $con->prepare("SELECT * FROM `statutes` WHERE `status` = '1'") or die(mysqli_error());
    echo '<option value = "">Select here</option>';
  if($animal->execute()){
    $a_result = $animal->get_result();
  }
    while($f_animal = $a_result->fetch_array()){
      echo '<option value = "'.$f_animal['id'].'">'.$f_animal['statutename'].'</option>';
    }

   
?>