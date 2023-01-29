<?php
    require("../connector.php");

    session_start();
    if(isset($_POST["submit"])){
        
        $pet = $_POST["petid"];
        $owner = $_POST["userid"];
        $petname = $_POST["petname"];
        $pettype = $_POST["pettype"];
        $petbreed = $_POST["petbreed"];
        $petweight = $_POST["petweight"];
        $petmark = $_POST["petmark"];
        $petbdate = $_POST["petbdate"];
        $petage = $_POST["petage"];
        $petgender = $_POST["petgender"];

        if($owner=="" || $petname=="" || $pettype=="" || $petbreed=="" || $petbdate=="" || $petage =="" || $petgender==""){
            $_SESSION["trigger"] = "editEPet";
            echo "<script>window.location='../profile.php?userid=".$owner."'</script>";
        } else {

            $update = "UPDATE alagapp_db.tbl_petprofile SET 
                userid = :userid,
                petname = :petname,
                pettype = :pettype,
                petbreed = :petbreed,
                petweight = :petweight,
                petmark = :petmark,
                petbdate = :petbdate,
                petage = :petage,
                petgender = :petgender

                WHERE petid = :petid";

            $val = array(
                ":petid"=>$pet,
                ":userid"=>$owner,
                ":petname"=>$petname,
                ":pettype"=>$pettype,
                ":petbreed"=>$petbreed,
                ":petweight"=>$petweight,
                ":petmark"=>$petmark,
                ":petbdate"=>$petbdate,
                ":petage"=>$petage,
                ":petgender"=>$petgender
            );

            $result = $connect->prepare($update);
            
            $result->execute($val);
                
            if($result->rowCount()>0) {
                $_SESSION["trigger"] = "editPet";
                echo "<script>window.location='../profile.php?userid=".$owner."'</script>";
             } else {
                $_SESSION["trigger"] = "editEPet";
                echo "<script>window.location='../profile.php?userid=".$owner."'</script>";
             }
        }
    }

    echo "<form action='editData/petEdit.php' method='POST'>";

    $pet = $_REQUEST["id"];
    $sql_pet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = :petid";

    $sqljoin = "SELECT alagapp_db.tbl_userlist.userid, alagapp_db.tbl_userlist.userfname FROM alagapp_db.tbl_petprofile 
    INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_petprofile.userid = alagapp_db.tbl_userlist.userid
    WHERE petid = :petid";
    $joinres = $connect->prepare($sqljoin);
    $valjoin = array("petid"=>$pet);
    $joinres->execute($valjoin);
    $joinres->rowCount()==1;
    $joinrow = $joinres->fetch(PDO::FETCH_ASSOC);

    try{
        $pet_res = $connect->prepare($sql_pet);
        $value = array("petid"=>$pet);
        $pet_res->execute($value);

        $owner = "";
        $petname = "";
        $pettype = "";
        $petbreed = "";
        $petweight = "";
        $petmark = "";
        $petbdate = "";
        $petage = "";
        $petgender = "";
        
        if($pet_res->rowCount()==1){
            $pet_row = $pet_res->fetch(PDO::FETCH_ASSOC);

            $owner = $pet_row["userid"];
            $petname = $pet_row["petname"];
            $pettype = $pet_row["pettype"];
            $petbreed = $pet_row["petbreed"];
            $petweight = $pet_row["petweight"];
            $petmark = $pet_row["petmark"];
            $petbdate = $pet_row["petbdate"];
            $petage = $pet_row["petage"];
            $petgender = $pet_row["petgender"];
        }
    } catch(PDOException $e){
        die("An error has occured!");
    }

    $sqlOwner = "SELECT * FROM alagapp_db.tbl_userlist";
    $resOwner = $connect->query($sqlOwner);
    $resOwner->execute();
    
    echo    "<input type='hidden' name='petid' value=".$pet.">
            <h1>Pet Profile</h1><br>
            <div class='input-group'>
            <span class='input-group-text'>Pet Name</span>
            <input class='form-control' type='text' placeholder=\"Name\" name='petname' value='".$petname."'>
            <span class='input-group-text'>Species</span>
            <input class='form-control' type='text' placeholder=\"Species\" name='pettype' value='".$pettype."'>
            <span class='input-group-text'>Breed</span>
            <input class='form-control' type='text' placeholder=\"Breed\" name='petbreed' value='".$petbreed."'>
            </div><br>

            <div class='input-group'>
            <span class='input-group-text'>Birth Date</span>
            <input class='form-control' type='date' name='petbdate' value='".$petbdate."'>
            <span class='input-group-text'>Age</span>
            <input class='form-control' type='text' placeholder=\"Age\" name='petage' value='".$petage."'>
            <label class='input-group-text' for='inputGenderSelect'>Gender</label>
                <select class='form-select' name='petgender' id='inputGenderSelect'>
                    <option selected=".$petgender." value='".$petgender."'>".$petgender."</option>
                    <option value=''>-- Select Gender --</option>
                    <option value='M'>M</option>
                    <option value='F'>F</option>
                </select>
            </div><br>



            <div class='input-group'>
            <label class='input-group-text' for='inputGroupSelect'>Owner</label>
                <select class='form-select' name='userid' id='inputGroupSelect'>
                    <option selected=".$owner." value='".$owner."'>".$joinrow['userfname']."</option>
                    <option value=''>-- Select Owner --</option>";
                if($resOwner->rowCount()>0){
                    $counter=1;
                    while($OwnerRow = $resOwner->fetch(PDO::FETCH_ASSOC)){
                        echo "<option name='userid' value='".$OwnerRow['userid']."'>".$OwnerRow['userfname']."</option>";
                        $counter++;
                    }
                }; 
                
            echo "</select>
            <span class='input-group-text'>Weight</span>
            <input class='form-control' type='float' placeholder=\"Weight\" name='petweight' value='".$petweight."'>
            <span class='input-group-text'>Color/Marking</span>
            <input class='form-control' type='text' placeholder=\"Color/Marking\" name='petmark' value='".$petmark."'>
            </div><br>

            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='submit' name='submit' class='btn btn-primary'>Save changes</button>
            </div>
        </form>";
?>