<?php
    require("./_connector.php");
    session_start();

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

        echo "<script>window.location='../index.php'</script>";

        /*$id = $_REQUEST['userid'];
        $session = 0;
        $set_Session = "UPDATE alagapp_db.tbl_userlist SET
            usersession = :session

            WHERE userid = :userid";

        $values = array(
            ":userid" => $id,
            ":session"=>$session
        );

        $result = $connect->prepare($set_Session);
        $result->execute($values);
        if($result->rowCount()>0){
            echo "<script>window.location='../index.php'</script>";
        } else {
            echo "<script>window.location='../homePage.php?userid=".$id."'</script>";
        }*/
?>