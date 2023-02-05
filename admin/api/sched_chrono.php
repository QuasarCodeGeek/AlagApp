<?php
require("./connector.php");

  session_start();
  if($_SESSION["adminsession"] == ""){
    echo "<script>window.location='./../index.php'</script>";
  }

  date_default_timezone_set("Asia/Singapore");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduler Status | AlagApp</title>
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
      <main class="container-fluid">
      <div class="modal fade" data-bs-backdrop="static" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
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
                      
                      <div class="modal fade" data-bs-backdrop="static" id="boxModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
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
<!-- Modal -->
<div class="modal fade" id="smsModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Send SMS for Tomorrow's Clients</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="send.php" method="POST">
          <p class="form-label">You will be sending sms to clients who have a scheduled appointment for tomorrow. Click 'Send SMS' to send them a message.</p>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="sms" class="btn btn-success text-white">Send SMS</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- -->
<div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title text-center" id="offcanvasRightLabel">SMS Log</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <?php include("./smsLog.php"); ?>
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
                  <h2 class="text-success p-3"><b>Scheduler</b> | Status</h2>
                </div>
      <div class="col-6 text-center bg bg-light">
        <a class="nav-link p-3 text-success" type="button" href="../scheduler.php"><strong>Account</strong></a>
      </div>
      <div class="col-6 text-center bg bg-success border-start rounded-pill border-light">
        <a class="nav-link p-3 text-white" type="button" href="sched_chrono.php" disable><strong>Status</strong></a>
      </div>
    </div>
    
    <div class="row m-auto p-1 mt-2"><div class="border border-3 border-success rounded-pill p-2">
      <form action="schedFind.php" method="POST"><div class="row">
        <div class="col text-center m-auto">
          <h4 class="fw-bold text-success">Search by:</h4>
        </div>
        <div class="col">
          <div class="input-group">
            <label class="input-group-text">User</label>
            <select class="form-select" aria-label="UserSelect" name="user">
              <option selected value="">Select User</option>
              <?php
                $user = "SELECT userid, userfname, userlname FROM alagapp_db.tbl_userlist";
                $res = $connect->query($user);
                $res->execute();
                if($res->rowCount()>0){
                  $i=1;
                  while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='".$row['userid']."'>".$row['userfname']." ".$row['userlname']."</option>";
                  }
                }
              ?>
            </select>
          </div>
        </div>

        <div class="col">
          <div class="input-group">
            <label class="input-group-text">Status</label>
            <select class="form-select" aria-label="StatusSelect" name="status">
              <option selected value="">Select Status</option>
              <option value="Pending">Pending</option>
              <option value="Denied">Denied</option>
              <option value="Accepted">Accepted</option>
              <option value="Cancelled">Cancelled</option>
              <option value="Finished">Finished</option>
            </select>
          </div>
        </div>

        <div class="col">
            <label class="form-label"> </label>
            <button type="submit" name="submit" class="btn btn-success">Search</button>
        </div>
      </form>
      <div class="col">
        <button type="button" class="btn btn-success text-white rounded" data-bs-toggle="modal" data-bs-target="#smsModal">
          Send SMS
        </button>
        <button class="btn btn-primary rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
          Show SMS Log
        </button>
      </div>
    </div></div>
    
    <div class="row m-auto" id="defaultContent">
      <div class="col bg bg-light px-1 pt-2 pb-3 overflow-auto overflow-y">
        <div class="row m-auto border border-3 border-success p-2 rounded mb-2">
          <?php include("./schedData/schedToday.php"); ?>
        </div>
        <div class="row m-auto border border-3 border-success p-2 rounded mb-2">
          <?php include("./schedData/schedTomorrow.php"); ?>
        </div>
        <div class="row m-auto border border-3 border-success p-2 rounded mb-2">
          <?php include("./schedData/schedNextWeek.php"); ?>  
        </div>
        <div class="row m-auto border border-3 border-success p-2 rounded mb-2">
          <?php include("./schedData/schedNextMonth.php"); ?>
        </div>
      </div>
  </div>

  <div class="row m-auto" id="searchContent">

  </div>

</div></main>
<script>
  function findInfo(){
    var user = document.getElementById("user").value;
    var fdate = document.getElementById("fdate").value;
    var ldate = document.getElementById("ldate").value;
    var month = document.getElementById("month").value;
    var syear = document.getElementById("startyear").value;
    var eyear = document.getElementById("endyear").value;
    var status = document.getElementById("status").value;

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("searchContent").innerHTML = this.responseText;
    }
    xhttp.open("GET", "schedFind.php");
    xhttp.send();
  }
</script>
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