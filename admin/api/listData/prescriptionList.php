<?php
    require("API/connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_notedetail";

    $res = $connect->prepare($sql);
    $res->execute();

    $sql2 = "SELECT COUNT(nid) AS entry FROM alagapp_db.tbl_notedetail";
    $res2 = $connect->query($sql2);
    $res2->execute();
    $row1 = $res2->fetch(PDO::FETCH_ASSOC);

    $sqla = "SELECT COUNT(nstatus) AS active FROM alagapp_db.tbl_notedetail WHERE nstatus LIKE 'Active'";
    $resa = $connect->query($sqla);
    $resa->execute();
    $rowa = $resa->fetch(PDO::FETCH_ASSOC);

    $sqli = "SELECT COUNT(nstatus) AS inactive FROM alagapp_db.tbl_notedetail WHERE nstatus LIKE 'Inactive'";
    $resi = $connect->query($sqli);
    $resi->execute();
    $rowi = $resi->fetch(PDO::FETCH_ASSOC);

?>

    <!-- <button type="button" class="btn btn-outline-info"  onclick="location.href='index.php'">Home</button>
            <label class="btn"><a href = "API/note_new.php">Add Prescription Note</a><label><br>
            <label class="num">Number of Prescription Notes: <?php echo $row1['entry'] ?></label><br>
            <label class="num">Number of Active Notes: <?php echo $rowa['active'] ?></label><br>
            <label class="num">Number of Inactive Notes: <?php echo $rowi['inactive'] ?></label><br>
    </div> -->
<?php
    echo "
    <table class='table table-striped'>
    <thead>
        <tr>
            <th scope='col'> Rx ID</th>
            <th scope='col'>User ID</th>
            <th scope='col'>Pet ID</th>
            <th scope='col'>Description</th>
            <th scope='col'>Date Issued</th>
            <th scope='col'>Status</th>
        </tr>
    </thead>
    <tbody>";

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "<tr scope='row'>
            <td>".$i."</td>
            <td>".$row['userid']."</td>
            <td>".$row['petid']."</td>
            <td>".$row['ndescription']."</td>
            <td>".$row['ndate']."</td>
            <td>".$row['nstatus']."</td>

            <td><button type='button' class='btn' onClick='prescriptionEdit(".$row['nid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit</button>
            <br>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan = '5'> No records found! </td></tr>
            </tbody>
            </table>";
    }
?>