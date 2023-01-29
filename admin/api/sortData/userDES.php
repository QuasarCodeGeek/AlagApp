<?php
  require("../connector.php");
?>
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Street</th>
            <th>Barangay</th>
            <th>Municipality</th>
            <th>Province</th>
            <th>Birth Date</th>
            <th>Gender</th>
            <th>Mobile No.</th>
          </tr>
          <?php include("./../reportData/userFilter.php");?>
        </thead>
        <tbody>
        <?php

            $cnt = "SELECT COUNT(userid) as count FROM alagapp_db.tbl_userlist;";
            $res = $connect->query($cnt);
            $res->execute();
            if($res->rowCount()>0){
                $counter = $res->fetch(PDO::FETCH_ASSOC);
                $count = $counter['count'];
            }

          $user= "SELECT * FROM alagapp_db.tbl_userlist ORDER BY userid ASC;";
          $res = $connect->query($user);
          $res->execute();
          if($res->rowCount()>0){
            $i=1;
            while($row = $res->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$row['userfname']." ".$row['usermname']." ".$row['userlname']."</td>
              <td>".$row['userstreet']."</td>
              <td>".$row['userdistrict']."</td>
              <td>".$row['usermunicipality']."</td>
              <td>".$row['userprovince']."</td>
              <td>".date("d/M/Y", strtotime($row['userbdate']))."</td>
              <td>".$row['usergender']."</td>
              <td>".$row['usermobile']."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan=\"9\" class='text-center'>No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>