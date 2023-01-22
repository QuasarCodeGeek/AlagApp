<?php
    require("api/_connector.php");
    
    $user = $_REQUEST["userid"];

    session_start();
    if($_SESSION["newsession"] !=  $user+date("Ymd")){
      echo "<script>window.location='./index.php'</script>";
    }

    /*$checkUser = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$user." AND usersession = '1'";
        $checkSession = $connect->prepare($checkUser);
        $checkSession->execute();
        if($checkSession->rowCount()>0){
          $wel = $checkSession->fetch(PDO::FETCH_ASSOC);
          
        } else {
          echo "<script>window.location='index.php'</script>";
        }*/

    $picture = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$user." ";
        $checkpict = $connect->prepare($picture);
        $checkpict->execute();

        if($checkpict->rowCount()>0) {
          $acc = $checkpict->fetch(PDO::FETCH_ASSOC);
          $sex = $acc['usergender'];
          $pict = $acc['userpict'];
          $name = $acc['userfname'];
        }
?>
<!doctype html>
<html lang="en">

<head>
  <title>Home</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body style="background-color: #C8E6C9;">
<nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid">
    <button class="navbar-toggler" style="border: none; color: white;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <h1><i class="bi bi-list"></i></h1>
    </button>
    <h1 class="text-white me-3"><b>AlagApp</b></h1>    
    <div class="offcanvas offcanvas-start w-75" style="background-color: #81C784;" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header bg bg-success">
        <h2 class="offcanvas-title text-white" id="offcanvasNavbarLabel">Menu</h2>
        <h3><button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button></h3>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav flex-grow-1 pe-3">
          <li class="nav-item">
            <h3><a class="nav-link" href="userPage.php?userid=<?php echo $user; ?>">
                    <?php 
                        if($pict!=''){
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/uploads/".$pict."'>";
                        } else if ($sex=='F') {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/default/female.png'>";
                        } else {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/default/male.png'>";
                        }
                    
                    echo "<label class='float-end text-white'>".$name."</label>"; ?>
            </a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link active" aria-current="page" href="homePage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-house-fill me-2" style="color: white;"></i>
            <label class="float-end text-white"><strong><u>Home</u></strong></label></a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link" href="chatPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">O-Consultation</label></a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link" href="trackerPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-archive-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">Health Tracker</label></a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link" href="aboutUs.php?userid=<?php echo $user; ?>">
            <i class="bi bi-info-circle-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">About Us</label></a></h3>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<main class="container-fluid">

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


