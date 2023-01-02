<?php
    require("../connector.php");

    if(isset($_POST["submit"])){
        $nid = $_POST["nid"];
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $status = $_POST["status"];
        $vet = $_POST["vet"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $vet==""){
            echo "<script>alert('Please complete the fields required!');
            window.location='profile.php?userid=".$user."'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_notedetail SET
                userid = :userid,
                petid = :petid,
                ndescription = :ndescription,
                ndate = :ndate,
                nstatus = :nstatus,
                nvet = :nvet

                WHERE nid = :nid";

            $values = array(
                ":nid"=>$nid,
                ":userid"=>$user,
                ":petid"=>$pet,
                ":ndescription"=>$description,
                ":ndate"=>$date,
                ":nstatus"=>$status,
                ":nvet"=>$vet
            );

            $result = $connect->prepare($sql);
            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>alert('Record has been updated!');
                window.location='../profile.php?userid=".$user."'</script>";
             } else {
                 echo "<script>alert('Unable to update record!');
                 window.location='../profile.php?userid=".$user."'</script>";
             }
        }
    }

    echo "<form action='editData/prescriptionEdit.php' method='POST'>";

    $nid = $_REQUEST["nid"];
    $sql_note = "SELECT * FROM alagapp_db.tbl_notedetail WHERE nid = :nid";

    try{
        $note_res = $connect->prepare($sql_note);
        $value = array("nid"=>$nid);
        $note_res->execute($value);

        $userid = "";
        $petid = "";
        $description = "";
        $date = "";
        $status = "";
        $vet = "";
        
        if($note_res->rowCount()==1){
            $note_row = $note_res->fetch(PDO::FETCH_ASSOC);

            $userid = $note_row["userid"];
            $petid = $note_row["petid"];
            $description = $note_row["ndescription"];
            $date = $note_row["ndate"];
            $vet = $note_row["nvet"];
            //$status = $note_row["nstatus"];
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
    echo "<input type='hidden' name='nid' value=".$nid.">
                <h1>Prescription Information</h1><br>
                <div class='input-group'>
                    <label class='input-group-text'>Pet Owner</label>
                    <input type='hidden' class='form-control' name='userid' value='".$userid."'>
                    <input type='text' class='form-control' name='owner' value='".$ownername."' readonly>
                    <label class='input-group-text'>Pet Name</label>
                    <input type='hidden' class='form-control' name='petid' value='".$petid."'>
                    <input type='text' class='form-control' name='pet' value='".$petname."' readonly>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Description</label>
                    <textarea placeholder=\"Description\" name='description' class='form-control' aria-label='With textarea'>".$description."</textarea>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Date</label>
                    <input type='date' class='form-control' name='date' value='".$date."'>
                    <label class='input-group-text'>Veterinarian</label>
                    <input type='text' class='form-control' name='status' value='".$status."' hidden>
                    <input type='text' class='form-control' name='vet' value='".$vet."'>
                </div><br>

                <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='submit' name='submit' class='btn btn-primary'>Save changes</button>
            </div>
        </form>";