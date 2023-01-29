<?php
    require("../connector.php");

    session_start();
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $type = $_POST['pettype'];
        $part = $_POST['bodypart'];
        $symptom = $_POST['symptom'];
        $diagnosis = $_POST['diagnosis'];
        $description = $_POST['description'];
  
        $update = "UPDATE alagapp_db.tbl_symptom SET
        pettype = :pettype,
        bodypart = :bodypart,
        symptom = :symptom,
        diagnosis = :diagnosis,
        description = :description
        WHERE sid = :sid";
        $valupdate = [
            "sid"=>$id,
            "pettype"=>$type,
            "bodypart"=>$part,
            "symptom"=>$symptom,
            "diagnosis"=>$diagnosis,
            "description"=>$description
        ];
        $resadd = $connect->prepare($update);
        $resadd->execute($valupdate);

        if($resadd->rowCount()>0) {
                $_SESSION["trigger"] = "editSymptom";
            echo "<script>window.location='../reportData/symptomDashboard.php'</script>";
        } else {
            $_SESSION["trigger"] = "editESymptom";
            echo "<script>window.location='../reportData/symptomDashboard.php'</script>";
        }
      } else {
        $_SESSION["trigger"] = "editESymptom";
        echo "<script>window.location='../reportData/symptomDashboard.php'</script>";
      }
?>
<form action="../editData/editSymptom.php" method="POST">
<?php
$sid = $_REQUEST['sid'];
                              
$get = "SELECT * FROM alagapp_db.tbl_symptom WHERE sid = :sid";
$val = ["sid"=>$sid];
$resget = $connect->prepare($get);
$resget->execute($val);
if($resget->rowCount()>0) {
    $resrow = $resget->fetch(PDO::FETCH_ASSOC)
?>
    <div class="input-group">
        <label class='input-group-text'>Pet Type</label>
        <input class='form-control' type="number" name="id" value="<?php echo $resrow['sid'] ;?>" hidden>
        <input class='form-control' type="text" name="pettype" placeholder="Enter a Type of Pet i.e. 'Dog' or 'Cat'" value="<?php echo $resrow['pettype'] ;?>">
    </div><br>
    <div class="input-group">
        <label class='input-group-text'>Body Part</label>
        <input class='form-control' type="text" name="bodypart" placeholder="Enter the concerned body part of the pet" value="<?php echo $resrow['bodypart'] ;?>">
    </div><br>
    <div class="input-group">
        <label class='input-group-text'>Symptom</label>
        <input class='form-control' type="text" name="symptom" placeholder="Enter symptoms separated with '/'" value="<?php echo $resrow['symptom'] ;?>">
    </div><br>
    <div class="input-group">
        <label class='input-group-text'>Diagnosis</label>
        <input class='form-control' type="text" name="diagnosis" placeholder="Enter diagnosis name/title" value="<?php echo $resrow['diagnosis'] ;?>">
    </div><br>
    <div class="input-group">
    <label class='input-group-text'>Description</label>
        <textarea class='form-control' type="text" name="description" placeholder="Enter description"><?php echo $resrow['description'] ;?></textarea>
    </div><br>
    <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' name='submit' class='btn btn-primary'>Update Diagnosis</button>
    </div>
</form>
<?php
    } else {
        echo "<script>alert('No Data Found!');
        window.location='../reportData/symptomDashboard.php'</script>";
    }
?>