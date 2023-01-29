<?php
    require("../connector.php");

    if(isset($_POST['submit'])){
        $pet = $_POST['petid'];
        $user = $_POST['userid'];
        $file = basename($_FILES["fileToUpload"]["name"]);

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 250000) {        
            echo "<script>window.location='../profile.php?userid=".$user."'</script>;";//File too large
            $uploadOk = 0;
        }
    
        $sql = "UPDATE alagapp_db.tbl_petprofile SET petpict = :file WHERE petid = :id";
        $value = array(":id"=>$pet,":file"=>$file);

        $res = $connect->prepare($sql);
        $res->execute($value);

        if($res->rowCount()>0){
           
    $target_dir = "../../../assets/pet/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "<script>window.location='../profile.php?userid=".$user."'</script>;";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    // if everything is ok, try to upload file
    } else {
        session_start();
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $_SESSION["trigger"] = "editPet";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>;";
        } else {
            session_start();
            $_SESSION["trigger"] = "editEPet";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>;";
        }
    }

} 
} 

    $pet = $_REQUEST['id'];
    $sql = "SELECT userid FROM alagapp_db.tbl_petprofile WHERE petid = ".$pet."";
    $res = $connect->query($sql);
    $res->execute();
    if($res->rowCount()>0){
        $row = $res->fetch(PDO::FETCH_ASSOC);
        echo "<form action='./editData/petImage.php' method='POST' enctype='multipart/form-data'>
        <div class='input-group mb-3'>
          <input type='file' max-size='250000' class='form-control col-12 col-sm-12 col-md col-lg col-xl-4' name='fileToUpload' id='fileToUpload'>
          <input type='number'  class='form-control' name='userid' value='".$row['userid']."' hidden>
          <input type='number' class='form-control' name='petid' value='".$pet."' hidden>
        </div>
        <div class='row m-auto'>
          <button type='button' class='col m-1 btn btn-secondary' data-bs-dismiss='modal'>Close</button>
          <button type='submit' name='submit' class='col m-1 btn btn-primary'>Upload</button>
        </div>
        </form>";
    }
?>


