<?php
    require("API/connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_vaxxcard";

    $res = $connect->prepare($sql);
    $res->execute();

    /*
    $sql2 = "SELECT COUNT(cid) AS entry FROM alagapp_db.tbl_vaxxcard";
    $res2 = $connect->query($sql2);
    $res2->execute();
    $row1 = $res2->fetch(PDO::FETCH_ASSOC);

    $sqlf = "SELECT COUNT(fdose) AS first FROM alagapp_db.tbl_vaxxcard WHERE fdose NOT LIKE '0000-00-00'";
    $resf = $connect->query($sqlf);
    $resf->execute();
    $rowf = $resf->fetch(PDO::FETCH_ASSOC);

    $sqls = "SELECT COUNT(sdose) AS second FROM alagapp_db.tbl_vaxxcard WHERE sdose NOT LIKE '0000-00-00'";
    $ress = $connect->query($sqls);
    $ress->execute();
    $rows = $ress->fetch(PDO::FETCH_ASSOC);

    $sqlb = "SELECT COUNT(booster) AS boost FROM alagapp_db.tbl_vaxxcard WHERE booster NOT LIKE '0000-00-00'";
    $resb = $connect->query($sqlb);
    $resb->execute();
    $rowb = $resb->fetch(PDO::FETCH_ASSOC);
    */
?>


    <!-- <div class="nav">
            <label class="btn"><a href = "API/card_new.php">Add Prescription Note</a><label><br>
            <label class="num">Number of Issued Cards: <?php echo $row1['entry'] ?></label><br>
            <label class="num">Number of 1st Dose: <?php echo $rowf['first'] ?></label><br>
            <label class="num">Number of 2nd Dose: <?php echo $rows['second'] ?></label><br>
            <label class="num">Number of Booster: <?php echo $rowb['boost'] ?></label><br>
    </div>-->


<?php
    echo "<table class='table table-striped'>
    <thead>
        <tr>
            <th scope='col'>Card ID</th>
            <th scope='col'>Pet ID</th>
            <th scope='col'>Vaccine ID</th>
            <th scope='col'>First Dose</th>
            <th scope='col'>Second Dose</th>
            <th scope='col'>Booster</th>
        </tr>
    </thead>
    <tbody>";


    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "<tr scope='row'>
            <td>".$i."</td>
            <td>".$row['petid']."</td>
            <td>".$row['vaxid']."</td>
            <td>".$row['fdose']."</td>
            <td>".$row['sdose']."</td>
            <td>".$row['booster']."</td>

            <td>
            <button type='button' class='btn' onClick='cardEdit(".$row['cid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit</button>
            <br>";
?>
            <!--<a href='API/card_delete.php?id=<?php echo $row['cid']; ?>'  onClick = "return confirm('Are you sure you want to delete this record?')">Delete</a></td>-->
<?php
            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan = '5'> No records found! </td></tr>
        </tbody>
    </table>";
    }
?>