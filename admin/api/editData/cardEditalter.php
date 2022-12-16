<?php
require("../connector.php");

    if(isset($_POST["submit"])){
        $card = $_POST["cid"];
        $owner = $_POST["userid"];
        $pet = $_POST["petid"];
        $vax = $_POST["vaxid"];
        $vet = $_POST["cvet"];
        $weight = $_POST["cweight"];
        $date = $_POST["cdate"];

        if($owner=="" || $pet=="" || $vet=="" || $vax=="" || $date==""){
            echo "<script>alert('Complete Required Fields!');
            window.location='profilealter.php?userid=".$owner."'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_carddetail SET
                userid = :userid,
                petid = :petid,
                vaxid = :vaxid,
                cvet = :cvet,
                cweight = :cweight,
                cdate = :cdate

                WHERE cid = :cid";

            $values = array(
                ":cid" => $card,
                ":userid" => $owner,
                ":petid" => $pet,
                ":vaxid" => $vax,
                ":cvet" => $vet,
                ":cweight" => $weight,
                ":cdate" => $date
            );

            $result = $connect->prepare($sql);
            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>alert('Record has been updated!');
                window.location='../profilealter.php?userid=".$owner."'</script>";
             } else {
                 echo "<script>alert('Unable to update record!')
                window.location='../profilealter.php?userid=".$owner."'</script>";
             }
        }
    }

    echo "<form action='editData/cardEditalter.php' method='POST'>";

    $card = $_REQUEST["cid"];
    $sql_card = "SELECT * FROM alagapp_db.tbl_carddetail WHERE cid = :cid";

    try{
        $card_res = $connect->prepare($sql_card);
        $value = array("cid"=>$card);
        $card_res->execute($value);

        $owner = "";
        $pet = "";
        $vax = "";
        $vet = "";
        $weight = "";
        $date = "";
        
        if($card_res->rowCount()==1){
            $card_row = $card_res->fetch(PDO::FETCH_ASSOC);

            $owner = $card_row["userid"];
            $pet = $card_row["petid"];
            $vax = $card_row["vaxid"];
            $vet = $card_row["cvet"];
            $weight = $card_row["cweight"];
            $date = $card_row["cdate"];
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
            <span class='input-group-text'>Veterinarian</span>
            <input class='form-control' type='text' placeholder=\"Veterinarian\" name='cvet' value=".$vet.">
            <span class='input-group-text'>Weight(Kg)</span>
            <input class='form-control' type='number' placeholder=\"Weight in Kilos\" name='cweight' value=".$weight.">
            <span class='input-group-text'>Date</span>
            <input class='form-control' type='date' placeholder=\"Date\" name='cdate' value=".$date.">
            </div><br>
            
            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='submit' name='submit' class='btn btn-primary'>Save changes</button>
            </div>
        </form>";