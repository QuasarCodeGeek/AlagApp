<?php
require("../connector.php");
$search = $_REQUEST['search'];
?>
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Pet</th>
            <th>Owner</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
          <?php include("./../reportData/schedFilter.php");?>
        </thead>
        <tbody>
        <?php
          $note = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname, alagapp_db.tbl_petprofile.petname
          FROM ((alagapp_db.tbl_scheduler
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
          INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
          WHERE
            userfname LIKE '%".$search."%' OR 
            userlname LIKE '%".$search."%' OR
            petname LIKE '%".$search."%' OR
            qdescription LIKE '%".$search."%' OR
            qdate LIKE '%".$search."%' OR
            qstatus LIKE '%".$search."%'";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=1;
            while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rownote['petname']."</td>
              <td>".$rownote['userfname']." ".$rownote['userlname']."</td>
              <td>".$rownote['qdescription']."</td>
              <td>".$rownote['qdate']."</td>
              <td>".$rownote['qstatus']."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan-\"7\">No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>