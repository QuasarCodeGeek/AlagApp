<?php
    require("../connector.php");

    if(isset($_POST["submit"])){
        $id = $_POST["id"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $bdate = $_POST["bdate"];
        $gender = $_POST["gender"];
        $street = $_POST["street"];
        $district = $_POST["district"];
        $municipality = $_POST["municipality"];
        $province = $_POST["province"];

        if($fname=="" || $lname=="" || $bdate=="" || $gender=="" || $district=="" || $municipality=="" || $province ==""){
            echo "<script>alert('Complete Required Fields!');
            window.location='../../account.php'</script>";
        } else if ($email=="" || $password =="") 
            echo "<script>alert('Email and Password Required!');
            window.location='../../account.php'</script>";
        else {
            $sql = "UPDATE alagapp_db.tbl_userlist SET
                useremail = :useremail,
                userpassword = :userpassword,

                userfname = :userfname,
                usermname = :usermname,
                userlname = :userlname,

                userbdate = :userbdate,
                usergender = :usergender,

                userstreet = :userstreet,
                userdistrict = :userdistrict,
                usermunicipality = :usermunicipality,
                userprovince = :userprovince

                WHERE userid = :userid";

            $values = array(
                ":userid" => $id,
                ":useremail" => $email,
                ":userpassword" => $password,
                ":userfname" => $fname,
                ":usermname" => $mname,
                ":userlname" => $lname,
                ":userbdate" => $bdate,
                ":usergender" => $gender,
                ":userstreet" => $street,
                ":userdistrict" => $district,
                ":usermunicipality" => $municipality,
                ":userprovince" => $province
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


    echo "<form action='editData/userEdit.php' method='POST'>";
    $id = $_REQUEST["id"];

    $sql_user = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = :userid";

    try{
        $user_res = $connect->prepare($sql_user);
        $value = array("userid"=>$id);
        $user_res->execute($value);

    $fname = "";
    $mname = "";
    $lname = "";
    $bdate = "";
    $gender = "";

    $street = "";
    $district = "";
    $municipality = "";
    $province = "";

    $email = "";
    $password = "";
        
        if($user_res->rowCount()==1){
            $user_row = $user_res->fetch(PDO::FETCH_ASSOC);

            $fname = $user_row["userfname"];
            $mname = $user_row["usermname"];
            $lname = $user_row["userlname"];
            $bdate = $user_row["userbdate"];
            $gender = $user_row["usergender"];
            $street = $user_row["userstreet"];
            $district = $user_row["userdistrict"];
            $municipality = $user_row["usermunicipality"];
            $province = $user_row["userprovince"];
            $email = $user_row["useremail"];
            $passsword = $user_row["userpassword"];
        }
    } catch(PDOException $e){
        die("An error has occured!");
    }

    echo "
        <input class='form-control' type='hidden' name='id' value='".$id."'>
        <h1>User Profile</h1><br>
        <div class='input-group'>
        <span class='input-group-text'>Given Name</span>
        <input class='form-control' type='text' name ='fname' value='".$fname."' placeholder=\"Enter Name\">
        <span class='input-group-text'>Middle Name</span>
        <input class='form-control' type='text' name='mname' value='".$mname."' placeholder=\"Enter Middle Name\">
        <span class='input-group-text'>Surname</span>
        <input class='form-control' type='text' name='lname' value='".$lname."' placeholder=\"Enter Last Name\">
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Birth Date</span>
        <input class='form-control' type='date' name='bdate' value=".$bdate.">
        <label class='input-group-text' for='genderSelect'>Sex</label>
        <select class='form-select' name='gender' id='genderSelect'>
            <option selected=".$gender." value=".$gender.">".$gender."</option>
            <option value=''>-- Select Gender --</option>
            <option name='gender' value='M'>Male</option>
            <option name='gender' value='F'>Female</option>
        <select>
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Baranggay</span>
        <input class='form-control' type='text' name='district' value='".$street."' placeholder=\"Enter Street\">
        <span class='input-group-text'>Street</span>
        <input class='form-control' type='text' name='district' value='".$district."' placeholder=\"Enter Barangay\">
        </div><br>
        <div class='input-group'>
        <span class='input-group-text'>Municipality</span>
        <input class='form-control' type='text' name='municipality' value='".$municipality."' placeholder=\"Enter Municipality\">
        <span class='input-group-text'>Province</span>
        <input class='form-control' type='text' name='province' value='".$province."' placeholder=\"Enter Province\">
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Email</span>
        <input class='form-control' type='email' name='email' value='".$email."' placeholder=\"Enter New Email\">
        <span class='input-group-text'>Password</span>
        <input class='form-control' type='text' name='password' value='".$password."' placeholder=\"Enter New Password\">
        </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' name='submit' class='btn btn-primary'>Save changes</button>
        </div>
    </form>";