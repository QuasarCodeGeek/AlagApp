<?php
require("./connector.php");
/*$check = "SELECT * FROM alagapp_db.tbl_admin WHERE adminid = 1 AND session = 1";
$checkSession = $connect->prepare($check);
$checkSession->execute();
if($checkSession->rowCount()>0){
  $wel = $checkSession->fetch(PDO::FETCH_ASSOC);
  
} else {
  echo "<script>window.location='./../index.php'</script>";
}*/
  if(isset($_POST["submit"])){
    $user = $_POST['user'];
    //$sdate = $_POST['firstdate'];
    //$edate = $_POST['lastdate'];
    //$month = $_POST['month'];
    //$syear = $_POST['startyear'];
    //$eyear = $_POST['endyear'];
    $status = $_POST['status'];
  }
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
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg bg-light">
      <main class="container-fluid">
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
              <?php
              $set = "SELECT userfname, userlname FROM alagapp_db.tbl_userlist WHERE userid = ".$user."";
              $resset = $connect->query($set);
              $resset->execute();
              $useSet = $resset->fetch(PDO::FETCH_ASSOC);
              echo "<option selected value='".$user."'>".$userSet['userfname']." ".$userSet['userlname']."</option>";

                $use = "SELECT userid, userfname, userlname FROM alagapp_db.tbl_userlist";
                $res = $connect->query($use);
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
              <option selected value="<?php echo $status;?>"><?php echo $status;?></option>
              <option value="All">All</option>
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
    </div></div>
    
    <div class="row m-auto" id="defaultContent">
      <div class="col bg bg-light px-1 pt-2 pb-3 overflow-auto overflow-y">
        <div class="row m-auto border border-3 border-success p-2 rounded mb-2">
          <?php include("./schedData/schedSToday.php"); ?>
        </div>
        <div class="row m-auto border border-3 border-success p-2 rounded mb-2">
          <?php include("./schedData/schedSTomorrow.php"); ?>
        </div>
        <div class="row m-auto border border-3 border-success p-2 rounded mb-2">
          <?php include("./schedData/schedSWeek.php"); ?>  
        </div>
        <div class="row m-auto border border-3 border-success p-2 rounded mb-2">
          <?php include("./schedData/schedSMonth.php"); ?>
        </div>
      </div>
  </div>

  <div class="row m-auto" id="searchContent">

  </div>

</div></main>
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