<?php
    require("api/_connector.php");
    $user = $_REQUEST["userid"];

    $checkUser = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$user." AND usersession = '1'";
        $checkSession = $connect->prepare($checkUser);
        $checkSession->execute();
        if($checkSession->rowCount()>0){
          $wel = $checkSession->fetch(PDO::FETCH_ASSOC);
          
        } else {
          echo "<script>window.location='index.php'</script>";
        }

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
  <title>Scheduler</title>
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
        <i class="bi bi-list"></i>
    </button>
    <a class="navbar-brand text-white" href="#"><b>AlagApp</b></a>    
    <div class="offcanvas offcanvas-start w-75" style="background-color: #81C784;" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header bg bg-success">
        <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="userPage.php?userid=<?php echo $user; ?>">
                    <?php 
                        if($pict!=''){
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/uploads/".$pict."'>";
                        } else if ($sex=='F') {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/default/female.png'>";
                        } else {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/default/male.png'>";
                        }
                    
                    echo "<label class='float-end text-white'>".$name."</label>"; ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="homePage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-house-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">Home</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="chatPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white"><strong>O-Consultation</strong></label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="trackerPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">Health Tracker</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutUs.php?userid=<?php echo $user; ?>">
            <i class="bi bi-info-circle-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">About Us</label></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<main class="container-fluid">
<div class="row">
        <div class="col-6 p-2 text-center" style="background-color: #A5D6A7;">
            <a class="nav-link" href="chatPage.php?userid=<?php echo $user;?>">Chat</a>
        </div>
        <div class="col-6 p-2 text-center" style="background-color: #81C784;">
            <a class="nav-link active text-white" href="schedPage.php?userid=<?php echo $user;?>"><strong>Scheduler</strong></a>
        </div>
    </div>
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 vh-100 d-none d-sm-block">
            <div class="text-center text-white rounded m-2 p-2" style="background-color: #81C784;">
                <label><b>Tabs</b></label>
            </div>
            <ul class="list-group list-group-flush rounded">
                <li class='list-group-item'>
                    <a type="button" class="btn nav-link"><strong>All</strong></a>
                </li>
                <li class='list-group-item'>
                    <a type="button" class="btn nav-link">Pending</a>
                </li>
                <li class='list-group-item'>
                    <a type="button" class="btn nav-link">Denied</a>
                </li>
                <li class='list-group-item'>
                    <a type="button" class="btn nav-link">Accepted</a>
                </li>
                <li class='list-group-item'>
                    <a type="button" class="btn nav-link">Cancelled</a>
                </li>
                <li class='list-group-item'>
                    <a type="button" class="btn nav-link">Finished</a>
                </li>
                <li class='list-group-item'>
                    <a type="button" class="btn nav-link">Draft</a>
                </li>
            </ul>
    </div>
    <div class="modal fade mt-5" id="NewModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"><!-- New Modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">New Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="NewHere">
                </div>
            </div>
        </div>
    </div><!-- New Edit -->
    <div class="modal fade mt-5" id="EditModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"><!-- Edit Modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Edit Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="EditHere">
                </div>
            </div>
        </div>
    </div><!-- Modal Edit -->
    <div class="modal fade mt-5" id="CancelModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"><!-- Cancel Modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Cancel Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="CancelHere">
                </div>
            </div>
        </div>
    </div><!-- Cancel Edit -->
    <div class="modal fade mt-5" id="ResubmitModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"><!-- Resubmit Modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Resubmit Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="ResubmitHere">
                </div>
            </div>
        </div>
    </div><!-- Resubmit Edit -->
    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 d-block"><!-- Scedules -->
    <div class="m-auto mt-2">
        <button class='m-1 btn btn-success w-100' data-bs-toggle='modal' data-bs-target='#NewModal' onClick="newSched(<?php echo $user; ?>)">Request Schedule</button>
    </div>
        <?php
                
                $schedlist = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_petprofile.petname
                    FROM alagapp_db.tbl_scheduler
                    INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid
                    WHERE tbl_scheduler.userid = ".$user."";
                    $checksched = $connect->prepare($schedlist);
                    $checksched->execute();

        echo "<div class='row'><!-- Schedules -->";
                            if($checksched->rowCount()>0) {
                                $j=1;
                                while($row = $checksched->fetch(PDO::FETCH_ASSOC)){
    
                                echo "<div class='col-12 colsm-12 col-md-6 col-lg-6 col-xl-6'>
                                <div class='card card-body m-2'>
                                  <div class='row'>
                                    <div class='col-12 col-sm col-md col-lg col-xl'>
                                        <label>Pet: ".$row['petname']."</label><br>
                                        <label>Description: ".$row['qdescription']."</label>
                                    </div>
                                    <div class='col-12 col-sm col-md col-lg col-xl'>
                                        <label>Date: ".$row['qdate']."</label><br>
                                        <label>Status: ".$row['qstatus']."</label>
                                    </div>
                                    <div>";
                                    if(date("Y-m-d")>$row['qdate']){
                                        echo "<label>This schedule already passed.</label><br>";
                                        echo "<button class='m-1 btn btn-info' data-bs-toggle='modal' data-bs-target='#ResubmitModal' onClick='resubmitSched(".$row['qid'].")'>Resubmit</button>";
                                    } else {
                                        if($row['qstatus'] == "Denied"){
                                            echo "<button class='m-1 btn btn-info' data-bs-toggle='modal' data-bs-target='#ResubmitModal' onClick='resubmitSched(".$row['qid'].")'>Resubmit</button>";
                                        } else if($row['qstatus'] == "Accepted") {
                                            $d1=strtotime($row['qdate']);
                                            $d2=ceil(($d1-time())/60/60/24);
                                            echo "Days left: " . $d2 ."<br>";
                                            echo "<button class='m-1 btn btn-danger' data-bs-toggle='modal' data-bs-target='#CancelModal' onClick='cancelSched(".$row['qid'].")'>Cancel</button>";
                                        } else if($row['qstatus'] == "Pending") {
                                            $d1=strtotime($row['qdate']);
                                            $d2=ceil(($d1-time())/60/60/24);
                                            echo "Days left: " . $d2."<br>";
                                            echo "<button class='m-1 btn btn-warning' data-bs-toggle='modal' data-bs-target='#EditModal' onClick='editSched(".$row['qid'].")'>Edit</button>";
                                            echo "<button class='m-1 btn btn-danger' data-bs-toggle='modal' data-bs-target='#CancelModal' onClick='cancelSched(".$row['qid'].")'>Cancel</button>";
                                        } else if($row['qstatus'] == "Cancelled") {
                                            echo "<label>This schedule is cancelled.</label>";
                                        } else if ($row['qstatus'] == "Finished") {
                                            echo "<label>This schedule is already finished.</label>";
                                            echo "<button class='m-1 btn btn-info' data-bs-toggle='modal' data-bs-target='#ResubmitModal' onClick='resubmitSched(".$row['qid'].")'>Resubmit</button>";
                                        }
                                    }
                                    echo "</div>
                                  </div>
                                </div>
                                </div>";
                                $j++;
                                }
                            } else {
                                echo "<div class='row card card-body m-2'>
                                    <label>No Record</label>
                                </div>";
                            }
        echo "</div>";
        ?>
    </div>
</div>
  </main>
  <script src="js/client.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>