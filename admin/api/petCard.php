<?php
$vax = "SELECT alagapp_db.tbl_carddetail.*,
alagapp_db.tbl_vaxxinfo.vaxname
FROM alagapp_db.tbl_carddetail
INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_carddetail.vaxid = alagapp_db.tbl_vaxxinfo.vaxid
WHERE petid = ".$row['petid']."";

$resvax = $connect->prepare($vax);
$resvax->execute();

if($resvax->rowCount()>0){
$j=1;
while($rowvax = $resvax->fetch(PDO::FETCH_ASSOC)){
  echo"
  <div class='row m-2 p-2 bg bg-light rounded'>
    
    <div class='col-6'>
      <label>Vaccine: ".$rowvax['vaxname']."</label><br>
      <label>Veterinarian: ".$rowvax['cvet']."</label>
    </div>
    <div class='col-4'>
      <label>Weight(Kg): ".$rowvax['cweight']."</label><br>
      <label>Date: ".$rowvax['cdate']."</label>
    </div>
    <div class='col-2'>
      <button type='button' class='btn btn-info w-100 h-100' onClick='cardEdit(".$rowvax['cid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
      <i class='bi bi-pencil-square'></i></button>
    </div>
  </div>";
  $j++;
}
  echo "<div class='row m-2'><button type='button' class='btn btn-light' onClick='cardNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
  <i class='bi bi-plus-square'></i>
  Add Vaccination</button></div>";
} else {
echo "<div class='row m-2 bg bg-light rounded'><label class='p-2 text-center '>No Record</label></div>";
echo "<div class='row m-2'><button type='button' class='btn btn-light' onClick='cardNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
<i class='bi bi-plus-square'></i>
Add Vaccination</button></div>";
}
?>