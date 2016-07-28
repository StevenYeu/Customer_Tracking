<!DOCTYPE html>
<html>

<?php

  $FIELDS = array("Client","Rack Space", "Megabit", "Internet Connector Fee", "Labor Charge", "Yearly Cost");
  $NUM_FIELDS = 6;
  include_once("myPHP/db.php");

echo '<head>
        <link rel="stylesheet" type="text/css" href="css/custom.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/af-2.1.2/b-1.2.1/b-colvis-1.2.1/b-print-1.2.1/cr-1.3.2/fc-3.2.2/fh-3.1.2/r-2.1.0/sc-1.4.2/se-1.2.0/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/af-2.1.2/b-1.2.1/b-colvis-1.2.1/b-print-1.2.1/cr-1.3.2/fc-3.2.2/fh-3.1.2/r-2.1.0/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script src="js/test.js"></script>
    </head>';

echo `<body>
      <div class="container">`;

/* Adds the buttons */
echo '<div class = "btn-toolbar">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalNorm">
       Add
     </button>
     <form id="myFormDel" action="/myPHP/deleteData.php" method="post">
     <input name="deleteId" id="deleteId" type="int" hidden="true">
     <button type="button" class="btn btn-danger btn-sm">Delete</button> </form>
     <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit">
      Edit
    </button>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalNormCol">
     Add Column
   </button>
   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalNormColDelete">
       Remove Column
   </button>
     </div>
';



echo '<!-- Modal -->
  <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add New Entry
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form id="myForm" action="myPHP/postData.php" method="post">';

                $sql = "SHOW COLUMNS FROM test2";
                $result = $mysqli->query($sql);
                while($row = $result->fetch_array()){
                  if($row['Field'] != 'id'){
                    echo '<div class="form-group">';
                    echo '<label for=',$row['Field'],"input>",$row['Field'],'</label>';
                    echo '<input type="',$row['Field'],'"', ' name="', $row['Field'],'" class="form-control" id =',$row['Field'],'input placeholder=""','/>';
                    echo '</div>';
                  }
                }
            echo '<div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </div></form>';
            echo '</div>';

            echo '<!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
        </div>
    </div>
</div>';


// Add Colum Modal
echo '<!-- Modal -->
<div class="modal fade" id="myModalNormCol" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add New Entry
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form id="addColumnForm" action="myPHP/addColumn.php" method="post">';
                    $newCol = "New Column Name";
                    $dataType = "Input Type";

                    echo '<div class="form-group">';
                    echo '<label for=', "$newCol","input>","$newCol",'</label>';
                    echo '<input name="', "col",'" class="form-control" id =',$newCol,'input placeholder=""','/>';

                    echo '<label for=', "DataType","input>","$dataType",'</label>';
                    echo  '<select class="form-control" name="DataType">
                           <option>Text</option>
                           <option value="Long">Numeric</option>
                           <option>Date</option>
                           </select>';

                    echo '</div>';


            echo '<div>
                  <button type="submit" class="btn btn-default">Submit</button>
                  </div></form>','</div>';

            echo '<!-- Modal Footer -->
            <div class="modal-footer">',

                '<button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
        </div>
    </div>
</div>';

// For Deleteing Columns
echo '<!-- Modal -->
 <div class="modal fade" id="myModalNormColDelete" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Select Column to Remove
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form id="removeColumnForm" action="myPHP/removeColumn.php" method="post">';

                echo '<select class="form-control" name="delCol">';
                echo '<option> Select Column </option>';
                    $newCol = "Delete Column";
                    $sql = "SHOW COLUMNS FROM test2";
                    $result = $mysqli->query($sql);
                    while($row = $result->fetch_array()){
                      if($row['Field'] != 'id'){
                        echo '<option>', $row['Field'],'</option>';
                      }
                    }

            echo '</select>','<div>
                              <button type="submit" class="btn btn-default">Submit</button>
                            </div></form></div>';


            echo '<!-- Modal Footer -->
            <div class="modal-footer">',

                '<button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
        </div>
    </div>
</div>';


/* Form for Updating Entry */
echo '<!-- Modal -->
 <div class="modal fade" id="edit" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add New Entry
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form id="myEdit" action="myPHP/updateData.php" method="post">
                <input name="alterId" id="alterId" type="int" hidden="true">';
                $data = $mysqli->query("SELECT * FROM `test2` WHERE 1");
                 while ($val = $data->fetch_field()){
                   if ($val->name != 'id') {
                      echo '<div class="form-group">';
                      echo '<label for=',$val->name,"input>",$val->name,'</label>';
                      echo '<input type="',$val->name,'"', 'name="', $val->name,'" class="form-control" id =',$val->name,'input placeholder=""','/>';
                      echo '</div>';
                   }

                 }
            echo '<div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </div></form>';
            echo '</div>';

            echo '<!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
        </div>
    </div>
</div>';





echo '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class="thead-inverse">
        <tr>';
/* Generate table headers */
    $data = $mysqli->query("SELECT * FROM `test2` WHERE 1");
    while($obj = $data->fetch_field()){
      if($obj->name != "id")
       echo '<th>', $obj->name, '</th>';
    }

    echo `<th style="width: 36px;"></th>`;

echo  '</tr></thead>';

/*Genearte table footer*/
echo '<tfoot><tr>';
$data = $mysqli->query("SELECT * FROM `test2` WHERE 1");
while($obj = $data->fetch_field()){
  if($obj->name != "id")
   echo '<th>', $obj->name, '</th>';
}

echo  '</tr></tfoot>';


echo '<tbody>';

$data = $mysqli->query("SELECT * FROM `test2` WHERE 1");
  $rowNum = 0;
  while($stuff = $data->fetch_row()){
    $rowNum = $rowNum + 1;
   $data->data_seek($rowNum - 1);
    $stuff2 = $data->fetch_assoc();
    //echo $stuff2["id"];
    echo "<tr onclick='highlight(id)' id='$stuff2[id]'>";
    $counter = 0;
    while($counter < $data->field_count){
      if($stuff[$counter] != $stuff2["id"])
      echo '<td>', $stuff[$counter], '</td>';
      $counter = $counter + 1;
    }
    echo '</tr>';
  }

   echo '</tbody></table>';
   echo '</div></body>';

  ?>

</html>
