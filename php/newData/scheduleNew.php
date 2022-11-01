<?php
    require("../connector.php");

    if(isset($_POST["add_sched"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $status = $_POST["status"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $status==""){
            echo "<script>alert('Please complete the fields required!')
            window.location='../../account.php'</script>";
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_scheduler(
                userid,
                petid,
                qdescription,
                qdate,
                qstatus) VALUES(
                    :userid,
                    :petid,
                    :qdescription,
                    :qdate,
                    :qstatus)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":qdescription"=>$description,
                ":qdate"=>$date,
                ":qstatus"=>$status
            );

            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>alert('Record has been save!');
                window.location='../../account.php'</script>";
             } else {
                 echo "<script>alert('Unable to add record!');
                 window.location='../../account.php'</script>";
             }
        }
    }
    echo "
    <form action='php/newData/scheduleNew.php' method='POST'>
    <h1>New Schedule</h1><br>
        <div class='input-group'>
                    <label class='input-group-text'>Owner ID</label>
                    <input placeholder=\"Enter Owner\" type='text' class='form-control' name='userid'>
                    <label class='input-group-text'>Pet ID</label>
                    <input placeholder=\"Enter Pet\" type='text' class='form-control' name='petid'>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Description</label>
                    <textarea placeholder=\"Description\" name='description' class='form-control' aria-label='With textarea'></textarea>
                </div><br>

                <div class='input-group'>
                    <label class='input-group-text'>Date</label>
                    <input type='date' class='form-control' name='date'>
                    <label class='input-group-text'>Status</label>
                    <input placeholder=\"Enter Status\" type='text' class='form-control' name='status'>
                </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary'>Add New User</button>
        </div>
    </form>";