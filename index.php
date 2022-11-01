<!doctype html>
    <html lang="en">
    <head>
    <title>AlagApp</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
    <header class="row text-white">
      <div class="container">
        <h1 class="text-center mt-2 fw-bold fs-1 title">AlagApp</h1>
        <p class="text-center fw-bold">Veterinary Clinic Pet Monitoring and Online Consultation System</p>
      </div>
    </header>
    <main class="container">
      <div class="row">
        <a class="nav-link" href="account.php">Account</a>
        <a class="nav-link" href="scheduler.php">Scheduler</a>
        <a class="nav-link" href="dashboard.php">Dashboard</a>
        <a class="nav-link" href="consultation.php">Consultation</a>
      </div>
      <div class="row function">
        <button class="col-md-4 col-sm-6 btn fs-1" type="button" href="#userprofile">User Profile</button>
        <button class="col-md-4 col-sm-6 btn fs-1" type="button" href="#userprofile">E-Vaccine Card</button>
        <button class="col-md-4 col-sm-6 btn fs-1" type="button" href="#userprofile">O-Consultation</button>
        <button class="col-md-4 col-sm-6 btn fs-1" type="button" href="#userprofile">Pet Profile</button>
        <button class="col-md-4 col-sm-6 btn fs-1" type="button" href="#userprofile">E-Prescription Note</button>
        <button class="col-md-4 col-sm-6 btn fs-1" type="button" href="#userprofile">Generate Report</button>
      </div>

      <div class="row" id="userprofile">
        <div class="col-6">
          <img class="thumbnail indexThumbnail" src="assets/img/mngt1.jpg" alt="userprofile">
        </div>
        <div class="col-6 container m-auto text-center">
          <h1>User Profile</h1>
          <p>
            The system manages user profile which are registered accounts of the clients that visited the clinic.
          </p>
          <a href="#" class="btn btn-primary"> Learn more > </a>
        </div>
      </div>

      <div class="row" id="petprofile">
        <div class="col-6">
          <h4>Pet Profile</h4>
          <p>
            The system manages the owner's pet profile which are registered accounts of the pets that visited the clinic.
          </p>
        </div>
        <div class="col-6">
          <img class="thumbnail indexThumbnail" src="assets/img/pet2.jpg" alt="userprofile">
        </div>
      </div>

      <div class="row team p-2">
        <div class="row">
          <h4 class="text-center m-2">MEET THE PROGRAM SLAYER</h4>
        </div>
        <div class="col-3 card profile m-auto p-2">
          <div class="over">
            <img src="assets/img/jean.png" class="card-img-top rounded" alt="Jean">
            <div class="catleenoverlay p-2">
              <img src="assets/img/catleen.jpg" class="card-img-top rounded" alt="Catleen">
            </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">Feliciano, C.G.M., MIT</h5>
            <p class="card-text">Project / Adviser</p>
            <a href="#" class="btn"><img class="fbicon" src="assets/bootstrap-icons/facebook.svg" alt="facebook"> catleenglo</a>
          </div>
        </div>
        <div class="col-3 card profile m-auto p-2">
          <div class="over">
            <img src="assets/img/diluc.png" class="card-img-top rounded" alt="Albedo">
            <div class="jayceoverlay p-2">
              <img src="assets/img/jayce.jpg" class="card-img-top rounded" alt="Jayce">
            </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">Reyes, J.D.</h5>
            <p class="card-text">Programmer / Researcher</p>
            <a href="#" class="btn"><img class="fbicon" src="assets/bootstrap-icons/facebook.svg" alt="facebook"> sonjay11</a>
          </div>
        </div>
        <div class="col-3 card profile m-auto p-2">
          <div class="over">
            <img src="assets/img/albedo.png" class="card-img-top rounded" alt="Diluc">
            <div class="jerronoverlay p-2">
              <img src="assets/img/jerron.jpg" class="card-img-top rounded" alt="Jerron">
            </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">Urbanozo, J.M.S.</h5>
            <p class="card-text">Programmer / Researcher</p>
            <a href="#" class="btn"><img class="fbicon" src="assets/bootstrap-icons/facebook.svg" alt="facebook"> ItsJehan.14</a>
          </div>
        </div>
        <div class="col-3 card profile m-auto p-2">
          <div class="over">
            <img src="assets/img/kaeya.png" class="card-img-top rounded" alt="Kaeya">
            <div class="lanceoverlay p-2">
              <img src="assets/img/lance.jpg" class="card-img-top rounded" alt="Lance">
            </div>
          </div>
          <div class="card-body">
            <h5 class="card-title">Zalamea, M.L.A.</h5>
            <p class="card-text">Programmer / Researcher</p>
            <a href="#" class="btn"><img class="fbicon" src="assets/bootstrap-icons/facebook.svg" alt="facebook"> lance.andrada.92</a>
          </div>
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
    </body>
</html>