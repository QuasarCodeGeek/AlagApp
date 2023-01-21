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
            <th>Vaccine</th>
            <th>Veterinarian</th>
            <th>Weight(Kg)</th>
            <th>Date</th>
          </tr>
          <?php include("./../../reportData/cardFilter.php");?>
        </thead>
        <tbody>
        <?php
          $card = "SELECT alagapp_db.tbl_carddetail.*, alagapp_db.tbl_userlist.*, alagapp_db.tbl_petprofile.*, alagapp_db.tbl_vaxxinfo.vaxname
          FROM (((alagapp_db.tbl_carddetail
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_carddetail.userid = alagapp_db.tbl_userlist.userid)
          INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_carddetail.petid = alagapp_db.tbl_petprofile.petid)
          INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_carddetail.vaxid = alagapp_db.tbl_vaxxinfo.vaxid)
          WHERE
            vaxname ='".$search."' OR
            cdate = '".$search."' OR
            cvet = '".$search."' OR
            cweight = '".$search."'";
          $rescard = $connect->query($card);
          $rescard->execute();
          if($rescard->rowCount()>0){
            $i=1;
            while($rowcard = $rescard->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rowcard['petname']."</td>
              <td>".$rowcard['userfname']." ".$rowcard['userlname']."</td>
              <td>".$rowcard['vaxname']."</td>
              <td>".$rowcard['cvet']."</td>
              <td>".$rowcard['cweight']."</td>
              <td>".$rowcard['cdate']."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan-\"7\">No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>