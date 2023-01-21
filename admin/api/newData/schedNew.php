<?php
    require("../connector.php");

    if(isset($_POST["submit"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $time = $_POST["time"];
        $date = $_POST["date"];
        $status = $_POST["status"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $status==""){
            echo "<script>window.location='./../sched_profile.php?userid=".$user."'</script>";//Field Required
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_scheduler(
                userid,
                petid,
                qdescription,
                qtime,
                qdate,
                qstatus) VALUES(
                    :userid,
                    :petid,
                    :qdescription,
                    :qtime,
                    :qdate,
                    :qstatus)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":qdescription"=>$description,
                ":qtime"=>$time,
                ":qdate"=>$date,
                ":qstatus"=>$status
            );

            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>window.location='./../sched_profile.php?userid=".$user."'</script>";//Saved
             } else {
                 echo "<script>window.location='./../sched_profile.php?userid=".$user."'</script>";//Not Saved
             }
        }
    }

    $user = $_REQUEST['user'];
    $pet = $_REQUEST['pet'];
    $ddate = $_REQUEST['cnext'];

    $get = "SELECT userfname, userlname FROM alagapp_db.tbl_userlist WHERE userid = ".$user."";
    $res = $connect->prepare($get);
    $res->execute();
    $row = $res->fetch(PDO::FETCH_ASSOC);

    $getpet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE userid = ".$user." AND petid = ".$pet."";
    $respet = $connect->prepare($getpet);
    $respet->execute();

    echo "
    <form action='schedNew.php' method='POST'>
    <h1>New Schedule</h1><br>
        <div class='input-group'>
                    <label class='input-group-text'>Owner</label>
                    <input placeholder=\"Enter Owner ID\" type='text' class='form-control' name='userid' value='".$user."' hidden>
                    <input placeholder=\"Enter Owner\" type='text' class='form-control' name='user' value='".$row['userfname']." ".$row['userlname']."'>
                    <label class='input-group-text'>Pet</label>
                    <select class='form-select' aria-label='Default select example' name='petid'>
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
                    <textarea placeholder=\"Description\" name='description' class='form-control' aria-label='With textarea'></textarea>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Time</label>
                    <input type='time' class='form-control' name='time'>
                    <label class='input-group-text'>Date</label>
                    <input type='date' class='form-control' name='date' value='".$ddate."'>
                    <label class='input-group-text'>Status</label>
                    <select class='form-select' aria-label='Default select example' name='status'>
                        <option value='Pending'>Pending</option>
                        <option selected>Select Status</option>
                        <option value='Pending'>Pend</option>
                        <option value='Accepted'>Accept</option>
                        <option value='Denied'>Deny</option>
                        <option value='Finished'>Finish</option>
                    </select>
                </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary'>Add New User</button>
        </div>
    </form>";