<?php
    require("../connector.php");

    if(isset($_POST["submit"])){
        $qid = $_POST["qid"];
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $status = $_POST["status"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $status==""){
            echo "<script>alert('Please complete the fields required!');
            window.location='../../account.php'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_scheduler SET
                userid = :userid,
                petid = :petid,
                qdescription = :qdescription,
                qdate = :qdate,
                qstatus = :qstatus

                WHERE qid = :qid";

            $values = array(
                ":qid"=>$qid,
                ":userid"=>$user,
                ":petid"=>$pet,
                ":qdescription"=>$description,
                ":qdate"=>$date,
                ":qstatus"=>$status
            );

            $result = $connect->prepare($sql);
            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>alert('Record has been updated!');
                window.location='../../account.php'</script>";
             } else {
                 echo "<script>alert('Unable to update record!')
                 window.location='../../account.php'</script>";
             }
        }
    }

    echo    "<form action='editData/scheduleEdit.php' method='POST'>";

    $qid = $_REQUEST["qid"];
    $sql_sched = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname as user, alagapp_db.tbl_petprofile.petname as pet
    FROM ((alagapp_db.tbl_scheduler
    INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
    INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)  
    WHERE qid = :qid";

    try{
        $sched_res = $connect->prepare($sql_sched);
        $value = array("qid"=>$qid);
        $sched_res->execute($value);

        $userid = "";
        $petid = "";
        $description = "";
        $date = "";
        $status = "";
        
        if($sched_res->rowCount()==1){
            $sched_row = $sched_res->fetch(PDO::FETCH_ASSOC);

            $userid = $sched_row["userid"];
            $user = $sched_row["user"];
            $petid = $sched_row["petid"];
            $pet = $sched_row["pet"];
            $description = $sched_row["qdescription"];
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
                    <input type='text' class='form-control' name='userid' value=".$userid." hidden>
                    <input type='text' class='form-control' name='userid' value=".$user.">
                    <label class='input-group-text'>Pet</label>
                    <input type='text' class='form-control' name='petid' value=".$petid." hidden>
                    <input type='text' class='form-control' name='userid' value=".$pet.">
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Description</label>
                    <textarea placeholder=\"Description\" name='description' class='form-control' aria-label='With textarea'>".$description."</textarea>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Date</label>
                    <input type='date' class='form-control' name='date' value=".$date.">
                    <label class='input-group-text'>Status</label>
                <input type='text' class='form-control' name='status' value=".$status.">
                </div><br>

            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button id='submitPetEdit' type='submit' name='submit' class='btn btn-primary'>Save changes</button>
            </div>
        </form>";