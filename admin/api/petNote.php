<?php
$note = "SELECT * FROM alagapp_db.tbl_notedetail
WHERE petid = ".$row['petid']."";

$resnote = $connect->prepare($note);
$resnote->execute();

if($resnote->rowCount()>0){
$p=1;
while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){
  echo"
      <div class='row m-2 p-2 bg bg-light rounded'>
          <div class='col-4 m-auto my-auto'>
            <label>Date: ".$rownote['ndate']."</label>
          </div>
          <div class='col-6 m-auto my-auto'>
            <label>Vet: ".$rownote['nvet']."</label>
          </div>
          <div class='col-2'>
            <button type='button' class='btn btn-warning rounded  float-end' onClick='prescriptionEdit(".$rownote['nid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
            <i class='bi bi-pencil-square'></i></button>
          </div>

        <div class='col-12 p-2 border border-2 border-success rounded mt-2'>
          <label class='col-12'>Description: ".$rownote['ndescription']."</label>
        </div>
      </div>";
      $p++;
    }
    echo "<div class='row m-2'><button type='button' class='btn btn-info' onClick='noteNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
    <i class='bi bi-plus-square'></i>
    Add Prescription</button></div>";
} else {
    echo "<div class='row m-2 bg bg-light rounded'><label class='p-2 text-center '>No Record</label></div>";
    echo "<div class='row m-2'><button type='button' class='btn btn-info' onClick='noteNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
    <i class='bi bi-plus-square'></i>
    Add Prescription</button></div>";
}
?>