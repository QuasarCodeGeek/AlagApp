
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
        $search = $_REQUEST['search'];
          $note = "SELECT * FROM alagapp_db.tbl_userlist
          WHERE
            userfname LIKE '%".$search."%' OR 
            usermname LIKE '%".$search."%' OR
            userlname LIKE '%".$search."%' OR
            userbdate LIKE '%".$search."%' OR
            usergender LIKE '%".$search."%' OR
            userstreet LIKE '%".$search."%' OR
            userdistrict LIKE '%".$search."%' OR
            usermunicipality LIKE '%".$search."%' OR
            userprovince LIKE '%".$search."%'";
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
              <td>".$rownote['userbdate']."</td>
              <td>".$rownote['usergender']."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan-\"7\">No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>