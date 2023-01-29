<?php
    require("../connector.php");

    session_start();
    $errorDate = NULL;
    if(isset($_POST["submit"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $time = $_POST["time"];
        $date = $_POST["date"];
        $status = $_POST["status"];
        $set = 1;

        if($user=="" || $pet=="" || $description=="" || $date=="" || $status=="" || date("Y/m/d",strtotime($date)) < date("Y/m/d")){
            $errorDate = "<div class='alert alert-danger alert-dismissible' role='alert'>
            <div>Invalid date!</div>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            "; 
            //$_SESSION["trigger"] = "newESched";
            //echo "<script>window.location='./../sched_profile.php?userid=".$user."'</script>";//Field Required
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_scheduler(
                userid,
                petid,
                qdescription,
                qtime,
                qdate,
                qstatus,
                qset) VALUES(
                    :userid,
                    :petid,
                    :qdescription,
                    :qtime,
                    :qdate,
                    :qstatus,
                    :qset)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":qdescription"=>$description,
                ":qtime"=>$time,
                ":qdate"=>$date,
                ":qstatus"=>$status,
                ":qset"=>$set
            );

            $result->execute($values);

            if($result->rowCount()>0) {
                $_SESSION["trigger"] = "newSched";
                echo "<script>window.location='./../sched_profile.php?userid=".$user."'</script>";//Saved
             } else {
                $_SESSION["trigger"] = "newESched";
                echo "<script>window.location='./../sched_profile.php?userid=".$user."'</script>";//Not Saved
             }
        }
    }

    $user = $_REQUEST['userid'];
    $get = "SELECT userfname, userlname FROM alagapp_db.tbl_userlist WHERE userid = ".$user."";
    $res = $connect->prepare($get);
    $res->execute();
    $row = $res->fetch(PDO::FETCH_ASSOC);

    $getpet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE userid = ".$user."";
    $respet = $connect->prepare($getpet);
    $respet->execute();

    echo "
    <form action='newData/scheduleNew.php' method='POST'>
    <h1>New Schedule</h1><br>
        <div class='input-group'>
                    <label class='input-group-text'>Owner</label>
                    <input placeholder=\"Enter Owner ID\" type='text' class='form-control' name='userid' value='".$user."' hidden>
                    <input placeholder=\"Enter Owner\" type='text' class='form-control' name='user' value='".$row['userfname']." ".$row['userlname']."' readonly>
                    <label class='input-group-text'>Pet</label>
                    <select class='form-select' aria-label='Default select example' name='petid' required>
                        <option selected>Select Pet</option>";
                        if($respet->rowCount()>0){
                            $i=1;
                            while($rowp = $respet->fetch(PDO::FETCH_ASSOC)){
                                echo "<option value=".$rowp['petid'].">".$rowp['petname']."</option>";
                            }
                        }
                    echo "</select>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Description</label>
                    <textarea placeholder=\"Description\" name='description' class='form-control' aria-label='With textarea' required></textarea>
                </div><br>

                <div id='errorDate'></div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Time</label>
                    <input type='time' class='form-control' name='time' required>
                    <label class='input-group-text'>Date</label>
                    <input type='date' class='form-control' name='date' id='date' onchange='checkDate()' required>
                    <label class='input-group-text'>Status</label>
                    <select class='form-select' aria-label='Default select example' name='status' required>
                        <option selected>Select Status</option>
                        <option value='Pending'>Pend</option>
                        <option value='Accepted'>Accept</option>
                        <option value='Denied'>Deny</option>
                        <option value='Finished'>Finish</option>
                    </select>
                </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary'>Add New Schedule</button>
        </div>
    </form>";
