<?php
require("../connector.php");

    if(isset($_POST["submit"])){
        $card = $_POST["cid"];
        $owner = $_POST["userid"];
        $pet = $_POST["petid"];
        $vax = $_POST["vaxid"];
        $fdose = $_POST["fdose"];
        $sdose = $_POST["sdose"];
        $booster = $_POST["booster"];

        if($owner=="" || $pet=="" || $vax=="" || $fdose==""){
            echo "<script>alert('Complete Required Fields!');
            window.location='profile.php?userid=".$owner."'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_vaxxcard SET
                userid = :userid,
                petid = :petid,
                vaxid = :vaxid,
                fdose = :fdose,
                sdose = :sdose,
                booster = :booster

                WHERE cid = :cid";

            $values = array(
                ":cid" => $card,
                ":userid" => $owner,
                ":petid" => $pet,
                ":vaxid" => $vax,
                ":fdose" => $fdose,
                ":sdose" => $sdose,
                ":booster" => $booster
            );

            $result = $connect->prepare($sql);
            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>alert('Record has been updated!');
                window.location='../profile.php?userid=".$owner."'</script>";
             } else {
                 echo "<script>alert('Unable to update record!')
                window.location='../profile.php?userid=".$owner."'</script>";
             }
        }
    }

    echo "<form action='editData/cardEdit.php' method='POST'>";

    $card = $_REQUEST["cid"];
    $sql_card = "SELECT * FROM alagapp_db.tbl_vaxxcard WHERE cid = :cid";

    try{
        $card_res = $connect->prepare($sql_card);
        $value = array("cid"=>$card);
        $card_res->execute($value);

        $owner = "";
        $pet = "";
        $vax = "";
        $fdose = "";
        $sdose = "";
        $booster = "";
        
        if($card_res->rowCount()==1){
            $card_row = $card_res->fetch(PDO::FETCH_ASSOC);

            $owner = $card_row["userid"];
            $pet = $card_row["petid"];
            $vax = $card_row["vaxid"];
            $fdose = $card_row["fdose"];
            $sdose = $card_row["sdose"];
            $booster = $card_row["booster"];
        }
    } catch(PDOException $e){
        die("An error has occured!");
    }

    $ownern = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$owner."";
    $ownerres = $connect->prepare($ownern);
    $ownerres->execute();
    if($ownerres->rowCount()==1){
        $ownernrow = $ownerres->fetch(PDO::FETCH_ASSOC);
        $ownername = $ownernrow['userfname'];
    }
    
    $petn = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$pet."";
    $petres = $connect->prepare($petn);
    $petres->execute();
    if($petres->rowCount()==1){
        $petnrow = $petres->fetch(PDO::FETCH_ASSOC);
        $petname = $petnrow['petname'];
    }

    $vaxn = "SELECT * FROM alagapp_db.tbl_vaxxinfo WHERE vaxid = ".$vax."";
    $vaxres = $connect->prepare($vaxn);
    $vaxres->execute();
    if($vaxres->rowCount()==1){
        $vaxnrow = $vaxres->fetch(PDO::FETCH_ASSOC);
        $vaxname = $vaxnrow['vaxname'];
    }

    echo    "<input type='hidden' name='cid' value=".$card.">
            <h1>Card Information</h1><br>
            <div class='input-group'>
            <span class='input-group-text'>Owner</span>
            <input class='form-control' type='text' placeholder=\"Owner Name\" name='userfname' value=".$ownername." readonly>
            <input class='form-control' type='hidden' placeholder=\"Owner ID\" name='userid' value=".$owner.">
            <span class='input-group-text'>Pet Name</span>
            <input class='form-control' type='text' placeholder=\"Pet Name\" name='petname' value=".$petname." readonly>
            <input class='form-control' type='hidden' placeholder=\"Pet ID\" name='petid' value=".$pet.">
            <span class='input-group-text'>Vaccine</span>
            <input class='form-control' type='hidden' placeholder=\"Vaccine ID\" name='vaxid' value=".$vax.">
            <input class='form-control' type='text' placeholder=\"Vaccine Name\" name='vaxname' value=".$vaxname." readonly>
            </div><br>
            <div class='input-group'>
            <span class='input-group-text'>First Dose</span>
            <input class='form-control' type='date' placeholder=\"First Dose\" name='fdose' value=".$fdose.">
            <span class='input-group-text'>Second Dose</span>
            <input class='form-control' type='date' placeholder=\"Second Dose\" name='sdose' value=".$sdose.">
            <span class='input-group-text'>Booster</span>
            <input class='form-control' type='date' placeholder=\"Booster\" name='booster' value=".$booster.">
            </div><br>
            
            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='submit' name='submit' class='btn btn-primary'>Save changes</button>
            </div>
        </form>";