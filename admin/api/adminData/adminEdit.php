<?php
    require("../connector.php");

    if(isset($_POST["submit"])){
        $id = $_POST["id"];
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $bdate = $_POST["bdate"];
        $gender = $_POST["gender"];
        $street = $_POST["street"];
        $district = $_POST["district"];
        $municipality = $_POST["municipality"];
        $province = $_POST["province"];
        $code = $_POST["username"];
        $pass = $_POST["password"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $telephone = $_POST["telephone"];
        $meet = $_POST["meet"];

        if($fname=="" || $lname=="" || $bdate=="" || $gender=="" || $district=="" || $municipality=="" || $province ==""){
            echo "<script>window.location='adminProfile.php'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_admin SET
                admincode = :username,
                adminpass = :password,

                fname = :fname,
                mname = :mname,
                lname = :lname,

                street = :street,
                district = :district,
                municipality = :municipality,
                province = :province,

                bdate = :bdate,
                gender = :gender,

                email = :email,
                mobile = :mobile,
                telephone = :telephone,
                gmeet = :meet

                WHERE adminid = :id";

            $values = array(
                ":id" => $id,

                ":username" => $code,
                ":password" => $pass,

                "fname" => $fname,
                ":mname" => $mname,
                ":lname" => $lname,

                ":street" => $street,
                ":district" => $district,
                ":municipality" => $municipality,
                ":province" => $province,

                ":bdate" => $bdate,
                ":gender" => $gender,

                ":email" => $email,
                ":mobile" => $mobile,
                ":telephone" => $telephone,
                ":meet" => $meet
            );

            $result = $connect->prepare($sql);
            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>window.location='adminProfile.php'</script>";
             } else {
                 echo "<script>window.location='adminProfile.php'</script>";
             }
        }
    }


    echo "<form action='adminEdit.php' method='POST'>";

    $id = $_REQUEST['id'];

    $sql_user = "SELECT * FROM alagapp_db.tbl_admin WHERE adminid = :id";

    try{
        $user_res = $connect->prepare($sql_user);
        $val = array(":id"=>$id);
        $user_res->execute($val);

    $fname = "";
    $mname = "";
    $lname = "";
    $bdate = "";
    $gender = "";

    $code = "";
    $pass = "";
    $email = "";

    $mobile = "";
    $telephone = "";
    $meet = "";

    $street = "";
    $district = "";
    $municipality = "";
    $province = "";
      
        if($user_res->rowCount()==1){
            $user_row = $user_res->fetch(PDO::FETCH_ASSOC);

            $fname = $user_row["fname"];
            $mname = $user_row["mname"];
            $lname = $user_row["lname"];
            $bdate = $user_row["bdate"];
            $gender = $user_row["gender"];
            $street = $user_row["street"];
            $district = $user_row["district"];
            $municipality = $user_row["municipality"];
            $province = $user_row["province"];
            $code = $user_row["admincode"];
            $email = $user_row["email"];
            $mobile = $user_row["mobile"];
            $telephone = $user_row["telephone"];
            $meet = $user_row["gmeet"];
            $pass = $user_row["adminpass"];
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
        <input class='form-control' type='date' name='bdate' value='".$bdate."'>
        <label class='input-group-text' for='genderSelect'>Sex</label>
        <select class='form-select' name='gender' id='genderSelect'>
            <option selected='".$gender."' value='".$gender."'>".$gender."</option>
            <option value=''>-- Select Gender --</option>
            <option name='gender' value='M'>Male</option>
            <option name='gender' value='F'>Female</option>
        <select>
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Street</span>
        <input class='form-control' type='text' name='street' value='".$street."' placeholder=\"Enter Street\">
        <span class='input-group-text'>Barangay</span>
        <input class='form-control' type='text' name='district' value='".$district."' placeholder=\"Enter Barangay\">
        </div><br>
        <div class='input-group'>
        <span class='input-group-text'>Municipality</span>
        <input class='form-control' type='text' name='municipality' value='".$municipality."' placeholder=\"Enter Municipality\">
        <span class='input-group-text'>Province</span>
        <input class='form-control' type='text' name='province' value='".$province."' placeholder=\"Enter Province\">
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Username</span>
        <input class='form-control' type='text' name='username' value='".$code."' placeholder=\"Enter Username\">
        <span class='input-group-text'>Email</span>
        <input class='form-control' type='text' name='email' value='".$email."' placeholder=\"Enter Email\">
        <span class='input-group-text'>Password</span>
        <input class='form-control' type='password' name='password' value='".$pass."' placeholder=\"Enter Password\">
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>Mobile</span>
        <input class='form-control' type='text' name='mobile' value='".$mobile."' placeholder=\"Enter Moobile Number\">
        <span class='input-group-text'>Telephone</span>
        <input class='form-control' type='text' name='telephone' value='".$telephone."' placeholder=\"Enter Telephone Number\">
        </div><br>

        <div class='input-group'>
        <span class='input-group-text'>GMeet Link</span>
        <input class='form-control' type='text' name='meet' value='".$meet."' placeholder=\"Enter Google Meet Link\">
        </div><br>

        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' name='submit' class='btn btn-primary'>Save changes</button>
        </div>
    </form>";