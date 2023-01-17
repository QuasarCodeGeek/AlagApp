<?php
    require("_connector.php");
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

          $pict = $acc['userpict'];

          $fname = $acc['userfname'];
          $mname = $acc['usermname'];
          $lname = $acc['userlname'];

          $bdate = $acc['userbdate'];
          $sex = $acc['usergender'];

          $street = $acc['userstreet'];
          $district = $acc['userdistrict'];
          $municipality = $acc['usermunicipality'];
          $province = $acc['userprovince'];

          $email = $acc['useremail'];
          $pass = $acc['userpassword'];
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
    <a class="navbar-brand text-white" href="#"><h1><b>AlagApp</b></h1></a>   
    <div class="offcanvas offcanvas-start w-75" style="background-color: #81C784;" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header bg bg-success">
        <h2 class="offcanvas-title text-white" id="offcanvasNavbarLabel">Menu</h2>
        <h3><button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button></h3>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav flex-grow-1 pe-3">
          <li class="nav-item">
            <h3><a class="nav-link active" href="../userPage.php?userid=<?php echo $user; ?>">
                    <?php 
                        if($pict!=''){
                            echo "<img class='rounded me-2' style='width: 25px;' src='../../assets/uploads/".$pict."'>";
                        } else if ($sex=='F') {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../../assets/default/female.png'>";
                        } else {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../../assets/default/male.png'>";
                        }
                    
                    echo "<label class='float-end text-white'><strong>".$fname."</strong></label>"; ?>
            </a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link" aria-current="page" href="../homePage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-house-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">Home</label></a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link" href="../chatPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">O-Consultation</label></a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link" href="../trackerPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-archive-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">Health Tracker</label></a></h3>
          </li>
          <li class="nav-item">
            <h3><a class="nav-link" href="../aboutUs.php?userid=<?php echo $user; ?>">
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
            <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="profileModalLabel">Upload Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                      <div class="input-group mb-3">
                        <input type="file" class="form-control col-12 col-sm-12 col-md col-lg col-xl-4" name="fileToUpload" id="fileToUpload">
                        <input type="number" class="form-controlclass="form-control" name="userid" value="<?php echo $user; ?>" hidden>
                      </div>
                      <div class="row">
                        <button type="button" class="col m-1 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" value="Upload Image" name="submit" class="col m-1 btn btn-primary">Upload</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php
                    echo "
                    <div class='card m-2 p-3' style='background-color:#E8F5E9;'>
                      <div class='row p-2'>
                        <div class='col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3'>";
                            if($pict!=''){
                                echo "<img class='mx-auto d-block mb-2 rounded' style='width: 23rem; max-height: 23rem; margin-left: auto; margin-right: auto;' src='../../assets/uploads/".$pict."' alt='userProfile'>";
                            } else if ($sex=='F') {
                                echo "<img class='mx-auto d-block mb-2 rounded' style='width: 23rem; max-height: 23rem; margin-left: auto; margin-right: auto;' src='../../assets/default/female.png' alt='userProfile'>";
                            } else {
                                echo "<img class='mx-auto d-block mb-2 rounded' style='width: 23rem; max-height: 23rem; margin-left: auto; margin-right: auto;' src='../../assets/default/male.png' alt='userProfile'>";
                            }
                            echo "
                            <div class='row m-2 mx-auto d-block'>
                              <button class='btn rounded bg bg-success text-white' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#profileModal'><i class='bi bi-pencil-square'></i> Change Profile</button>
                            </div>
                        </div>
                        <div class='p-2 col-12 col-sm-12 col-md-7 col-lg-8 col-xl-9 rounded bg bg-light'>
                          <div class='p-2'>
                              <form action='updateProfile.php' method='POST'>
                                <div class='col mb-2'>
                                    <label class='form-label'>Name</label>
                                    <input type='number' class='form-control' name='userid' value='".$user."' hidden>
                                    <input type='text' class='form-control col-12 col-sm-12 col-md col-lg col-xl-4' name='fname' placeholder=\"First name\" value='".$fname."'><br>
                                    <input type='text' class='form-control col-12 col-sm-12 col-md col-lg col-xl-4' name='mname' placeholder=\"Middle Name\" value='".$mname."'><br>
                                    <input type='text' class='form-control col-12 col-sm-12 col-md col-lg col-xl-4' name='lname' placeholder=\"Surname\" value='".$lname."'>
                                </div><br>
                                <div class='col mb-2'>
                                    <label class='form-label'>B-Day</label>
                                    <input type='date' class='form-control' name='bdate' value='".$bdate."'>
                                </div><br>
                                <div class='col mb-2'>
                                    <label class='form-label'>Gender</label>
                                    <input type='char' class='form-control' name='sex' placeholder=\"Enter M or F\" value='".$sex."'>
                                </div><br>
                                <div class='col mb-2'>
                                    <label class='form-label'>Address</label>
                                    <input type='text' class='form-control col-12 col-sm-12 col-md col-lg col-xl-4' name='street' placeholder=\"Street\" value='".$street."'><br>
                                    <input type='text' class='form-control col-12 col-sm-12 col-md col-lg col-xl-4' name='district' placeholder=\"Baranggay\" value='".$district."'><br>
                                    <input type='text' class='form-control col-12 col-sm-12 col-md col-lg col-xl-4' name='municipality' placeholder=\"Municipality\" value='".$municipality."'><br>
                                    <input type='text' class='form-control col-12 col-sm-12 col-md col-lg col-xl-4' name='province' placeholder=\"Province\" value='".$province."'>
                                </div><br>
                                <div class='col mb-2'>
                                    <label class='form-label'>Email</label>
                                    <input type='text' class='form-control' name='email' placeholder=\"name@example.com\"  value='".$email."'>
                                </div><br>
                                <div class='col mb-2'>
                                    <label class='form-label'>Password</label>
                                    <input type='password' class='form-control' name='password' placeholder=\"Enter Password\"  value='".$pass."'>
                                </div><br>
                                <div>
                                  <button type='submit' value='Update' name='submit' class='col btn btn-success w-100'>Update</button>
                                </div>
                              </form>
                          </div> 
                        </div     
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