<div class="m-2 input-group">
    <label class="input-group-text">Symptom</label>
    <select id="symptom" name="symptom" class="form-control form-select" aria-label="SelectSymptom">
        <option selected>-- Select Symptom --</option>
    <?php
        require("../_connector.php");
        $type = $_REQUEST['type'];
        $body = $_REQUEST['body'];
        
        $symptomFind = "SELECT symptom FROM alagapp_db.tbl_symptom
            WHERE pettype = '".$type."' AND bodypart = '".$body."' GROUP BY symptom HAVING COUNT(symptom) >= 1";
        $check = $connect->prepare($symptomFind);
        $check->execute();
        
        if($check->rowCount()>0) {
            $j=1;
            while($row = $check->fetch(PDO::FETCH_ASSOC)){
                $symptom = $row['symptom']; 
                echo "<option value='".$symptom."'>".$symptom."</option>";
                $j++;
            }
        } else {
            echo "<option value=''>No Record</option>";
        }
    ?>
    </select>
</div>