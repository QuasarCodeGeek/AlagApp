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
            echo "<script>alert('Post have been uploaded!');
            window.location = 'profile.php?userid=".$user."'</script>";
         } else {
           echo "<script>alert('Unable to Upload!');
           window.location = 'profile.php?userid=".$user."'</script>";
         }
      }else{
        echo "<script>alert('Upload Error!');
        window.location = 'profile.php?userid=".$user."'</script>";
      }

?>