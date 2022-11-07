<?php
  require("php/dataAnalytics.php");
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <div class="container row">
      <div class="col-4">
        <canvas id="donutchart" width="50" height="50"></canvas>
      </div>
      <div class="col-4">
        <canvas id="myChart" width="50" height="50"></canvas>
      </div>
      <div class="col-4">
        <canvas id="donut" width="50" height="50"></canvas>
      </div>
      <div class="col-6">
        <canvas id="barbar" width="50" height="50"></canvas>
      </div>
      <div class="col-3">
        <canvas id="userratio" width="50" height="50"></canvas>
      </div>
      <div class="col-3">
        <canvas id="petratio" width="50" height="50"></canvas>
      </div>
    </div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Nutrient Level',
        data: [12, 19, 3, 5, 2, 3, 6],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
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
          text: 'HydroTech',
          display: true
        }
      }
    }
  });

  const cty = document.getElementById('donutchart');
  const config = new Chart(cty, {
    type: 'doughnut',
    data: {
      labels: [
        'Red',
        'Blue',
        'Yellow'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
      }]
    }, option: {

    }
  });

  const ctz = document.getElementById('donut');
  const conf = new Chart(ctz, {
    type: 'polarArea',
    data: {
      labels: [
        'Red',
        'Green',
        'Yellow',
        'Grey',
        'Blue'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [11, 16, 7, 3, 14],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(75, 192, 192)',
          'rgb(255, 205, 86)',
          'rgb(201, 203, 207)',
          'rgb(54, 162, 235)'
        ]
      }]
    },
    options: {

    }
  });

  const bar = document.getElementById('barbar');
  const myBar = new Chart(bar, {
    type: 'bar',
    data: {
      labels: ['Users', 'Pets', 'Vaccines', 'Cards', 'Notes', 'Schedules', 'Chats', 'Calls'],
      datasets: [{
        label: 'Total Data Count',
        data: [ 45, 47, 8, 52, 51, 57, 68, 62],
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

  const user = document.getElementById('userratio');
  const uratio = new Chart(user, {
    type: 'doughnut',
    data: {
      labels: [
        'Male',
        'Female'
      ],
      datasets: [{
        label: 'User Account Gender Ratio',
        data: [28, 12],
        backgroundColor: [
          '#3F51B5',
          '#F44336',
        ],
        hoverOffset: 4
      }]
    }, option: {
        plugins: {
          legend: {
            display: true,
          },
          title: {
            display: true,
            text: 'Custom Chart Title',
            align: 'center',
            padding: {
                    top: 10,
                    bottom: 30
                }
          }
        }
    }
  });
</script>