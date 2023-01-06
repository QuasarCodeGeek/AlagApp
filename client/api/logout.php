<?php
    require("./_connector.php");

        $id = $_REQUEST['userid'];
        $session = 0;
        $timeout = date("Y-m-d h:i:sa");
        $set_Session = "UPDATE alagapp_db.tbl_session SET
            session_out = :session_out,
            status = :status

            WHERE userid = :userid";

        $values = array(
            ":userid" => $id,
            ":session_out"=>$timeout,
            ":status" => $session
        );

        $result = $connect->prepare($set_Session);
        $result->execute($values);
        if($result->rowCount()>0){
            echo "<script>window.location='../index.php'</script>";
        }
?>