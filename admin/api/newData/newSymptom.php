<?php
    require("../connector.php");

    session_start();
    if(isset($_POST['submit'])){
        $type = $_POST['pettype'];
        $part = $_POST['bodypart'];
        $symptom = $_POST['symptom'];
        $diagnosis = $_POST['diagnosis'];
        $description = $_POST['description'];
  
        $add = "INSERT INTO alagapp_db.tbl_symptom(petbreed, pettype, bodypart, symptom, diagnosis, description)
        VALUES(
            :petbreed,
            :pettype,
            :bodypart,
            :symptom,
            :diagnosis,
            :description)";
        $valadd = [
          "petbreed"=>$type,
          "pettype"=>$type,
          "bodypart"=>$part,
          "symptom"=>$symptom,
          "diagnosis"=>$diagnosis,
          "description"=>$description
        ];
        $resadd = $connect->prepare($add);
        $resadd->execute($valadd);

        if($resadd->rowCount()>0) {
            $_SESSION["trigger"] = "newSymptom";
            echo "<script>window.location='../reportData/symptomDashboard.php'</script>";//Added
        } else {
            $_SESSION["trigger"] = "newESymptom";
            echo "<script>window.location='../reportData/symptomDashboard.php'</script>";//Unable
        }
      } else {
        $_SESSION["trigger"] = "newESymptom";
        echo "<script>window.location='../reportData/symptomDashboard.php'</script>";//Unable
      }
?>

<form action="../newData/newSymptom.php" method="POST">
  <div class="input-group">
    <label class='input-group-text'>Pet Type</label>
    <input class='form-control' type="text" name="pettype" placeholder="Enter a Type of Pet i.e. 'Dog' or 'Cat'" required>
  </div><br>
  <div class="input-group">
    <label class='input-group-text'>Body Part</label>
    <input class='form-control' type="text" name="bodypart" placeholder="Enter the concerned body part of the pet" required>
  </div><br>
  <div class="input-group">
    <label class='input-group-text'>Symptom</label>
    <input class='form-control' type="text" name="symptom" placeholder="Enter symptoms separated with '/'" required>
  </div><br>
  <div class="input-group">
    <label class='input-group-text'>Diagnosis</label>
    <input class='form-control' type="text" name="diagnosis" placeholder="Enter diagnosis name/title" required>
  </div><br>
  <div class="input-group">
    <label class='input-group-text'>Description</label>
    <textarea class='form-control' type="text" name="description" placeholder="Enter description" required></textarea>
  </div><br>
  <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
    <button type='submit' name='submit' class='btn btn-primary'>Add Diagnosis</button>
  </div>
</form>