<table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>User</th>
            <th>Pets</th>
            <th>Schedules</th>
            <th>Chats</th>
            <th>Calls</th>
          </tr>
        </thead>
        <tbody>
        <?php
            require("../connector.php");

            $cnt = "SELECT COUNT(userid) as count FROM alagapp_db.tbl_userlist;";
            $res = $connect->query($cnt);
            $res->execute();
            if($res->rowCount()>0){
                $counter = $res->fetch(PDO::FETCH_ASSOC);
                $count = $counter['count'];
            }

          $user = "SELECT * FROM alagapp_db.tbl_userlist ORDER BY userid ASC";
          $ruser = $connect->query($user);
          $ruser->execute();

          if($ruser->rowCount()>0){
            $i=1;
            while($rowdata = $ruser->fetch(PDO::FETCH_ASSOC)){

                $petdata = "SELECT COUNT(petid) AS cpet FROM alagapp_db.tbl_petprofile WHERE userid = ".$rowdata['userid']."";
                $respet = $connect->query($petdata);
                $respet->execute();
                $rowpet = $respet->fetch(PDO::FETCH_ASSOC);

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