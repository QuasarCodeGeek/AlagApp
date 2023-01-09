
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Pet</th>
            <th>Owner</th>
            <th>Description</th>
            <th>Veterinarian</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
        <?php
        require("../connector.php");
        $cnt = "SELECT COUNT(nid) as count FROM alagapp_db.tbl_notedetail;";
            $res = $connect->query($cnt);
            $res->execute();
            if($res->rowCount()>0){
                $counter = $res->fetch(PDO::FETCH_ASSOC);
                $count = $counter['count'];
            }
          $note = "SELECT alagapp_db.tbl_notedetail.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname, alagapp_db.tbl_petprofile.petname
          FROM ((alagapp_db.tbl_notedetail
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_notedetail.userid = alagapp_db.tbl_userlist.userid)
          INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_notedetail.petid = alagapp_db.tbl_petprofile.petid)
            ORDER BY nid DESC";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=$count;
            while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rownote['petname']."</td>
              <td>".$rownote['userfname']." ".$rownote['userlname']."</td>
              <td>".$rownote['ndescription']."</td>
              <td>".$rownote['nvet']."</td>
              <td>".$rownote['ndate']."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan-\"7\">No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>