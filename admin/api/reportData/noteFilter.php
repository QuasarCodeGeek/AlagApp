<tr>
    <th></th>
    <th>
    </th>
    <th>
    </th>
    <th>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="vet" onchange="filterNote()">
            <option selected value="">-Select Vet-</option>
            <?php
                $vet = "SELECT * FROM alagapp_db.tbl_carddetail GROUP BY cvet HAVING COUNT(cvet) >= 1";
                $vres = $connect->query($vet);
                $vres->execute();

                if($vres->rowCount()>0){
                    $i=1;
                    while($vrow = $vres->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$vrow['cvet']."'>".$vrow['cvet']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <input type="date" class="form-control" id="date" onchange="filterNote()">
    </th>
</tr>