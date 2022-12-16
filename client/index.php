<?php
  require("api/_connector.php");

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
           echo "<script>alert('Account not found!');</script>";
       }
    } else {
      echo "<div onload='checkField()'></div>";
    }
  }
?>

<!doctype html>
<html lang="en">

<head>
  <title>Log In</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  
  <link href="css/client.css" rel="stylesheet">
</head>

<body class="background">
  <main class="text-center">
      <div class="align-center mt-5 mb-5">
        <img class="mb-2" src="../assets/logo/AlagApp.png" alt="AlagApp" style="width: 10rem;">
        <h1 class="text-white">AlagApp</h1>
      </div>
      <div class="card p-3 ms-auto me-auto mb-5" style="max-width: 18rem;">
        <form action="index.php" method="POST">
          <div class="mb-3 text-center">
            <span class="text-secondary">Please Log In to continue</span>
          </div>
          <div id="liveAlertPlaceholder"></div>
          <div id="ErrorAlert"></div>
          <div class="mb-3">
            <input id="email" name="email" type="text" class="form-control" placeholder="Email" required>
          </div>
          <div>
            <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
          </div><br>
          <div class="mb-2">
            <a href="../php/client/_forgotpassword.php">Forgot Password</a>
          </div><br>
          <button onclick="checkField()" id="liveAlertBtn" type="submit" name="submit" class="btn btn-success w-100">Log In</button>
        </form>
      </div>
    </main>

  <script src="js/client.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>