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
  <title>About Us</title>
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
          <h3><a class="nav-link" href="trackerPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-archive-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">Health Tracker</label></a></h3>
          </li>
          <li class="nav-item">
          <h3><a class="nav-link active" href="aboutUs.php?userid=<?php echo $user; ?>">
            <i class="bi bi-info-circle-fill me-2" style="color: white;"></i>
            <label class="float-end text-white"><strong>About Us</strong></label></a></h3>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<main class="container container-fluid">
  <div class="m-2">
    <div class="card card-body bg bg-light">
      <label>To be Added</label>
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