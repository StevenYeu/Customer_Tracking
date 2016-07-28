<?php
  include_once("db.php");

  /* Make a new row and only fill in its id value */
  $mysqli->query("INSERT INTO `test2` (id) VALUES(DEFAULT)");

  /* Get the id of the row that was just added */
  $id = $mysqli->insert_id;

  //TODO this will need to be updated when data field names are changed
  foreach($_POST as $key=>$value){
    $keyMod = str_replace('_', ' ', $key);
    if ($keyMod != "id") {
      $mysqli->query("UPDATE `test2` SET `$keyMod`='$value' WHERE id=$id");
    }
  }


  header( 'Location: http://localhost' ) ;

  ?>
