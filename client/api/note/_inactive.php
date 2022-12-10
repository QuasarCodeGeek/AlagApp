<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $petid = $_REQUEST["petid"];

    $sql = "SELECT * FROM alagapp_db.tbl_notedetail WHERE petid = ".$petid." AND nstatus = 'Inactive' ";

    try{
    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $note_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            $note_arr[] = array(
                "nid" =>$row['nid'],
                "userid" => $row['userid'],
                "petid" => $row['petid'],
                "ndescription" =>$row['ndescription'],
                "ndate"=> $row['ndate'],
                "nstatus" => $row['nstatus']
            );
        }
           echo json_encode($note_arr);
        }
    } catch(PDOException $e){
        die("An error occured!" . $e);
    };

?>
