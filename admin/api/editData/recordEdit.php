<?php
    require("../connector.php");
    session_start();
    if(isset($_POST["submit"])){
        $rid = $_POST["rid"];
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $vet = $_POST["rvet"];
        $temp = $_POST["rtemp"];
        $weight = $_POST["rweight"];
        $date = $_POST["rdate"];
        $history = $_POST["rhistory"];
        $treatment = $_POST["rtreatment"];

        if($user=="" || $pet=="" || $vet=="" || $date==""){
            $_SESSION["trigger"] = "editERecord";
            //echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Fields Required
        } else {
            $sql = "UPDATE alagapp_db.tbl_record SET
                userid = :userid,
                petid = :petid,
                rdate = :rdate,
                rweight = :rweight,
                rtemp = :rtemp,
                rhistory = :rhistory,
                rtreatment = :rtreatment,
                rvet = :rvet
                
                WHERE rid = :rid";

            $result = $connect->prepare($sql);

            $values = array(
                ":rid" => $rid,
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
                $_SESSION["trigger"] = "editRecord";
                echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Record Save
             } else {
                $_SESSION["trigger"] = "editERecord";
                echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Record Not Saved
             }
        }
    }

    echo "<form action='editData/recordEdit.php' method='POST'>";

    $rid = $_REQUEST["rid"];
    $sql_rec = "SELECT * FROM alagapp_db.tbl_record WHERE rid = :rid";

    try{
        $rec_res = $connect->prepare($sql_rec);
        $value = array(":rid"=>$rid);
        $rec_res->execute($value);

        $userid = "";
        $petid = "";
        $date = "";
        $weight = "";
        $temp = "";
        $vet = "";
        $history = "";
        $treatment = "";
        
        if($rec_res->rowCount()==1){
            $rrow = $rec_res->fetch(PDO::FETCH_ASSOC);

            $userid = $rrow["userid"];
            $petid = $rrow["petid"];
            $date = $rrow["rdate"];
            $weight = $rrow["rweight"];
            $temp = $rrow["rtemp"];
            $vet = $rrow["rvet"];
            $history = $rrow["rhistory"];
            $treatment = $rrow["rtreatment"];
        }

        $ownern = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$userid."";
        $ownerres = $connect->prepare($ownern);
        $ownerres->execute();
        if($ownerres->rowCount()==1){
            $ownernrow = $ownerres->fetch(PDO::FETCH_ASSOC);
            $ownername = $ownernrow['userfname'];
        }

        $petn = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$petid."";
        $res = $connect->prepare($petn);
        $res->execute();
        if($res->rowCount()==1){
            $petnrow = $res->fetch(PDO::FETCH_ASSOC);
            $petname = $petnrow['petname'];
        }


    } catch(PDOException $e){
        die("An error has occured!");
    }

    echo "<input type='hidden' name='rid' value=".$rid.">
    <h1>Edit Medical History</h1><br>
        <div class='input-group'>
            <label class='input-group-text'>Owner</label>
                <input placeholder=\"Owner ID\" type='hidden' class='form-control' value='".$userid."' name='userid'>
                <input placeholder=\"Owner Name\" type='text' class='form-control' value='".$ownername."' name='userfname' readonly>
            <label class='input-group-text'>Pet Name</label>
                <input placeholder=\"Pet ID\" type='hidden' class='form-control' value='".$petid."' name='petid'>
                <input placeholder=\"Pet Name\" type='text' class='form-control' value='".$petname."' name='petname' readonly>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>Date</label>
                <input type='date' class='form-control' name='rdate' value='".$rrow['rdate']."' required>
            <label class='input-group-text'>Wt.(Kg)</label>
                <input type='text' placeholder=\"Enter Weight\" class='form-control' name='rweight' value='".$rrow['rweight']."'>
            <label class='input-group-text'>Temp.</label>
                <input type='text' placeholder=\"37.2 c/f\" class='form-control' name='rtemp' value='".$rrow['rtemp']."' required>
            <label class='input-group-text'>Vet</label>
                <input type='text' placeholder=\"Enter Vet\" class='form-control' name='rvet' value='".$rrow['rvet']."' required>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>History</label>
            <textarea placeholder=\"Description\" name='rhistory' class='form-control row-5' aria-label='With textarea' required>".$rrow['rhistory']."</textarea>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>Treatment</label>
            <textarea placeholder=\"Description\" name='rtreatment' class='form-control row-5' aria-label='With textarea' required>".$rrow['rtreatment']."</textarea>
        </div><br>

        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary')'>Add Record</button>
        </div>
    </form>";