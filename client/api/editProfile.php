<?php
    require("api/_connector.php");
    $user = $_REQUEST["userid"];

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
                    
                    echo "<label class='float-end text-white'><b>".$fname."</b></label>"; ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="homePage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-house-fill me-2" style="color: white;"></i>
            <label class="float-end text-white"><strong>Home</strong></label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="chatPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">O-Consultation</label></a>
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
    <div class="col"><!-- Pet Profile -->
        <div class="m-2 p-2">
            <?php
                    echo "
                    <div class='card m-2 p-3' style='background-color:#E8F5E9;'>
                      <div class='row p-2'>
                        <div class='col-12 col-sm-12 col-md col-lg col-xl-4'>";
                            if($pict!=''){
                                echo "<img class='m-auto mb-2 rounded' style='width: 16rem; margin-left: auto; margin-right: auto;' src='../assets/uploads/".$pict."' alt='userProfile'>";
                            } else if ($sex=='F') {
                                echo "<img class='m-auto mb-2 rounded' style='width: 16rem; margin-left: auto; margin-right: auto;' src='../assets/default/female.png' alt='userProfile'>";
                            } else {
                                echo "<img class='m-auto mb-2 rounded' style='width: 16rem; margin-left: auto; margin-right: auto;' src='../assets/default/male.png' alt='userProfile'>";
                            }
                            echo "</div>
                        <div class='p-2 col col-sm col-md col-lg col-xl rounded bg bg-light'>
                          <div class='p-2'>
                                <div class='col input-group'>
                                    <label class='input-group-text'>Name</label>
                                    <input type='text' class='form-control' placeholder=\"Name\" value='".$fname." ".$mname." ".$lname."' readonly>
                                </div><br>
                                <div class='col input-group'>
                                    <label class='input-group-text'>B-Day</label>
                                    <input type='date' class='form-control' value='".$bdate."' readonly>
                                </div><br>
                                <div class='col input-group'>
                                    <label class='input-group-text'>Gender</label>
                                    <input type='text' class='form-control' value='".$sex."' readonly>
                                </div><br>
                                <div class='col input-group'>
                                    <label class='input-group-text'>Address</label>
                                    <input type='text' class='form-control' value='".$address1." ".$address2."' readonly>
                                </div><br>
                                <div class='col input-group'>
                                    <label class='input-group-text'>Email</label>
                                    <input type='text' class='form-control' placeholder=\"name@example.com\"  value='".$email."' readonly>
                                </div>
                                <div class='col input-group'>
                                    <label class='input-group-text'>Password</label>
                                    <input type='password' class='form-control' placeholder=\"Enter Password\"  value='".$pass."' required readonly>
                                </div>
                                <div>
                                    <button class='btn btn-success'>Update</button>
                                </div>
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