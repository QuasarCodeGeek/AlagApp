<?php
  include 'export.php';
  include ("../dataAnalytics.php");

    $userdata = "SELECT COUNT(userid) AS cuser FROM alagapp_db.tbl_userlist ORDER BY userid DESC";
    $resuser = $connect->query($userdata);
    $resuser->execute();
    $rowuser = $resuser->fetch(PDO::FETCH_ASSOC);
header('Content-type: application/vnd-ms-excel');
$filename="Consultations.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");
?>
<table class="table m-2">
        <thead>
          <tr>CONSULTATIONS <br />
          <label>Number of Rows: <?php echo $rowuser['cuser'];?></label>
          <th>#</th>
            <th>User</th>
            <th># Pets</th>
            <th># Card</th>
            <th># Prescription</th>
            <th># Schedules</th>
            <th># Chats</th>
            <th># Calls</th>
          </tr>
        </thead>
        <tbody>
        <?php
           $user = "SELECT * FROM alagapp_db.tbl_userlist";
           $ruser = $connect->query($user);
           $ruser->execute();
 
           if($ruser->rowCount()>0){
             $i=1;
             while($rowdata = $ruser->fetch(PDO::FETCH_ASSOC)){
 
                 $petdata = "SELECT COUNT(petid) AS cpet FROM alagapp_db.tbl_petprofile WHERE userid = ".$rowdata['userid']."";
                 $respet = $connect->query($petdata);
                 $respet->execute();
                 $rowpet = $respet->fetch(PDO::FETCH_ASSOC);

                  $carddata = "SELECT COUNT(cid) AS ccard FROM alagapp_db.tbl_carddetail WHERE userid = ".$rowdata['userid']."";
                  $rescard = $connect->query($carddata);
                  $rescard->execute();
                  $rowcard = $rescard->fetch(PDO::FETCH_ASSOC);

                  $notedata = "SELECT COUNT(nid) AS cnote FROM alagapp_db.tbl_notedetail WHERE userid = ".$rowdata['userid']."";
                  $resn = $connect->query($notedata);
                  $resn->execute();
                  $rownote = $resn->fetch(PDO::FETCH_ASSOC);
 
                 $scheddata = "SELECT COUNT(qid) AS csched FROM alagapp_db.tbl_scheduler WHERE userid = ".$rowdata['userid']."";
                 $ressched = $connect->query($scheddata);
                 $ressched->execute();
                 $rowsched = $ressched->fetch(PDO::FETCH_ASSOC);
 
                 $chatdata = "SELECT COUNT(mid) AS cchat FROM alagapp_db.tbl_chat WHERE userid = ".$rowdata['userid']."";
                 $reschat = $connect->query($chatdata);
                 $reschat->execute();
                 $rowchat = $reschat->fetch(PDO::FETCH_ASSOC);
 
                 $calldata = "SELECT COUNT(vid) AS ccall FROM alagapp_db.tbl_call WHERE userid = ".$rowdata['userid']."";
                 $rescall = $connect->query($calldata);
                 $rescall->execute();
                 $rowcall = $rescall->fetch(PDO::FETCH_ASSOC);
 
               echo "<tr>
               <td>".$i."</td>
               <td>".$rowdata['userfname']." ".$rowdata['userlname']."</td>
               <td>".$rowpet['cpet']."</td>
               <td>".$rowcard['ccard']."</td>
               <td>".$rownote['cnote']."</td>
               <td>".$rowsched['csched']."</td>
               <td>".$rowchat['cchat']."</td>
               <td>".$rowcall['ccall']."</td>
             </tr>";
             $i++;
             }
           }
        ?>
        </tbody>
      </table>