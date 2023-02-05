<?php
require("./../connector.php");

    session_start();

    $id = $_POST['nid'];
    $user = $_POST['userid'];

    if(isset($_POST['delete'])){
        $del = "DELETE FROM alagapp_db.tbl_notedetail WHERE nid = ".$id."";
        $res = $connect->prepare($del);
        $res->execute();

        if($res->rowCount()>0){
            $_SESSION["trigger"] = "delSNote";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>";
        } else {
            $_SESSION["trigger"] = "delFNote";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>";
        }
    } else {
        $_SESSION["trigger"] = "delFNote";
        echo "<script>window.location='../profile.php?userid=".$user."'</script>";
    }
?>