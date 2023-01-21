  <?php 
    require("connector.php"); 
    /*$check = "SELECT * FROM alagapp_db.tbl_admin WHERE adminid = 1 AND session = 1";
$checkSession = $connect->prepare($check);
$checkSession->execute();
if($checkSession->rowCount()>0){
  $wel = $checkSession->fetch(PDO::FETCH_ASSOC);
  
} else {
  echo "<script>window.location='./../index.php'</script>";
}*/
    require("dataAnalytics.php");
    $prof = $_GET["userid"];
    
    $npet = "SELECT COUNT(userid) AS numpet FROM alagapp_db.tbl_petprofile WHERE userid = ".$prof."";
    $res1 = $connect->query($npet);
    $res1->execute();
    $row1 = $res1->fetch(PDO::FETCH_ASSOC);
    $totalnpet = $row1["numpet"];

    $nsched = "SELECT COUNT(userid) AS numsched FROM alagapp_db.tbl_scheduler WHERE userid = ".$prof."";
    $res2 = $connect->query($nsched);
    $res2->execute();
    $row2 = $res2->fetch(PDO::FETCH_ASSOC);
    $totalnsched = $row2["numsched"];

    $ncard = "SELECT COUNT(userid) AS numcard FROM alagapp_db.tbl_carddetail WHERE userid = ".$prof."";
    $res3 = $connect->query($ncard);
    $res3->execute();
    $row3 = $res3->fetch(PDO::FETCH_ASSOC);
    $totalncard = $row3["numcard"];

    $nnote = "SELECT COUNT(userid) AS numnote FROM alagapp_db.tbl_notedetail WHERE userid = ".$prof."";
    $res4 = $connect->query($nnote);
    $res4->execute();
    $row4 = $res4->fetch(PDO::FETCH_ASSOC);
    $totalnnonte = $row4["numnote"];
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
      <link rel="stylesheet" href="../css/styles.css">
  </head>
  <body class="bg bg-light">

<main class="container-fluid"><div class="row m-auto">

<!-- Modal New Data -->
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
<!-- Modal New Data -->
<!-- Modal Edit Data -->
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
<!-- Modal Edit Data -->
<!-- Modal Profile -->
                      <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="ModalLabel">Choose Pet Picture</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-grid gap-2 container-fluid" id="modalPict">
                            </div>
                          </div>
                        </div>
                      </div>
<!-- Modal Profile -->
<div class="col-2 vh-100 bg bg-success"><!--SideBar-->
          <div class="row m-auto text-center my-3"><!--aa-->
            <a class="nav-link text-white nav-brand" href="#"><h1><b>AlagApp</b></h1></a>
          </div><br>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../dashboard.php"><h5><i class="bi bi-speedometer2"></i> Dashboard</h5></a> 
          </div>
          <div class="row m-auto text-center my-3 bg bg-light rounded p-2">
            <a class="nav-link text-success" href="../account.php" active><h4><i class="bi bi-person-circle"></i> Account</h4></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../scheduler.php"><h5><i class="bi bi-calendar"></i> Scheduler</h5></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../consultation.php"><h5><i class="bi bi-chat"></i> O-Consultation</h5></a>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          <div class="row m-auto text-center my-3 float-bottom">
          <a class="nav-link text-white" href="./adminData/adminProfile.php"><h5>Admin<h5></a>
            <a class="nav-link text-white" href="./../logout.php"><h5>Log Out<h5></a>
          </div><!--aa-->
        </div><!--SideBar-->
              <div class="col-2 bg bg-light pt-2 vh-100 overflow-auto overflow-y"><!-- Users List-->
                <?php include("./userList.php");?>
              </div><!-- Users List-->
              <div class="col-8 vh-100 overflow-auto overflow-y bg bg-light">
                  <div class="row m-2 p-2 bg bg-success rounded" style="--bs-bg-opacity: .75;">
                    <h3 class="text-white p-2"><b>User Profile</b></h3>
                    <?php include("./profileUser.php"); ?>
                  </div>
                  <div class="row m-2 p-2" style="--bs-bg-opacity: .75;">
                    <?php include("./profilePet.php"); ?>
                  </div>
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
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
  </body>
  </html>