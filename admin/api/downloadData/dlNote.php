<?php
  include 'export.php';
  include ("../dataAnalytics.php");


    $notedata = "SELECT COUNT(nid) AS count FROM alagapp_db.tbl_notedetail";
    $resdata = $connect->query($notedata);
    $resdata->execute();
    $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

header('Content-type: application/vnd-ms-excel');
$filename="Prescription Note.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");
?>
<table class="table m-2">
        <thead>
          <tr>PRESCRIPTION NOTES <br />
          <label>Number of Notes: <?php echo $rowdata['count'];?></label>
            <th>#</th>
            <th>Pet</th>
            <th>Owner</th>
            <th>Description</th>
            <th>Date Issued</th>
          </tr>
        </thead>
        <tbody>
        <?php
           $note = "SELECT alagapp_db.tbl_notedetail.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname, alagapp_db.tbl_petprofile.petname
           FROM ((alagapp_db.tbl_notedetail
           INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_notedetail.userid = alagapp_db.tbl_userlist.userid)
           INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_notedetail.petid = alagapp_db.tbl_petprofile.petid)";
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
               <td>".$rownote['ndate']."</td>
             </tr>";
             $i++;
             }
           }
        ?>
        </tbody>
      </table>