<?php
                  require("connector.php");
                  $d=strtotime("+1 month");
                  $month = date("m", $d);

                  $sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_petprofile.petname
                  FROM ((alagapp_db.tbl_scheduler
                  INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
                  INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
                  WHERE qdate LIKE '%-".$month."-%' ORDER BY qdate ASC, qtime ASC";
              
                  $res = $connect->prepare($sql);
                  $res->execute();
              ?>
                <h3 class="fw-bold text-success">Next Month</h3>
                <ul class="list-group list-group-horizontal position-relative overflow-auto wh-100">
                <?php 
          
          if($res->rowCount()>0){
              $i=1;
              while($row = $res->fetch(PDO::FETCH_ASSOC)){
              echo
              "<li class='list-group-item p-3'>
                <div class='m-2' style='width: 25rem;'>
                  <h5>".$row['petname']."</h5>
                      <label class='card-text' style='font-size: 12px;'>Owner: ".$row['userfname']."</label><br>
                      <label class='card-text' style='font-size: 12px;'>Description: ".$row['qdescription']."</label><br>
                      <label class='card-text' style='font-size: 12px;'>Time: ".date("h:i a",strtotime($row['qtime']))."</label><br>
                      <label class='card-text' style='font-size: 12px;'>Date: ".date("M-d-Y",strtotime($row['qdate']))."</label><br>
                      <label class='card-text' style='font-size: 12px;'>Status: ".$row['qstatus']."</label>
                </div>

                      <button type='button' class='btn btn-primary w-100' onClick='schedEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit</button>
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