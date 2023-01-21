<tr>
    <th></th>
    <th>
        <input type="text" class="form-control" id="name" onchange="filterVaccine()">
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="type" onchange="filterVaccine()">
            <option selected></option>
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
            <option selected></option>
            <?php
                $brand = "SELECT vaxbrand FROM alagapp_db.tbl_vaxxinfo GROUP BY vaxbrand HAVING COUNT(vaxbrand) >= 1";
                $vbres = $connect->query($brand);
                $vbres->execute();

                if($vbres->rowCount()>0){
                    $x=1;
                    while($vbrow = $vbres->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$vbrow['vaxbrand']."'>".$vbrow['vaxbrand']."</option>";
                        $x++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <input type="text" class="form-control" id="description" onchange="filterVaccine()">
    </th>
    <th>
        <input type="number" class="form-control" id="admin" onchange="filterVaccine()">
    </th>
    <th></th>
</tr>