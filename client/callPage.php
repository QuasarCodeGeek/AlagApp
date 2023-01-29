<?php
    require("api/_connector.php");
    $user = $_REQUEST["userid"];

    session_start();
    $set = md5(strval($user));
    $_SESSION["newsession"] = $user.$set;
    if($_SESSION["newsession"] != $_SESSION["setsession"] ){
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

        if(isset($_POST["submit"])){
            $channel = $user;
            $date = date("Y-m-d h:i:sa");
        
            if($user=="" || $channel=="" || $date==""){
                echo "<script>window.location='chatPage.php?userid=".$user."'</script>";//Invalid
            } else {
                $sql = "INSERT INTO alagapp_db.tbl_call(
                    userid,
                    vchannel,
                    vdatetime) VALUES(
                        :userid,
                        :vchannel,
                        :vdatetime)";
        
                $result = $connect->prepare($sql);
        
                $values = array(
                    ":userid"=>$user,
                    ":vchannel"=>$channel,
                    ":vdatetime"=>$date
                );
        
                $result->execute($values);
                if($result->rowCount()>0) {
                
                  $meet = "SELECT gmeet FROM alagapp_db.tbl_admin WHERE adminid = 1";
                  $checklink = $connect->prepare($meet);
                  $checklink->execute();
                    if($checklink->rowCount()>0){
                      $link = $checklink->fetch(PDO::FETCH_ASSOC);
                      echo "<script>window.open('".$link['gmeet']."')</script>";
                    }
                 } else {
                     echo "<script>window.location='callPage?userid=".$user."'</script>";//Unable to Initiate Call
                 }
            }
        }
?>
<!doctype html>
<html lang="en">

<head>
  <title>Chat</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="./../bootstrap-5.2.2-dist/css/bootstrap.css" rel="stylesheet">
    <script src="./../bootstrap-5.2.2-dist/js/bootstrap.js"></script>
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
    <h1 class="text-white"><b>AlagApp</b></h1>
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
          <h3><a class="nav-link active" href="chatPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white"><strong><u>O-Consultation</u></strong></label></a></h3>
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
        <div class="col-4 p-2 text-center" style="background-color: #A5D6A7;">
            <a class="nav-link active" href="chatPage.php?userid=<?php echo $user;?>">Chat</a>
        </div>
        <div class="col-4 p-2 text-center " id="videoCall" style="background-color: #81C784;">
          <a class="nav-link text-white" href="#"><strong>Call</strong></a>
        </div>
        <div class="col-4 p-2 text-center" style="background-color: #A5D6A7;">
            <a class="nav-link" href="schedPage.php?userid=<?php echo $user;?>">Scheduler</a>
        </div>
    </div>
<div class="container">
    <div class="row m-auto p-2">
        <form action="callPage.php" method="POST">
            <input type="text" value="<?php echo $user; ?>" name="userid" hidden>
            <button class="btn btn-success w-100" type="submit" name="submit">Join Meeting</button>
        </form>
    </div>
    <div class="row m-auto p-2 text-center">
        <label class="fw-bold">Call Logs</label>
    </div>
    <div class="row m-auto"><div class="bg bg-light rounded p-2">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Date and Time</th>
                </tr>
            </thead>
            <tbody>
        <?php
            $call = "SELECT * FROM alagapp_db.tbl_call WHERE userid = ".$user." ORDER BY vid DESC";
            $checkcall = $connect->prepare($call);
            $checkcall->execute();
    
            if($checkcall->rowCount()>0) {
                $x=1;
                while($crow = $checkcall->fetch(PDO::FETCH_ASSOC)){
                   echo "<tr><td>".$x."</td>
                   <td>".date("M d, Y - h:i a",strtotime($crow['vdatetime']))."</td></tr>"; 
                  $x++;
                }
            }
        ?>
            </tbody>
        </table>
    </div></div>
</div>
  </main>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

<script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</body>
</html>