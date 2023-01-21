<?php
    require("../connector.php");

    if(isset($_POST['submit'])){
        $id = 1;
        $file = basename($_FILES["fileToUpload"]["name"]);
    
        $sql = "UPDATE alagapp_db.tbl_admin SET pict = :file WHERE adminid = :id";
        $value = array(":id"=>$id,":file"=>$file);

        $res = $connect->prepare($sql);
        $res->execute($value);

        if($res->rowCount()>0){
           
    $target_dir = "../../../assets/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "<script>window.location='adminProfile.php'</script>;";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<script>window.location='adminProfile.php'</script>;";
    } else {
        echo "<script>window.location='adminProfile.php'</script>;";
    }
    }

} 
} 
?>
