<?php
$vax = "SELECT alagapp_db.tbl_carddetail.*,
alagapp_db.tbl_vaxxinfo.vaxname
FROM alagapp_db.tbl_carddetail
INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_carddetail.vaxid = alagapp_db.tbl_vaxxinfo.vaxid
WHERE petid = ".$row['petid']."";

$resvax = $connect->prepare($vax);
$resvax->execute();

if($resvax->rowCount()>0){
$j=1;?>
    <div class="bg bg-light rounded p-2"><table class="table table-striped">
      <thead>
      <tr>
      <th>Date</th>
      <th>Wt(Kg)</th>
      <th>Vaccine</th>
      <th>Veterinarian</th>
      <th></th>
      </tr>
      </thead>
      <tbody>
        <?php
          while($rowvax = $resvax->fetch(PDO::FETCH_ASSOC)){
            echo "
            <tr>
              <td>".$rowvax['cdate']."</td>
              <td>".$rowvax['cweight']."</td>
              <td>".$rowvax['vaxname']."</td>
              <td>".$rowvax['cvet']."</td>
              <td>
                <button type='button' class='btn btn-warning rounded flex-end' onClick='cardEdit(".$rowvax['cid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
                <i class='bi bi-pencil-square'></i></button>
              </td>
            </tr>
            ";
            $j++;
          }
        ?>
      </tbody>
    </table></div>
  <?php 
  echo "<div class='row m-2'><button type='button' class='btn btn-info' onClick='cardNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
  <i class='bi bi-plus-square'></i>
  Add Vaccination</button></div>";
} else {
echo "<div class='row m-2 bg bg-light rounded'><label class='p-2 text-center '>No Record</label></div>";
echo "<div class='row m-2'><button type='button' class='btn btn-info' onClick='cardNew(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
<i class='bi bi-plus-square'></i>
Add Vaccination</button></div>";
}
?>