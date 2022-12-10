<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $petid = $_REQUEST["petid"];

    $sql = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$petid." ";

    try{
    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $pet_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            $pet_arr[] = array(
                "petid" => $row['petid'],
                "userid" => $row['userid'],
                "petname" =>$row['petname'],
                "pettype"=> $row['pettype'],
                "petbreed" => $row['petbreed'],
                "petweight" => $row['petweight'],
                "petheight" => $row['petheight'],
                "petbdate" => $row['petbdate'],
                "petage"=> $row['petage'],
                "petgender" => $row['petgender']
            );
        }
           echo json_encode($pet_arr);
        }
    } catch(PDOException $e){
        die("An error occured!" . $e);
    };

?>
