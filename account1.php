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
            <div class="col-3 container p-2 bg bg-light">
                <!--<div class="row m-2">
                <input type="text" onkeyup="_searchAccount()" class="form-control rounded-start" id="searchAccount" placeholder="Search">
                </div>-->
                <div class="m-1" id="accountHere">
                  
                </div>
                <div class="row m-1 overflow-x overflow-auto">
                    <ul class="list-group list-group-flush">
                    <?php include("php/accountList.php"); ?>
                    </ul>
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
                </div>
            </div>
            <div class="col-9 container bg bg-light pb-5">
              <div class="row p-2">
                <div class="col-6 m-auto">
                  <button type='button' class='p-2 btn btn-success w-100' onClick='userNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Add User</button>
                </div>
                <div class="col-6 m-auto">
                 <button type='button' class='p-2 btn btn-success w-100' onClick='petNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Add Pet</button>
                </div>
              </div>
            </div>
        </div>
      </main>
<!-- Main Functions -->
<script src="js/main.js"></script>
<!-- Ajax Function -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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