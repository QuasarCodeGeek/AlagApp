<?php
    require("../connector.php");

    session_start();
    if(isset($_POST["submit"])){
        $qid = $_POST["qid"];
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $time = $_POST["time"];
        $date = $_POST["date"];
        $status = $_POST["status"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $status==""){
            $_SESSION["trigger"] = "editESched";
            echo "<script>window.location='../sched_profile.php?userid=".$user."'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_scheduler SET
                userid = :userid,
                petid = :petid,
                qdescription = :qdescription,
                qtime = :qtime,
                qdate = :qdate,
                qstatus = :qstatus

                WHERE qid = :qid";

            $values = array(
                ":qid"=>$qid,
                ":userid"=>$user,
                ":petid"=>$pet,
                ":qdescription"=>$description,
                ":qtime"=>$time,
                ":qdate"=>$date,
                ":qstatus"=>$status
            );

            $result = $connect->prepare($sql);
            $result->execute($values);

            if($result->rowCount()>0) {
                $_SESSION["trigger"] = "editSched";
                echo "<script>window.location='../sched_profile.php?userid=".$user."'</script>";
             } else {
                $_SESSION["trigger"] = "editESched";
                echo "<script>window.location='../sched_profile.php?userid=".$user."'</script>";
             }
        }
    }

    echo    "<form action='editData/schedEdit.php' method='POST'>";

    $qid = $_REQUEST["qid"];
    $sql_sched = "SELECT * FROM alagapp_db.tbl_scheduler WHERE qid = :qid";

    try{
        $sched_res = $connect->prepare($sql_sched);
        $value = array("qid"=>$qid);
        $sched_res->execute($value);

        $userid = "";
        $petid = "";
        $description = "";
        $time = "";
        $date = "";
        $status = "";
        
        if($sched_res->rowCount()==1){
            $sched_row = $sched_res->fetch(PDO::FETCH_ASSOC);

            $sql_pet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$sched_row["petid"]." ";
            $pet_res = $connect->prepare($sql_pet);
            $pet_res->execute();
            $pet_row = $pet_res->fetch(PDO::FETCH_ASSOC);

            $sql_owner = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$pet_row["userid"]." ";
            $owner_res = $connect->prepare($sql_owner);
            $owner_res->execute();
            $owner_row = $owner_res->fetch(PDO::FETCH_ASSOC);

            $userid = $sched_row["userid"];
            $user = $owner_row["userfname"];
            $petid = $sched_row["petid"];
            $pet = $pet_row["petname"];
            $description = $sched_row["qdescription"];
            $time = $sched_row["qtime"];
            $date = $sched_row["qdate"];
            $status = $sched_row["qstatus"];
        }
    } catch(PDOException $e){
        die("An error has occured!");
    }
    echo        "<input type='hidden' name='qid' value=".$qid.">
                <h1>Schedule Information</h1><br>
                <div class='input-group'>
                    <label class='input-group-text'>Owner</label>
                    <input type='text' class='form-control' name='userid' value='".$userid."' hidden>
                    <input type='text' class='form-control' name='user' value='".$user."'>
                    <label class='input-group-text'>Pet</label>
                    <input type='text' class='form-control' name='petid' value='".$petid."' hidden>
                    <input type='text' class='form-control' name='pet' value='".$pet."'>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Description</label>
                    <textarea placeholder=\"Description\" name='description' class='form-control' aria-label='With textarea'>".$description."</textarea>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Time</label>
                    <input type='time' class='form-control' name='time' value='".$time."'>
                    <label class='input-group-text'>Date</label>
                    <input type='date' class='form-control' name='date' value='".$date."'>
                    <label class='input-group-text'>Status</label>
                    <select class='form-select' name='status'>
                        <option selected value='".$status."'>".$status."</option>
                        <option value='Pending'>Pend</option>
                        <option value='Accepted'>Accept</option>
                        <option value='Denied'>Deny</option>
                        <option value='Finished'>Finish</option>
                    </select>
                </div><br>

            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button id='submitPetEdit' type='submit' name='submit' class='btn btn-primary'>Save changes</button>
            </div>
        </form>";