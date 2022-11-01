<?php
    require("../connector.php");
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $district = $_POST["district"];
        $municipality = $_POST["municipality"];
        $province = $_POST["province"];

        if($fname=="" || $lname=="" || $municipality=="" || $province ==""){
            echo "<script>alert('Complete Required Fields!');
            window.location='../../account.php'</script>";
        } else if ($email=="" || $password =="") 
            echo "<script>alert('Email and Password Required!');
            window.location='../../account.php'</script>";
        else {
            $sql = "INSERT INTO alagapp_db.tbl_userlist(
                useremail,
                userpassword,
                userfname,
                usermname,
                userlname,
                userdistrict,
                usermunicipality,
                userprovince) VALUES(
                    :useremail,
                    :userpassword,
                    :userfname,
                    :usermname,
                    :userlname,
                    :userdistrict,
                    :usermunicipality,
                    :userprovince)";

            $result = $connect->prepare($sql);

            $values = array(
                ":useremail" => $email,
                ":userpassword" => $password,
                ":userfname" => $fname,
                ":usermname" => $mname,
                ":userlname" => $lname,
                ":userdistrict" => $district,
                ":usermunicipality" => $municipality,
                ":userprovince" => $province
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
        <form action='php/newData/userNew.php' method='POST'>
        <h1>New User Profile</h1><br>
        <div class='input-group'>
        <span class='input-group-text'>Given Name</span>
        <input class='form-control' type='text' name ='fname' placeholder=\"Enter Name\">
        <span class='input-group-text'>Middle Name</span>
        <input class='form-control' type='text' name='mname' placeholder=\"Enter Middle Name\">
        <span class='input-group-text'>Surname</span>
        <input class='form-control' type='text' name='lname' placeholder=\"Enter Last Name\">
        </div><br>
        <div class='input-group'>
        <span class='input-group-text'>Baranggay</span>
        <input class='form-control' type='text' name='district' placeholder=\"Enter Barangay\">
        <span class='input-group-text'>Municipality</span>
        <input class='form-control' type='text' name='municipality' placeholder=\"Enter Municipality\">
        <span class='input-group-text'>Province</span>
        <input class='form-control' type='text' name='province' placeholder=\"Enter Province\">
        </div><br>
        <div class='input-group'>
        <span class='input-group-text'>Email</span>
        <input class='form-control' type='email' name='email' placeholder=\"Enter User Email\">
        <span class='input-group-text'>Password</span>
        <input class='form-control' type='text' name='password' placeholder=\"Enter User Password\">
        </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' name='submit' class='btn btn-primary'>Add New User</button>
        </div>
    </form>";
?>