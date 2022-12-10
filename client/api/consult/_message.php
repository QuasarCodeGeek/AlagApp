<?php
    header("Access-Control-Allow-Origin: *");

    require("_connector.php");

    $userid = $_REQUEST["userid"];
    $message = $_REQUEST["message"];

    if ($message != "") {
        $sql = "INSERT INTO alagapp_db.tbl_chat(
            mchannel,
            mdatetime,
            msender,
            mcontent,
            userid
            ) VALUES(
                :mchannel,
                :mdatetime,
                :msender,
                :mcontent,
                :userid)";
    
            try {
                $date = date("Y-m-d h:i:sa");
    
                $result = $connect->prepare($sql);
                $values = array(
                    ":mchannel" => $userid,
                    ":mcontent" => $message,
                    ":mdatetime" => $date,
                    ":msender" => $userid,
                    ":userid" => $userid,
                );
            
                $result->execute($values);
                echo json_encode(array("message"=>"success"));
        } catch(PDOException $e){
            die("An error occured!" . $e);
        };
    }

?>
