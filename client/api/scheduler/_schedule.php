<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $userid = $_REQUEST["userid"];

    $sql = "SELECT * FROM alagapp_db.tbl_scheduler WHERE userid = ".$userid." ";

    try{
    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $sched_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){

            $pet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$row['petid']." ";
            $respet = $connect->prepare($pet);
            $respet->execute();
            $rowpet = $respet->fetch(PDO::FETCH_ASSOC);

            $sched_arr[] = array(
                "qid" =>$row['qid'],
                "petname" => $rowpet['petname'],
                "pettype" => $rowpet['pettype'],
                "petbreed" => $rowpet['petbreed'],
                "qdescription" => $row['qdescription'],
                "qdate" => $row['qdate'],
                "userid" => $row['userid'],
                "qstatus" => $row['qstatus']
            );
        }
           echo json_encode($sched_arr);
        }
    } catch(PDOException $e){
        die("An error occured!" . $e);
    };

?>
