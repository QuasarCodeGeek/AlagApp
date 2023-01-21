<?php
        require("../../connector.php");
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
          <?php include("./../../reportData/schedFilter.php");?>
        </thead>
        <tbody>
        <?php
          $status = $_REQUEST['status'];
          $fdate = $_REQUEST['fdate'];
          $ldate = $_REQUEST['ldate'];
          $month = $_REQUEST['month'];

          if ($fdate != "" && $ldate != ""){
            $date = "qdate BETWEEN '".$fdate."' AND '".$ldate."'";
          } else {
            $date = "";
          }

          if($fdate == "" && $ldate != ""){
            $date = "qdate = '".$ldate."'";
          }

          if($month != ""){
            $date = "qdate LIKE '".$month."-%'";
          }


          if($status != ""){
            $stat = "qstatus = '".$status."'";
          } else if ($date != "" && $status != ""){
            $stat = "AND = '".$status."'";
          } else {
            $stat = "";
          }
          
          $note = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.*, alagapp_db.tbl_petprofile.*
          FROM ((alagapp_db.tbl_scheduler
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
          INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
          WHERE ".$date." ".$stat."";
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