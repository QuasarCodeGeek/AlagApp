<?php
    require("API/connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_vaxxinfo";

    $res = $connect->prepare($sql);
    $res->execute();

    $sql2 = "SELECT COUNT(vaxid) AS entry, SUM(vaxused) AS used FROM alagapp_db.tbl_vaxxinfo";
    $res2 = $connect->query($sql2);
    $res2->execute();
    $row1 = $res2->fetch(PDO::FETCH_ASSOC);
?>
    <!-- <div class="nav">
            <button type="button" class="btn btn-outline-info"  onclick="location.href='index.php'">Home</button>
            <label class="btn"><a href = "API/vaxx_new.php">Add New Vaccine</a><label><br>
            <label class="num">Number of Registered Vaccines: <?php echo $row1['entry'] ?></label><br>
            <label class="num">Number of Administered Vaccines: <?php echo $row1['used'] ?></label>
    </div> -->
    <?php
    echo "<table class='table table-striped'>
    <thead>
        <tr>
            <th scope='col'>Vax ID</th>
            <th scope='col'>Name</th>
            <th scope='col'>Type</th>
            <th scope='col'>Brand</th>
            <th scope='col'>Used</th>
        </tr>
    </thead>
    <tbody>";

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "<tr scope='row'>
            <td>".$i."</td>
            <td>".$row['vaxname']."</td>
            <td>".$row['vaxtype']."</td>
            <td>".$row['vaxbrand']."</td>
            <td>".$row['vaxused']."</td>

            <td>
            <button type='button' class='btn' onClick='vaccineEdit(".$row['vaxid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit</button>
            <br>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan = '5'> No records found! </td></tr></tbody>
        </table>";
    }
?>