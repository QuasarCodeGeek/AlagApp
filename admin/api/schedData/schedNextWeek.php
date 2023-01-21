<?php
                  require("connector.php");
                  $m=strtotime("next week monday");
                  $M = date("Y-m-d", $m);
                  $t=strtotime("next week tuesday");
                  $T = date("Y-m-d", $t);
                  $w=strtotime("next week wednesday");
                  $W = date("Y-m-d", $w);
                  $th=strtotime("next week thursday");
                  $TH = date("Y-m-d", $th);
                  $f=strtotime("next week friday");
                  $F = date("Y-m-d", $f);
                  $s=strtotime("next week saturday");
                  $S = date("Y-m-d", $s);
                  $sun=strtotime("next week sunday");
                  $Sun = date("Y-m-d", $sun);

                  $sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_petprofile.petname
                  FROM ((alagapp_db.tbl_scheduler
                  INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
                  INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
                  WHERE qdate = '".$M."' OR
                  qdate = '".$T."' OR
                  qdate = '".$W."' OR
                  qdate = '".$TH."' OR
                  qdate = '".$F."' OR
                  qdate = '".$S."' OR
                  qdate = '".$Sun."'
                  ORDER BY qdate ASC, qtime ASC";
              
                  $res = $connect->prepare($sql);
                  $res->execute();
              ?>
                <h3 class="fw-bold text-success">Next Week</h3>
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