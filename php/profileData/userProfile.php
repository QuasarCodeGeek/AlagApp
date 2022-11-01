<?php
    require("../connector.php");

    $account = $_GET["userid"];
    $sql = "SELECT * FROM alagapp_db.tbl_userlist
        WHERE userid = ".$account." ";

    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $row = $res->fetch(PDO::FETCH_ASSOC);
        echo"
            <div class='col-3'>
            <img class='userProfile m-auto rounded' src='assets/img/diluc.png' alt='profile_picture'><br>
            </div>
            <div class='col-4 p-2 rounded bg bg-light'>
                <button type='button' class='btn float-end' onClick='userEdit(".$row['userid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>
                    <i class='bi bi-pencil-square'></i>    
                <!--<img class='edit_icon' src='../../assets/bootstrap-icons/pencil-square.svg' alt=''>-->
                </button><br>
                <label>Name: ".$row['userfname']." ".$row['usermname']." ".$row['userlname']."</label><br>
                <label>username: ".$row['useremail']."</label><br>
                <label>Birth Date: ".$row['userbdate']."</label><br>
                <label>Gender: ".$row['usergender']."</label><br>
                <label>Address: ".$row['userstreet']." ".$row['userdistrict']." ".$row['usermunicipality']." ".$row['userprovince']."</label>
            </div>
            <div class='col-5'>
                <button type='button' class='btn btn-light'>Generate Report</button><br>
                <label>Number of Pets:</label>
            </div>";
    } else {
        echo "No Record";
    }
?>