<div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 vh-100 d-none d-sm-block">
            <div class="text-center text-white rounded m-2 p-2" style="background-color: #81C784;">
                <label><b>My Pets</b></label>
            </div>
            <ul class="list-group list-group-flush rounded">
            <?php
                $petlist = "SELECT * FROM alagapp_db.tbl_petprofile WHERE userid = ".$user." ";
                $checklist = $connect->prepare($petlist);
                $checklist->execute();

                $petres = $connect->prepare($petlist);
                $petres->execute();
        
                if($checklist->rowCount()>0) {
                  $i=1;
                  while($pet = $checklist->fetch(PDO::FETCH_ASSOC)){
                    echo "<li class='list-group-item'>
                    <label><b>".$pet['petname']."</b></label>
                    <label class='float-end'>".$pet['pettype']."</label>
                    </li>";
                    $i++;
                  }
                  
                }
            ?>
            </ul>
        </div>
    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 d-block"><!-- Pet Profile -->
        <div class="m-2 p-2">
            <?php
            if($petres->rowCount()>0) {
                while($petrow = $petres->fetch(PDO::FETCH_ASSOC)){
                    echo "
                    <div class='card m-2 p-3' style='background-color:#E8F5E9;'>
                      <div class='row p-2'>
                        <div class='col-12 col-sm-12 col-md col-lg col-xl-4'>";
                          if($petrow['petpict'] == ""){
                            echo "<img style='width: 15rem;' class='mb-2 mx-auto d-block rounded' src='../assets/default/paw.png' alt='profile_picture'>";
                          } else {
                            echo "<img style='width: 15rem;' class='mb-2 mx-auto d-block rounded' src='../assets/pet/".$petrow['petpict']."' alt='profile_picture'>";
                          }
                            //<img class='mb-2 mx-auto d-block rounded' style='width: 18rem;' src='../assets/img/".$petrow['pettype']."/".$petrow['petbreed'].".jpg' alt='petProfile'>
                        echo "
                          <div class='card-img-overlay'>
                            <button type='button' class='btn btn-light' onClick='petImg(".$petrow['petid'].")' data-bs-toggle='modal' data-bs-target='#profileModal'>
                            <i class='bi bi-pencil-square'></i></button>
                          </div>
                        </div>
                        <div class='p-2 col-12 col-sm-12 col-md col-lg col-xl-8 rounded bg bg-light'>
                          <div class='p-2'>
                                <div class='col mb-2'>
                                    <label>Name: ".$petrow['petname']."</label>
                                    <label class='float-end'>Gender: ".$petrow['petgender']."</label>
                                </div> 
                                <div class='col-12 col-sm-12 mb-2'>
                                    <label>Species: ".$petrow['pettype']."</label>
                                    <label class='d-block d-sm-none my-2'>Breed: ".$petrow['petbreed']."</label>
                                    <label class='d-none d-sm-block float-end'>Breed: ".$petrow['petbreed']."</label>
                                </div>
                                <div class='col mb-2'>
                                    <label>DOB: ".$petrow['petbdate']."</label>
                                    <label class='float-end'>Age: ".$petrow['petage']."</label>
                                </div>
                                <div class='col-12 col-sm-12'>
                                    <label>Wt(Kg): ".$petrow['petweight']."</label>
                                    <label class='d-block d-sm-none my-2'>Color/Marking: ".$petrow['petmark']."</label>
                                    <label class='d-none d-sm-block float-end'>Color/Marking: ".$petrow['petmark']."</label>
                                </div>
                          </div>      
                        </div>
                      </div>
                    </div>";

                    $cardlist = "SELECT alagapp_db.tbl_carddetail.*, alagapp_db.tbl_vaxxinfo.vaxname
                    FROM alagapp_db.tbl_carddetail
                    INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_carddetail.vaxid = alagapp_db.tbl_vaxxinfo.vaxid
                    WHERE petid = ".$petrow['petid']." ";
                    $checkcard = $connect->prepare($cardlist);
                    $checkcard->execute();

                    echo "<div class='row'>
                        <div class='col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12'><!-- Vaccine Card -->
                            <button class='btn btn-success w-100 mb-2' type='button' data-bs-toggle='collapse' data-bs-target='#collapseCard".$petrow['petid']."' aria-expanded='false' aria-controls='collapseCard".$petrow['petid']."'>
                                    E-Vaccine Card
                            </button>
                            <div class='collapse' id='collapseCard".$petrow['petid']."'>";?>
                            
                            <table class="table table-striped bg bg-light rounded">
                              <thead>
                                <tr>
                                  <th>Date</th>
                                  <th>Due Date</th>
                                  <th>Wt(Kg)</th>
                                  <th>Vaccine</th>
                                  <th>Veterinarian</th>
                                  <tbody>
                            <?php
                        
                            if($checkcard->rowCount()>0) {
                                $j=1;
                                while($cardrow = $checkcard->fetch(PDO::FETCH_ASSOC)){
    
                                echo "<tr>
                                  <td>".$cardrow['cdate']."</td>
                                  <td>".$cardrow['cnext']."</td>
                                  <td>".$cardrow['cweight']."</td>
                                  <td>".$cardrow['vaxname']."</td>
                                  <td>".$cardrow['cvet']."</td>
                                </tr>";
                                $j++;
                                }
                                echo "</tbody>
                                </tr>
                              </thead>
                              </table>";
                            } else {
                                echo "<div class='row card card-body m-2'>
                                    <label>No Record</label>
                                </div>";
                            }
                            echo "</div>
                        </div>";

                        $notelist = "SELECT * FROM alagapp_db.tbl_notedetail WHERE petid = ".$petrow['petid']." ";
                            $checknote = $connect->prepare($notelist);
                            $checknote->execute();

                        echo "<div class='col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12'><!-- Prescription Note -->
                            <button class='btn btn-success w-100 mb-2' type='button' data-bs-toggle='collapse' data-bs-target='#collapseNote".$petrow['petid']."' aria-expanded='false' aria-controls='collapseNote".$petrow['petid']."'>
                                    E-Prescription Note
                            </button>
                            <div class='collapse' id='collapseNote".$petrow['petid']."'>";

                            if($checknote->rowCount()>0) {
                                $k=1;
                                while($noterow = $checknote->fetch(PDO::FETCH_ASSOC)){
    
                            echo "<div class='row m-auto bg bg-light rounded p-2 mb-2'>
                                  <div class='col-6'>
                                    <label>Date: ".$noterow['ndate']."</label>
                                  </div>
                                  <div class='col-6'>
                                    <label>Veterinarian: ".$noterow['nvet']."</label>
                                  </div>
                                  <div class='col-12 p-2 border border-1 border-success rounded'>
                                    <p>Description: ".$noterow['ndescription']."</p>
                                  </div>
                                </div>";
                                }
                            } else {
                                echo "<div class='row card card-body m-2'>
                                    <label>No Record</label>
                                </div>";
                            }
                            echo "</div>
                        </div>
                    </div>";
                }
            } else {
              echo "<div class='row card card-body'>
                <label class='text-center'>Empty Pet! Please contact or visit the clinic to have your pet registered to your account!</label>
              </div>";
            }
            ?>
        </div>
    </div>
</div>
  </main>
  <script src="./js/client.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>