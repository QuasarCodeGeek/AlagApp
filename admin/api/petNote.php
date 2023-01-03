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
      <label>Description: ".$rownote['ndescription']."</label><br>
      <label>Date Issued: ".$rownote['ndate']."</label><br>
      <label>Veterinarian: ".$rownote['nvet']."</label>

      <button type='button' class='btn btn-info' onClick='prescriptionEdit(".$rownote['nid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
      <i class='bi bi-pencil-square'></i>
      Edit</button>
        </div>";
        $p++;
    }
    echo "<div class='row m-2 bg bg-light rounded'><button type='button' class='btn btn-light' onClick='noteNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
    <i class='bi bi-plus-square'></i>
    Add Prescription</button></div>";
} else {
    echo "<div class='row m-2 bg bg-light rounded'><label class='p-2 text-center '>No Record</label></div>";
    echo "<div class='row m-2'><button type='button' class='btn btn-light' onClick='noteNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
    <i class='bi bi-plus-square'></i>
    Add Prescription</button></div>";
}
?>