
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
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
        require("../connector.php");
        
        $cnt = "SELECT COUNT(vaxid) as count FROM alagapp_db.tbl_vaxxinfo";
            $res = $connect->query($cnt);
            $res->execute();
            if($res->rowCount()>0){
                $counter = $res->fetch(PDO::FETCH_ASSOC);
                $count = $counter['count'];
            }

          $note = "SELECT * FROM alagapp_db.tbl_vaxxinfo ORDER BY vaxid DESC";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=$count;
            while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){

                $vaxdata = "SELECT COUNT(vaxid) AS vaxx FROM alagapp_db.tbl_vaxxcard WHERE vaxid LIKE ".$rownote['vaxid']."";
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
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan-\"7\">No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>