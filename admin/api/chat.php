<?php
  require("connector.php");


  /*$check = "SELECT * FROM alagapp_db.tbl_admin WHERE adminid = 1 AND session = 1";
$checkSession = $connect->prepare($check);
$checkSession->execute();
if($checkSession->rowCount()>0){
  $wel = $checkSession->fetch(PDO::FETCH_ASSOC);
  
} else {
  echo "<script>window.location='./../index.php'</script>";
}*/

  $id = $_REQUEST['userid'];

  $c = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = '".$id."'";
  $cres = $connect->prepare($c);
  $cres->execute();

  if($cres->rowCount()>0){
    $row = $cres->fetch(PDO::FETCH_ASSOC);
    if($row['userstatus']!=0){
      $status = 0;
      $see = "UPDATE alagapp_db.tbl_userlist SET userstatus = :status WHERE userid = ".$id."";
      $sres = $connect->prepare($see);
      $array = array(":status"=>$status);
      $sres->execute($array);
    }
  }


  if(isset($_POST["submit"])){
    $userid = $_POST["userid"];
    $sender = $_POST["sender"];
    $channel = $_POST["channel"];
    $message = $_POST["message"];
    $date = date("Y-m-d h:i:sa");

    if($userid=="" || $sender=="" || $channel=="" || $message==""){
        echo "<script>window.location='chat.php?userid=".$userid."'</script>";//Invalid
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
            echo "<script>window.location='chat.php?userid=".$userid."'</script>";//Message Sent
         } else {
             echo "<script>window.location='chat.php?userid=".$userid."'</script>";//Unable to send message
         }
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation | AlagApp</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg bg-light">

      <main class="container-fluid">
  <div class="row m-auto">
  <div class="col-2 vh-100 bg bg-success"><!--SideBar-->
          <div class="row m-auto text-center my-3"><!--aa-->
            <a class="nav-link text-white nav-brand" href="#"><h1><b>AlagApp</b></h1></a>
          </div><br>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../dashboard.php"><h5><i class="bi bi-speedometer2"></i> Dashboard</h5></a> 
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../account.php" active><h5><i class="bi bi-person-circle"></i> Account</h5></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="../scheduler.php"><h5><i class="bi bi-calendar"></i> Scheduler</h5></a>
          </div>
          <div class="row m-auto text-center my-3 bg bg-light rounded p-2">
            <a class="nav-link text-success" href="../consultation.php"><h4><i class="bi bi-chat"></i> O-Consultation</h4></a>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          <div class="row m-auto text-center my-3 float-bottom">
          <a class="nav-link text-white" href="./adminData/adminProfile.php"><h5>Admin<h5></a>
            <a class="nav-link text-white" href="./../logout.php"><h5>Log Out<h5></a>
          </div><!--aa-->
        </div><!--SideBar-->
    <div class="col-2 pt-2 vh-100 bg bg-light overflow-auto overflow-y">
      <?php include("./chatList.php");?>
    </div>
    <div class="col-8 pt-2 vh-100 overflow-auto overflow-y">
      <?php 
        $id = $_REQUEST['userid'];
        $channel = $id;
        $_account = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$id." ";

        $_result = $connect->prepare($_account);
        $_result->execute();

        if($_result->rowCount()>0){
            $_rowe = $_result->fetch(PDO::FETCH_ASSOC);
            $_fname = $_rowe['userfname'];
            $_lname = $_rowe['userlname'];
        };
      ?>
      <div class="row p-2"><!-- Chat Header -->
        <div class="border border-3 border-success text-success rounded-pill pt-2">
          <img class="ms-2  me-2 rounded-circle" src="../../assets/uploads/<?php echo $_rowe['userpict']; ?>" alt="" style="width: 3rem; height: 3rem;"> 
          <label><h4><?php echo $_rowe['userfname']." ".$_rowe['userlname']; ?></h4></label>
          <?php
            $meet = "SELECT gmeet FROM alagapp_db.tbl_admin WHERE adminid = 1";
            $checklink = $connect->prepare($meet);
            $checklink->execute();
            if($checklink->rowCount()>0){
              $link = $checklink->fetch(PDO::FETCH_ASSOC);
              echo "<a href=".$link['gmeet'].">";
            }
          ?>
          <button class="btn btn-primary-outline float-end"><iconify-icon icon="bi:camera-video-fill" style="color: green;" width="30" height="30"></iconify-icon></button>
          </a>
        </div>
      </div><!-- Chat Header -->
        
      <div class="row p-2 "><!-- Chat Conversation -->
        <div class="m-auto p-2 border border-3 border-success rounded mb-2 ">
            <?php
              $chat = "SELECT * FROM alagapp_db.tbl_chat WHERE mchannel = ".$channel."";

              $reschat = $connect->prepare($chat);
              $reschat->execute();
              if($reschat->rowCount()>0){
                  $j=1;
                  echo "<ul class='list-group'>";
                  while($rowchat = $reschat->fetch(PDO::FETCH_ASSOC)){
                    if($rowchat['msender']!=0){
                      echo "<li class='list-group-item border-0'>
                        <div class='float-start p-3' style='background-color: #E8F5E9; border-radius: 10px;'>
                        <label>Client</label><br>";
                        if($rowchat['mtype'] == "Img"){
                          echo "<img src='../../assets/chat/".$rowchat['mcontent']."' style='width: 15rem; height: auto;'></img><br>";
                        } else {
                          echo "<label>".$rowchat['mcontent']."</label><br>";
                        }
                        echo "<span style='font-size: 12px;'>".$rowchat['mdatetime']."</span>
                        </div>
                        </li>";
                  } else {
                    echo "<li class='list-group-item border-0'>
                        <div class='float-end p-3' style='background-color: #81C784; border-radius: 10px;'>
                        <label>You</label><br>";
                        if($rowchat['mtype'] == "Img"){
                          echo "<img src='../../assets/chat/".$rowchat['mcontent']."' style='width: 15rem; height: auto;'></img><br>";
                        } else {
                          echo "<label>".$rowchat['mcontent']."</label><br>";
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
      </div><!-- Chat Conversation -->
      <!--Modal Upload Image-->
      <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="profileModalLabel">Upload Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="sendImg.php" method="POST" enctype="multipart/form-data">
                      <div class="input-group mb-3">
                        <input type="file" class="form-control col-12 col-sm-12 col-md col-lg col-xl-4" name="fileToUpload" id="fileToUpload">
                        <input type="number" class="form-control" value="<?php echo $id ?>" name="userid" hidden>
                        <input type="number" class="form-control" value="<?php echo $channel ?>" name="mchannel" hidden>
                        <input type="number" class="form-control" value="0" name="msender" hidden>
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
      <!--Modal Upload Image-->
      <div class="row m-auto"><!-- Chat Field -->
          <div class="mb-2 p-2 border border-3 border-success rounded">
            <form method="POST" action="chat.php" class="d-flex gap-2">
                <button class='btn btn-success' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#profileModal'><i class="bi bi-image"></i></button>
                <input type="number" class="form-control" value="<?php echo $id ?>" placeholder="Userid" name="userid" hidden>
                <input type="number" class="form-control" value="<?php echo $channel ?>" placeholder="Channel" name="channel" hidden>
                <input type="number" class="form-control" value="0" placeholder="Sender" name="sender" hidden>
                <input type="text" class="form-control me-2" name="message" placeholder="Enter Message">
                <button class="btn btn-success" type="submit" name="submit"><i class="bi bi-send-fill"></i></button>
            </form>
          </div>
      </div><!-- Chat Field -->
    </div>
  </div>
</main>
<!-- Main Functions -->
<script> src="../js/main.js"</script>
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

<script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</body>
</html>