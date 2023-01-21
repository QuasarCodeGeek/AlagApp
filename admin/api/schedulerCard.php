<?php
require("connector.php");

$userid = $_REQUEST['userid'];?>

    <div class="row m-auto"><!-- Chat Header -->
        <div class="border border-3 border-success text-success rounded-pill pt-2">
          <?php
            $pr = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$userid."";
            $pres = $connect->query($pr);
            $pres->execute();
            $_rowe = $pres->fetch(PDO::FETCH_ASSOC);
          ?>
          <img class="mb-2 ms-2  me-2 rounded-circle" src="../../assets/uploads/<?php echo $_rowe['userpict']; ?>" alt="" style="width: 3rem; height: 3rem;"> 
          <label><h4><?php echo $_rowe['userfname']." ".$_rowe['userlname']; ?></h4></label>
          <div class="float-end m--auto mx-auto">
            <button class="btn btn-primary fw-bold text-white rounded-pill m-1" onClick='scheduleNew(<?php echo $_rowe['userid']?>)' data-bs-toggle='modal' data-bs-target='#newModal')>
            <i class="bi bi-plus-square"></i> Add Schedule</button>
          </div>
        </div>
    </div><!-- Chat Header -->

      <?php
$sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_petprofile.petname
FROM ((alagapp_db.tbl_scheduler
INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
WHERE alagapp_db.tbl_scheduler.userid = ".$userid." ORDER BY qdate, qtime ASC";

$res = $connect->prepare($sql);
$res->execute();

echo "<div class='row m-auto mt-2'>";
          
              if($res->rowCount()>0){
                  $i=1;
                  while($row = $res->fetch(PDO::FETCH_ASSOC)){
                  echo
                  "<div class='col-3'><div class='card m-1 p-1 col-flex' style='width: 15rem;'>
                      <div class='card-body'>
                        <button type='button' class='btn btn-success w-100' onClick='SchedEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>
                            <h6 class='card-title m-auto my-auto'>".$row['petname']."
                            <i class='bi bi-pencil-square'></i></h6>
                        </button><br>
                          <label class='card-text' style='font-size: 12px;'>Owner: ".$row['userfname']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Description: ".$row['qdescription']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Time: ".date("h:i a",strtotime($row['qtime']))."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Date: ".date("M-d-Y",strtotime($row['qdate']))."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Status: ".$row['qstatus']."</label>
                      </div>
                  </div>
                  </div>";
                  $i++;
                  }
              }  else {
                  echo "
                  </div>";
              }
              echo "</div>";
                ?>