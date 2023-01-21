<?php
require("../connector.php");
    if(isset($_POST["submit"])){
        $owner = $_POST["userid"];
        $name = $_POST["petname"];
        $type = $_POST["pettype"];
        $breed = $_POST["petbreed"];
        $weight = $_POST["petweight"];
        $mark = $_POST["petmark"];
        $bdate = $_POST["petbdate"];
        $age = $_POST["petage"];
        $gender = $_POST["petgender"];

        if($owner=="" || $name=="" || $type=="" || $breed=="" || $age ==""){
            echo "<script>window.location='../profile.php?userid=".$owner."'</script>";//Fields Required
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_petprofile(
                userid,
                petname,
                pettype,
                petbreed,
                petweight,
                petmark,
                petbdate,
                petage,
                petgender) VALUES(
                    :userid,
                    :petname,
                    :pettype,
                    :petbreed,
                    :petweight,
                    :petmark,
                    :petbdate,
                    :petage,
                    :petgender)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid" => $owner,
                ":petname" => $name,
                ":pettype" => $type,
                ":petbreed" => $breed,
                ":petweight" => $weight,
                ":petmark" => $mark,
                ":petbdate" => $bdate,
                ":petage" => $age,
                ":petgender" => $gender
            );

            $result->execute($values);

            if($result->rowCount()>0) {
               echo "<script>window.location='../profile.php?userid=".$owner."'</script>";//Saved
            } else {
                echo "<script>window.location='../profile.php?userid=".$owner."'</script>";//Not Saved
            }
        }
    }

    $user = $_REQUEST['userid'];
    $sqlOwner = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$user."";
    $resOwner = $connect->query($sqlOwner);
    $resOwner->execute();
    $OwnerRow = $resOwner->fetch(PDO::FETCH_ASSOC);
    echo    "
            <form action='newData/petNew.php' method='POST'>
            <h1>New Pet Profile</h1><br>
            <div class='input-group'>
            <span class='input-group-text'>Pet Name</span>
            <input class='form-control' type='text' placeholder=\"Name\" name='petname' required>
            <span class='input-group-text'>Species</span>
            <input class='form-control' type='text' placeholder=\"Species\" name='pettype' required>
            <span class='input-group-text'>Breed</span>
            <input class='form-control' type='text' placeholder=\"Breed\" name='petbreed' required>
            </div><br>
            <div class='input-group'>
            <span class='input-group-text'>Birth Date</span>
            <input class='form-control' type='date' name='petbdate' required>
            <span placeholder=\"Age\" class='input-group-text'>Age</span>
            <input class='form-control' type='number' placeholder='Age' name='petage'>
            <label class='input-group-text' for='inputGenderSelect'>Gender</label>
                <select class='form-select' name='petgender' id='inputGenderSelect' required>
                    <option selected''>-- Select Gender --</option>
                    <option value='M'>M</option>
                    <option value='F'>F</option>
                </select>
            </div><br>
            <div class='input-group'>
            <label class='input-group-text' for='inputGroupSelect'>Owner</label>
            <input class='form-control' type='text' value='".$OwnerRow['userid']."' name='userid' hidden>
            <input class='form-control' type='text' value='".$OwnerRow['userfname']."' name='userfname' readonly>
            <span class='input-group-text'>Weight(kg)</span>
            <input class='form-control' type='float' placeholder=\"Weight\" name='petweight'>
            <span class='input-group-text'>Color/Marking</span>
            <input class='form-control' type='text' placeholder=\"Color/Marking\" name='petmark' required>
            </div><br>

            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button id='submitPetEdit' type='submit' name='submit' class='btn btn-primary'>Add Pet Profile</button>
            </div>
        </form>";
?>