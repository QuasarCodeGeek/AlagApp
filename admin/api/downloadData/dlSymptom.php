<?php
  include 'export.php';
  include ("../dataAnalytics.php");

  $check = "SELECT * FROM alagapp_db.tbl_admin WHERE adminid = 1 AND session = 1";
  $checkSession = $connect->prepare($check);
  $checkSession->execute();
  if($checkSession->rowCount()>0){
    $wel = $checkSession->fetch(PDO::FETCH_ASSOC);
    
  } else {
    echo "<script>window.location='./../../index.php'</script>";
  }
  
      $ddata = "SELECT COUNT(sid) AS count FROM alagapp_db.tbl_symptom";
      $resdata = $connect->query($ddata);
      $resdata->execute();
      $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

header('Content-type: application/vnd-ms-excel');
$filename="Symptoms.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");
?>
<table class="table m-2">
        <thead>
          <tr>SYMPTOMS <br />
          <label>Number of Records: <?php echo $rowdata['count'];?></label>
            <th>#</th>
            <th>Pet Type</th>
            <th>Body Part</th>
            <th>Symptom</th>
            <th>Diagnosis</th>
            <th>Description</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
        <?php
           $symptom = "SELECT * FROM alagapp_db.tbl_symptom";
           $ress = $connect->query($symptom);
           $ress->execute();
           if($ress->rowCount()>0){
             $i=1;
             while($roww = $ress->fetch(PDO::FETCH_ASSOC)){
               echo "<tr>
               <td>".$i."</td>
               <td>".$roww['pettype']."</td>
               <td>".$roww['bodypart']."</td>
               <td>".$roww['symptom']."</td>
               <td>".$roww['diagnosis']."</td>
               <td>".$roww['description']."</td>
               <td><button class='btn' onClick='symptomEdit(".$roww['sid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'><i class='bi bi-pencil-square'></i></button></td>
             </tr>";
             $i++;
             }
           }
        ?>
        </tbody>
      </table>