<?php
    $account = $_GET["userid"];
    $sql = "SELECT * FROM alagapp_db.tbl_userlistWHERE userid = ".$account." ";
    $res = $connect->prepare($sql);
    $res->execute();

    $sql = "SELECT * FROM alagapp_db.tbl_userlist";          
    $res = $connect->prepare($sql);
    $res->execute();

    $sql2 = "SELECT COUNT(userid) AS entry FROM alagapp_db.tbl_userlist";
    $res2 = $connect->query($sql2);
    $res2->execute();
    $row1 = $res2->fetch(PDO::FETCH_ASSOC);


?>