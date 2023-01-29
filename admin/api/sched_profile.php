<?php
  require("connector.php");

  session_start();
  if($_SESSION["adminsession"] == ""){
    echo "<script>window.location='./../index.php'</script>";
  }
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
    <link href="./../../bootstrap-5.2.2-dist/css/bootstrap.css" rel="stylesheet">
    <script src="./../../bootstrap-5.2.2-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg bg-light" onload="triggerModal()">

<main class="container-fluid"><!-- -->
      <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="ModalLabel">New Record</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-grid gap-2 container-fluid" id="schedNew">
                              This Account has no pet yet, please Register a pet before adding a new schedule!
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


                        <!-- -->
<?php
  include("./modalTrigger.php");
  include("./modalError.php");

  if($_SESSION["trigger"]!="none"){
    echo "<input type='text' id='trigger' value='".$_SESSION["trigger"]."' hidden>";
  } 
?>
<!-- -->

<div class="row m-auto">
<div class="col-2 vh-100 bg bg-success"><!--SideBar-->
          <div class="row m-auto text-center my-3"><!--aa-->
            <a class="nav-link text-white nav-brand" href="#"><h1><b>AlagApp</b></h1></a>
          </div><br>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../dashboard.php"><h5><i class="bi bi-speedometer2"></i> Dashboard</h5></a> 
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../account.php" active><h5><i class="bi bi-person-circle"></i> Account</h5></a>
          </div>
          <div class="row m-auto text-center my-3 bg bg-light rounded p-2">
            <a class="nav-link text-success" href="../scheduler.php"><h4><i class="bi bi-calendar"></i> Scheduler</h4></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../consultation.php"><h5><i class="bi bi-chat"></i> O-Consultation</h5></a>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          <div class="row m-auto text-center my-3 float-bottom">
          <a class="nav-link text-white" href="./adminData/adminProfile.php"><h5>Admin<h5></a>
            <a class="nav-link text-white" href="./../logout.php"><h5>Log Out<h5></a>
          </div><!--aa-->

        </div><!--SideBar-->  

<div class="col-10 vh-100 overflow-auto overflow-y">
    <div class="row m-auto">
      <div class="row m-auto">
                    <h2 class="text-success p-3"><b>Scheduler</b> | Account</h2>
                  </div>
                  <div class="row m-auto">
      <div class="col-6 text-center bg bg-success border-start rounded-pill border-light">
                    <a class="nav-link text-white p-3" type="button" href="../scheduler.php"><strong>Account</strong></a>
      </div>
      <div class="col-6 text-center bg bg-light">
                    <a class="nav-link p-3 text-success" type="button" href="sched_chrono.php"><strong>Status</strong></a>
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

                  $owner = $res->fetch(PDO::FETCH_ASSOC);
              ?><!-- -->
  <!-- -->
  <div class="row m-auto mt-2"><!-- -->
    <div class="col-3 pt-2 pb-2 vh-100  bg bg-light overflow-x overflow-auto bg bg-light">
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

<?php
  $_SESSION["trigger"]="none";
?>