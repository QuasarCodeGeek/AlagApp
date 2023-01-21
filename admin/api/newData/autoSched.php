<?php

    $getuser = "SELECT userfname, userlname FROM alagapp_db.tbl_userlist WHERE userid = ".$user."";
    $resuser = $connect->prepare($getuser);
    $resuser->execute();
    $userrow = $resuser->fetch(PDO::FETCH_ASSOC);

    $getpet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE userid = ".$user." AND petid = ".$pet."";
    $respet = $connect->prepare($getpet);
    $respet->execute();
    $petrow = $respet->fetch(PDO::FETCH_ASSOC);

    $sqlvax = "SELECT * FROM alagapp_db.tbl_vaxxinfo WHERE vaxid = ".$vax."";
    $resvax = $connect->query($sqlvax);
    $resvax->execute();
    $vaxrow = $resvax->fetch(PDO::FETCH_ASSOC);

    $description = "".$petrow['petname']."'s ".$vaxrow['vaxname']." next due date.  ";
    $status = "Pending";
    $time = "09:30 am";

    $sql = "INSERT INTO alagapp_db.tbl_scheduler(
        userid,
        petid,
        qdescription,
        qtime,
        qdate,
        qstatus) VALUES(
            :userid,
            :petid,
            :qdescription,
            :qtime,
            :qdate,
            :qstatus)";

    $result = $connect->prepare($sql);

    $values = array(
        ":userid"=>$user,
        ":petid"=>$pet,
        ":qdescription"=>$description,
        ":qtime"=>$time,
        ":qdate"=>$next,
        ":qstatus"=>$status
    );

    $result->execute($values);

?>