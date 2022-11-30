<?php
  require("connector.php");
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
<body class="bg bg-warning">
<main class=" row container container-fluid">
  <div class="col-2 bg bg-success">
    <ul class="list-goup mb-2 mb-lg-0">
      <li class="list-group-item">
        <a class="text-white" href="../account.php">Account</a>
      </li>
      <li class="list-group-item">
        <a class="text-white" href="../scheduler.php">Scheduler</a>
      </li>
      <li class="list-group-item">
        <a class="text-white" href="../consultation.php" active><strong>Consultation</strong></a>
      </li>
      <li class="list-group-item">
        <a class="text-white" href="../dashboard.php">Dashboard</a>
      </li>
    </ul>
  </div>
    <div class="col-3 overflow-auto overflow-y vh-100">
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
                    <a type='button' class='btn' href='chat.php?userid=".$row['userid']."'>
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
    <div class="col-7 position-relative bg bg-light">
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
      <div class="row position overflow-auto overflow-y vh-100">
        <div class="row bg bg-success" style="--bs-bg-opacity: .5">
            <label class="col m-auto"><?php echo $_rowe['userfname']." ".$_rowe['userlname']; ?></label>
              <button type="button" class="col btn">
                <i class="bi bi-telephone-fill float-end"></i>
              </button>
        </div>
        <div class="row">
          <?php
            $chat = "SELECT * FROM alagapp_db.tbl_chat WHERE mchannel = ".$channel."";

            $reschat = $connect->prepare($chat);
            $reschat->execute();
            if($reschat->rowCount()>0){
                $j=1;
                echo "<ul class='list-group list-group-flush'>";
                while($rowchat = $reschat->fetch(PDO::FETCH_ASSOC)){
                  if($rowchat['msender']!=0){
                    echo "<li class='list-group-item border-0'>
                      <div class='float-start p-3' style='background-color: #E8F5E9;'>
                      <label>Vet</label><br>
                      <label>".$rowchat['mdatetime']."</label><br>
                      <label>".$rowchat['mcontent']."</label>
                      </div>
                      </li>";
                } else {
                  echo "<li class='list-group-item border-0'>
                      <div class='float-end p-3' style='background-color: #81C784 ;'>
                      <label>You</label><br>
                      <label>".$rowchat['mdatetime']."</label><br>
                      <label>".$rowchat['mcontent']."</label>
                      </div>    
                      </li>"; 
                }
                    $j++;
                }
                echo "</ul>";
            }
          ?>
        </div>
        <div class="row bg bg-success w-100 m-2">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="message" placeholder="Search" aria-label="Search">
            <button class="btn btn-light" type="submit">Send</button>
          </form>
        </div>
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
</body>
</html>