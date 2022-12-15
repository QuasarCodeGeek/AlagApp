<?php
    require("api/_connector.php");
    $user = $_REQUEST["userid"];

    $picture = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$user." ";
        $checkpict = $connect->prepare($picture);
        $checkpict->execute();

        if($checkpict->rowCount()>0) {
          $acc = $checkpict->fetch(PDO::FETCH_ASSOC);
          $sex = $acc['usergender'];
          $pict = $acc['userpict'];
          $name = $acc['userfname'];
        }
?>
<!doctype html>
<html lang="en">

<head>
  <title>Health Tracker</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body style="background-color: #C8E6C9;">
<nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid">
    <button class="navbar-toggler" style="border: none; color: white;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <i class="bi bi-list"></i>
    </button>
    <a class="navbar-brand text-white" href="#"><b>AlagApp</b></a>    
    <div class="offcanvas offcanvas-start w-75" style="background-color: #81C784;" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header bg bg-success">
        <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="userPage.php?userid=<?php echo $user; ?>">
                    <?php 
                        if($pict!=''){
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/uploads/".$pict."'>";
                        } else if ($sex=='F') {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/default/female.png'>";
                        } else {
                            echo "<img class='rounded me-2' style='width: 25px;' src='../assets/default/male.png'>";
                        }
                    
                    echo "<label class='float-end text-white'>".$name."</label>"; ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="homePage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-house-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">Home</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="chatPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">O-Consultation</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="trackerPage.php?userid=<?php echo $user; ?>">
            <i class="bi bi-chat-fill me-2" style="color: white;"></i>
            <label class="float-end text-white"><strong>Health Tracker</strong></label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutUs.php?userid=<?php echo $user; ?>">
            <i class="bi bi-info-circle-fill me-2" style="color: white;"></i>
            <label class="float-end text-white">About Us</label></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<main class="container-fluid">
<div class="col">
    <div class="row m-2 p-2 rounded" style="background-color: #81C784;">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="m-2 input-group">
                <label class="input-group-text">Pet Type</label>
                <select id="type" name="type" class="form-control form-select" aria-label="SelectPetType">
                    <option selected>-- Select Pet Type --</option>
                    <option value="Bird">Bird</option>
                    <option value="Cat">Cat</option>
                    <option value="Cow">Cow</option>
                    <option value="Dog">Dog</option>
                    <option value="Fish">Fish</option>
                    <option value="Frog">Frog</option>
                    <option value="Mouse">Mouse</option>
                    <option value="Lizard">Lizard</option>
                    <option value="Snake">Snake</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="m-2 input-group">
                <label class="input-group-text">Body Part</label>
                <select id="part" name="part" class="form-control form-select" aria-label="SelectBodyPart">
                    <option selected>-- Select Body Part --</option>
                    <option value="Abdomen">Bird</option>
                    <option value="Back">Back</option>
                    <option value="Behavior">Behavior</option>
                    <option value="Digits">Digits</option>
                    <option value="Eyes">Eyes</option>
                    <option value="Ears">Ears</option>
                    <option value="Fur">Fur</option>
                    <option value="Gills">Gills</option>
                    <option value="Gizzard">Gizzard</option>
                    <option value="Heart">Heart</option>
                    <option value="Lungs">Lungs</option>
                    <option value="Mouth">Mouth</option>
                    <option value="Mucosa">Mucosa</option>
                    <option value="Nerve (Bronchial)">Nerve (Bronchial)</option>
                    <option value="Nose">Nose</option>
                    <option value="Near Tail">Near Tail</option>
                    <option value="Spleen">Spleen</option>
                    <option value="Skin">Skin</option>
                    <option value="Systematic">Systematic</option>
                    <option value="Tail">Tail</option>
                    <option value="Toes">Toes</option>
                    <option value="Tongue">Tongue</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="m-2 input-group">
                <label class="input-group-text">Symptom</label>
                <select id="symptom" name="symptom" class="form-control form-select" aria-label="SelectSymptom">
                    <option selected>-- Select Symptom --</option>
                    <option value="Abdominal Enlargement">Abdominal Enlargement</option>
                    <option value="Abnormal Shedding">Abnormal Shedding</option>
                    <option value="Aggression">Aggression</option>
                    <option value="Bloating">Bloating</option>
                    <option value="Cough">Cough</option>
                    <option value="Diarrhea">Diarrhea</option>
                    <option value="Dermatitis">Dermatitis</option>
                    <option value="High Fever">High Fever</option>
                    <option value="Lethargy">Lethargy</option>
                    <option value="Loss of Appetite">Loss of Appetite</option>
                    <option value="Milky Skin">Milky Skin</option>
                    <option value="Nasal Discharge">Nasal Discharge</option>
                    <option value="Ocular Discharge">Ocular Discharge</option>
                    <option value="Paralysis">Paralysis</option>
                    <option value="Sudden Death">Sudden Death</option>
                    <option value="Ulceration">Ulceration</option>
                    <option value="Weight Loss">Weight Loss</ioption>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="m-auto">
                <button type="submit" onclick="getSymptom()" name="submit" class="m-2 p-2 w-100 btn btn-success">Find</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="m-2 p-2 text-center rounded" style="background-color: #4CAF50;">
                <label class="text-white"><strong>Results</strong></label>
            </div>
            <div id="ContentHere">

            </div>
        </div>
    </div>
</div>
  </main>
  <script src="js/client.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>