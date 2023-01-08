<?php
    require("./_connector.php");

        $id = $_REQUEST['userid'];
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
            echo "<script>alert('Log Out Successful!');window.location='../index.php'</script>";
        } else {
            echo "<script>alert('Error!');window.location='../homePage.php?userid=".$id."'</script>";
        }
?>