<?php
  include_once("db.php");

  $id = $_POST["alterId"];


//TODO this will need to be updated when data field names are changed
                foreach($_POST as $key=>$value){
                  if($key != 'id'){
                    $keyMod = str_replace('_', ' ', $key);
                    $mysqli->query("UPDATE `test2` SET `$keyMod`='$value' WHERE id=$id and '$value' is not null and '$value' <> ''" );
                  }
                }



header( 'Location: http://localhost' ) ;

  ?>
