<?php
require("../connector.php");
$search = $_REQUEST['search'];
?>
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Description</th>
            <th># Administered</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $note = "SELECT * FROM alagapp_db.tbl_vaxxinfo
          WHERE
            vaxname LIKE '%".$search."%' OR 
            vaxtype LIKE '%".$search."%' OR
            vaxbrand LIKE '%".$search."%' OR
            vaxdes LIKE '%".$search."%'";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=1;
            while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){

              $vaxdata = "SELECT COUNT(vaxid) AS vaxx FROM alagapp_db.tbl_carddetail WHERE vaxid LIKE ".$rownote['vaxid']."";
              $resdata = $connect->query($vaxdata);
              $resdata->execute();
              $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

              echo "<tr>
              <td>".$i."</td>
              <td>".$rownote['vaxname']."</td>
              <td>".$rownote['vaxtype']."</td>
              <td>".$rownote['vaxbrand']."</td>
              <td>".$rownote['vaxdes']."</td>
              <td>".$rowdata['vaxx']."</td>
              <td><button class='btn' onclick='vaccineEdit(".$rowdata['vaxid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'><i class='bi bi-pencil-square'></i></button></td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan=\"7\" class='text-center'>No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>