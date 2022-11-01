<?php
    require("../connector.php");

    if(isset($_POST["add_sched"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $vax = $_POST["vaxid"];
        $fdose = $_POST["fdose"];
        $sdose = $_POST["sdose"];
        $booster = $_POST["booster"];

        if($user=="" || $pet=="" || $vaxid=="" || $fdose==""){
            echo "<script>alert('Please complete the fields required!')
            window.location='../../account.php'</script>";
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_scheduler(
                userid,
                petid,
                vaxid,
                fdose,
                sdose,
                booster) VALUES(
                    :userid,
                    :petid,
                    :vaxid,
                    :fdose,
                    :sdose,
                    :booster)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":vaxid"=>$vax,
                ":fdose"=>$fdose,
                ":sdose"=>$sdose,
                ":booster"=>$booster
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
    <form action='php/newData/cardNew.php' method='POST'>
    <h1>New E-Vaccine Card</h1><br>
        <div class='input-group'>
            <label class='input-group-text'>Owner ID</label>
                <input placeholder=\"Owner\" type='text' class='form-control' name='userid'>
            <label class='input-group-text'>Pet ID</label>
                <input placeholder=\"Pet Name\" type='text' class='form-control' name='petid'>
            <label class='input-group-text'>Vaccine ID</label>
                <input placeholder=\"Vaccine\" type='text' class='form-control' name='vaxid'>
        </div><br>
        <label style='margin-left: auto; margin-right: auto;'>Vaccination Schedule</label><br>
        <div class='input-group'>
            <label class='input-group-text'>First Shot</label>
            <input type='date' class='form-control' name='fdate'>
            <label class='input-group-text'>Second Shot</label>
            <input type='date' class='form-control' name='sdate'>
            <label class='input-group-text'>Booster</label>
            <input type='date' class='form-control' name='booster'>
            </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary'>Add Card</button>
        </div>
    </form>";