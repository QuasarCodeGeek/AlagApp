<?php
    include ("../dataAnalytics.php");

    /*$check = "SELECT * FROM alagapp_db.tbl_admin WHERE adminid = 1 AND session = 1";
$checkSession = $connect->prepare($check);
$checkSession->execute();
if($checkSession->rowCount()>0){
  $wel = $checkSession->fetch(PDO::FETCH_ASSOC);
  
} else {
  echo "<script>window.location='./../../index.php'</script>";
}*/


    $userdata = "SELECT COUNT(userid) AS cuser FROM alagapp_db.tbl_userlist";
    $resuser = $connect->query($userdata);
    $resuser->execute();
    $rowuser = $resuser->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | AlagApps</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="node_modules/bootstrap/dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body class="bg bg-light">
      <main class="container-fluid"><div class="row m-auto">
      <div class="col-2 vh-100 bg bg-success">
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white nav-brand" href="#"><h1><b>AlagApp</b></h1></a>
          </div><br>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-success bg bg-light rounded p-2" href="../../dashboard.php" active><h4><i class="bi bi-speedometer2"></i> Dashboard</h4></a> 
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../../account.php"><h5><i class="bi bi-person-circle"></i> Account</h5></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../../scheduler.php"><h5><i class="bi bi-calendar"></i> Scheduler</h5></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../../consultation.php"><h5><i class="bi bi-chat"></i> O-Consultation</h5></a>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          <div class="row m-auto text-center my-3 float-bottom">
          <a class="nav-link text-white" href="./../adminData/adminProfile.php"><h5>Admin<h5></a>
            <a class="nav-link text-white" href="./../../logout.php"><h5>Log Out<h5></a>
          </div>
    </div>
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
<div class="col-10 vh-100 overflow-auto overflow-y">
          <div class="row m-auto mb-2">
            <h2 class="text-success p-3"><b>Dashboard</b> | Consultation Summary</h2>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="../../dashboard.php">Main</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="userDashboard.php">User List</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="petDashboard.php">Pet List</a>
            </div>
            <div class="col text-center p-1"  style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="cardDashboard.php">Vaccine Card</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="noteDashboard.php">Prescription Note</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="schedDashboard.php">Scheduler</a>
            </div>
            <div class="col text-center p-1 bg bg-success">
              <a type="button" class="text-white nav-link" href="consultDashboard.php"><strong>Consultation</strong></a>
            </div>
            <div class="col text-center p-1"  style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="vaccineDashboard.php">Vaccine List</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="symptomDashboard.php">Symptoms Diagnosis</a>
            </div>
          </div>
          
    <div class="row m-auto border border-3 border-success rounded m-2 p-2"><!-- Vaccine Card -->
      <div class="row m-auto">
        <div class="col-2 m-auto">
          <label class="fw-bold text-success">Total Rows: <?php echo $rowuser['cuser'];?></label>
        </div>
        <div class="col-6">
        <div class="row">
            <div class="col">
              <input class="form-control w-100" id="consult" type="text">
            </div>
            <div class="col">
              <button onclick="searchConsult()" class="btn btn-success">Search</button>
            </div>
          </div>
        </div>
        <div class="col-2 btn-group" role="group">
          <button type="button" class="btn btn-success" onclick="window.location='consultDashboard.php'"><i class="bi bi-sort-down"></i> ASC</button>
          <button type="button" class="btn btn-success" onclick="descConsult()"><i class="bi bi-sort-up"></i> DES</button>
        </div>
        <div class="col-2">
        <button class="btn btn-success float-end" onclick="window.location='../downloadData/dlConsult.php'" target="_blank"><i class="bi bi-download"></i> Download</button>
        </div>
      </div>
      <div class="row m-auto" id="alter">
      </div>
      <div class="row m-auto" id="table">
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>User</th>
            <th># Pets</th>
            <th># Schedules</th>
            <th># Chats</th>
            <th># Calls</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $user = "SELECT * FROM alagapp_db.tbl_userlist ORDER BY userid DESC";
          $ruser = $connect->query($user);
          $ruser->execute();

          if($ruser->rowCount()>0){
            $i=1;
            while($rowdata = $ruser->fetch(PDO::FETCH_ASSOC)){

                $petdata = "SELECT COUNT(petid) AS cpet FROM alagapp_db.tbl_petprofile WHERE userid = ".$rowdata['userid']."";
                $respet = $connect->query($petdata);
                $respet->execute();
                $rowpet = $respet->fetch(PDO::FETCH_ASSOC);

                $scheddata = "SELECT COUNT(qid) AS csched FROM alagapp_db.tbl_scheduler WHERE userid = ".$rowdata['userid']."";
                $ressched = $connect->query($scheddata);
                $ressched->execute();
                $rowsched = $ressched->fetch(PDO::FETCH_ASSOC);

                $chatdata = "SELECT COUNT(mid) AS cchat FROM alagapp_db.tbl_chat WHERE userid = ".$rowdata['userid']."";
                $reschat = $connect->query($chatdata);
                $reschat->execute();
                $rowchat = $reschat->fetch(PDO::FETCH_ASSOC);

                $calldata = "SELECT COUNT(vid) AS ccall FROM alagapp_db.tbl_call WHERE userid = ".$rowdata['userid']."";
                $rescall = $connect->query($calldata);
                $rescall->execute();
                $rowcall = $rescall->fetch(PDO::FETCH_ASSOC);

              echo "<tr>
              <td>".$i."</td>
              <td>".$rowdata['userfname']." ".$rowdata['userlname']."</td>
              <td>".$rowpet['cpet']."</td>
              <td>".$rowsched['csched']."</td>
              <td>".$rowchat['cchat']."</td>
              <td>".$rowcall['ccall']."</td>
            </tr>";
            $i++;
            }
          }
        ?>
        </tbody>
      </table>
      </div>
    </div><br>
    </div></div></main>

<!-- Main Functions -->
<script src="../../js/main.js"></script>
<script src="../../js/dashboardFilter.js"></script>
<script src="../../js/searchInfo.js"></script>
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
<!-- Chart JS Library -->
</body>
</html>