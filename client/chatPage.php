<?php
    require("api/_connector.php");
   
    $user = $_REQUEST["userid"];
    session_start();
    if($_SESSION["newsession"] !=  $user+date("Ymd")){
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
          $status = $acc['userstatus'];
        }

        if(isset($_POST["submit"])){
            $userid = $_POST["userid"];
            $sender = $_POST["sender"];
            $channel = $_POST["channel"];
            $message = $_POST["message"];
            $date = date("Y-m-d h:i:sa");
        
            if($userid=="" || $sender=="" || $channel=="" || $message==""){
                echo "<script>window.location='chatPage.php?userid=".$user."'</script>";//Invalid
            } else {
                $sql = "INSERT INTO alagapp_db.tbl_chat(
                    userid,
                    mchannel,
                    msender,
                    mcontent,
                    mdatetime) VALUES(
                        :userid,
                        :mchannel,
                        :msender,
                        :mcontent,
                        :mdatetime)";
        
                $result = $connect->prepare($sql);
        
                $values = array(
                    ":userid"=>$userid,
                    ":mchannel"=>$channel,
                    ":msender"=>$sender,
                    ":mcontent"=>$message,
                    ":mdatetime"=>$date
                );
        
                $result->execute($values);
        
                if($result->rowCount()>0) {

                    if($status!=1){
                      $status = 1;
                      $see = "UPDATE alagapp_db.tbl_userlist SET userstatus = :status WHERE userid = ".$user."";
                      $sres = $connect->prepare($see);
                      $array = array(":status"=>$status);
                      $sres->execute($array);
                      if($sres->rowCount()>0){
                        echo "<script>window.location='chatPage.php?userid=".$user."'</script>";//Message Sent
                      }
                    }
                 } else {
                     echo "<script>window.location='chatPage.php?userid=".$user."'</script>";//Message not sent
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
        <div class="col-4 p-2 text-center" style="background-color: #81C784;">
            <a class="nav-link active text-white" href="chatPage.php?userid=<?php echo $user;?>"><strong>Chat</strong></a>
        </div>
        <div class="col-4 p-2 text-center" id="videoCall" style="background-color: #A5D6A7;">
          <a class="nav-link" href="callPage.php?userid=<?php echo $user;?>">Call</a>
        </div>
        <div class="col-4 p-2 text-center" style="background-color: #A5D6A7;">
            <a class="nav-link" href="schedPage.php?userid=<?php echo $user;?>">Scheduler</a>
        </div>
    </div>
<div class="container">
    <div class="row">
        <div class="m-auto p-2 rounded">
          <?php
            $id = $user;
            $channel = $id;
            $chat = "SELECT * FROM alagapp_db.tbl_chat WHERE mchannel = ".$channel."";

            $reschat = $connect->prepare($chat);
            $reschat->execute();
            if($reschat->rowCount()>0){
                $j=1;
                echo "<ul class='list-group'>";
                while($rowchat = $reschat->fetch(PDO::FETCH_ASSOC)){
                  if($rowchat['msender']==0){
                    echo "<li class='list-group-item border-0'>
                      <div class='float-start p-3' style='background-color: #E8F5E9; border-radius: 10px;'>
                      <label style='font-size: 12px;'>Vet</label><br>";
                      if($rowchat['mtype'] == "Img"){
                        echo "<img src='../assets/chat/".$rowchat['mcontent']."' style='width: 15rem; height: auto;'></img><br>";
                      } else {
                        echo "<label style='font-size: 16px;'>".$rowchat['mcontent']."</label><br>";
                      }
                      echo "<span style='font-size: 12px;'>".$rowchat['mdatetime']."</span>
                      </div>
                      </li>";
                    } else {
                    echo "<li class='list-group-item border-0'>
                        <div class='float-end p-3' style='background-color: #81C784; border-radius: 10px;'>
                        <label style='font-size: 12px;'>You</label><br>";
                        if($rowchat['mtype'] == "Img"){
                          echo "<img src='../assets/chat/".$rowchat['mcontent']."' style='width: 15rem; height: auto;'></img><br>";
                        } else {
                          echo "<label style='font-size: 16px;'>".$rowchat['mcontent']."</label><br>";
                        }
                        echo "<span style='font-size: 12px;'>".$rowchat['mdatetime']."</span>
                        </div>    
                        </li>"; 
                    }
                    $j++;
                }
                echo "</ul>";
            }
          ?>
        </div>
    </div>
    <!--Modal Image User Upload-->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="profileModalLabel">Upload Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="api/sendImg.php" method="POST" enctype="multipart/form-data">
                      <div class="input-group mb-3">
                        <input type="file" max-size="250000" class="form-control col-12 col-sm-12 col-md col-lg col-xl-4" name="fileToUpload" id="fileToUpload">
                        <input type="number" class="form-control" value="<?php echo $id ?>" name="userid" hidden>
                        <input type="number" class="form-control" value="<?php echo $channel ?>" name="mchannel" hidden>
                        <input type="number" class="form-control" value="<?php echo $user ?>" name="msender" hidden>
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
    <!--Modal Image User Upload-->
        <div class="row m-auto">
            <div class="mb-2 p-2 bg bg-success rounded">
                <form method="POST" action="chatPage.php" class="d-flex gap-2">
                <button class='btn btn-light' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#profileModal'><i class="bi bi-image" style="color: green;"></i></button>
                      
                    <input type="number" class="form-control" value="<?php echo $id ?>" placeholder="Userid" name="userid" hidden>
                    <input type="number" class="form-control" value="<?php echo $channel ?>" placeholder="Channel" name="channel" hidden>
                    <input type="number" class="form-control" value="<?php echo $user ?>" placeholder="Sender" name="sender" hidden>
                    <input type="text" class="form-control me-2" name="message" placeholder="Enter Message">
                    <button class="btn btn-light text-success fw-bold" type="submit" name="submit">Send</button>
                </form>
            </div>
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

<script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</body>
</html>