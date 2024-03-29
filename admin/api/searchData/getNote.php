<?php
require("../connector.php");
$search = $_REQUEST['search'];
?>
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
          <?php include("./../reportData/noteFilter.php");?>
        </thead>
        <tbody>
        <?php
          $note = "SELECT alagapp_db.tbl_notedetail.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname, alagapp_db.tbl_petprofile.petname
          FROM ((alagapp_db.tbl_notedetail
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_notedetail.userid = alagapp_db.tbl_userlist.userid)
          INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_notedetail.petid = alagapp_db.tbl_petprofile.petid)
          WHERE
            userfname LIKE '%".$search."%' OR 
            userlname LIKE '%".$search."%' OR
            petname LIKE '%".$search."%' OR
            ndescription LIKE '%".$search."%' OR
            ndate LIKE '%".$search."%' OR
            nvet LIKE '%".$search."%'";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=1;
            while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rownote['petname']."</td>
              <td>".$rownote['userfname']." ".$rownote['userlname']."</td>
              <td>".$rownote['ndescription']."</td>
              <td>".$rownote['nvet']."</td>
              <td>".date("d/M/Y", strtotime($rownote['ndate']))."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan=\"6\" class='text-center'>No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>