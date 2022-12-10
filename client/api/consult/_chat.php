<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $userid = $_REQUEST["userid"];

    $sql = "SELECT * FROM alagapp_db.tbl_chat WHERE userid = ".$userid." ";

    try{
    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $chat_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            $chat_arr[] = array(
                "mid" =>$row['mid'],
                "msender" => $row['msender'],
                "mcontent" => $row['mcontent'],
                "mdatetime" => $row['mdatetime'],
                "userid" => $row['userid']
            );
        }
           echo json_encode($chat_arr);
        }
    } catch(PDOException $e){
        die("An error occured!" . $e);
    };

?>
