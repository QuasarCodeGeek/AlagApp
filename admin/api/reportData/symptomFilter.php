<tr>
    <th></th>
    <th>
        <select class="form-select" aria-label="Default select example" id="pet" onchange="filterSymptom()">
            <option selected></option>
            <?php
                $pet = "SELECT * FROM alagapp_db.tbl_symptom GROUP BY pettype HAVING COUNT(pettype) >=1 ";
                $pres = $connect->query($pet);
                $pres->execute();

                if($pres->rowCount()>0){
                    $i=1;
                    while($prow = $pres->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$prow['pettype']."'>".$prow['pettype']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <input type="text" class="form-control" id="body" onchange="filterSymptom()">
    </th>
    <th>
        <input type="text" class="form-control" id="symptom" onchange="filterSymptom()">
    </th>
    <th>
        <input type="text" class="form-control" id="diagnosis" onchange="filterSymptom()">
    </th>
    <th>
        <input type="text" class="form-control" id="description" onchange="filterSymptom()">
    </th>
    <th></th>
</tr>