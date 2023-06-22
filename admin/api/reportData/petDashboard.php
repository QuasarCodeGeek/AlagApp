<?php
    include ("../dataAnalytics.php");

    session_start();
    if($_SESSION["adminsession"] == ""){
      echo "<script>window.location='./../index.php'</script>";
    }

    $petdata = "SELECT COUNT(petid) AS count FROM alagapp_db.tbl_petprofile";
    $resdata = $connect->query($petdata);
    $resdata->execute();
    $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);
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
    <link href="./../../../bootstrap-5.2.2-dist/css/bootstrap.css" rel="stylesheet">
    <script src="./../../../bootstrap-5.2.2-dist/js/bootstrap.js"></script>
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
            <h2 class="text-success p-3"><b>Dashboard</b> | Pet List </h2>
            <div class="row m-auto border border-3 border-success rounded-pill p-2">
            <div class="col text-center p-1">
              <a type="button" class="text-success nav-link" href="../../dashboard.php"><strong>Main</strong></a>
            </div>
            <div class="col text-center p-1">
              <a type="button" class="text-success fw-bold nav-link" href="userDashboard.php">User List</a>
            </div>
            <div class="col text-center p-1 bg bg-success rounded-pill">
              <a type="button" class="text-white fw-bold nav-link" href="petDashboard.php">Pet List</a>
            </div>
            <div class="col text-center p-1">
              <a type="button" class="text-success fw-bold nav-link" href="cardDashboard.php">Vaccine Card</a>
            </div>
            <div class="col text-center p-1">
              <a type="button" class="text-success fw-bold nav-link" href="noteDashboard.php">Prescription Note</a>
            </div>
            <div class="col text-center p-1">
              <a type="button" class="text-success fw-bold nav-link" href="schedDashboard.php">Scheduler</a>
            </div>
            <div class="col text-center p-1">
              <a type="button" class="text-success fw-bold nav-link" href="vaccineDashboard.php">Vaccine List</a>
            </div>
            <div class="col text-center p-1">
              <a type="button" class="text-success fw-bold nav-link" href="symptomDashboard.php">Symptoms Diagnosis</a>
            </div>
          </div>
          </div>
          
    <div class="row m-auto border border-3 border-success rounded m-2 p-2"><!-- Pet List -->
      <div class="row m-auto">
        <div class="col-2 m-auto">
          <label class="fw-bold text-sucess">Total Pets: <?php echo $rowdata['count'];?></label>
        </div>
        <div class="col-6">
          <div class="row">
            <div class="col">
              <input class="form-control w-100" id="pet" type="text">
            </div>
            <div class="col">
              <button onclick="searchPet()" class="btn btn-success">Search</button>
            </div>
          </div>
        </div>
        <div class="col btn-group" role="group">
          <button type="button" class="btn btn-success" onclick="window.location='petDashboard.php'"><i class="bi bi-sort-down"></i> ASC</button>
          <button type="button" class="btn btn-success" onclick="descPet()"><i class="bi bi-sort-up"></i> DES</button>
        </div>
        <div class="col">
        <button class="btn btn-success float-end" onclick="window.location='../downloadData/dlPet.php'" target="_blank"><i class="bi bi-download"></i> Download</button>
        </div>
      </div>
      <div class="row m-auto" id="alter">
      </div>
      <div class="row m-auto" id="table">
      <table class="table table-striped m-2" id="tblPet">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Pet</th>
            <th>Owner</th>
            <th>Pet Type</th>
            <th>Breed</th>
            <th>Wt(Kg)</th>
            <th>Color/Marking</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Sex</th>
          </tr>
          <?php include("./petFilter.php");?>
        </thead>
        <tbody>
        <?php
          $pet = "SELECT alagapp_db.tbl_petprofile.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname
          FROM (alagapp_db.tbl_petprofile
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_petprofile.userid = alagapp_db.tbl_userlist.userid)
          ORDER BY petid DESC";
          $respet = $connect->query($pet);
          $respet->execute();
          if($respet->rowCount()>0){
            $i=1;
            while($rowpet = $respet->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rowpet['petname']."</td>
              <td>".$rowpet['userfname']." ".$rowpet['userlname']."</td>
              <td>".$rowpet['pettype']."</td>
              <td>".$rowpet['petbreed']."</td>
              <td>".$rowpet['petweight']."</td>
              <td>".$rowpet['petmark']."</td>
              <td>".date("d/M/Y", strtotime($rowpet['petbdate']))."</td>
              <td>".$rowpet['petage']."</td>
              <td>".$rowpet['petgender']."</td>
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
<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
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

<script>
document.getElementById("ExportTable").addEventListener('click', function() {
  /* Create worksheet from HTML DOM TABLE */
  var wb = XLSX.utils.table_to_book(document.getElementById("tblPet"));
  /* Export to file (start a download) */
  XLSX.writeFile(wb, "Pet Profile Summary.xlsx");
});
</script>
</body>
</html>