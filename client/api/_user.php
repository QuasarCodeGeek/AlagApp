<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $userid = $_REQUEST["userid"];

    $sql = "SELECT * FROM alagapp_db.tbl_userlist WHERE userid = ".$userid." ";

    try{
    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $user_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            $user_arr[] = array(
                "userid" =>$row['userid'],
            );
        }
           echo json_encode($user_arr);
        }
    } catch(PDOException $e){
        die("An error occured!" . $e);
    };

?>
