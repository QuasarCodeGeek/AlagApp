<?php
    require("../connector.php");

    $account = $_GET["account"];
    $search = "SELECT * FROM alagapp_db.tbl_userlist WHERE 
        userfname LIKE '%".$account."%' OR 
        userlname LIKE '%".$account."%' ";
    $res = $connect->query($search);
    $res->execute();

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "
            <li class='list-group-item list-group-item-light'>
            <a type='button' class='btn' onClick='showProfile(".$row['userid'].")'>
            <label>".$row['userfname']." ".$row['userlname']."</label>
            </a>
            </li>";
            $i++;
        }
    } else {
        echo " ";
    }
?>