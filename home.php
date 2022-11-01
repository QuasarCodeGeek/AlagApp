<?php 
    require("API/connector.php");

    include("dataAnalytics.php");
?>
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
    <main class="container">
        <div class="row">
        <div class="col-2 d-flex flex-column vh-100 p-2 text-white  overflow-x overflow-auto" id="Sidebar" style="background-color: #A5D6A7;"><!-- Sidemenu Navbar -->
            <div class="container">
                <div class="text-center"><h3 class="text-white">AlagApp</h3></div><br>
                <div class="d-grid gap-2">    
                <button type="button" class="btn btn-light" onclick="getUserProfile()">User Profile</button>
                <button type="button" class="btn btn-light" onclick="getPetProfile()">Pet Profile</button>
                <button type="button" class="btn btn-light" onclick="getCardProfile()">E-Vaccine Card</button>
                <button type="button" class="btn btn-light" onclick="getNoteProfile()">E-Prescription Note</button><br>
                <button type="button" class="btn btn-light" onclick="location.href='consultation/consultation.php'">O-Consultation</button>
                <button type="button" class="btn btn-light" onclick="location.href='scheduler.php'">Scheduler</button><br>
                <div class="d-grid gap-2">
                <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseButton" aria-expanded="false" aria-controls="collapseButton">
                    Generate Report
                </button>
                <div class="collapse p-2 rounded" id="collapseButton" style="font-size: 12px; background-color: #E8F5E9;">
                    <button type="button" class="btn" onclick="getUser()">User List</button><br>
                    <button type="button" class="btn" onclick="getPet()">Pet List</button><br>
                    <button type="button" class="btn" onclick="getVaccine()">Vaccine List</button><br>
                    <button type="button" class="btn" onclick="getCardList()">Card List</button><br>
                    <button type="button" class="btn" onclick="getPrescription()">Note List</button><br>
                    <button type="button" class="btn" onclick="getSchedule()">Schedule List</button><br>
                </div>
                </div>

                
                </div><!-- d-grid gap-2 -->
            </div><!-- container -->
        </div><!-- Sidemenu Navbar -->

        <div class="col-10 d-flex flex-column vh-100 p-2 text-dark" style="background-color: #E8F5E9;"><!-- Body Content -->

            <div id="dashboardHere" class="m-2 row">
                <div class="card col m-1" style="width: 10rem;">
                    <div class="card-body">
                        <div class="row align-center" style="height: 5rem;">
                            <img src="figures/icons/users-solid.svg" alt="" style="height: 3rem; display: block; margin-left: auto; margin-right: auto;">
                            <strong class="fs-6 text-center">Users</strong><br>
                        </div>
                        <div class="row">
                            <button class="btn" style="font-size: 12px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                                More +
                            </button>
                            <div class="collapse p-2 rounded" id="collapseUser" style="font-size: 12px; background-color: #E8F5E9; max-height: auto;">
                                <label>Active Users: <?php echo $totaluser; ?></label><br>
                                <label>Male Users: <?php echo $maleuser; ?></label><br>
                                <label>Female Users: <?php echo $femaleuser; ?></label><br>
                                <label>M: <?php echo $rmale; ?>/ F: <?php echo $rfemale; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col m-1" style="width: 10rem;">
                    <div class="card-body">
                        <div class="row align-center" style="height: 5rem;">
                            <img src="figures/icons/paw-solid.svg" alt="" style="height: 3rem; display: block; margin-left: auto; margin-right: auto;">
                            <strong class="fs-6 text-center">Pets</strong><br>
                        </div>
                        <div class="row">
                            <button class="btn" style="font-size: 12px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePet" aria-expanded="false" aria-controls="collapsePet">
                                More +
                            </button>
                            <div class="collapse p-2 rounded" id="collapsePet" style="font-size: 12px; background-color: #E8F5E9;">
                                <label>Total Pet: <?php echo $totalpet; ?></label><br>
                                <label>Owner/Pet Ratio: 54.5</label><br>
                                <label>Total Boy: <?php echo $boypet; ?></label><br>
                                <label>Total Girl: <?php echo $girlpet; ?></label><br>
                                <label>M: <?php echo $maleratio; ?>/ F: <?php echo $femaleratio; ?></label>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card col m-1" style="width: 10rem;">
                    <div class="card-body">
                        <div class="row align-center" style="height: 5rem;">
                            <img src="figures/icons/credit-card-solid.svg" alt="" style="height: 3rem; display: block; margin-left: auto; margin-right: auto;">
                            <strong class="fs-6 text-center">E-Vaccine Card</strong><br>
                        </div>
                        <div class="row">
                            <button class="btn" style="font-size: 12px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCard" aria-expanded="false" aria-controls="collapseCard">
                                More +
                            </button>
                            <div class="collapse p-2 rounded" id="collapseCard" style="font-size: 12px; background-color: #E8F5E9;">
                                <label>Highest Pet/User: 7</label>
                                <label>Average Pet/User: 54.5</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col m-1" style="width: 10rem;">
                    <div class="card-body">
                        <div class="row align-center" style="height: 5rem;">
                            <img src="figures/icons/notes-medical-solid.svg" alt="scheduler" style="height: 3rem; display: block; margin-left: auto; margin-right: auto;">
                            <strong class="text-center" style="font-size: 15px;">E-Prescription Note</strong><br>
                        </div>
                        <div class="row">
                            <button class="btn" style="font-size: 12px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNote" aria-expanded="false" aria-controls="collapseNote">
                                More +
                            </button>
                            <div class="collapse p-2 rounded" id="collapseNote" style="font-size: 12px; background-color: #E8F5E9;">
                                <label>Total Card: 46</label>
                                <label>Average Card/User: 24.50</label>
                                <label>Total Vaccine Registered: 250</label>
                                <label>Total Vaccine Administered: 135</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col m-1" style="width: 10rem;"><!-- Scheduler -->
                    <div class="card-body">
                        <div class="row align-center" style="height: 5rem;">
                            <img src="figures/icons/calendar-days-regular.svg" alt="scheduler" style="height: 3rem; display: block; margin-left: auto; margin-right: auto;">
                            <strong class="fs-6 text-center">Scheduler</strong><br>
                        </div>
                        <div class="row" >
                            <button class="btn" style="font-size: 12px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSchedule" aria-expanded="false" aria-controls="collapseSchedule">
                                More +
                            </button>
                            <div class="collapse p-2 rounded" id="collapseSchedule" style="font-size: 12px; background-color: #E8F5E9;">
                                <label>Pending Schedules: 46.75</label>
                                <label>Accepted Schedules: 24.50</label>
                                <label>Cancelled Schedules: 24.50</label>
                                <label>Denied Schedules: 24.50</label>
                                <label>Finished Schedules: 24.50</label>
                            </div>
                        </div>
                    </div>
                </div><!-- Scheduler -->
                <div class="card col m-1" style="width: 10rem;">
                    <div class="card-body">
                        <div class="row" style="height: 5rem;">
                            <img src="figures/icons/address-book-solid.svg" alt="" style="height: 3rem; display: block; margin-left: auto; margin-right: auto;">
                            <strong class="fs-6 text-center">O-Consultation</strong><br>
                        </div>
                        <div class="row">
                            <button class="btn" style="font-size: 12px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseConsult" aria-expanded="false" aria-controls="collapseConsult">
                                More +
                            </button>
                            <div class="collapse p-2 rounded" id="collapseConsult" style="font-size: 12px; background-color: #E8F5E9;">
                                <label>Average Chat per Day: 46.75</label>
                                <label>Average Conference per Day: 24.50</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Dashboard Content -->

            <div class="container input-group"><!-- Search & Filter Panel-->
                <div class="dropdown">
                    <button class="float-start btn btn-light dropdown" style="margin-right: 10px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Add
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                        <button class="btn dropdown-item" type='button' class='btn btn-light' onClick='userNew()' data-bs-toggle='modal' data-bs-target='#newModal')>User Profile</button>
                        </li>
                        <li>
                        <button class="btn dropdown-item" type='button' class='btn btn-light' onClick='petNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Pet Profile</button>   
                        </li>
                        <li>
                        <button class="btn dropdown-item" type='button' class='btn btn-light' onClick='vaccineNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Vaccine Information</button>   
                        </li>
                        <li>
                        <button class="btn dropdown-item" type='button' class='btn btn-light' onClick='cardNew()' data-bs-toggle='modal' data-bs-target='#newModal')>E-Vaccine Card</button>   
                        </li>
                        <li>
                        <button class="btn dropdown-item" type='button' class='btn btn-light' onClick='prescriptionNew()' data-bs-toggle='modal' data-bs-target='#newModal')>E-Prescription Note</button>   
                        </li>
                    </ul>
                </div>
                <input type="text" onkeyup="searchBy()" class="form-control rounded-start" id="search" placeholder="Search">
                    <select class="form-control rounded-end" id="searchby">
                        <option selected>-- Search by --</option>
                        <option value="1">User</option>
                        <option value="2">Pet</option>
                        <option value="3">Card</option>
                        <option value="4">Vaccine</option>
                        <option value="5">Note</option>
                        <option value="6">Schedule</option>
                    </select>
                <div class="btn-group" role="button" style="padding-right: 10px; padding-left: 10px;">
                    <button class="btn btn-light">Filter</button>
                    <button class="btn btn-light">Ascending</button>
                    <button class="btn btn-light">Descending</button>
                </div>
            </div>

            <div class="container overflow-x overflow-auto mt-2" id="contentHere"><!-- Data Pane--></div>
            <!-- Modal Contents -->
            <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">Add New Record</h1>
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

            <div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Pet Vaccine Card</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-grid gap-2 container-fluid" id="cardmodalHere">
                </div>
                </div>
            </div>
            </div>
<!-- Modal Contents -->

        </div><!-- Body Content-->
        </div><!-- row -->
    </main>

<?php 
    include("footer.php");
?>