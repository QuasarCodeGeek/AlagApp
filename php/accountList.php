<?php
    require("connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_userlist";

    $res = $connect->prepare($sql);
    $res->execute();

    $sql2 = "SELECT COUNT(userid) AS entry FROM alagapp_db.tbl_userlist";
    $res2 = $connect->query($sql2);
    $res2->execute();
    $row1 = $res2->fetch(PDO::FETCH_ASSOC);

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "
            <li class='list-group-item bg bg-light'>
            <a type='button' class='btn' href='php/profile.php?userid=".$row['userid']."'>
            <label class='text-wrap'>".$row['userfname']." ".$row['userlname']."</label>
            </a>
            </li>";
            $i++;
        }
    } else {
        echo "Nothing follows";
    }
?>