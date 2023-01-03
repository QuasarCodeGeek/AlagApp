<?php
require("connector.php");

$userid = $_REQUEST['userid'];

$sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_petprofile.petname
FROM ((alagapp_db.tbl_scheduler
INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
WHERE alagapp_db.tbl_scheduler.userid = ".$userid." ";

$res = $connect->prepare($sql);
$res->execute();

echo "<div class='row m-auto'>";
          
              if($res->rowCount()>0){
                  $i=1;
                  while($row = $res->fetch(PDO::FETCH_ASSOC)){
                  echo
                  "<div class='col-3'><div class='card m-1 p-1 col-flex' style='width: 15rem;'>
                      <div class='card-body'>
                        <button type='button' class='btn btn-success w-100' onClick='schedEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$row['petname']."</h6></button><br>
                          <label class='card-text' style='font-size: 12px;'>Owner: ".$row['userfname']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Description: ".$row['qdescription']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Date: ".$row['qdate']."</label><br>
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