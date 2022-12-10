<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $petid = $_REQUEST["petid"];

    $sql = "SELECT * FROM alagapp_db.tbl_vaxxcard WHERE petid = ".$petid." ";

    try{
    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $card_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){

            $vax = "SELECT * FROM alagapp_db.tbl_vaxxinfo WHERE vaxid = ".$row['vaxid']." ";
            $resvax = $connect->prepare($vax);
            $resvax->execute();
            $vaxrow = $resvax->fetch(PDO::FETCH_ASSOC);

            $card_arr[] = array(
                "cid" =>$row['cid'],
                "userid" => $row['userid'],
                "petid" => $row['petid'],
                "vaxname" =>$vaxrow['vaxname'],
                "fdose"=> $row['fdose'],
                "sdose" => $row['sdose'],
                "booster" => $row['booster']
            );
        }
           echo json_encode($card_arr);
        }
    } catch(PDOException $e){
        die("An error occured!" . $e);
    };

?>
