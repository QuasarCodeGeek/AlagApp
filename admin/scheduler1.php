<?php
  include("sidebar.php");
?>

    <div class="main-content">
        
        <header>
         
                
                <div class="header-menu">
                    <label for="">
                      
                        <span>User Profile</span>
                    </label>
                    
                  
        </header>
        
        
        <main>        
            <div class="page-content">
                    
            <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="ModalLabel">New Record</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-grid gap-2 container-fluid" id="schedNew">
                              Content Here
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="modal fade" id="boxModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="ModalLabel">Edit Data</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-grid gap-2 container-fluid" id="schedHere">
                              Content Edit Here No Record Retrieved
                            </div>
                          </div>
                        </div>
                        </div>

        <div class="row">
          <div class="col text-center bg bg-success">
              <a class="nav-link text-white p-2" type="button" href="scheduler1.php"><strong>Account</strong></a>
          </div>
          <div class="col text-center bg bg-light">
              <a class="nav-link p-2" type="button" href="php/sched_chrono1.php"><strong>Status</strong></a>
          </div>
        </div>
        <div class="row">
              <div class="col-3 container p-2 bg bg-light">
                <div class="row m-1 overflow-x overflow-auto">
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
                                  <a type='button' class='btn w-100 text-start' href='php/sched_profile.php?userid=".$row['userid']."'>
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
            </div>
            <div class="col-9 container bg bg-light pt-2 pb-5">
            <?php
                  $sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_petprofile.petname
                  FROM ((alagapp_db.tbl_scheduler
                  INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
                  INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)";
              
                  $res = $connect->prepare($sql);
                  $res->execute();
              ?>
              <div class="container row">
              <?php 
          
              if($res->rowCount()>0){
                  $i=1;
                  while($row = $res->fetch(PDO::FETCH_ASSOC)){
                  echo
                  "<div class='card m-1 p-1 col-flex' style='width: 11rem;'>
                      <div class='card-body'>
                        <button type='button' class='btn btn-success w-100' onClick='scheduleEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$row['petname']."</h6></button><br>
                          <label class='card-text' style='font-size: 12px;'>Owner: ".$row['userfname']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Description: ".$row['qdescription']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Date Issued: ".$row['qdate']."</label><br>
                          <label class='card-text' style='font-size: 12px;'>Status: ".$row['qstatus']."</label>
                      </div>
                  </div>";
                  $i++;
                  }
              }  else {
                  echo "
                  </div>";
              }
                ?>
            </div>
            </div>
        </div>
      </main>

<!-- Main Functions -->
<script src="js/main.js"></script>
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
            </div>

            
        </main>
    
</body>

</html>