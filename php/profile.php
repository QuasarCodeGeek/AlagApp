  <?php 
    require("connector.php"); 
    require("dataAnalytics.php");
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
      <nav class="navbar navbar-expand-lg bg bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php">AlagApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link text-success" href="../account.php" active><strong>Account</strong></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../scheduler.php">Scheduler</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../consultation.php">Consultation</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../dashboard.php">Dashboard</a>
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
          <div class="row">
              <div class="col-3 container p-2 bg bg-light">
                  <!--<div class="row m-2">
                  <input type="text" onkeyup="_searchAccount()" class="form-control rounded-start" id="searchAccount" placeholder="Search">
                  </div>-->
                  <div class="m-1" id="accountHere">
                    
                    </div>
                  <div class="row m-1 overflow-x overflow-auto">
                      <ul class="list-group list-group-flush">
                      <?php 
                          $sql = "SELECT * FROM alagapp_db.tbl_userlist";
                      
                          $res = $connect->prepare($sql);
                          $res->execute();
                      
                          $sql2 = "SELECT COUNT(userid) AS entry FROM alagapp_db.tbl_userlist";
                          $res2 = $connect->query($sql2);
                          $res2->execute();
                          $row1 = $res2->fetch(PDO::FETCH_ASSOC);
                      
                          if($res->rowCount()>0){
                              $i=1;
                              while($row = $res->fetch(PDO::FETCH_ASSOC)){
                                  echo "
                                  <li class='list-group-item bg bg-light'>
                                  <a type='button' class='btn' href='profile.php?userid=".$row['userid']."'>
                                  <label class='text-wrap'>".$row['userfname']." ".$row['userlname']."</label>
                                  </a>
                                  </li>";
                                  $i++;
                              }
                          } else {
                              echo "Nothing follows";
                          }
                      ?>
                      </ul>
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
                  </div>
              </div>
              <div class="col-9 container bg bg-light">
                  <div class="row mb-2 p-2 bg bg-success rounded" style="--bs-bg-opacity: .75;" id="userProfile">
                    <?php
                      $account = $_GET["userid"];
                      $sql = "SELECT * FROM alagapp_db.tbl_userlist
                          WHERE userid = ".$account." ";
                  
                      $res = $connect->prepare($sql);
                      $res->execute();
                  
                      if($res->rowCount()>0){
                          $row = $res->fetch(PDO::FETCH_ASSOC);
                          echo"
                              <div class='col-3'>
                              <img class='userProfile m-auto rounded' src='../assets/img/diluc.png' alt='profile_picture'><br>
                              </div>
                              <div class='col-4 p-2 rounded bg bg-light'>
                                  <label>Name: ".$row['userfname']." ".$row['usermname']." ".$row['userlname']."</label><br>
                                  <label>username: ".$row['useremail']."</label><br>
                                  <label>Birth Date: ".$row['userbdate']."</label><br>
                                  <label>Gender: ".$row['usergender']."</label><br>
                                  <label>Address: ".$row['userstreet']." ".$row['userdistrict']." ".$row['usermunicipality']." ".$row['userprovince']."</label>
                              </div>
                              <div class='col-3'>
                                <div class='row-2 m-auto mb-2 p-2 bg bg-light rounded'>
                                    <label>Pets: #</label>
                                </div>
                                <div class='row-2 m-auto mb-2 p-2 bg bg-light rounded'>
                                    <label>Schedules: #</label>
                                </div>
                                <div class='row-2 m-auto mb-2 p-2 bg bg-light rounded'>
                                    <label>Vaccine Card: #</label>
                                </div>
                                <div class='row-2 m-auto mb-2 p-2 bg bg-light rounded'>
                                    <label>Prescription Note: #</label>
                                </div>
                              </div>
                              <div class='col-2'>
                                  <button type='button' class='btn btn-light mb-2' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Print'>
                                    <i class='bi bi-printer-fill'></i></button><br>
                                  <button type='button' class='btn btn-light mb-2' onClick='userEdit(".$row['userid'].")' data-bs-toggle='tooltip'  data-bs-placement='right' data-bs-title='Edit'>
                                    <i class='bi bi-pencil-square' data-bs-toggle='modal' data-bs-target='#boxModal'></i></button>
                                  <button type='button' class='p-2 btn btn-info w-100' onClick='PetNew()' data-bs-toggle='modal' data-bs-target='#newModal')>
                                    <i class='bi bi-plus-square'></i> Add Pet</button>
                              </div>";
                      } else {
                          echo "No Record";
                      }
                    ?>
                  </div>
                  <div class="row p-2 bg bg-success rounded" style="--bs-bg-opacity: .5;" id="petProfile">
                    <?php
                      $petaccount = $_GET["userid"];
                      $sql = "SELECT * FROM alagapp_db.tbl_petprofile
                          WHERE userid = ".$petaccount." ";
                  
                      $res = $connect->prepare($sql);
                      $res->execute();
                  
                      if($res->rowCount()>0){
                          $i=1;
                          while($row = $res->fetch(PDO::FETCH_ASSOC)){
                              echo"
                              <div class='row m-auto mb-2 p-2 bg bg-success rounded' style='--bs-bg-opacity: .5'>
                                  <div class='col-3'>
                                      <img class='userProfile m-auto rounded' src='../assets/img/albedo.png' alt='profile_picture'><br>
                                  </div>
                                  <div class='col-8'>
                                    <div class='row'>
                                      <div class='col-4'>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Name: ".$row['petname']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Species: ".$row['pettype']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Breed: ".$row['petbreed']."</label>
                                        </div>
                                      </div>
                                      <div class='col-4'>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Gender: ".$row['petgender']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>DOB: ".$row['petbdate']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Age: ".$row['petage']."</label>
                                        </div>
                                      </div>
                                      <div class='col-4'>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Weight(Kg): ".$row['petweight']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Height(Ft): ".$row['petheight']."</label>
                                        </div>
                                      </div>
                                    </div> 
                                  </div>
                                  <div class='col-1'>
                                    <button type='button' class='btn btn-light mb-2' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Print'>
                                      <i class='bi bi-printer-fill'></i></button><br>
                                    <button type='button' class='btn btn-light' onClick='petEdit(".$row['petid'].")' data-bs-toggle='tooltip'  data-bs-placement='right' data-bs-title='Edit'>
                                      <i class='bi bi-pencil-square' data-bs-toggle='modal' data-bs-target='#boxModal'></i></button>
                                  </div><br>
                  
                              <div class='row mx-auto my-2'>
                                <div class='col-6 bg bg-success rounded-start'>";
                                  $vax = "SELECT alagapp_db.tbl_vaxxcard.cid,
                                    alagapp_db.tbl_vaxxcard.petid,
                                    alagapp_db.tbl_vaxxcard.vaxid,
                                    alagapp_db.tbl_vaxxinfo.vaxname,
                                    alagapp_db.tbl_vaxxcard.fdose,
                                    alagapp_db.tbl_vaxxcard.sdose,
                                    alagapp_db.tbl_vaxxcard.booster 
                                    FROM alagapp_db.tbl_vaxxcard
                                    INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_vaxxcard.vaxid = alagapp_db.tbl_vaxxinfo.vaxid
                                    WHERE petid = ".$row['petid']."";
                    
                                  $resvax = $connect->prepare($vax);
                                  $resvax->execute();
                    
                                  if($resvax->rowCount()>0){
                                    $j=1;
                                    while($rowvax = $resvax->fetch(PDO::FETCH_ASSOC)){
                                      echo"
                                      <div class='row m-2 p-2 bg bg-light rounded'>
                                
                                      <label>Vaccine: ".$rowvax['vaxname']."</label><br>
                                      <label>First Dose: ".$rowvax['fdose']."</label><br>
                                      <label>Second Dose: ".$rowvax['sdose']."</label><br>
                                      <label>Booster: ".$rowvax['booster']."</label>

                                      <button type='button' class='btn btn-info' onClick='cardEdit(".$rowvax['cid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
                                      <i class='bi bi-pencil-square'></i>
                                      Edit</button>
                                      </div>";
                                      $j++;
                                    }
                                      echo "<div class='row m-2'><button type='button' class='btn btn-light' onClick='cardNew()' data-bs-toggle='modal' data-bs-target='#newModal')>
                                      <i class='bi bi-plus-square'></i>
                                      Add Vaccination</button></div>";
                                  } else {
                                    echo "<div class='row m-2 bg bg-light rounded'><label class='p-2 text-center '>No Record</label></div>";
                                    echo "<div class='row m-2'><button type='button' class='btn btn-light' onClick='cardNew()' data-bs-toggle='modal' data-bs-target='#newModal')>
                                    <i class='bi bi-plus-square'></i>
                                    Add Vaccination</button></div>";
                                  }
                                  echo "
                                </div>
                                <div class='col-6 bg bg-success rounded-end'>";
                                  $note = "SELECT * FROM alagapp_db.tbl_notedetail
                                    WHERE petid = ".$row['petid']."";
                    
                                  $resnote = $connect->prepare($note);
                                  $resnote->execute();
                    
                                  if($resnote->rowCount()>0){
                                    $p=1;
                                    while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){
                                      echo"
                                        <div class='row m-2 p-2 bg bg-light rounded'>
                                          <label>Description: ".$rownote['ndescription']."</label><br>
                                          <label>Date Issued: ".$rownote['ndate']."</label><br>
                                          <label>Status: ".$rownote['nstatus']."</label>

                                          <button type='button' class='btn btn-info' onClick='prescriptionEdit(".$rownote['nid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
                                          <i class='bi bi-pencil-square'></i>
                                          Edit</button>
                                            </div>";
                                            $p++;
                                        }
                                        echo "<div class='row m-2 bg bg-light rounded'><button type='button' class='btn btn-light' onClick='noteNew()' data-bs-toggle='modal' data-bs-target='#newModal')>
                                        <i class='bi bi-plus-square'></i>
                                        Add Prescription</button></div>";
                                    } else {
                                        echo "<div class='row m-2 bg bg-light rounded'><label class='p-2 text-center '>No Record</label></div>";
                                        echo "<div class='row m-2'><button type='button' class='btn btn-light' onClick='noteNew()' data-bs-toggle='modal' data-bs-target='#newModal')>
                                        <i class='bi bi-plus-square'></i>
                                        Add Prescription</button></div>";
                                    }
                    
                                echo "
                                </div>
                            </div>
                            </div>";
                              $i++;
                          }
                      } else {
                          echo "<div class='col'>
                          <div class='row bg bg-light rounded'>
                            <label class='p-2 text-center '>No Record
                            </label></div>
                          </div>
                          </div><br>";
                      }
                    ?>
                  </div>
              </div>
          </div>
        </main>
  <!-- Footer -->
  <footer class="position-bottom text-white py-3">
    <div class="container">
        <label class="float-start">@2022</label>
        <label>User Guide</label>
        <label class=" float-end">PROGRAM SLAYER</label>
    </div>
  </footer>
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