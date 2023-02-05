<tr>
    <th></th>
    <th></th>
    <th>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="type" onchange="filterPet()">
            <option selected value="">-Pet Type-</option>
            <?php
                $pt = "SELECT * FROM alagapp_db.tbl_petprofile GROUP BY pettype HAVING COUNT(pettype) >= 1";
                $res = $connect->query($pt);
                $res->execute();

                if($res->rowCount()>0){
                    $i=1;
                    while($row = $res->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['pettype']."'>".$row['pettype']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="breed" onchange="filterPet()">
            <option selected value="">-Select Pet Breed-</option>
            <?php
                $pt = "SELECT * FROM alagapp_db.tbl_petprofile GROUP BY petbreed HAVING COUNT(petbreed) >= 1";
                $res = $connect->query($pt);
                $res->execute();

                if($res->rowCount()>0){
                    $i=1;
                    while($row = $res->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['petbreed']."'>".$row['petbreed']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <input type="text" class="form-control" id="weight" onchange="filterPet()" placeholder="Enter Weight">
    </th>
    <th>
        <input type="text" class="form-control" id="mark" onchange="filterPet()" placeholder="Enter Color/Marking">
        <!--<select class="form-select" aria-label="Default select example" id="mark" onchange="filterPet()">
            <option selected></option>
            <?php
                /*$pt = "SELECT * FROM alagapp_db.tbl_petprofile GROUP BY petmark HAVING COUNT(petmark) >= 1";
                $res = $connect->query($pt);
                $res->execute();

                if($res->rowCount()>0){
                    $i=1;
                    while($row = $res->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['petmark']."'>".$row['petmark']."</option>";
                        $i++;
                    }
                }*/
            ?>
        </select>-->
    </th>
    <th>
        <input type="date" class="form-control" id="date" onchange="filterPet()">
    </th>
    <th>
        <input type="text" class="form-control" id="age" onchange="filterPet()" placeholder="Enter Age">
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="gender" onchange="filterPet()">
            <option selected value="">-Sex-</option>
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
    </th>
</tr>