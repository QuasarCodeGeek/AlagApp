<?php
  include 'export.php';
  include ("../dataAnalytics.php");
  
      $vdata = "SELECT COUNT(vaxid) AS count FROM alagapp_db.tbl_vaxxinfo";
      $resdata = $connect->query($vdata);
      $resdata->execute();
      $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

header('Content-type: application/vnd-ms-excel');
$filename="Vaccine Information.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");
?>
<table class="table m-2">
        <thead>VACCINE INFORMATION <br />
        <label>Number of Vaccines: <?php echo $rowdata['count'];?></label>
          <tr> 
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Description</th>
            <th># Administered</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $vaxx = "SELECT * FROM alagapp_db.tbl_vaxxinfo";
          $resvaxx = $connect->query($vaxx);
          $resvaxx->execute();
          if($resvaxx->rowCount()>0){
            $i=1;
            while($rowvaxx = $resvaxx->fetch(PDO::FETCH_ASSOC)){

              $vaxdata = "SELECT COUNT(vaxid) AS vaxx FROM alagapp_db.tbl_vaxxcard WHERE vaxid LIKE ".$rowvaxx['vaxid']."";
              $resdata = $connect->query($vaxdata);
              $resdata->execute();
              $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

              echo "<tr>
              <td>".$i."</td>
              <td>".$rowvaxx['vaxname']."</td>
              <td>".$rowvaxx['vaxtype']."</td>
              <td>".$rowvaxx['vaxbrand']."</td>
              <td>".$rowvaxx['vaxdes']."</td>
              <td>".$rowdata["vaxx"]."</td>
              <td><button class='btn' onClick='vaccineEdit(".$rowvaxx['vaxid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'><i class='bi bi-pencil-square'></i></button></td>
            </tr>";
            $i++;
            }
          }
        ?>
        </tbody>
      </table>