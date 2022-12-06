<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="account1.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
</head>
<body>
   <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3><span>Alagapp</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(img/3.jpeg)"></div>
                <h4>Alagapp</h4>
                
            </div>

            <div class="side-menu">
                <ul>
                    <li>
                       <a href="account1.php" class="active">
                            <span class="las la-home"></span>
                            <small>Account</small>
                        </a>
                    </li>
                    <li>
                       <a href="scheduler1.php">
                            <span class="las la-user-alt"></span>
                            <small>Scheduler</small>
                        </a>
                    </li>
                    <li>
                       <a href="dashboard.php">
                            <span class="las la-envelope"></span>
                            <small>Dashboard</small>
                        </a>
                    </li>
                    <li>
                       <a href="consultation1.php">
                            <span class="las la-clipboard-list"></span>
                            <small>Consultation</small>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        
        <header>
         
                
                <div class="header-menu">
                    <label for="">
                      
                        <span>User Profile</span>
                    </label>
                    
                  
        </header>
        
        
        <main>
            
            <div class="page-header">
                <h1>Alagapp</h1>
                <h2>Veterinary Clinic Pet Monitoring and Online Consultation System</h2>
            </div>
            
            <div class="page-content">
            
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

            
        </main>
    
</body>

</html>