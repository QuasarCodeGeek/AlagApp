
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Pet Type</th>
            <th>Body Part</th>
            <th>Symptom</th>
            <th>Diagnosis</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
        <?php
        require("../connector.php");
        
        $cnt = "SELECT COUNT(sid) as count FROM alagapp_db.tbl_symptom;";
            $res = $connect->query($cnt);
            $res->execute();
            if($res->rowCount()>0){
                $counter = $res->fetch(PDO::FETCH_ASSOC);
                $count = $counter['count'];
            }

          $note = "SELECT * FROM alagapp_db.tbl_symptom ORDER BY sid DESC";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=$count;
            while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rownote['pettype']."</td>
              <td>".$rownote['bodypart']."</td>
              <td>".$rownote['symptom']."</td>
              <td>".$rownote['diagnosis']."</td>
              <td>".$rownote['description']."</td>
            </tr>";
            $i++;
            }
          } else {
            echo "<tr><td colspan-\"7\">No Record!</td></tr>";
          }
        ?>
        </tbody>
      </table>