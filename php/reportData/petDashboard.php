<?php
    include ("../dataAnalytics.php");
    $petdata = "SELECT COUNT(petid) AS count FROM alagapp_db.tbl_petprofile";
    $resdata = $connect->query($petdata);
    $resdata->execute();
    $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | AlagApps</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="node_modules/bootstrap/dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body class="bg bg-success">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="row collapse navbar-collapse mx-auto" id="navbarSupportedContent">
            <div class="col text-center">
              <a class="nav-link" href="../../account.php">Account</a>
            </div>
            <div class="col text-center">
            <a class="nav-link" href="../../scheduler.php">Scheduler</a>
            </div>
            <div class="col text-center">
              <a class="navbar-brand" href="../../index.html"><strong>AlagApp</strong></a>
            </div>
            <div class="col text-center">
              <a class="nav-link" href="../../consultation.php">Consultation</a>
            </div>
            <div class="col text-center border-bottom border-success border-5">
              <a class="nav-link text-success" href="../../dashboard.php" active><strong>Dashboard</strong></a> 
            </div>
          </div>
        </div>
      </nav>
      <main class="container container-fluid" style="background-color: #E0E0E0;">
                    <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">New Record</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body d-grid gap-2 container-fluid" id="modalNew">
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
                          <div class="modal-body d-grid gap-2 container-fluid" id="modalHere">
                          </div>
                        </div>
                      </div>
                    </div>

          <div class="row">
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="../../dashboard.php">Main</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="userDashboard.php">User List</a>
            </div>
            <div class="col text-center p-1 bg bg-success">
              <a type="button" class="text-white nav-link" href="petDashboard.php"><strong>Pet List</strong></a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="cardDashboard.php">Vaccine Card</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="noteDashboard.php">Prescription Note</a>
            </div>
            <div class="col text-center p-1"  style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="vaccineDashboard.php">Vaccine List</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="symptomDashboard.php">Symptoms Diagnosis</a>
            </div>
          </div>
          
    <div class="row bg bg-light rounded m-2 p-2"><!-- Pet List -->
      <div class="row">
        <div class="col">
          <h3>Pet List</h3>
          <label>Number of Pets: <?php echo $rowdata['count'];?></label>
        </div>
        <div class="col">
          <button class="btn btn-success float-end">Print Data</button>
        </div>
      </div>
      <div class="row">
      <table class="table table-striped m-2">
        <thead class="bg bg-success text-white">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Owner</th>
            <th>Specie</th>
            <th>Breed</th>
            <th>Wt(Kg)</th>
            <th>Ht(M)</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Gender</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $pet = "SELECT alagapp_db.tbl_petprofile.*, alagapp_db.tbl_userlist.userfname, alagapp_db.tbl_userlist.userlname
          FROM (alagapp_db.tbl_petprofile
          INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_petprofile.userid = alagapp_db.tbl_userlist.userid)";
          $respet = $connect->query($pet);
          $respet->execute();
          if($respet->rowCount()>0){
            $i=1;
            while($rowpet = $respet->fetch(PDO::FETCH_ASSOC)){

              echo "<tr>
              <td>".$i."</td>
              <td>".$rowpet['petname']."</td>
              <td>".$rowpet['userfname']." ".$rowpet['userlname']."</td>
              <td>".$rowpet['pettype']."</td>
              <td>".$rowpet['petbreed']."</td>
              <td>".$rowpet['petweight']."</td>
              <td>".$rowpet['petheight']."</td>
              <td>".$rowpet['petbdate']."</td>
              <td>".$rowpet['petage']."</td>
              <td>".$rowpet['petgender']."</td>
            </tr>";
            $i++;
            }
          }
        ?>
        </tbody>
      </table>
      </div>
    </div><br>
  </main>

<!-- Main Functions -->
<script src="../../js/main.js"></script>
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
<!-- Chart JS Library -->
</body>
</html>