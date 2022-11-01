<?php
    require("API/connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_petprofile";

    $res = $connect->prepare($sql);
    $res->execute();

    $sql2 = "SELECT COUNT(petid) AS entry FROM alagapp_db.tbl_petprofile";
    $res2 = $connect->query($sql2);
    $res2->execute();
    $row1 = $res2->fetch(PDO::FETCH_ASSOC);

    $sqlm = "SELECT COUNT(petgender) AS male FROM alagapp_db.tbl_petprofile WHERE petgender LIKE 'Male'";
    $resm = $connect->query($sqlm);
    $resm->execute();
    $rowm = $resm->fetch(PDO::FETCH_ASSOC);

    $sqlf = "SELECT COUNT(petgender) AS female FROM alagapp_db.tbl_petprofile WHERE petgender LIKE 'Female'";
    $resf = $connect->query($sqlf);
    $resf->execute();
    $rowf = $resf->fetch(PDO::FETCH_ASSOC);

    echo "
    <table class='table table-striped'>
    <thead>
        <tr>
            <th scope='col'>Pet ID</th>
            <th scope='col'>Owner ID</th>
            <th scope='col'>Name</th>
            <th scope='col'>Breed</th>
            <th scope='col'>Weight</th>
            <th scope='col'>Height</th>
            <th scope='col'>Birth Date</th>
            <th scope='col'>Age</th>
            <th scope='col'>Gender</th>
        </tr>
    </thead>
    <tbody>";

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "<tr scope='row'>
            <td>".$i."</td>
            <td>".$row['userid']."</td>
            <td>".$row['petname']."</td>
            <td>".$row['petbreed']."</td>
            <td>".$row['petweight']."</td>
            <td>".$row['petheight']."</td>
            <td>".$row['petbdate']."</td>
            <td>".$row['petage']."</td>
            <td>".$row['petgender']."</td>

            <td><button type='button' class='btn' onClick='petEdit(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit</button>
            <br>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "</tbody>
        </table>";
    }
?>
