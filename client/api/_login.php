<?php
  require("../php/client/_connector.php");

  if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    if($email !="" || $password !=""){
        $check = "SELECT * FROM alagapp_db.tbl_userlist WHERE useremail = '".$email."' AND userpassword = '".$password."' ";
        $checkresult = $connect->prepare($check);
        $checkresult->execute();

        if($checkresult->rowCount()>0) {
          $user = $checkresult->fetch(PDO::FETCH_ASSOC);

          echo "<script>window.location='homePage.php?userid=".$user['userid']."'</script>";
       } else {
           echo "<script>window.location='index.php'</script>";
       }
    }
  }
?>