<div class="m-2 input-group">
    <label class="input-group-text">Body Part</label>
    <select id="body" onchange="bodySelect()" name="part" class="form-control form-select" aria-label="SelectBodyPart">
        <option selected>-- Select Body --</option>
    <?php
        require("../_connector.php");
        $type = $_REQUEST['type'];
        
        $bodypart = "SELECT bodypart FROM alagapp_db.tbl_symptom WHERE pettype = '".$type."' GROUP BY bodypart HAVING COUNT(bodypart) >= 1";
        $check = $connect->prepare($bodypart);
        $check->execute();
        
        if($check->rowCount()>0) {
            $k=1;
            while($row = $check->fetch(PDO::FETCH_ASSOC)){
                $body = $row['bodypart']; 
                echo "<option value='".$body."'>".$body."</option>";
                $k++;
            }
        } else {
            echo "<option value=''>No Record</option>";
        }
    ?>
    </select>
</div>