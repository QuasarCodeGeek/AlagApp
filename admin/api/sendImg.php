<?php
    require("connector.php");

    if(isset($_POST['submit'])){
        $user = $_REQUEST['userid'];
        $mchannel = $_POST['mchannel'];
        $msender = $_POST['msender'];
        $mcontent = basename($_FILES["fileToUpload"]["name"]);
        $mdatetime = date("Y-m-d h:i:sa");
        $mtype = "Img";

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 250000) {        
            echo "<script>window.location='chat.php?userid=".$user."'</script>;";//File too large
            $uploadOk = 0;
        }
    
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
            //File is not an Image
            $user = $_REQUEST['userid'];
            echo "<script>window.location='chat.php?userid=".$user."'</script>;";
            $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            //File not uploaded
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $user = $_REQUEST['userid'];
                        echo "<script>window.location='chat.php?userid=".$user."'</script>;";//Upload successful
                } else {
                    $user = $_REQUEST['userid'];
                    echo "<script>window.location='chat.php?userid=".$user."'</script>;";//Error Occured
                }
            }
        }
    } 
?>
