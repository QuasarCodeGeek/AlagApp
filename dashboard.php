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
    <link href="node_modules/bootstrap/dist/css/bootstrap-grid.min.css" rel="stylesheet">
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
            <div class="col text-center">
              <a class="nav-link" href="consultation.php">Consultation</a>
            </div>
            <div class="col text-center border-bottom border-success border-5">
              <a class="nav-link text-success" href="dashboard.php" active><strong>Dashboard</strong></a> 
            </div>
          </div>
        </div>
      </nav>
      <main class="container container-fluid" style="background-color: #E0E0E0;">
          <div class="row p-5"><!-- First Graph -->
            <div class="col-6 m-auto">
              <div class="row">
                <div class="col bg bg-success border-end border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                  <i class="bi bi-chat m-1"></i><strong> Users</strong>
                  <label class="float-end"><?php echo $totaluser; ?></label>
                </div>
                <div class="col bg bg-success border-end border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                  <i class="bi bi-chat m-1"></i><strong> Pets</strong>
                  <label class="float-end"><?php echo $totalpet; ?></label>
                </div>
              </div>
              <div class="row">
                <div class="col bg bg-success border-end border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                  <i class="bi bi-chat m-1"></i><strong> Vaccine</strong>
                  <label class="float-end"><?php echo $totalvaxinfo; ?></label>
                </div>
                <div class="col bg bg-success border-end border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Card</strong>
                  <label class="float-end"><?php echo $totalcard; ?></label>
                </div>
              </div>
              <div class="row">
                <div class="col bg bg-success border-end border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                  <i class="bi bi-chat m-1"></i><strong> Notes</strong>
                  <label class="float-end"><?php echo $totalnote; ?></label>
                </div>
                <div class="col bg bg-success border-end border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                  <i class="bi bi-chat m-1"></i><strong> Schedules</strong>
                  <label class="float-end"><?php echo $totalsched; ?></label>
                </div>
              </div>
              <div class="row">
                <div class="col bg bg-success border-end border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                  <i class="bi bi-chat m-1"></i><strong> Chats</strong>
                  <label class="float-end"><?php echo $totalchat; ?></label>
                </div>
                <div class="col bg bg-success border-end border-5 border-success m-2 p-3 rounded " style="--bs-bg-opacity: .1;">
                  <i class="bi bi-chat m-1"></i><strong> Calls</strong>
                  <label class="float-end">62</label>
                </div>
              </div>
            </div>
            <div class="col-6">
              <canvas id="barbar" width="50" height="50"></canvas>
            </div>
          </div><!-- First Graph End Tag -->
        <div class="row p-5"><!-- Second Graph -->
          <div class="col-6">
            <canvas id="schedulebar" width="50" height="50"></canvas>
          </div>
          <div class="col-6 m-auto">
              <div class="col bg bg-success border-start border-5 border-success m-2 p-3 rounded w-50" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Pending</strong>
                <label class="float-end"><?php echo $totalpending; ?></label>
              </div>
              <div class="col bg bg-success border-start border-5 border-success m-2 p-3 rounded w-50" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Denied</strong>
                <label class="float-end"><?php echo $totaldenied; ?></label>
              </div>
              <div class="col bg bg-success border-start border-5 border-success m-2 p-3 rounded w-50" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong>Accepted</strong>
                <label class="float-end"><?php echo $totalaccepted; ?></label>
              </div>
              <div class="col bg bg-success border-start border-5 border-success m-2 p-3 rounded w-50" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Cancelled</strong>
                <label class="float-end"><?php echo $totalcancelled; ?></label>
              </div>
              <div class="col bg bg-success border-start border-5 border-success m-2 p-3 rounded w-50" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Finished</strong>
                <label class="float-end"><?php echo $totalfinished; ?></label>
              </div>
          </div>
        </div><!-- Second Graph End Tag -->
  
      <div class="row p-5"><!-- Second Graph -->
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
                <i class="bi bi-chat m-1"></i><strong> Dog</strong>
                <label class="float-end">28</label>
              </div>
              <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Cat</strong>
                <label class="float-end">12</label>
              </div>
            </div>
            <div class="row">
            <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Bird</strong>
                <label class="float-end">2</label>
              </div>
              <div class="col bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Mouse</strong>
                <label class="float-end">5</label>
              </div>
            </div>
            <canvas id="donutpet" width="50" height="50"></canvas>
          </div>
          <div class="col-3 m-auto">
            <div class="row text-center">
              <label>Vaccine Administered Ratio</label>
            </div>
            <div class="row">
              <div class="row bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Rabies</strong>
                <label class="float-end">28</label>
              </div>
              <div class="row bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Leptospirosis</strong>
                <label class="float-end">12</label>
              </div>
            <div class="row bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Distemper</strong>
                <label class="float-end">2</label>
              </div>
              <div class="row bg bg-success border-bottom border-5 border-success m-2 p-3 rounded" style="--bs-bg-opacity: .1;">
                <i class="bi bi-chat m-1"></i><strong> Deworming</strong>
                <label class="float-end">5</label>
              </div>
            </div>
            <canvas id="donutvax" width="50" height="50"></canvas>
          </div>
        </div>
    <div class="row bg bg-light rounded m-2 p-2">
      <div class="row">
        <div class="col">
          <h3 class="">Vaccine Information</h3>
        </div>
        <div class="col flex-end">
          <button class="btn btn-success me-2">Print Data</button>
          <button class="btn btn-success">Add Vaccine</button>
        </div>
      </div>
      <div class="row">
      <table class="table m-2">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $vaxx = "SELECT * FROM alagapp_db.tbl_vaxxinfo";
          $resvaxx = $connect->query($vaxx);
          $resvaxx->execute();
          if($resvax->rowCount()>0){
            $i=1;
            while($rowvaxx = $resvaxx->fetch(PDO::FETCH_ASSOC)){
              echo "<tr>
              <td>".$i."</td>
              <td>".$rowvaxx['vaxname']."</td>
              <td>".$rowvaxx['vaxtype']."</td>
              <td>".$rowvaxx['vaxbrand']."</td>
              <td>".$rowvaxx['vaxdes']."</td>
              <td><button class='btn' onClick='vaccineEdit(".$rowvaxx['vaxid'].")'><i class='bi bi-pencil-square'></i></button></td>
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