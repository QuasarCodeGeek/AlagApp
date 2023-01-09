
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Street</th>
            <th>Barangay</th>
            <th>Municipality</th>
            <th>Province</th>
            <th>Bdate</th>
            <th>Gender</th>
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

          $user= "SELECT * FROM alagapp_db.tbl_userlist ORDER BY userid DESC;";
          $res = $connect->query($user);
          $res->execute();
          if($res->rowCount()>0){
            $i=$count;
            while($row = $res->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$row['userfname']." ".$row['usermname']." ".$row['userlname']."</td>
              <td>".$row['userstreet']."</td>
              <td>".$row['userdistrict']."</td>
              <td>".$row['usermunicipality']."</td>
              <td>".$row['userprovince']."</td>
              <td>".$row['userbdate']."</td>
              <td>".$row['usergender']."</td>
            </tr>";
            $i--;
            }
          } else {
            echo "<tr><td colspan-\"7\">No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>