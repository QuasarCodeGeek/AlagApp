<?php
require("./../connector.php");

    session_start();

    $id = $_POST['cid'];
    $user = $_POST['userid'];

    if(isset($_POST['delete'])){
        $del = "DELETE FROM alagapp_db.tbl_carddetail WHERE cid = ".$id."";
        $res = $connect->prepare($del);
        $res->execute();

        if($res->rowCount()>0){
            $_SESSION["trigger"] = "delSCard";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>";
        } else {
            $_SESSION["trigger"] = "delFCard";
            echo "<script>window.location='../profile.php?userid=".$user."'</script>";
        }
    } else {
        $_SESSION["trigger"] = "delFCard";
        echo "<script>window.location='../profile.php?userid=".$user."'</script>";
    }
?>