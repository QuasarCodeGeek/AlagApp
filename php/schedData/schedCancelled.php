<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduler Chronological | AlagApp</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body class="bg bg-info">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="../index.html">AlagApp</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="../../account.php">Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-success" href="../../scheduler.php" active><strong>Scheduler</strong></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../consultation.php">Consultation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../dashboard.php">Dashboard</a>
</li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav> 

      <main class="container container-fluid">
      <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="ModalLabel">New Record</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-grid gap-2 container-fluid" id="modalNew">
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
                            <div class="modal-body d-grid gap-2 container-fluid" id="modalHere">
                              Content Edit Here
                            </div>
                          </div>
                        </div>
                        </div>

        <div class="row">
          <div class="col text-center bg bg-light">
              <a class="nav-link p-2" type="button" href="../../scheduler.php"><strong>Account</strong></a>
          </div>
          <div class="col text-center bg bg-success">
              <a class="nav-link p-2 text-white" type="button" href="../sched_chrono.php"><strong>Chronological</strong></a>
          </div>
        </div>
        <div class="row">
            <div class="col-3 p-2 bg bg-light vh-100">
                <div class="row m-auto p-2 bg bg-success rounded" style="--bs-bg-opacity: .5;">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link bg bg-success text-light" aria-current="page" href="#"><strong>Day</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Week</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Month</a>
                    </li>
                </ul>
                </div>

                <div class="row m-2">
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedPending.php'">Pending</button>
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedDenied.php'">Denied</button>
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedAccepted.php'">Accepted</button>
                    <button class="btn w-100 bg bg-success text-white mb-1" onclick="location.href='schedCancelled.php'"><strong>Cancelled</strong></button>
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedFinished.php'">Finished</button>
                </div>
            </div>
            <div class="col-9 container bg bg-light pt-2 pb-5">
            <?php
                  require("../connector.php");

                  $sql = "SELECT * FROM alagapp_db.tbl_scheduler WHERE qstatus = 'Cancelled' ";
              
                  $res = $connect->prepare($sql);
                  $res->execute();
              
                  $join1 = "SELECT alagapp_db.tbl_userlist.userfname
                  FROM alagapp_db.tbl_scheduler
                  INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid";
                  $entry1 = $connect->query($join1);
                  $entry1->execute();
              
                  $join2 = "SELECT alagapp_db.tbl_petprofile.petname
                  FROM alagapp_db.tbl_scheduler
                  INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid";
                  $entry2 = $connect->query($join2);
                  $entry2->execute();

              ?>
              <div class="container row">
              <?php 
          
              if($res->rowCount()>0 && $entry1->rowCount()>0 && $entry2->rowCount()>0){
                  $i=1;
                  while($row = $res->fetch(PDO::FETCH_ASSOC)){
                      $rowentry1 = $entry1->fetch(PDO::FETCH_ASSOC);
                      $rowentry2 = $entry2->fetch(PDO::FETCH_ASSOC);
                  echo
                  "<div class='card m-1 p-1 col-flex' style='width: 11rem;'>
                      <div class='card-body'>
                          <button type='button' class='btn btn-success w-100' onClick='SchedEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$rowentry2['petname']."</h6></button><br>
                          <label class='card-text' style='font-size: 12px;'>Owner: ".$rowentry1['userfname']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Description: ".$row['qdescription']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Date Issued: ".$row['qdate']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Status: ".$row['qstatus']."</label>
                      </div>
                  </div>";
                  $i++;
                  }
              }  else {
                  echo "
                  </div>";
              }
                ?>
            </div>
        </div>
      </main>

<!-- Main Functions -->
<script> src="../../js/main.js"</script>
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