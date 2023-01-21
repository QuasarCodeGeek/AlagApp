
<tr>
    <th></th>
    <th>
    </th>
    <th>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="vaxx" onchange="filterCard()">
            <option selected></option>
            <?php
                $vaxx = "SELECT * FROM alagapp_db.tbl_vaxxinfo";
                $vres = $connect->query($vaxx);
                $vres->execute();

                if($vres->rowCount()>0){
                    $i=1;
                    while($vrow = $vres->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$vrow['vaxname']."'>".$vrow['vaxname']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="vet" onchange="filterCard()">
            <option selected></option>
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
        <input type="number" class="form-control" id="weight" onchange="filterCard()">
    </th>
    <th>
        <input type="date" class="form-control" id="date" onchange="filterCard()">
    </th>
</tr>