<?php
   require("connector.php");

    $user = $_REQUEST["userid"];
    $title = $_POST["title"];
    $caption = $_POST["caption"];

    $pict = $_FILES["media"]["name"];
    $tempname = $_FILES["media"]["tmp_name"];    
    $folder = "../assets/uploads/".$filename;

    $sql = "INSERT INTO db_user.tbl_userlist(userpict) VALUES(:userpict)";
    $res = $conn->prepare($sql);
    $data = array(":userpict"=>$pict);
    $res->execute($data);
          
      if (move_uploaded_file($pict, $folder))  {
        if($res->rowCount()>0) {
            echo "<script>window.location = 'profile.php?userid=".$user."'</script>";//Picture Uploaded
         } else {
           echo "<script>window.location = 'profile.php?userid=".$user."'</script>";//Unable to Upload
         }
      }else{
        echo "<script>window.location = 'profile.php?userid=".$user."'</script>";//Upload Error
      }

?>