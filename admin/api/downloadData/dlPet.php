<?php
  include 'export.php';
  include ("../dataAnalytics.php");
  
      $petdata = "SELECT COUNT(petid) AS count FROM alagapp_db.tbl_petprofile ORDER BY petid DESC";
      $resdata = $connect->query($petdata);
      $resdata->execute();
      $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

header('Content-type: application/vnd-ms-excel');
$filename="Pet List.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");
?>
<table class="table m-2">
        <thead>
          <tr>PET LISTS <br />
          <label>Number of Pets: <?php echo $rowdata['count'];?></label>
            <th>#</th>
            <th>Name</th>
            <th>Owner</th>
            <th>Specie</th>
            <th>Breed</th>
            <th>Wt(Kg)</th>
            <th>Ht(M)</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Gender</th>
          </tr>
        </thead>
        <tbody>
        <?php
           $pet = "SELECT alagapp_db.tbl_petprofile.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname
           FROM (alagapp_db.tbl_petprofile
           INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_petprofile.userid = alagapp_db.tbl_userlist.userid)";
           $respet = $connect->query($pet);
           $respet->execute();
           if($respet->rowCount()>0){
             $i=1;
             while($rowpet = $respet->fetch(PDO::FETCH_ASSOC)){
 
               echo "<tr>
               <td>".$i."</td>
               <td>".$rowpet['petname']."</td>
               <td>".$rowpet['userfname']." ".$rowpet['userlname']."</td>
               <td>".$rowpet['pettype']."</td>
               <td>".$rowpet['petbreed']."</td>
               <td>".$rowpet['petweight']."</td>
               <td>".$rowpet['petheight']."</td>
               <td>".$rowpet['petbdate']."</td>
               <td>".$rowpet['petage']."</td>
               <td>".$rowpet['petgender']."</td>
             </tr>";
             $i++;
             }
           }
        ?>
        </tbody>
      </table>