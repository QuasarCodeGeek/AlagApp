<?php
$vax = "SELECT alagapp_db.tbl_carddetail.*,
alagapp_db.tbl_vaxxinfo.vaxname
FROM alagapp_db.tbl_carddetail
INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_carddetail.vaxid = alagapp_db.tbl_vaxxinfo.vaxid
WHERE petid = ".$row['petid']." ORDER BY cid DESC";

$resvax = $connect->prepare($vax);
$resvax->execute();

if($resvax->rowCount()>0){
$j=1;?>
    <div class="bg bg-light rounded p-2 overflow-auto overflow-y" style="height: 35rem;"><table class="table table-striped">
      <thead>
      <tr>
      <th>Date</th>
      <th>Due Date</th>
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
              <td>".date("M d,Y", strtotime($rowvax['cdate']))."</td>
              <td>".date("M d,Y", strtotime($rowvax['cnext']))."</td>
              <td>".$rowvax['cweight']."</td>
              <td>".$rowvax['vaxname']."</td>
              <td>".$rowvax['cvet']."</td>
              <td>
                <button type='button' class='btn btn-warning rounded' onClick='cardEdit(".$rowvax['cid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
                <i class='bi bi-pencil-square'></i></button>
                <button type='button' class='btn btn-danger rounded' data-bs-toggle='modal' data-bs-target='#delCard'>
                <i class='bi bi-trash'></i></button>
                <!-- Modal Del Card -->
                      <div class='modal fade' id='delCard' data-bs-backdrop='static' tabindex='-1' aria-labelledby='ModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h1 class='modal-title fs-5 text-danger' id='ModalLabel'>Delete Vaccination Data</h1>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <form action='./deleteData/deleteCard.php' method='POST'><div class='modal-body d-grid gap-2 container-fluid text-danger text-center' id='modalHere'>
                              Deleting this record will permanently erase the data. Are you sure you want to delete this record?
                              <input name='userid' value='".$rowvax['userid']."' hidden></input>
                              <input name='cid' value='".$rowvax['cid']."' hidden></input>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                              <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                            </div></form>
                          </div>
                        </div>
                      </div>
                    <!-- Modal Del Card -->
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