
      <?php 
        require("../../connector.php");
        $search = $_REQUEST['filter'];
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
          <?php include("./../../reportData/userFilter.php");?>
        </thead>
        <tbody>
        <?php
          $note = "SELECT * FROM alagapp_db.tbl_userlist
          WHERE
            userstreet = '".$search."' OR
            userdistrict = '".$search."' OR
            usermunicipality = '".$search."' OR
            userprovince = '".$search."' OR
            userbdate = '".$search."' OR
            usergender = '".$search."' OR
            usermobile LIKE '".$search."%'";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=1;
            while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rownote['userfname']." ".$rownote['usermname']." ".$rownote['userlname']."</td>
              <td>".$rownote['userstreet']."</td>
              <td>".$rownote['userdistrict']."</td>
              <td>".$rownote['usermunicipality']."</td>
              <td>".$rownote['userprovince']."</td>
              <td>".date("d/M/Y", strtotime($rownote['userbdate']))."</td>
              <td>".$rownote['usergender']."</td>
              <td>".$rownote['usermobile']."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan=\"9\" class='text-center'>No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>