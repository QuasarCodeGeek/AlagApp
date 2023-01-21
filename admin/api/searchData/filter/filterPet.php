<?php
        require("../../connector.php");
        $search = $_REQUEST['filter'];
?>
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Pet</th>
            <th>Owner</th>
            <th>Pet Type</th>
            <th>Breed</th>
            <th>Wt(Kg)</th>
            <th>Color/Marking</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Gender</th>
          </tr>
          <?php include("./../../reportData/petFilter.php");?>
        </thead>
        <tbody>
        <?php
          $note = "SELECT alagapp_db.tbl_petprofile.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname
          FROM alagapp_db.tbl_petprofile
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_petprofile.userid = alagapp_db.tbl_userlist.userid
          WHERE
            pettype = '".$search."' OR
            petbreed = '".$search."' OR
            petweight = '".$search."' OR
            petmark = '".$search."' OR
            petbdate = '".$search."' OR
            petage = '".$search."' OR
            petgender = '".$search."'";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=1;
            while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rownote['petname']."</td>
              <td>".$rownote['userfname']." ".$rownote['userlname']."</td>
              <td>".$rownote['pettype']."</td>
              <td>".$rownote['petbreed']."</td>
              <td>".$rownote['petweight']."</td>
              <td>".$rownote['petmark']."</td>
              <td>".$rownote['petbdate']."</td>
              <td>".$rownote['petage']."</td>
              <td>".$rownote['petgender']."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan-\"7\">No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>