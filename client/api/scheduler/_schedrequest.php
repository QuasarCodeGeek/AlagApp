<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

        $user = $_REQUEST["userid"];
        $petname = $_REQUEST["pet"];
        $reason = $_REQUEST["reason"];
        $comment = $_REQUEST["comment"];
        $date = $_REQUEST["date"];
        $status = $_REQUEST["status"];

        $sql = "INSERT INTO alagapp_db.tbl_scheduler(
                petid,
                userid,
                qdescription,
                qdate,
                qstatus)
                VALUES(
                    :petid,
                    :userid,
                    :qdescription,
                    :qdate,
                    :qstatus)";

    try {
        $description = $reason." ".$comment;

        $pet = "SELECT petid FROM alagapp_db.tbl_petprofile WHERE userid = ".$user." AND petname = '".$petname."' ";
        $res = $connect->prepare($pet);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $petid = $row['petid'];

        $result = $connect->prepare($sql);
        $values = array(
            ":petid" => $petid,
            ":userid" => $user,
            ":qdescription" => $description,
            ":qdate" => $date,
            ":qstatus" => $status
        );
        $result->execute($values);
        echo json_encode(array("message"=>"success"));
    } catch(PDOException $e) {
        die ("An error has occured!" . $e);
    }
