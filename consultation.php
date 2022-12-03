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
<body class="bg bg-warning">
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
<main class="container container-fluid">
  <div class="row">
    <div class="col-3 overflow-auto overflow-y" >
      <ul class="list-group list-group-flush">
        <?php
          require("php/connector.php");

          $sql = "SELECT * FROM alagapp_db.tbl_userlist";
      
          $res = $connect->prepare($sql);
          $res->execute();
      
          $sql2 = "SELECT COUNT(userid) AS entry FROM alagapp_db.tbl_userlist";
          $res2 = $connect->query($sql2);
          $res2->execute();
          $row1 = $res2->fetch(PDO::FETCH_ASSOC);
      
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
    <div class="col-9 position-relative bg bg-light pb-5">
      <label>Select Conversation</label>
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