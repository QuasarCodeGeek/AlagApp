<?php
    require("../connector.php");

    if(isset($_POST["Update"])){
        $nid = $_POST["nid"];
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $status = $_POST["status"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $status==""){
            echo "<script>alert('Please complete the fields required!');
                window.location='../../account.php'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_notedetail SET
                userid = :userid,
                petid = :petid,
                ndescription = :ndescription,
                ndate = :ndate,
                nstatus = :nstatus

                WHERE nid = :nid";

            $values = array(
                ":nid"=>$nid,
                ":userid"=>$user,
                ":petid"=>$pet,
                ":ndescription"=>$description,
                ":ndate"=>$date,
                ":nstatus"=>$status
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
    echo "<form action='editData/prescriptionEdit.php' method='POST'>";

    $nid = $_REQUEST["id"];
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
        
        if($note_res->rowCount()==1){
            $note_row = $note_res->fetch(PDO::FETCH_ASSOC);

            $userid = $note_row["userid"];
            $petid = $note_row["petid"];
            $description = $note_row["ndescription"];
            $date = $note_row["ndate"];
            $status = $note_row["nstatus"];
        }
    } catch(PDOException $e){
        die("An error has occured!");
    }
    echo "<input type='hidden' name='nid' value=".$nid.">
                <h1>Prescription Information</h1><br>
                <div class='input-group'>
                    <label class='input-group-text'>Owner ID</label>
                    <input type='text' class='form-control' name='userid' value=".$userid.">
                    <label class='input-group-text'>Pet ID</label>
                    <input type='text' class='form-control' name='petid' value=".$petid.">
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