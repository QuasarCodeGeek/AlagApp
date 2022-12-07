<?php
require("php/connector.php");
include("php/dataAnalytics.php");
include("sidebar.php");
?>

    <div class="main-content">
        <header>   
          <div>
            <button class="btn btn-success">User</button>
            <button class="btn btn-success">Pet</button>
            <button class="btn btn-success">Card</button>
            <button class="btn btn-success">Note</button>
            <button class="btn btn-success">Vaccine</button>
            <button class="btn btn-success">Symptom</button>
          </div>
        </header>
        
        
        <main>
            
            <div class="page-header">
                <h3>Alagapp</h3>
                <h4>Veterinary Clinic Pet Monitoring and Online Consultation System</h4>
            </div>
            
            <div class="page-content">
                    
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
      </div><br>
    
    <div class="row bg bg-light rounded m-2 p-2"><!-- Vaccine Information -->
      <div class="row">
        <div class="col">
          <h3>Vaccine Information</h3>
        </div>
        <div class="col">
          <button class="btn btn-success float-end">Print Data</button>
          <button class="btn btn-success float-end me-2" onClick="vaccineNew()" data-bs-toggle='modal' data-bs-target='#newModal'>Add Vaccine</button>
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
            <th># Administered</th>
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

              $vaxdata = "SELECT COUNT(vaxid) AS vaxx FROM alagapp_db.tbl_vaxxcard WHERE vaxid LIKE ".$rowvaxx['vaxid']."";
              $resdata = $connect->query($vaxdata);
              $resdata->execute();
              $rowdata = $resdata->fetch(PDO::FETCH_ASSOC);

              echo "<tr>
              <td>".$i."</td>
              <td>".$rowvaxx['vaxname']."</td>
              <td>".$rowvaxx['vaxtype']."</td>
              <td>".$rowvaxx['vaxbrand']."</td>
              <td>".$rowvaxx['vaxdes']."</td>
              <td>".$rowdata["vaxx"]."</td>
              <td><button class='btn' onClick='vaccineEdit(".$rowvaxx['vaxid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'><i class='bi bi-pencil-square'></i></button></td>
            </tr>";
            $i++;
            }
          }
        ?>
        </tbody>
      </table>
      </div>
    </div><br>
    <div class="row bg bg-light rounded m-2 p-2"><!-- Pet Symptoms -->
    <div class="row">
        <div class="col">
          <h3>Pet Symptoms Diagnosis</h3>
        </div>
        <div class="col">
          <button class="btn btn-success float-end">Print Data</button>
          <button class="btn btn-success float-end me-2" onClick="symptomNew()" data-bs-toggle='modal' data-bs-target='#newModal'>Add Diagnosis</button>
        </div>
      </div>
      <div class="row">
      <table class="table m-2">
        <thead>
          <tr>
            <th>#</th>
            <th>Pet Type</th>
            <th>Body Part</th>
            <th>Symptom</th>
            <th>Diagnosis</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $symptom = "SELECT * FROM alagapp_db.tbl_symptom";
          $ress = $connect->query($symptom);
          $ress->execute();
          if($ress->rowCount()>0){
            $i=1;
            while($roww = $ress->fetch(PDO::FETCH_ASSOC)){
              echo "<tr>
              <td>".$i."</td>
              <td>".$roww['pettype']."</td>
              <td>".$roww['bodypart']."</td>
              <td>".$roww['symptom']."</td>
              <td>".$roww['diagnosis']."</td>
              <td>".$roww['description']."</td>
              <td><button class='btn' onClick='symptomEdit(".$roww['sid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'><i class='bi bi-pencil-square'></i></button></td>
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


            </div>
      
    
</body>

</html>