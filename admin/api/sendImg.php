<?php
    require("connector.php");

    if(isset($_POST['submit'])){
        $user = $_REQUEST['userid'];
        $mchannel = $_POST['mchannel'];
        $msender = $_POST['msender'];
        $mcontent = basename($_FILES["fileToUpload"]["name"]);
        $mdatetime = date("Y-m-d h:i:sa");
        $mtype = "Img";
    
        $sql = "INSERT INTO alagapp_db.tbl_chat(
            userid,
            mchannel,
            msender,
            mcontent,
            mdatetime,
            mtype) VALUES(
                :userid,
                :mchannel,
                :msender,
                :mcontent,
                :mdatetime,
                :mtype)";
        $res = $connect->prepare($sql);
        $data = array(
            ":userid"=>$user,
            ":mchannel"=>$mchannel,
            ":msender"=>$msender,
            ":mcontent"=>$mcontent,
            ":mdatetime"=>$mdatetime,
            ":mtype"=>$mtype
        );
        $res->execute($data);
        
        if($res->rowCount()>0){
           
    $target_dir = "../../assets/chat/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed')</script>;";
    $user = $_REQUEST['userid'];
    echo "<script>window.location='chat.php?userid=".$user."'</script>;";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $user = $_REQUEST['userid'];
            echo "<script>alert('Upload successful!!')</script>;";
            echo "<script>window.location='chat.php?userid=".$user."'</script>;";
    } else {
        $user = $_REQUEST['userid'];
        echo "<script>alert('Sorry an error occured!!')</script>";
        echo "<script>window.location='chat.php?userid=".$user."'</script>;";
    }
    }

} else {
    echo "<script>alert('Error');</script>";
}
} else {
    echo "<script>alert('Error');</script>";
}
?>
