<?php
  require('db.php');
  if($_REQUEST['animal']==1){
  $animal = $con->prepare("SELECT * FROM `statedepartment` WHERE `ministry_id` = '$_REQUEST[animal_group]'") or die(mysqli_error());
    echo '<option value = "">Select State department</option>';
  if($animal->execute()){
    $a_result = $animal->get_result();
  }
    while($f_animal = $a_result->fetch_array()){
      echo '<option value = "'.$f_animal['id'].'">'.$f_animal['statedepartment_name'].'</option>';
    }
  }
  else
  {

  $animal = $con->prepare("SELECT * FROM organizations WHERE `ministry_id` = '$_REQUEST[animal_group]'") or die(mysqli_error());
    echo '<option value = "">Select Agency</option>';
  if($animal->execute()){
    $a_result = $animal->get_result();
  }
    while($f_animal = $a_result->fetch_array()){
      echo '<option value = "'.$f_animal['id'].'">'.$f_animal['organization_name'].'</option>';
    }
  }

   
?>