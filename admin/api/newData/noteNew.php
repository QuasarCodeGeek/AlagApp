<?php
    require("../connector.php");
    session_start();
    if(isset($_POST["submit"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $vet = $_POST["vet"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $vet==""){
            $_SESSION["trigger"] = "newENote";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Fields Required
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_notedetail(
                userid,
                petid,
                ndescription,
                ndate,
                nvet) VALUES(
                    :userid,
                    :petid,
                    :ndescription,
                    :ndate,
                    :nvet)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":ndescription"=>$description,
                ":ndate"=>$date,
                ":nvet"=>$vet
            );

            $result->execute($values);

            if($result->rowCount()>0) {
                $_SESSION["trigger"] = "newNote";
                echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Saved
             } else {
                $_SESSION["trigger"] = "newENote";
                echo "<script>window.location='../profile.php?userid=".$user."'</script>";//Not Saved
             }
        }
    };

    $pid = $_REQUEST["petid"];
    $sql_note = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$pid."";

    $note_res = $connect->prepare($sql_note);
    $note_res->execute();
    $row = $note_res->fetch(PDO::FETCH_ASSOC);

    $user = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$row['userid']."";

    $user_res = $connect->prepare($user);
    $user_res->execute();
    $userrow = $user_res->fetch(PDO::FETCH_ASSOC);

    echo "
    <form action='newData/noteNew.php' method='POST'>
        <h1>New E-Prescription Note</h1><br>
        <div class='input-group'>
            <label class='input-group-text'>Owner</label>
            <input type='hidden' placeholder=\"Owner ID\" class='form-control' value='".$userrow['userid']."' name='userid'>
            <input type='text' placeholder=\"Owner Name\" class='form-control' value='".$userrow['userfname']."' name='userfname' readonly>
            <label class='input-group-text'>Pet Name</label>
            <input type='hidden' placeholder=\"Pet ID\" class='form-control' value='".$row['petid']."' name='petid'>
            <input type='text' placeholder=\"Pet Name\" class='form-control' value='".$row['petname']."' name='petname' readonly>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>Description</label>
            <textarea placeholder=\"Description\" name='description' class='form-control row-5' aria-label='With textarea' required></textarea>
        </div><br>

        <div class='input-group'>
            <label class='input-group-text'>Date Issued</label>
            <input type='date' class='form-control' name='date' required>
            <label class='input-group-text'>Veterinarian</label>
            <input type='text' class='form-control' name='vet' required>
        </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'> 
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary'>Add Note</button>
        </div>
    </form>";