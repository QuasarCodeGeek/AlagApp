<?php
    require("../connector.php");
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $bdate = $_POST["bdate"];
        $gender = $_POST["gender"];
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $district = $_POST["district"];
        $municipality = $_POST["municipality"];
        $province = $_POST["province"];
        $mobile = $_POST["mobile"];

        if($fname=="" || $lname=="" || $municipality=="" || $province ==""){
            echo "<script>window.location='../../account.php'</script>";//Field Required
        } else if ($email=="" || $password =="") 
            echo "<script>window.location='../../account.php'</script>";//Username and Password Required
        else {
            $sql = "INSERT INTO alagapp_db.tbl_userlist(
                useremail,
                userpassword,
                userfname,
                usermname,
                userlname,
                userbdate,
                usergender,
                userdistrict,
                usermunicipality,
                userprovince,
                usermobile) VALUES(
                    :useremail,
                    :userpassword,
                    :userfname,
                    :usermname,
                    :userlname,
                    :userbdate,
                    :usergender,
                    :userdistrict,
                    :usermunicipality,
                    :userprovince,
                    :usermobile)";

            $result = $connect->prepare($sql);

            $values = array(
                ":useremail" => $email,
                ":userpassword" => $password,
                ":userfname" => $fname,
                ":usermname" => $mname,
                ":userlname" => $lname,
                ":userbdate" => $bdate,
                ":usergender" => $gender,
                ":userdistrict" => $district,
                ":usermunicipality" => $municipality,
                ":userprovince" => $province,
                ":usermobile" => $mobile
            );

            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>window.location='../../account.php'</script>";//Saved
             } else {
                 echo "<script>window.location='../../account.php'</script>";//Not Saved
             }
        }
    }
echo "
        <form action='api/newData/userNew.php' method='POST'>
        <h1>New User Profile</h1><br>
        <div class='input-group'>
        <span class='input-group-text'>Given Name</span>
        <input class='form-control' type='text' name ='fname' placeholder=\"Enter Name\" required>
        <span class='input-group-text'>Middle Name</span>
        <input class='form-control' type='text' name='mname' placeholder=\"Enter Middle Name\">
        <span class='input-group-text'>Surname</span>
        <input class='form-control' type='text' name='lname' placeholder=\"Enter Last Name\" required>
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Birth Date</span>
        <input class='form-control' type='date' name='bdate' required>
        <label class='input-group-text' for='genderSelect'>Sex</label>
        <select class='form-select' name='gender' id='genderSelect' name='gender' required>
            <option selected>-- Select Gender --</option>
            <option value='M'>Male</option>
            <option value='F'>Female</option>
        <select>
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Baranggay</span>
        <input class='form-control' type='text' name='district' placeholder=\"Enter Barangay\">
        <span class='input-group-text'>Municipality</span>
        <input class='form-control' type='text' name='municipality' placeholder=\"Enter Municipality\" required>
        <span class='input-group-text'>Province</span>
        <input class='form-control' type='text' name='province' placeholder=\"Enter Province\" required>
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Contact No.</span>
        <input class='form-control' type='text' name='mobile' placeholder=\"Enter User Mobile Number\">
        <span class='input-group-text'>Email</span>
        <input class='form-control' type='email' name='email' placeholder=\"Enter User Email\" required>
        <span class='input-group-text'>Password</span>
        <input class='form-control' type='text' name='password' placeholder=\"Enter User Password\" required>
        </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' name='submit' class='btn btn-primary'>Add New User</button>
        </div>
    </form>";
?>