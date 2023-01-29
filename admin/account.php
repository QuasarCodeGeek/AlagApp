<?php
require("./api/connector.php");

session_start();
if($_SESSION["adminsession"] == ""){
  echo "<script>window.location='./index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account | AlagApp</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link href="./../bootstrap-5.2.2-dist/css/bootstrap.css" rel="stylesheet">
    <script src="./../bootstrap-5.2.2-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg bg-light">

      <!-- Modal New Data-->
                    <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">New Record</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body d-grid gap-2 container-fluid" id="modalNew">
                          </div>
                        </div>
                      </div>
                    </div>
      <!-- Modal New Data-->
      <!-- Modal Edit Data-->
                    <div class="modal fade" id="boxModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">Edit Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <div class="modal-body d-grid gap-2 container-fluid" id="modalHere">
                      </div>
                    </div>
                  </div>
                </div>
            </div>
      <!-- Modal Edit Data --> 
<?php
  include("./api/modalTrigger.php");
  include("./api/modalError.php");

  if($_SESSION["trigger"]!="none"){
    echo "<input type='text' id='trigger' value='".$_SESSION["trigger"]."' hidden>";
  } 
?>
<main class="container-fluid"><div class="row m-auto">
<div class="col-2 vh-100 bg bg-success"><!--SideBar-->
          <div class="row m-auto text-center my-3"><!--aa-->
            <a class="nav-link text-white nav-brand" href="#"><h1><b>AlagApp</b></h1></a>
          </div><br>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="dashboard.php"><h5><i class="bi bi-speedometer2"></i> Dashboard</h5></a> 
          </div>
          <div class="row m-auto text-center my-3 bg bg-light rounded p-2">
            <a class="nav-link text-success" href="account.php" active><h4><i class="bi bi-person-circle"></i> Account</h4></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="scheduler.php"><h5><i class="bi bi-calendar"></i> Scheduler</h5></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="consultation.php"><h5><i class="bi bi-chat"></i> O-Consultation</h5></a>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          <div class="row m-auto text-center my-3 float-bottom">
            <a class="nav-link text-white" type="button" href="./api/adminData/adminProfile.php"><h5>Admin<h5></a>
            <a class="nav-link text-white" type="button" href="./logout.php"><h5>Log Out<h5></a>
          </div><!--aa-->
        </div><!--SideBar-->
        
        
    <div class="col-10 vh-100 overflow-auto overflow-y bg bg-light pb-3"><!-- Profile Panel-->
    <!-- Buttons Section -->
      <div class="row m-auto p-3">
        <div class="col-4 m-auto">
          <h2 class="text-success p-3"><b>Account</b></h2>
        </div>
        <div class="col-4 m-auto">
          <button type='button' class='p-3 btn btn-primary w-100 rounded-pill fw-bold' onClick='userNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Add User</button>
        </div>
        <div class="col-4 m-auto">
          <button type='button' class='p-3 btn btn-info w-100 rounded-pill fw-bold' onClick='petNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Add Pet</button>
        </div>
      </div>
    <!-- Buttons Section -->
    <div class="row m-auto"><!-- Account Card-->
      <?php include("api/userCard.php"); ?>
    </div><!-- Accounnt Card-->
  </div><!-- Profile Panel -->
</div></main>
<!-- Main Functions -->
<script src="js/main.js"></script>
<!-- Ajax Function -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
  integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<!-- Chart Javascript Library -->
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
</body>
</html>
<?php
  $_SESSION["trigger"]="none";
?>