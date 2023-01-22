<?php
require("_connector.php");

if(isset($_POST["submit"])){
    $id = $_POST["userid"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $bdate = $_POST["bdate"];
    $gender = $_POST["sex"];
    $street = $_POST["street"];
    $district = $_POST["district"];
    $municipality = $_POST["municipality"];
    $province = $_POST["province"];
    $mobile = $_POST["mobile"];

        session_start();
        if($_SESSION["newsession"] !=  $id+date("Ymd")){
        echo "<script>window.location='../index.php'</script>";
        }

    if($fname=="" || $lname=="" || $bdate=="" || $gender=="" || $district=="" || $municipality=="" || $province ==""){
        echo "<script>window.location='editProfile.php?userid=".$id."'</script>";
    } else {
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
            userprovince = :userprovince,

            usermobile = :usermobile

            WHERE userid = :userid";

        $values = array(
            ":userid" => $id,
            ":useremail" => $email,
            ":userpassword" => $pass,
            ":userfname" => $fname,
            ":usermname" => $mname,
            ":userlname" => $lname,
            ":userbdate" => $bdate,
            ":usergender" => $gender,
            ":userstreet" => $street,
            ":userdistrict" => $district,
            ":usermunicipality" => $municipality,
            ":userprovince" => $province,
            ":usermobile" => $mobile
        );

        $result = $connect->prepare($sql);
        $result->execute($values);

        if($result->rowCount()>0) {
            echo "<script>window.location='../userPage.php?userid=".$id."'</script>";//Updated
         } else {
             echo "<script>window.location='editProfile.php?userid=".$id."'</script>";//Unsuccessful
         }
    }
}
?>