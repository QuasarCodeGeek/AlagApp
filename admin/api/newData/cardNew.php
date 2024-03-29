<?php
    require("../connector.php");
    session_start();
    if(isset($_POST["submit"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $vax = $_POST["vaxid"];
        $vet = $_POST["cvet"];
        $weight = $_POST["cweight"];
        $date = $_POST["cdate"];
        $next = $_POST["cnext"];
        $check = $_POST["check"];

        if($user=="" || $pet=="" || $vax=="" || $vet=="" || $date==""){
            $_SESSION["trigger"] = "newECard";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Fields Required
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_carddetail(
                userid,
                petid,
                vaxid,
                cvet,
                cweight,
                cdate,
                cnext) VALUES(
                    :userid,
                    :petid,
                    :vaxid,
                    :cvet,
                    :cweight,
                    :cdate,
                    :cnext)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":vaxid"=>$vax,
                ":cvet"=>$vet,
                ":cweight"=>$weight,
                ":cdate"=>$date,
                ":cnext"=>$next
            );

            $result->execute($values);

            if($result->rowCount()>0) {

                if($check == "checked" AND date("d/M/Y", strtotime($next)) > date("d/M/Y")){
                    include("./autoSched.php");
                } else {
                    $_SESSION["trigger"] = "newECard";
                    echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Record Not Saved
                }
                $_SESSION["trigger"] = "newCard";
                echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Record Save
             } else {
                $_SESSION["trigger"] = "newECard";
                echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Record Not Saved
             }
        }
    }

    $pid = $_REQUEST["petid"];
    $sql_card = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$pid."";

    $card_res = $connect->prepare($sql_card);
    $card_res->execute();
    $row = $card_res->fetch(PDO::FETCH_ASSOC);

    
    $sqlvax = "SELECT * FROM alagapp_db.tbl_vaxxinfo";
    $resvax = $connect->query($sqlvax);
    $resvax->execute();

    $user = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$row['userid']."";

    $user_res = $connect->prepare($user);
    $user_res->execute();
    $userrow = $user_res->fetch(PDO::FETCH_ASSOC);

    echo "
    <form action='newData/cardNew.php' method='POST'>
    <h1>New E-Vaccine Card</h1><br>
        <div class='input-group'>
            <label class='input-group-text'>Owner</label>
                <input placeholder=\"Owner ID\" type='hidden' class='form-control' value='".$userrow['userid']."' name='userid'>
                <input placeholder=\"Owner Name\" type='text' class='form-control' value='".$userrow['userfname']."' name='userfname' readonly>
            <label class='input-group-text'>Pet Name</label>
                <input placeholder=\"Pet ID\" type='hidden' class='form-control' value='".$row['petid']."' name='petid'>
                <input placeholder=\"Pet Name\" type='text' class='form-control' value='".$row['petname']."' name='petname' readonly>
            <label class='input-group-text'>Vaccine</label>
                <select class='form-select' name='vaxid' id='inputGroupSelect' required>
                <option selected=''>-- Select Vaccine--</option>";
                if($resvax->rowCount()>0){
                    $counter=1;
                    while($vaxrow = $resvax->fetch(PDO::FETCH_ASSOC)){
                        echo "<option name ='vaxid' value='".$vaxrow['vaxid']."'>".$vaxrow['vaxname']."</option>";
                        $counter++;
                    }
                };
        echo "</select>
        </div><br>
        <div class='input-group'>
            <label class='input-group-text'>Veterinarian</label>
            <input type='text' placeholder=\"Enter Veterinarian\" class='form-control' name='cvet' required>
            <label class='input-group-text'>Weight(Kg)</label>
            <input type='text' placeholder=\"Enter Weight\" class='form-control' name='cweight'>
            <label class='input-group-text'>Date</label>
            <input type='date' class='form-control' name='cdate' required>
            <label class='input-group-text'>Due Date</label>
            <input type='date' class='form-control' name='cnext' required>
            </div><br>
            <p>Do you want to generate a new scheduler for this vaccination's due date? 
            <input class='form-check-input' type='checkbox' value='checked' name='check' id='flexCheckChecked' checked></p>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary')'>Add Card</button>
        </div>
    </form>";