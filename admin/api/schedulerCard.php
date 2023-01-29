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
          <?php if($_rowe['userpict']!=""){
            echo "<img class='mb-2  ms-2  me-2 rounded-circle' src='../../assets/uploads/".$_rowe['userpict']."' alt='' style='width: 3rem; height: 3rem;'>";
          } else if ($_rowe['usergender'] == 'F'){
            echo "<img class='mb-2  ms-2  me-2 rounded-circle' src='../../assets/default/female.png' alt='' style='width: 3rem; height: 3rem;'>";
          } else {
            echo "<img class='mb-2 ms-2  me-2 rounded-circle' src='../../assets/default/male.png' alt='' style='width: 3rem; height: 3rem;'>";
          }
          ?>
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
                  "<div class='col-6'>
                    <div class='m-auto mb-2 p-2 border border-2 border-success rounded'>
                      <div class='row m-auto mx-auto text-center'>
                        <div class='col-6'>
                          <div class='row m-auto'>
                            <h4 class='m-auto fw-bold text-success'>".$row['petname']."</h4>
                          </div>
                          <div class='row m-auto'>
                            <label class='flext start' style='font-size: 12px;'>Owner: ".$row['userfname']."</label>
                          </div>
                        </div>
                        <div class='col-6'>
                            <div class='row m-auto'>
                              <label class='flex-center' style='font-size: 12px;'>Date: ".date("M-d-Y",strtotime($row['qdate']))."</label>
                            </div>
                            <div class='row m-auto'>
                              <label class='flex-end' style='font-size: 12px;'>Time: ".date("h:i a",strtotime($row['qtime']))."</label>
                            </div>
                        </div>
                      </div>

                      <div class='row m-auto my-2 border border-2 border-success p-2 rounded'>
                        <p style='font-size: 12px;'>Description: ".$row['qdescription']."</p>
                      </div>
                      <div class='row m-auto'>";

                        if($row['qstatus'] == "Pending"){
                          echo "<div class='col-6 bg bg-info rounded-pill p-2 text-center'>";
                        } else if ($row['qstatus'] == "Accepted"){
                          echo "<div class='col-6 bg bg-success rounded-pill p-2 text-center'>";
                        } else if ($row['qstatus'] == "Finished"){
                          echo "<div class='col-6 bg bg-primary rounded-pill p-2 text-center'>";
                        } else if ($row['qstatus'] == "Cancelled"){
                          echo "<div class='col-6 bg bg-danger rounded-pill p-2 text-center'>";
                        } else if ($row['qstatus'] == "Denied"){
                          echo "<div class='col-6 bg bg-secondary rounded-pill p-2 text-center'>";
                        } 

                          echo "<label class='card-text fw-bold text-white' style='font-size: 12px;'>".$row['qstatus']."</label>
                        </div>
                        <div class='col-6'>
                          <button type='button' class='btn btn-warning w-100' onClick='SchedEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>
                          <i class='bi bi-pencil-square'></i> Edit</button>
                        </div>
                      </div>
                    </div>
                  </div>";
                  $i++;
                  }
              }  else {
                  echo "<div class='card p-4'>
                  <label class='fw-bold text-center text-success'>No record<label>
                  </div>";
              }
                ?>