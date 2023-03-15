<?php
        require("../../connector.php");
        $search = $_REQUEST['filter'];
?>
      <table class="table table-striped m-2" id="tblCard">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Pet</th>
            <th>Owner</th>
            <th>Vaccine</th>
            <th>Veterinarian</th>
            <th>Weight(Kg)</th>
            <th>Date</th>
            <th>Due Date</th>
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
            cnext = '".$search."' OR
            cvet = '".$search."' OR
            cweight LIKE '".$search."%'";
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
              <td>".date("dM/Y", strtotime($rowcard['cdate']))."</td>
              <td>".date("d/M/Y", strtotime($rowcard['cnext']))."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan=\"7\" class='text-center'>No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>