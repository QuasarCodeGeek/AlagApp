<?php
$note = "SELECT * FROM alagapp_db.tbl_notedetail
WHERE petid = ".$row['petid']." ORDER BY nid DESC";

$resnote = $connect->prepare($note);
$resnote->execute();

if($resnote->rowCount()>0){
$p=1;
echo "<div class='overflow-auto overflow-y' style='height: 35rem;'>";
while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){
  echo"<div class='row m-2 p-2 bg bg-light rounded'>
          <div class='col-10 m-auto my-auto'>
            <label>Date: ".date("M d,Y", strtotime($rownote['ndate']))."</label><br>
            <label>Vet: ".$rownote['nvet']."</label>
          </div>
          <div class='col-2'>
            <button type='button' class='btn btn-warning rounded' onClick='prescriptionEdit(".$rownote['nid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
            <i class='bi bi-pencil-square'></i></button>
            <button type='button' class='btn btn-danger rounded' data-bs-toggle='modal' data-bs-target='#delNote'>
            <i class='bi bi-trash'></i></button>
                <!-- Modal Del Note -->
                      <div class='modal fade' id='delNote' tabindex='-1' aria-labelledby='ModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h1 class='modal-title fs-5 text-danger' id='ModalLabel'>Delete Prescription Data</h1>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <form action='./deleteData/deleteNote.php' method='POST'><div class='modal-body d-grid gap-2 container-fluid text-danger text-center' id='modalHere'>
                              Deleting this record will permanently erase the data. Are you sure you want to delete this record?
                              <input name='userid' value='".$rownote['userid']."' hidden></input>
                              <input name='nid' value='".$rownote['nid']."' hidden></input>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                              <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                            </div><form>
                          </div>
                        </div>
                      </div>
                    <!-- Modal Del Card -->
          </div>

        <div class='col-12 p-2 border border-2 border-success rounded mt-2'>
          <label class='col-12'>Description: ".$rownote['ndescription']."</label>
        </div>
      </div>";
      $p++;
    }
    echo "</div>
    <div class='row m-2'><button type='button' class='btn btn-info' onClick='noteNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
    <i class='bi bi-plus-square'></i>
    Add Prescription</button></div>";
} else {
    echo "<div class='row m-2 bg bg-light rounded'><label class='p-2 text-center '>No Record</label></div>";
    echo "<div class='row m-2'><button type='button' class='btn btn-info' onClick='noteNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
    <i class='bi bi-plus-square'></i>
    Add Prescription</button></div>";
}
?>