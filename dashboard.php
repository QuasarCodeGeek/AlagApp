<?php
  include ("php/dataAnalytics.php");
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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg bg-success">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="../index.html">AlagApp</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="account.php">Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="scheduler.php">Scheduler</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consultation.php">Consultation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-success" href="dashboard.php" active><strong>Dashboard</strong></a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <main class="container container-fluid">
        <div class="row p-2 bg bg-light">
          <div class="col-6">
            <canvas id="barbar" width="50" height="50"></canvas>
          </div>
          <div class="col-6">
            <canvas id="schedulebar" width="50" height="50"></canvas>
          </div>
        </div>  
        <div class="row p-2 bg bg-light">
          <div class="col-3">
            <div class="text-center">
              <label>User Gender Ratio</label>
            </div>
            <canvas id="donutuser" width="50" height="50"></canvas>
          </div>
          <div class="col-3">
            <div class="text-center">
              <label>Pet Type Ratio</label>
            </div>
            <canvas id="donutpet" width="50" height="50"></canvas>
          </div>
          <div class="col-3">
            <div class="text-center">
              <label>Vaccine Administered Ratio</label>
            </div>
            <canvas id="donutvax" width="50" height="50"></canvas>
          </div>
        </div>
      </main>
<!-- Footer -->
<footer class="position-bottom text-white py-3">
  <div class="container">
      <label class="float-start">@2022</label>
      <label>User Guide</label>
      <label class=" float-end">PROGRAM SLAYER</label>
  </div>
</footer>

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
          display: true,
          text: 'User Account Ratio'
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
        data: [28, 12, 2, 5],
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

  const vax = document.getElementById('donutvax');
  const vaxratio = new Chart(vax, {
    type: 'doughnut',
    data: {
      labels: [
        'Rabies',
        'Leptospirosis',
        'Distemper',
        'Deworming'
      ],
      datasets: [{
        label: 'Vaccine Administered Ratio',
        data: [
          16, 45, 12, 31
        ],
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
          display: true,
          text: 'Schedule Status'
        }
      }
    }
  });
</script>
</body>
</html>