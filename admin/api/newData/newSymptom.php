<?php
    require("../connector.php");

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
            echo "<script>alert('Symptom Added!');
            window.location='../reportData/symptomDashboard.php'</script>";
        } else {
            echo "<script>alert('Unable to add Symptom!');
            window.location='../reportData/symptomDashboard.php'</script>";
        }
      } else {
        echo "<script>alert('Unable to add Symptom!');
        window.location='../reportData/symptomDashboard.php'</script>";
      }
?>

<form action="../newData/newSymptom.php" method="POST">
  <div class="input-group">
    <label class='input-group-text'>Pet Type</label>
    <input class='form-control' type="text" name="pettype" placeholder="Enter a Type of Pet i.e. 'Dog' or 'Cat'">
  </div><br>
  <div class="input-group">
    <label class='input-group-text'>Body Part</label>
    <input class='form-control' type="text" name="bodypart" placeholder="Enter the concerned body part of the pet">
  </div><br>
  <div class="input-group">
    <label class='input-group-text'>Symptom</label>
    <input class='form-control' type="text" name="symptom" placeholder="Enter symptoms separated with '/'">
  </div><br>
  <div class="input-group">
    <label class='input-group-text'>Diagnosis</label>
    <input class='form-control' type="text" name="diagnosis" placeholder="Enter diagnosis name/title">
  </div><br>
  <div class="input-group">
    <label class='input-group-text'>Description</label>
    <textarea class='form-control' type="text" name="description" placeholder="Enter description"></textarea>
  </div><br>
  <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
    <button type='submit' name='submit' class='btn btn-primary'>Add Diagnosis</button>
  </div>
</form>