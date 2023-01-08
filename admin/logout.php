<?php
    require("./api/connector.php");

    $sql = "UPDATE alagapp_db.tbl_admin SET
                session = '0'

                WHERE adminid = 1";

            $result = $connect->prepare($sql);
            $result->execute();

            if($result->rowCount()>0) {
                echo "<script>alert('Successfully Logged Out!');
                window.location='./index.php'</script>";
             } else {
                 echo "<script>alert('Error!')
                 window.location='./account.php'</script>";
             }
?>