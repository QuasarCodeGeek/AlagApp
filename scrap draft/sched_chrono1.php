<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="sched_chrono1.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
</head>
<body>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3><span>Alagapp</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/3.jpeg)"></div>
                <h4>Alagapp</h4>
                
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="account1.php" class="active">
                            <span class="las la-home"></span>
                            <small>Account</small>
                        </a>
                    </li>
                    <li>
                       <a href="scheduler1.php">
                            <span class="las la-user-alt"></span>
                            <small>Scheduler</small>
                        </a>
                    </li>
                    <li>
                       <a href="dashboard1.php">
                            <span class="las la-envelope"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                       <a href="consultation1.php">
                            <span class="las la-clipboard-list"></span>
                            <small>Consultation</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
         
                
                <div class="header-menu">
                    <label for="">
                      
                        <span>User Profile</span>
                    </label>
                    
                  
        </header>
        
        
        <main>
            
            <div class="page-header">
                <h1>Alagapp</h1>
                <h2>Veterinary Clinic Pet Monitoring and Online Consultation System</h2>
            </div>
            
            <div class="page-content">
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

        <div class="row">
          <div class="col text-center bg bg-light">
              <a class="nav-link p-2" type="button" href="../scheduler1.php"><strong>Account</strong></a>
          </div>
          <div class="col text-center bg bg-success">
              <a class="nav-link p-2 text-white" type="button" href="php/sched_chrono.php" disable><strong>Status</strong></a>
          </div>
        </div>
        <div class="row">
            <div class="col-2 p-2 bg bg-light">
                <div class="row m-2">
                    <button class="btn w-100 bg bg-success text-white mb-1" onclick="location.href='sched_chrono1.php'">All</button>
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedData/schedPending1.php'">Pending</button>
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedData/schedDenied1.php'">Denied</button>
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedData/schedAccepted1.php'">Accepted</button>
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedData/schedCancelled1.php'">Cancelled</button>
                    <button class="btn w-100 bg bg-success text-white mb-1" style="--bs-bg-opacity: .5;" onclick="location.href='schedData/schedFinished1.php'">Finished</button>
                </div>
            </div>
            <div class="col-9 container bg bg-light pt-2 pb-5">
            <?php
                  require("connector.php");

                  $sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_petprofile.petname
                  FROM ((alagapp_db.tbl_scheduler
                  INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
                  INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)";
              
                  $res = $connect->prepare($sql);
                  $res->execute();
              ?>
              <div class="container row">
              <?php 
          
              if($res->rowCount()>0){
                  $i=1;
                  while($row = $res->fetch(PDO::FETCH_ASSOC)){
                  echo
                  "<div class='card m-1 p-1 col-flex' style='width: 11rem;'>
                      <div class='card-body'>
                          <button type='button' class='btn btn-success w-100' onClick='schedEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$row['petname']."</h6></button><br>
                          <label class='card-text' style='font-size: 12px;'>Owner: ".$row['userfname']."</label><br>
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
            </div>
    
</body>

</html>