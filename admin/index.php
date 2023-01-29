<?php
  require("api/connector.php");

  session_start();

  $error = NULL;
  if(isset($_POST["submit"])){
    $code = $_POST["admincode"];
    $pass = $_POST["adminpass"];

    if($code !="" || $pass !=""){
        $check = "SELECT * FROM alagapp_db.tbl_admin WHERE admincode = '".$code."' AND adminpass = '".$pass."' ";
        $checkresult = $connect->prepare($check);
        $checkresult->execute();

        if($checkresult->rowCount()>0) {
          $_SESSION["adminsession"]= rand();

          $_SESSION["trigger"]="none";

          echo "<script>window.location='./dashboard.php'</script>";//Successfully Log In
       } else {
          $error = "<div class='alert alert-danger alert-dismissible' role='alert'>
          <div>Incorrect Username or Password!</div>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
          ";
          //echo "<script>window.location='./index.php?error=e'</script>";//Unable to Find Account
       }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="./../bootstrap-5.2.2-dist/css/bootstrap.css" rel="stylesheet">
    <script src="./../bootstrap-5.2.2-dist/js/bootstrap.js"></script>
  <link href="css/styles.css" rel="stylesheet">
</head>

<body class="background">
  <main class="text-center">
      <div class="align-center mt-5 mb-5">
        <img class="mb-2" src="../assets/logo/AlagApp.png" alt="AlagApp" style="width: 10rem;">
        <h1 class="text-white mb-2">AlagApp</h1>
        <h class="text-white">Administrator Web System</h3>
      </div>
      <div class="card p-3 ms-auto me-auto mb-5" style="max-width: 18rem;">
        <form action="" method="POST">
          <div class="mb-3 text-center">
            <h3 class="text-success">Admin Log In</h3>
          </div>
          <div id="liveAlertPlaceholder"></div>
          <div id="errorLogin">
            <?php
              if($error != NULL){
                echo $error;
              }
            ?>
          </div>
          <div class="mb-3 input-group">
            <label class="input-group-text bg bg-success"><i class="bi bi-person" style="color: white;"></i></label>
            <input id="code" name="admincode" type="text" class="form-control" placeholder="Enter Username" required>
          </div>
          <div class="input-group">
            <label class="input-group-text bg bg-success"><i class="bi bi-key" style="color: white;"></i></label>
            <input id="pass" name="adminpass" type="password" class="form-control" placeholder="Enter Password" required>
          </div><br>
          <div class="mb-2">
          </div><br>
          <button onclick="checkField()" id="liveAlertBtn" type="submit" name="submit" class="btn btn-success w-100">Log In</button>
        </form>
      </div>
    </main>

  <script src="js/main.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>