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

          $pict = $acc['userpict'];

          $fname = $acc['userfname'];
          $mname = $acc['usermname'];
          $lname = $acc['userlname'];

          $bdate = $acc['userbdate'];
          $sex = $acc['usergender'];

          $address1 = $street = $acc['userstreet']." ".$district = $acc['userdistrict'];
          $address2 = $municipality = $acc['usermunicipality']." ".$province = $acc['userprovince'];

          $email = $acc['useremail'];
          $pass = $acc['userpassword'];

          $mobile = $acc['usermobile'];
        }
?>
<!doctype html>
<html lang="en">

<head>
  <title>User</title>
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
            <h3><a class="nav-link acite" href="userPage.php?userid=<?php echo $user; ?>">
                    <?php 
                        if($pict!=''){
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/uploads/".$pict."'>";
                        } else if ($sex=='F') {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/default/female.png'>";
                        } else {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/default/male.png'>";
                        }
                    
                    echo "<label class='float-end text-white'><strong><u>".$fname."</u></strong></label>"; ?>
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

<div class="row">
    <div class="col"><!-- Pet Profile -->
        <div class="m-2 p-2">
            <?php
                    echo "
                    <div class='card m-2 p-3' style='background-color:#E8F5E9;'>
                      <div class='row p-2'>
                        <div class='col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3'>";
                            if($pict!=''){
                                echo "<img class='mb-2  d-block mx-auto rounded' style='width: 18rem; max-height: 20rem;' src='../assets/uploads/".$pict."' alt='userProfile'>";
                            } else if ($sex=='F') {
                                echo "<img class='mb-2  d-block mx-auto rounded' style='width: 18rem; max-height: 20rem;' src='../assets/default/female.png' alt='userProfile'>";
                            } else {
                                echo "<img class='mb-2  d-block mx-auto rounded' style='width: 18rem; max-height: 20rem;' src='../assets/default/male.png' alt='userProfile'>";
                            }
                            echo "
                        </div>
                        <div class='p-2 col-12 col-sm-12 col-md-7 col-lg-8 col-xl-9 rounded bg bg-light h-100'>
                          <div class='p-2'>
                                <div class='col mb-1'>
                                    <label>Name: ".$fname." ".$mname." ".$lname."</label>
                                </div>
                                <div class='col mb-1'>
                                    <label>Gender: ".$sex."</label>
                                </div> 
                                <div clas='col mb-1'>
                                    <label>B-Day: ".$bdate."</label>
                                </div>
                                <div class='col mb-1'>
                                    <label>Address: ".$address1." ".$address2."</label>
                                </div>
                                <div class='col mb-2'>
                                    <label>Mobile No.: ".$mobile."</label>
                                </div>
                                <div class='col mb-2'>
                                    <label>Email: ".$email."</label>
                                </div>";
                                ?>
                                <div class="col row mt-5">
                                  <div class='col-6 mb-2'>
                                      <button class='btn btn-warning w-100' onclick="window.location='api/editProfile.php?userid=<?php echo $user; ?>'">Edit</button>
                                  </div>
                                  <div class='col-6'>
                                      <button class='btn btn-danger w-100' type="submit name="logout" onclick="window.location='api/logout.php?userid=<?php echo $user;?>'">Log Out</button>
                                  </div>
                                </div>
                          <?php echo "
                          </div>      
                        </div>
                      </div>
                    </div>";
            ?>
        </div>
    </div>
</div>

  </main>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>