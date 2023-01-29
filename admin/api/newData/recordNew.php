<?php
    require("../connector.php");
    session_start();
    if(isset($_POST["submit"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $vet = $_POST["rvet"];
        $temp = $_POST["rtemp"];
        $weight = $_POST["rweight"];
        $date = $_POST["rdate"];
        $history = $_POST["rhistory"];
        $treatment = $_POST["rtreatment"];

        if($user=="" || $pet=="" || $vet=="" || $date==""){
            $_SESSION["trigger"] = "newERecord";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Fields Required
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_record(
                userid,
                petid,
                rdate,
                rweight,
                rtemp,
                rhistory,
                rtreatment,
                rvet) VALUES(
                    :userid,
                    :petid,
                    :rdate,
                    :rweight,
                    :rtemp,
                    :rhistory,
                    :rtreatment,
                    :rvet)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":rdate"=>$date,
                ":rweight"=>$weight,
                ":rtemp"=>$temp,
                ":rhistory"=>$history,
                ":rtreatment"=>$treatment,
                ":rvet"=>$vet
            );

            $result->execute($values);

            if($result->rowCount()>0) {
                $_SESSION["trigger"] = "newRecord";
                echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Record Save
             } else {
                $_SESSION["trigger"] = "newERecord";
                echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Record Not Saved
             }
        }
    }

    $pid = $_REQUEST["petid"];
    $sql_card = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$pid."";
    $card_res = $connect->prepare($sql_card);
    $card_res->execute();
    $row = $card_res->fetch(PDO::FETCH_ASSOC);

    $user = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$row['userid']."";
    $user_res = $connect->prepare($user);
    $user_res->execute();
    $userrow = $user_res->fetch(PDO::FETCH_ASSOC);

    echo "
    <form action='newData/recordNew.php' method='POST'>
    <h1>New Medical History</h1><br>
        <div class='input-group'>
            <label class='input-group-text'>Owner</label>
                <input placeholder=\"Owner ID\" type='hidden' class='form-control' value='".$userrow['userid']."' name='userid'>
                <input placeholder=\"Owner Name\" type='text' class='form-control' value='".$userrow['userfname']."' name='userfname' readonly>
            <label class='input-group-text'>Pet Name</label>
                <input placeholder=\"Pet ID\" type='hidden' class='form-control' value='".$row['petid']."' name='petid'>
                <input placeholder=\"Pet Name\" type='text' class='form-control' value='".$row['petname']."' name='petname' readonly>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>Date</label>
                <input type='date' class='form-control' name='rdate' required>
            <label class='input-group-text'>Wt.(Kg)</label>
                <input type='text' placeholder=\"Enter Weight\" class='form-control' name='rweight'>
            <label class='input-group-text'>Temp.</label>
                <input type='text' placeholder=\"37.2 c/f\" class='form-control' name='rtemp' required>
            <label class='input-group-text'>Vet</label>
                <input type='text' placeholder=\"Enter Vet\" class='form-control' name='rvet' required>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>History</label>
            <textarea placeholder=\"Description\" name='rhistory' class='form-control row-5' aria-label='With textarea' required></textarea>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>Treatment</label>
            <textarea placeholder=\"Description\" name='rtreatment' class='form-control row-5' aria-label='With textarea' required></textarea>
        </div><br>

        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary')'>Add Record</button>
        </div>
    </form>";