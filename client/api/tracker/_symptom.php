<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $type = $_REQUEST['pettype'];
    $body = $_REQUEST['bodypart'];
    $symptom = $_REQUEST['symptom'];

    $sql = "SELECT * FROM alagapp_db.tbl_symptom WHERE pettype LIKE '%".$type."%' AND
    bodypart LIKE '%".$body."%' AND
    symptom LIKE '%".$symptom."%' ";

    try{
    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $data_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            $data_arr[] = array(
                "sid" =>$row['sid'],
                "pettype" => $row['pettype'],
                "bodypart" => $row['bodypart'],
                "symptom" => $row['symptom'],
                "diagnosis" => $row['diagnosis'],
                "description" => $row['description']
            );
        }
           echo json_encode($data_arr);
        }
    } catch(PDOException $e){
        die("An error occured!" . $e);
    };

?>
