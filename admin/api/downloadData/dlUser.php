<?php
  include 'export.php';
  include ("../dataAnalytics.php");
  
      $userdata = "SELECT COUNT(userid) AS count FROM alagapp_db.tbl_userlist ORDER BY userid DESC";
      $resdata = $connect->query($userdata);
      $resdata->execute();
      $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

header('Content-type: application/vnd-ms-excel');
$filename="User List.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");
?>
<table class="table m-2">
        <thead>
          <tr>USER LISTS <br />
          <label>Number of Users: <?php echo $rowdata['count'];?></label>
            <th>#</th>
            <th>Name</th>
            <th>Street</th>
            <th>Baranggay</th>
            <th>Municipality</th>
            <th>Province</th>
            <th>Birth Date</th>
            <th>Gender</th>
          </tr>
        </thead>
        <tbody>
        <?php
           $user = "SELECT * FROM alagapp_db.tbl_userlist";
           $resuser = $connect->query($user);
           $resuser->execute();
           if($resuser->rowCount()>0){
             $i=1;
             while($rowuser = $resuser->fetch(PDO::FETCH_ASSOC)){
 
               echo "<tr>
               <td>".$i."</td>
               <td>".$rowuser['userfname']." ".$rowuser['usermname']." ".$rowuser['userlname']."</td>
               <td>".$rowuser['userstreet']."</td>
               <td>".$rowuser['userdistrict']."</td>
               <td>".$rowuser['usermunicipality']."</td>
               <td>".$rowuser['userprovince']."</td>
               <td>".$rowuser['userbdate']."</td>
               <td>".$rowuser['usergender']."</td>
             </tr>";
             $i++;
             }
           }
        ?>
        </tbody>
      </table>