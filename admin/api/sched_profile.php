<?php
  require("connector.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduler | AlagApp</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg bg-success">
      <!--<nav class="navbar navbar-expand-lg bg-light">
        <div class="container container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="row collapse navbar-collapse mx-auto" id="navbarSupportedContent">
            <div class="col text-center">
              <a class="nav-link" href="../account.php">Account</a>
            </div>
            <div class="col text-center border-bottom border-success border-5">
            <a class="nav-link" href="../scheduler.php" active><strong>Scheduler</strong></a>
            </div>
            <div class="col text-center">
              <a class="navbar-brand" href="../index.html"><strong>AlagApp</strong></a>
            </div>
            <div class="col text-center">
              <a class="nav-link" href="../consultation.php">Consultation</a>
            </div>
            <div class="col text-center">
              <a class="nav-link text-success" href="../dashboard.php">Dashboard</a> 
            </div>
          </div>
        </div>
      </nav>-->

<main class="container-fluid"><!-- -->
      <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="ModalLabel">New Record</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-grid gap-2 container-fluid" id="schedNew">
                              Content Here
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="modal fade" id="boxModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="ModalLabel">Edit Data</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-grid gap-2 container-fluid" id="schedHere">
                              Content Edit Here
                            </div>
                          </div>
                        </div>
                        </div>

<div class="row m-auto">
  <div class="col-2">
    <div class="col text-center my-3">
      <a class="nav-link text-white nav-brand" href="#"><h2>AlagApp</h2></a>
    </div><br>
    <div class="col text-center my-3">
      <a class="nav-link text-white" href="../dashboard.php" active>Dashboard</a> 
    </div>
    <div class="col text-center my-3">
      <a class="nav-link text-white" href="../account.php">Account</a>
    </div>
    <div class="col text-center my-3">
      <a class="nav-link text-white" href="../scheduler.php"><h4>Scheduler</h4></a>
    </div>
    <div class="col text-center my-3">
      <a class="nav-link text-white" href="../consultation.php">Consultation</a>
    </div>     
  </div>    

<div class="col-10">
  <div class="row m-auto">
    <div class="col-6 text-center bg bg-success">
                  <a class="nav-link text-white p-3" type="button" href="../scheduler.php"><strong>Account</strong></a>
    </div>
    <div class="col-6 text-center bg bg-light">
                  <a class="nav-link p-3" type="button" href="sched_chrono.php"><strong>Status</strong></a>
    </div>
  </div>
            <!-- --><?php
                  require("connector.php");

                  $userid = $_REQUEST['userid'];

                  $sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_petprofile.petname
                  FROM ((alagapp_db.tbl_scheduler
                  INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
                  INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
                  WHERE alagapp_db.tbl_scheduler.userid = ".$userid." ";
              
                  $res = $connect->prepare($sql);
                  $res->execute();
              ?><!-- -->
  <!-- -->
  <div class="row m-auto"><!-- -->
    <div class="col-3 pt-2 pb-2 vh-100  bg bg-lightoverflow-x overflow-auto bg bg-light">
      <?php include("./userListSched.php") ; ?>
    </div>
    <div class="col-9 vh-100 bg bg-light pb-2 pt-2 overflow-x overflow-auto bg bg-light">
      <div class="row m-auto">
        <?php include("./schedulerCard.php");?>
      </div>
    </div>
  </div>
  <!-- -->
</div></main><!-- -->

<!-- Main Functions -->
<script src="../js/main.js"></script>
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