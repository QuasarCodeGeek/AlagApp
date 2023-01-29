<?php
require("../connector.php");
$search = $_REQUEST['search'];
?>
<table class="table table-striped">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>User <span class="float-end">No. of set</span></th>
            <th>/Pets</th>
            <th>/Vaccination</th>
            <th>/Prescription</th>
            <th>/Schedules</th>
            <th>/Chats</th>
            <th>/Calls</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $user = "SELECT * FROM alagapp_db.tbl_userlist
          WHERE
            userfname LIKE '%".$search."%' OR 
            userlname LIKE '%".$search."%'";
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
                $resnote = $connect->query($notedata);
                $resnote->execute();
                $rownote = $resnote->fetch(PDO::FETCH_ASSOC);

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
          } else {
            echo "<td>No Record!</td>";
          }
        ?>
        </tbody>
      </table>