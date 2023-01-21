<?php
                  require("connector.php");
                  $d=strtotime("tomorrow");
                  $tomorrow = date("Y-m-d", $d);

                  if(isset($_POST["submit"])){
                    $user = $_POST['user'];
                    $status = $_POST['status'];

                    if($user != ""){
                      $owner = "alagapp_db.tbl_scheduler.userid = ".$user."";
                    } else {
                      $owner = "";
                    }

                    if($user != "" && $status !=""){
                      $stat = "AND qstatus = '".$status."'";
                    } else if($user == "" && $status !=""){
                      $stat = "qstatus = '".$status."'";
                    } else {
                      $stat = "";
                    }
                  }


                  $sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_petprofile.petname
                  FROM ((alagapp_db.tbl_scheduler
                  INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
                  INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
                  WHERE ".$owner." ".$stat."
                  AND qdate = '".$tomorrow."' 
                  ORDER BY qtime ASC";
              
                  $res = $connect->prepare($sql);
                  $res->execute();
              ?>
                <h3 class="fw-bold text-success">Tomorrow</h3>
                <ul class="list-group list-group-horizontal position-relative overflow-auto wh-100">
                <?php 
          
          if($res->rowCount()>0){
              $i=1;
              while($row = $res->fetch(PDO::FETCH_ASSOC)){
              echo
              "<li class='list-group-item p-3'>
                <div class='m-2' style='width: 25rem;'>
                <div class='row m-auto mb-2 p-2 border border-2 border-success rounded'><div class='col-6 m-auto mx-auto'>
                <div class='row m-auto text-center'>
                  <h4 class='m-auto fw-bold text-success'>".$row['petname']."</h4>
                </div>
              </div>
              <div class='col-6'>
                <div class='row m-auto'>
                  <label class='flex-end' style='font-size: 12px;'>Date: ".date("M-d-Y",strtotime($row['qdate']))."</label>
                </div>
                <div class='row m-auto'>
                  <label class='flex-end' style='font-size: 12px;'>Time: ".date("h:i a",strtotime($row['qtime']))."</label>
                </div>
              </div></div>
              <div class='row m-auto'>
                <p class='fst-italic' style='font-size: 12px;'>Owner: ".$row['userfname']."</p>
                <p style='font-size: 12px;'>Description: ".$row['qdescription']."</p>
              </div>";
                
                if($row['qstatus'] == "Pending"){
                  echo "<div class='bg bg-info rounded-pill p-2 text-center'>";
                } else if ($row['qstatus'] == "Accepted"){
                  echo "<div class='bg bg-success rounded-pill p-2 text-center'>";
                } else if ($row['qstatus'] == "Finished"){
                  echo "<div class='bg bg-primary rounded-pill p-2 text-center'>";
                } else if ($row['qstatus'] == "Cancelled"){
                  echo "<div class='bg bg-danger rounded-pill p-2 text-center'>";
                } else if ($row['qstatus'] == "Denied"){
                  echo "<div class='bg bg-secondary rounded-pill p-2 text-center'>";
                }
                echo "
                  <label class='card-text fw-bold text-white' style='font-size: 12px;'>".$row['qstatus']."</label>
                </div>
                </div>

                      <button type='button' class='btn btn-warnign w-100' onClick='schedEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>
                      <i class='bi bi-pencil-square'></i> Edit</button>
              </li>";
              $i++;
              }
          } else {
            echo "<div class='card card-body'>
            <label>Nothing here!</label>
            </div>";
          }
          ?>
            </ul>