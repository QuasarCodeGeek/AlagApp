<?php
    require("./api/connector.php");
    /*$check = "SELECT * FROM alagapp_db.tbl_admin WHERE adminid = 1 AND session = 1";
        $checkSession = $connect->prepare($check);
        $checkSession->execute();
        if($checkSession->rowCount()>0){
          $wel = $checkSession->fetch(PDO::FETCH_ASSOC);
          
        } else {
          echo "<script>window.location='./index.php'</script>";
        }*/
        

    $sql = "UPDATE alagapp_db.tbl_admin SET
                session = '0'

                WHERE adminid = 1";

            $result = $connect->prepare($sql);
            $result->execute();

            if($result->rowCount()>0) {
                echo "<script>window.location='./index.php'</script>";//Successfully Logged Out
             } else {
                 echo "<script>window.location='./account.php'</script>";//Log Out Error
             }
?>