<tr>
    <th></th>
    <th></th>
    <th>
        <select class="form-select" aria-label="Default select example" id="type" onchange="filterVaccine()">
            <option selected value="">-Select Type-</option>
            <?php
                $type = "SELECT vaxtype FROM alagapp_db.tbl_vaxxinfo GROUP BY vaxtype HAVING COUNT(vaxtype) >= 1";
                $vtres = $connect->query($type);
                $vtres->execute();

                if($vtres->rowCount()>0){
                    $x=1;
                    while($vtrow = $vtres->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$vtrow['vaxtype']."'>".$vtrow['vaxtype']."</option>";
                        $x++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="brand" onchange="filterVaccine()">
            <option selected value="">-Select Brand-</option>
            <?php
                $brand = "SELECT vaxbrand FROM alagapp_db.tbl_vaxxinfo GROUP BY vaxbrand HAVING COUNT(vaxbrand) >= 1";
                $vbres = $connect->query($brand);
                $vbres->execute();

                if($vbres->rowCount()>0){
                    $y=1;
                    while($vbrow = $vbres->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$vbrow['vaxbrand']."'>".$vbrow['vaxbrand']."</option>";
                        $y++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
    </th>
    <th>
    </th>
    <th></th>
</tr>