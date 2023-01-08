<?php
  include ("api/dataAnalytics.php");
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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg bg-light">
  <main class="container-fluid"><div class="row m-auto">
    <div class="col-2 vh-100 bg bg-success">
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white nav-brand" href="#"><h1><b>AlagApp</b></h1></a>
          </div><br>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-success bg bg-light rounded p-2" href="dashboard.php" active><h4><i class="bi bi-speedometer2"></i> Dashboard</h4></a> 
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="account.php"><h5><i class="bi bi-person-circle"></i> Account</h5></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="scheduler.php"><h5><i class="bi bi-calendar"></i> Scheduler</h5></a>
          </div>
          <div class="row m-auto text-center my-3">
            <a class="nav-link text-white" href="consultation.php"><h5><i class="bi bi-chat"></i> O-Consultation</h5></a>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          <div class="row m-auto text-center my-3 float-bottom">
          <a class="nav-link text-white" type="button" href="./api/adminData/adminProfile.php"><h5>Admin<h5></a>
            <a class="nav-link text-white" type="button" href="./logout.php"><h5>Log Out<h5></a>
          </div>
    </div>
      <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"><!---->
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
    </div><!---->
  <div class="col-10 vh-100"><div class="row m-auto"><!--mm-->
          <div class="row m-auto mb-2">
          <h2 class="text-success p-3"><b>Dashboard</b> | Main</h2>
            <div class="col text-center bg bg-success p-1">
              <a type="button" class="text-white nav-link" href="dashboard.php"><strong>Main</strong></a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/userDashboard.php">User List</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/petDashboard.php">Pet List</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/cardDashboard.php">Vaccine Card</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/noteDashboard.php">Prescription Note</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/schedDashboard.php">Scheduler</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/consultDashboard.php">Consultation</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/vaccineDashboard.php">Vaccine List</a>
            </div>
            <div class="col text-center p-1s" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/symptomDashboard.php">Symptoms Diagnosis</a>
            </div>
          </div><!--mm-->
  
    <div class="row m-auto"><!-- First Graph -->
            <div class="col-4"><!--Ratio-->
              <div class="row m-auto mb-2"><!--yy-->
                  <div class="border border-3 border-success rounded p-2">
                    <div class="row m-auto"><!--xx-->
                      <div class="col-6 my-auto">  
                        <h3 class="text-center">User Gender Ratio</h3>
                        <h4><b><i class="bi bi-gender-male"></i> Male:</b> <?php echo $maleuser; ?></h4><br>
                        <h4><b><i class="bi bi-gender-female"></i> Female:</b> <?php echo $femaleuser; ?></h4>
                      </div>
                      <div class="col-6">
                          <canvas id="donutuser" width="50" height="50"></canvas>
                      </div>
                    </div><!--xx-->
                  </div>
              </div><!--yy-->
              <div class="row m-auto">
                  <div class="border border-3 border-success rounded p-2"><!--yy-->
                    <div class="row m-auto"><!--xx-->
                      <div class="col-5 my-auto">  
                        <h3 class="text-center">Pet Type Ratio</h3>
                        <h4><b><i class="bi bi-gender-male"></i> Male:</b> <?php echo $totaldog; ?></h4><br>
                        <h4><b><i class="bi bi-gender-female"></i> Female:</b> <?php echo $totalcat; ?></h4><br>
                        <h4><b><i class="bi bi-gender-female"></i> Female:</b> <?php echo $totalmouse; ?></h4><br>
                        <h4><b><i class="bi bi-gender-female"></i> Female:</b> <?php echo $totalbird; ?></h4>
                      </div>
                      <div class="col-7">
                          <canvas id="donutpet" width="50" height="50"></canvas>
                      </div>
                    </div><!--xx-->
                  </div><!--yy-->
              </div>
            </div><!--Ratio-->

            <div class="col-8 border border-3 border-success rounded p-2"><!---->
              <div class="row m-auto">
                <div class="col">
                  <h3 class="text-center">Overall Data Counter</h3>
                  <canvas id="barbar" width="50" height="50"></canvas>
                </div>
                <div class="col">
                  <h3 class="text-center">Scheduler Data Counter</h3>
                  <canvas id="schedulebar" width="50" height="50"></canvas>
                </div>
              </div>
            </div><!---->

        </div><!-- First Graph End Tag -->
   </div></div></main>

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
<!-- Chart JS Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart Data -->
<script>
  const bar = document.getElementById('barbar');
  const myBar = new Chart(bar, {
    type: 'bar',
    data: {
      labels: ['Users', 'Pets', 'Vaccines', 'Cards', 'Notes', 'Schedules', 'Chats', 'Calls'],
      datasets: [{
        label: 'Total Data Count',
        data: [ 
          <?php echo $totaluser; ?>, 
          <?php echo $totalpet; ?>, 
          <?php echo $totalvaxinfo; ?>, 
          <?php echo $totalcard; ?>, 
          <?php echo $totalnote; ?>, 
          <?php echo $totalsched; ?>, 
          <?php echo $totalchat; ?>, 
          62],
        backgroundColor: [
          '#F44336',
          '#FF9800',
          '#FFEB3B',
          '#4CAF50',
          '#2196F3',
          '#3F51B5',
          '#9C27B0',
          '#607D8B'
        ]
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      layout: {
        padding: 20,
        width: 50,
        height: 50
      },
      plugins: {
        title: {
        }
      }
    }
  });

  const user = document.getElementById('donutuser');
  const userratio = new Chart(user, {
    type: 'doughnut',
    data: {
      labels: [
        'Male',
        'Female'
      ],
      datasets: [{
        label: 'User Account Gender Ratio',
        data: [
          <?php echo $maleuser; ?>,
          <?php echo $femaleuser; ?>
        ],
        backgroundColor: [
          '#3F51B5',
          '#F44336',
        ],
        hoverOffset: 4
      }]
    }, option: {
        plugins: {

        }
    }
  });

    const pet = document.getElementById('donutpet');
  const petratio = new Chart(pet, {
    type: 'doughnut',
    data: {
      labels: [
        'Dog',
        'Cat',
        'Mouse',
        'Bird'
      ],
      datasets: [{
        label: 'Pet Type Ratio',
        data: [
          <?php echo $totaldog; ?>, 
          <?php echo $totalcat ?>,
          <?php echo $totalmouse ?>,
          <?php echo $totalbird; ?> ],
        backgroundColor: [
          '#3F51B5',
          '#F44336',
          '#FFEB3B',
          '#FF9800'
        ],
        hoverOffset: 4
      }]
    }, option: {
        plugins: {

        }
    }
  });

  const schedbar = document.getElementById('schedulebar');
  const mySched = new Chart(schedbar, {
    type: 'bar',
    data: {
      labels: ['Pending', 'Accepted', 'Denied', 'Cancelled', 'Finished'],
      datasets: [{
        label: 'Total Data Count',
        data: [ 
          <?php echo $totalpending; ?>, 
          <?php echo $totalaccepted; ?>, 
          <?php echo $totaldenied; ?>, 
          <?php echo $totalcancelled; ?>, 
          <?php echo $totalfinished; ?>
        ],
        backgroundColor: [
          '#F44336',
          '#FF9800',
          '#FFEB3B',
          '#4CAF50',
          '#2196F3'
        ]
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      layout: {
        padding: 20,
        width: 50,
        height: 50
      },
      plugins: {
        title: {
        }
      }
    }
  });
</script>
</body>
</html>