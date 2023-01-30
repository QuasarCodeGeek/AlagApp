<?php
  include 'export.php';
  include ("../dataAnalytics.php");
  
      $schedcount = "SELECT COUNT(qid) AS queue FROM alagapp_db.tbl_scheduler";
      $resq = $connect->query($schedcount);
      $resq->execute();
      $rowq = $resq->fetch(PDO::FETCH_ASSOC);

header('Content-type: application/vnd-ms-excel');
$filename="Schedules.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");
?>
<table class="table m-2">
        <thead>
          <tr>SCHEDULES <br />
          <label>Number of Schedules: <?php echo $rowq['queue'];?></label>
          <th>#</th>
            <th>Pet</th>
            <th>Owner</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php
           $scheddata = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.*, alagapp_db.tbl_petprofile.petname
           FROM ((alagapp_db.tbl_scheduler
           INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
           INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)";
           $res = $connect->query($scheddata);
           $res->execute();

         if($res->rowCount()>0){
           $i=1;
           while($rowdata = $res->fetch(PDO::FETCH_ASSOC)){
             echo "<tr>
             <td>".$i."</td>
             <td>".$rowdata['petname']."</td>
             <td>".$rowdata['userfname']." ".$rowdata['userlname']."</td>
             <td>".$rowdata['qdescription']."</td>
             <td>".$rowdata['qdate']."</td>
             <td>".$rowdata['qstatus']."</td>
           </tr>";
           $i++;
           }
         }
        ?>
        </tbody>
      </table>