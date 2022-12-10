<?php
    require("API/connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_userlist";

    $res = $connect->prepare($sql);
    $res->execute();

    $sql2 = "SELECT COUNT(userid) AS entry FROM alagapp_db.tbl_userlist";
    $res2 = $connect->query($sql2);
    $res2->execute();
    $row1 = $res2->fetch(PDO::FETCH_ASSOC);
?>

<?php
    echo "
    <table class='table table-striped'>
    <thead>
        <tr>
            <th scope='col'>User ID</th>
            <th scope='col'>Email</th>
            <th scope='col'>Surname</th>
            <th scope='col'>First Name</th>
            <th scope='col'>Middle Name</th>
            <th scope='col'>Birth Date</th>
            <th scope='col'>Gender</th>
            <th scope='col'>Street</th>
            <th scope='col'>District</th>
            <th scope='col'>Municipality</th>
            <th scope='col'>Province</th>
        </tr>
    </thead>
    <tbody>";

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "<tr scope='row'>
            <td>".$i."</td>
            <td>".$row['useremail']."</td>
            <td>".$row['userlname']."</td>
            <td>".$row['userfname']."</td>
            <td>".$row['usermname']."</td>
            <td>".$row['userbdate']."</td>
            <td>".$row['usergender']."</td>
            <td>".$row['userstreet']."</td>
            <td>".$row['userdistrict']."</td>
            <td>".$row['usermunicipality']."</td>
            <td>".$row['userprovince']."</td>

            <td>
            <button type='button' class='btn' onClick='userEdit(".$row['userid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>Edit</button>
            <br>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "
                </tbody>
            </table>";
    }
?>