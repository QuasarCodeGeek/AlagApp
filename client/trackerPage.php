<?php
    require("api/_connector.php");
    
    $user = $_REQUEST["userid"];

    session_start();
    if($_SESSION["newsession"] == ""){
      echo "<script>window.location='./index.php'</script>";
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
  <title>Health Tracker</title>
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
          <h3><a class="nav-link" aria-current="page" href="homePage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-house-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">Home</label></a></h3>
          </li>
          <li class="nav-item">
          <h3><a class="nav-link" href="chatPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">O-Consultation</label></a></h3>
          </li>
          <li class="nav-item">
          <h3><a class="nav-link active" href="trackerPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-archive-fill me-2" style="color: white;"></i>
            <label class="float-end text-white"><strong><u>Health Tracker</u></strong></label></a></h3>
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
<div class="col">
    <div class="row m-2 p-2 rounded" style="background-color: #81C784;">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="m-2 input-group">
                <label class="input-group-text">Pet Type</label>
                <select id="type" onchange="typeSelect()" name="type" class="form-control form-select" aria-label="SelectPetType">
                  <?php
                      $pet = "SELECT pettype FROM alagapp_db.tbl_symptom GROUP BY pettype HAVING COUNT(pettype) >= 1";
                      $petlist = $connect->prepare($pet);
                      $petlist->execute();
              
                      if($petlist->rowCount()>0) {
                        $i=1;
                        echo "<option selected>-- Select Pet Type --</option>";
                        while($petrow= $petlist->fetch(PDO::FETCH_ASSOC)){
                          $pettype = $petrow['pettype'];
                          echo "<option value='".$pettype."'>".$pettype."</option>";
                          $i++;
                        }
                      }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
          <div id="bodySelect">
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
          <div id="symptomSelect">
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="m-auto">
                <button type="submit" onclick="getSymptom()" name="submit" class="m-2 p-2 w-100 btn btn-success">Find</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="m-2 p-2 text-center rounded" style="background-color: #4CAF50;">
                <label class="text-white"><strong>Tentative Diagnosis Results</strong></label>
            </div>
            <p class="text-center">These information are tentative only. Consult your Veterinarian to free your worries :)</p>
            <div id="ContentHere">
            </div>
        </div>
    </div>
</div>
  </main>
  <script>
    function typeSelect(){
      var type = document.getElementById("type").value;
      const xhttp = new XMLHttpRequest();
      console.log(type);
      xhttp.onload = function() {
          document.getElementById("bodySelect").innerHTML = this.responseText;
        }
      xhttp.open("GET", "api/tracker/body.php?type="+type);
      xhttp.send();
    }
    function bodySelect(){
      var type = document.getElementById("type").value;
      var body = document.getElementById("body").value;
      console.log(type, body);
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
          document.getElementById("symptomSelect").innerHTML = this.responseText;
        }
      xhttp.open("GET", "api/tracker/symptom.php?type="+type+"&body="+body);
      xhttp.send();
    }
  </script>
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