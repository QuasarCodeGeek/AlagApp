<?php
    require("_connector.php");
    
    if(isset($_POST['submit'])){
        $user = $_POST['userid'];
        $file = basename($_FILES["fileToUpload"]["name"]);

        session_start();
        $set = md5(strval($user));
        $_SESSION["newsession"] = $user.$set;
        if($_SESSION["newsession"] != $_SESSION["setsession"] ){
          echo "<script>window.location='./../index.php'</script>";
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 250000) {        
            echo "<script>window.location='editProfile.php?userid=".$user."'</script>;";//File too large
            $uploadOk = 0;
        }
    
        $sql = "UPDATE alagapp_db.tbl_userlist SET userpict = :file WHERE userid = :userid";
        $value = array(":userid"=>$user,":file"=>$file);

        $res = $connect->prepare($sql);
        $res->execute($value);

        if($res->rowCount()>0){
           
    $target_dir = "../../assets/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    
    echo "<script>window.location='editProfile.php?userid=".$user."'</script>;";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<script>window.location='editProfile.php?userid=".$user."'</script>;";
    } else {
        echo "<script>window.location='editProfile.php?userid=".$user."'</script>;";
    }
    }

} else {
    echo "<script>alert('Error');</script>";
}
} else {
    echo "<script>alert('Error');</script>";
}
?>
