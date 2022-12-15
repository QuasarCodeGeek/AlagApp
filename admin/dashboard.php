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
    <link rel="stylesheet" href="../css/styles.css">
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
              <a class="navbar-brand" href="#"><strong>AlagApp</strong></a>
            </div>
            <div class="col text-center">
              <a class="nav-link" href="consultation.php">Consultation</a>
            </div>
            <div class="col text-center border-bottom border-success border-5">
              <a class="nav-link text-success" href="dashboard.php" active><strong>Dashboard</strong></a> 
            </div>
          </div>
        </div>
      </nav>
      <main class="container-fluid" style="background-color: #E0E0E0;">
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
              <a type="button" class="text-white nav-link" href="api/reportData/vaccineDashboard.php">Vaccine List</a>
            </div>
            <div class="col text-center p-1" style="background-color: #81C784;">
              <a type="button" class="text-white nav-link" href="api/reportData/symptomDashboard.php">Symptoms Diagnosis</a>
            </div>
          </div>
    <div class="container pb-5">
          <div class="row p-2"><!-- First Graph -->
            <div class="col bg bg-light rounded m-2 p-2">
              <div class="text-center">
                <h3>Overall Data Counter</h3>
              </div>
              <canvas id="barbar" width="50" height="50"></canvas>
            </div>
            <div class="col bg bg-light rounded m-2 p-2">
            <div class="text-center">
                <h3>Scheduler Data Counter</h3>
              </div>
              <canvas id="schedulebar" width="50" height="50"></canvas>
            </div>
          </div><br><!-- First Graph End Tag -->
  
        <div class="row bg bg-light rounded m-2 p-2"><!-- Second Graph -->
          <div class="col-3 m-auto">
            <div class="col text-center">
              <label>User Gender Ratio</label>
            </div>
            <div class="row">
            <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Male</strong>
                <label class="float-end"><?php echo $maleuser; ?></label>
              </div>
              <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Female</strong>
                <label class="float-end"><?php echo $femaleuser; ?></label>
              </div>
            </div>
            <canvas id="donutuser" width="50" height="50"></canvas>
          </div>
          <div class="col-3 m-auto">
            <div class="col text-center">
              <label>Pet Type Ratio</label>
            </div>
            <div class="row">
              <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong>Dog</strong>
                <label class="float-end"><?php echo $totaldog; ?></label>
              </div>
              <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong>Cat</strong>
                <label class="float-end"><?php echo $totalcat; ?></label>
              </div>
            </div>
            <div class="row">
            <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong>Mouse</strong>
                <label class="float-end"><?php echo $totalmouse; ?></label>
              </div>
              <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong>Bird</strong>
                <label class="float-end"><?php echo $totalbird; ?></label>
              </div>
            </div>
            <canvas id="donutpet" width="50" height="50"></canvas>
          </div>
        </div>
    </div> 
  </main>

<!-- Main Functions -->
<script src="../js/main.js"></script>
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