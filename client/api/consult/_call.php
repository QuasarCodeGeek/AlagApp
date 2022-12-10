<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $userid = $_REQUEST["userid"];

    $sql = "SELECT * FROM alagapp_db.tbl_call WHERE userid = ".$userid." ";

    try{
    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $call_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            $call_arr[] = array(
                "vid" =>$row['vid'],
                "vtype" => $row['vtype'],
                "vdatetime" => $row['vdatetime'],
                "userid" => $row['userid']
            );
        }
           echo json_encode($call_arr);
        }
    } catch(PDOException $e){
        die("An error occured!" . $e);
    };

?>
