<tr>
    <th></th>
    <th></th>
    <th></th>
    <th>
        <select class="form-select" aria-label="Default select example" id="district" onchange="filterUser()">
        <option selected value="">-Select Barangay-</option>
            <?php
                $dt = "SELECT * FROM alagapp_db.tbl_userlist GROUP BY userdistrict HAVING COUNT(userdistrict) >= 1";
                $res = $connect->query($dt);
                $res->execute();

                if($res->rowCount()>0){
                    $i=1;
                    while($row = $res->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['userdistrict']."'>".$row['userdistrict']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="municipality" onchange="filterUser()">
            <option selected value="">-Select Municipality-</option>
            <?php
                $dt = "SELECT * FROM alagapp_db.tbl_userlist GROUP BY usermunicipality HAVING COUNT(usermunicipality) >= 1";
                $res = $connect->query($dt);
                $res->execute();

                if($res->rowCount()>0){
                    $i=1;
                    while($row = $res->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['usermunicipality']."'>".$row['usermunicipality']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <select class="form-select" aria-label="Default select example" id="province" onchange="filterUser()">
            <option selected value="">-Select Province-</option>
            <?php
                $dt = "SELECT * FROM alagapp_db.tbl_userlist GROUP BY userprovince HAVING COUNT(userprovince) >= 1";
                $res = $connect->query($dt);
                $res->execute();

                if($res->rowCount()>0){
                    $i=1;
                    while($row = $res->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['userprovince']."'>".$row['userprovince']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </th>
    <th>
        <input type="date" class="form-control" id="date" onchange="filterUser()">
    </th>
    <th>
    <select class="form-select" aria-label="Default select example" id="gender" onchange="filterUser()">
            <option selected value="">-Select Gender-</option>
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
    </th>
    <th>
        <input type="text" class="form-control" id="mobile" onchange="filterUser()" placeholder="Enter Number 09-">
    </th>
</tr>