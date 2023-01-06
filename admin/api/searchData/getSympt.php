
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
        $search = $_REQUEST['search'];
          $note = "SELECT * FROM alagapp_db.tbl_symptom
          WHERE
            pettype LIKE '%".$search."%' OR 
            bodypart LIKE '%".$search."%' OR
            symptom LIKE '%".$search."%' OR
            diagnosis LIKE '%".$search."%' OR
            description LIKE '%".$search."%'";
          $resnote = $connect->query($note);
          $resnote->execute();
          if($resnote->rowCount()>0){
            $i=1;
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