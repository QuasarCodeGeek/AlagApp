<?php
  include 'export.php';
  include ("../dataAnalytics.php");


  
      $carddata = "SELECT COUNT(cid) AS count FROM alagapp_db.tbl_carddetail ORDER BY cid DESC";
      $resdata = $connect->query($carddata);
      $resdata->execute();
      $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

header('Content-type: application/vnd-ms-excel');
$filename="Vaccine Card.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");
?>
<table class="table m-2">
        <thead>
          <tr>VACCINE CARDS <br />
          <label>Number of Cards: <?php echo $rowdata['count'];?></label>
          <th>#</th>
            <th>Pet</th>
            <th>Owner</th>
            <th>Vaccine</th>
            <th>First Dose</th>
            <th>Second Dose</th>
            <th>Booster</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $card = "SELECT alagapp_db.tbl_vaxxcard.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname, alagapp_db.tbl_petprofile.petname, alagapp_db.tbl_vaxxinfo.vaxname
          FROM (((alagapp_db.tbl_vaxxcard
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_vaxxcard.userid = alagapp_db.tbl_userlist.userid)
          INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_vaxxcard.petid = alagapp_db.tbl_petprofile.petid)
          INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_vaxxcard.vaxid = alagapp_db.tbl_vaxxinfo.vaxid)";
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
              <td>".$rowcard['fdose']."</td>
              <td>".$rowcard['sdose']."</td>
              <td>".$rowcard['booster']."</td>
            </tr>";
            $i++;
            }
          }
        ?>
        </tbody>
      </table>