<?php
  require("php/connector.php");

  if(isset($_POST["submit"])){
    $userid = $_POST["userid"];
    $sender = $_POST["sender"];
    $channel = $_POST["channel"];
    $message = $_POST["message"];
    $date = date("Y-m-d h:i:sa");

    if($userid=="" || $sender=="" || $channel=="" || $message==""){
        echo "<script>alert('Invalid!');
        window.location='chat.php?userid=".$userid."'</script>";
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
            echo "<script>alert('Message Sent!');
            window.location='chat.php?userid=".$userid."'</script>";
         } else {
             echo "<script>alert('Unable to send message!');
             window.location='chat.php?userid=".$userid."'</script>";
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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg bg-success">
<nav class="navbar navbar-expand-lg bg-light">
        <div class="container container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="row collapse navbar-collapse mx-auto" id="navbarSupportedContent">
            <div class="col text-center">
              <a class="nav-link" href="account.php">Account</a>
            </div>
            <div class="col text-center">
            <a class="nav-link" href="scheduler.php">Scheduler</a>
            </div>
            <div class="col text-center">
              <a class="navbar-brand" href="index.html"><strong>AlagApp</strong></a>
            </div>
            <div class="col text-center border-bottom border-success border-5">
              <a class="nav-link" href="consultation.php" active><strong>Consultation</strong></a>
            </div>
            <div class="col text-center">
              <a class="nav-link text-success" href="dashboard.php">Dashboard</a> 
            </div>
          </div>
        </div>
      </nav>
<main class="container-fluid">
  <div class="row bg bg-light">
    <div class="col-2">
      <ul class="list-group list-group-flush">
        <?php
            $sql = "SELECT * FROM alagapp_db.tbl_userlist";
        
            $res = $connect->prepare($sql);
            $res->execute();
        
            if($res->rowCount()>0){
                $i=1;
                while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    echo "
                    <li class='list-group-item bg bg-light'>
                    <a type='button' class='btn' href='php/chat.php?userid=".$row['userid']."'>
                    <label class='text-wrap'>".$row['userfname']." ".$row['userlname']."</label>
                    </a>
                    </li>";
                    $i++;
                }
            } else {
                echo "Nothing follows";
            }
        ?>
      </ul>
    </div>
    <div class="col-10">
      <?php 
        $id = 1;
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
      <div class="">
        <div class="row m-2 p-2 bg bg-success text-white rounded">
            <label><strong><?php echo $_rowe['userfname']." ".$_rowe['userlname']; ?></strong></label>
        </div>
        <div class="row m-2 p-2 rounded">
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
                      <label>Client</label><br>
                      <label>".$rowchat['mcontent']."</label><br>
                      <span style='font-size: 12px;'>".$rowchat['mdatetime']."</span>
                      </div>
                      </li>";
                } else {
                  echo "<li class='list-group-item border-0'>
                      <div class='float-end p-3' style='background-color: #81C784; border-radius: 10px;'>
                      <label>You</label><br>
                      <label>".$rowchat['mcontent']."</label><br>
                      <span style='font-size: 12px;'>".$rowchat['mdatetime']."</span>
                      </div>    
                      </li>"; 
                }
                    $j++;
                }
                echo "</ul>";
            }
          ?>
        </div>
        <div class="row m-2 p-2 bg bg-success rounded">
          <form method="POST" action="chat.php" class="d-flex">
              <input type="number" class="form-control" value="<?php echo $id ?>" placeholder="Userid" name="userid" hidden>
              <input type="number" class="form-control" value="<?php echo $channel ?>" placeholder="Channel" name="channel" hidden>
              <input type="number" class="form-control" value="0" placeholder="Sender" name="sender" hidden>
                <input type="text" class="form-control me-2 d-flex" name="message" placeholder="Enter Message">
                <button class="btn btn-light" type="submit" name="submit">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- Main Functions -->
<script> src="js/main.js"</script>
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
</body>
</html>