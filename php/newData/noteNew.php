<?php
    require("../connector.php");
    if(isset($_POST["submit"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $status = $_POST["status"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $status==""){
            echo "<script>alert('Please complete the fields required!');
            window.location='../../account.php'</script>";
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_notedetail(
                userid,
                petid,
                ndescription,
                ndate,
                nstatus) VALUES(
                    :userid,
                    :petid,
                    :ndescription,
                    :ndate,
                    :nstatus)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":ndescription"=>$description,
                ":ndate"=>$date,
                ":nstatus"=>$status
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
    <form action='php/newData/prescriptionNew.php' method='POST'>
        <h1>New E-Prescription Note</h1><br>
        <div class='input-group'>
            <label class='input-group-text'>Owner</label>
            <input type='hidden' placeholder=\"Owner ID\" class='form-control' name='userid'>
            <input type='text' placeholder=\"Owner Name\" class='form-control' name='userid'>
            <label class='input-group-text'>Pet Name</label>
            <input type='hidden' placeholder=\"Pet ID\" class='form-control' name='userid'>
            <input type='text' placeholder=\"Pet Name\" class='form-control' name='petid'>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>Description</label>
            <textarea placeholder=\"Description\" name='description' class='form-control row-5' aria-label='With textarea'></textarea>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>Date Issued</label>
            <input type='date' class='form-control' name='date'>
            <label class='input-group-text'>Status</label>
            <select class='form-select' name='status' id='inputGroupSelect'>
                    <option selected''>-- Set Status --</option>
                    <option name='status' value='Active'>Active</option>
                    <option name='status' value='Inactive'>Inactive</option>
                </select>
        </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'> 
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary'>Add Note</button>
        </div>
    </form>";