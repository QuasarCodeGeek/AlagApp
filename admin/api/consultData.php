<div class="mt-3 mb-3 p-3 border border-3 border-success rounded">

    <?php
        $userdata = "SELECT COUNT(userid) AS cuser FROM alagapp_db.tbl_userlist";
        $resuser = $connect->query($userdata);
        $resuser->execute();
        $rowuser = $resuser->fetch(PDO::FETCH_ASSOC);
      ?>
    <div class="row m-auto mb-2">
        <div class="col-2 m-auto">
          <label class="fw-bold text-success">Total Rows: <?php echo $rowuser['cuser'];?></label>
        </div>
        <div class="col-6">
        <div class="row">
            <div class="col">
              <input class="form-control w-100" id="consult" type="text">
            </div>
            <div class="col">
              <button onclick="searchConsult()" class="btn btn-success">Search</button>
            </div>
          </div>
        </div>
        <div class="col-2 btn-group" role="group">
          <button type="button" class="btn btn-success" onclick="window.location='dashboard.php'"><i class="bi bi-sort-down"></i> ASC</button>
          <button type="button" class="btn btn-success" onclick="descConsult()"><i class="bi bi-sort-up"></i> DES</button>
        </div>
        <div class="col-2">
            <button class="btn btn-success float-end" onclick="window.location='api/downloadData/dlConsult.php'" target="_blank"><i class="bi bi-download"></i> Download</button>
        </div>
    </div>

  <div class="row m-auto" id="alter">
    </div>
  <div class="row m-auto" id="table">
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
          $user = "SELECT * FROM alagapp_db.tbl_userlist ORDER BY userid DESC";
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
  </div>
</div>