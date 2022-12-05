<?php
    require("connector.php");

    // User Analytics
    // Total User
    $tuser = "SELECT COUNT(userid) AS totaluser FROM alagapp_db.tbl_userlist";
    $restuser = $connect->query($tuser);
    $restuser->execute();
    $rowtuser = $restuser->fetch(PDO::FETCH_ASSOC);
    $totaluser = $rowtuser["totaluser"];
    // Total Male User
    $totalmale = "SELECT COUNT(usergender) AS male FROM alagapp_db.tbl_userlist WHERE usergender LIKE 'M'";
    $resmaleuser = $connect->query($totalmale);
    $resmaleuser->execute();
    $rowmaleuser = $resmaleuser->fetch(PDO::FETCH_ASSOC);
    $maleuser = $rowmaleuser["male"];
    // Total Female User
    $totalfemale = "SELECT COUNT(usergender) AS female FROM alagapp_db.tbl_userlist WHERE usergender LIKE 'F'";
    $resfemaleuser = $connect->query($totalfemale);
    $resfemaleuser->execute();
    $rowfemaleuser = $resfemaleuser->fetch(PDO::FETCH_ASSOC);
    $femaleuser = $rowfemaleuser["female"];
    // Male to Female User Ratio
    $userratio = "SELECT 
        sum(case when `usergender` = 'M' then 1 else 0 end)/count(*)*100 as maleratio,
        sum(case when `usergender` = 'F' then 1 else 0 end)/count(*)*100 as femaleratio
        FROM alagapp_db.tbl_userlist";
    $resuserratio = $connect->query($userratio);
    $resuserratio->execute();
    $rowuserratio = $resuserratio->fetch(PDO::FETCH_ASSOC);
    $ratiomale = $rowuserratio["maleratio"];
    $ratiofemale = $rowuserratio["femaleratio"];

    $roundm = "SELECT ROUND(".$ratiomale.", 2) AS RoundM";
    $roundf = "SELECT ROUND(".$ratiofemale.", 2) AS RoundF;";
    $resmround = $connect->query($roundm);
    $resfround = $connect->query($roundf);
    $resmround->execute();
    $resfround->execute();
    $rowmround = $resmround->fetch(PDO::FETCH_ASSOC);
    $rowfround = $resfround->fetch(PDO::FETCH_ASSOC);
    $rmale = $rowmround["RoundM"];
    $rfemale = $rowfround["RoundF"];
    // Pet Analytics
    // Total Pet Account
    $tpet = "SELECT COUNT(petid) AS totalpet FROM alagapp_db.tbl_petprofile";
    $restpet = $connect->query($tpet);
    $restpet->execute();
    $rowtpet = $restpet->fetch(PDO::FETCH_ASSOC);
    $totalpet = $rowtpet["totalpet"];
    // Owner to Pet Ratio
    // Ratio formula r=(m/f)*100
    /*$petratio = "SELECT 
        sum(case when `petgender` = 'M' then 1 else 0 end)/count(*)*100 as male_ratio,
        sum(case when `petgender` = 'F' then 1 else 0 end)/count(*)*100 as female_ratio
        FROM alagapp_db.tbl_petprofile";
    $respetratio = $connect->query($petratio);
    $respetratio->execute();
    $rowpetratio = $respetratio->fetch(PDO::FETCH_ASSOC);
    $maleratio = $rowpetratio["totaluser"];
    $femaleratio = $rowpetratio["totaluser"];*/
    // Total Boy Pets
    $tboy = "SELECT COUNT(petgender) AS boy FROM alagapp_db.tbl_petprofile WHERE petgender LIKE 'M'";
    $restboy = $connect->query($tboy);
    $restboy->execute();
    $rowtboy = $restboy->fetch(PDO::FETCH_ASSOC);
    $boypet = $rowtboy["boy"];
    // Total Girl Pets
    $tgirl = "SELECT COUNT(petgender) AS girl FROM alagapp_db.tbl_petprofile WHERE petgender = 'F'";
    $restgirl = $connect->query($tgirl);
    $restgirl->execute();
    $rowtgirl = $restgirl->fetch(PDO::FETCH_ASSOC);
    $girlpet = $rowtgirl["girl"];
    // Girl to Boy Ratio
    // Ratio formula r=(m/f)*100
    $petratio = "SELECT 
        sum(case when `petgender` = 'M' then 1 else 0 end)/count(*)*100 as male_ratio,
        sum(case when `petgender` = 'F' then 1 else 0 end)/count(*)*100 as female_ratio
        FROM alagapp_db.tbl_petprofile";
    $respetratio = $connect->query($petratio);
    $respetratio->execute();
    $rowpetratio = $respetratio->fetch(PDO::FETCH_ASSOC);
    $maler = $rowpetratio["male_ratio"];
    $femaler = $rowpetratio["female_ratio"];

    $roundmale = "SELECT ROUND(".$maler.", 2) AS RoundMale";
    $roundfemale = "SELECT ROUND(".$femaler.", 2) AS RoundFemale;";
    $resroundm = $connect->query($roundmale);
    $resroundf = $connect->query($roundfemale);
    $resroundm->execute();
    $resroundf->execute();
    $rowroundm = $resroundm->fetch(PDO::FETCH_ASSOC);
    $rowroundf = $resroundf->fetch(PDO::FETCH_ASSOC);
    $maleratio = $rowroundm["RoundMale"];
    $femaleratio = $rowroundf["RoundFemale"];
    // Total Vaccine Info
    $tvaxinfo = "SELECT COUNT(vaxid) AS totalvax FROM alagapp_db.tbl_vaxxinfo";
    $resvaxinfo = $connect->query($tvaxinfo);
    $resvaxinfo->execute();
    $rowvaxinfo = $resvaxinfo->fetch(PDO::FETCH_ASSOC);
    $totalvaxinfo = $rowvaxinfo["totalvax"];
    // Total Card Issued
    $tcard = "SELECT COUNT(cid) AS totalcard FROM alagapp_db.tbl_vaxxcard";
    $rescard = $connect->query($tcard);
    $rescard->execute();
    $rowcard = $rescard->fetch(PDO::FETCH_ASSOC);
    $totalcard = $rowcard["totalcard"];
    // Total Vaccine Administered
    $tvax = "SELECT COUNT(vaxid) AS totalvaccine FROM alagapp_db.tbl_vaxxcard";
    $resvax = $connect->query($tvax);
    $resvax->execute();
    $rowvax = $resvax->fetch(PDO::FETCH_ASSOC);
    $totalvax = $rowvax["totalvaccine"];
    // Pet to Card Ratio
    // Total Notes
    $tnote = "SELECT COUNT(nid) AS totalnote FROM alagapp_db.tbl_notedetail";
    $resnote = $connect->query($tnote);
    $resnote->execute();
    $rownote = $resnote->fetch(PDO::FETCH_ASSOC);
    $totalnote = $rownote["totalnote"];
    // Pet to Note Ratio
    // Total Active Notes
    // Total Inactive Notes
    // Active to Inactive Notes Ratio
    // Total Schedule
    $tsched = "SELECT COUNT(qid) AS totalsched FROM alagapp_db.tbl_scheduler";
    $ressched = $connect->query($tsched);
    $ressched->execute();
    $rowsched = $ressched->fetch(PDO::FETCH_ASSOC);
    $totalsched = $rowsched["totalsched"];
    // Pet to Sched Ratio
    // AM to PM Sched Ratio
    // Total Pending
    $tpending = "SELECT COUNT(qstatus) AS totalpending FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Pending'";
    $respending = $connect->query($tpending);
    $respending->execute();
    $rowpending = $respending->fetch(PDO::FETCH_ASSOC);
    $totalpending = $rowpending["totalpending"];
    // Total Accepted
    $taccepted = "SELECT COUNT(qstatus) AS totalaccepted FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Accepted'";
    $resaccepted = $connect->query($taccepted);
    $resaccepted->execute();
    $rowaccepted = $resaccepted->fetch(PDO::FETCH_ASSOC);
    $totalaccepted = $rowaccepted["totalaccepted"];
    // Total Denied
    $tdenied = "SELECT COUNT(qstatus) AS totaldenied FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Denied'";
    $resdenied = $connect->query($tdenied);
    $resdenied->execute();
    $rowdenied = $resdenied->fetch(PDO::FETCH_ASSOC);
    $totaldenied = $rowdenied["totaldenied"];
    // Total Cancelled
    $tcancelled = "SELECT COUNT(qstatus) AS totalcancelled FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Cancelled'";
    $rescancelled = $connect->query($tcancelled);
    $rescancelled->execute();
    $rowcancelled = $rescancelled->fetch(PDO::FETCH_ASSOC);
    $totalcancelled = $rowcancelled["totalcancelled"];
    // Total Finished
    $tfinished = "SELECT COUNT(qstatus) AS totalfinished FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Finished'";
    $resfinished = $connect->query($tfinished);
    $resfinished->execute();
    $rowfinished = $resfinished->fetch(PDO::FETCH_ASSOC);
    $totalfinished = $rowfinished["totalfinished"];
    // Total Chat Count
    $tchat = "SELECT COUNT(mid) AS totalchat FROM alagapp_db.tbl_chat";
    $reschat = $connect->query($tchat);
    $reschat->execute();
    $rowchat = $reschat->fetch(PDO::FETCH_ASSOC);
    $totalchat = $rowchat["totalchat"];
    // Total Call Count
    // Total Voice Call
    // Total Video Call
    // Voice to Video Call Ratio
    // Total Dog
    $dog = "SELECT COUNT(pettype) AS dog FROM alagapp_db.tbl_petprofile WHERE pettype LIKE 'Dog'";
    $resdog = $connect->query($dog);
    $resdog->execute();
    $rowdog = $resdog->fetch(PDO::FETCH_ASSOC);
    $totaldog = $rowdog["dog"];
    // Total Cat
    $cat = "SELECT COUNT(pettype) AS cat FROM alagapp_db.tbl_petprofile WHERE pettype LIKE 'Cat'";
    $rescat = $connect->query($cat);
    $rescat->execute();
    $rowcat = $rescat->fetch(PDO::FETCH_ASSOC);
    $totalcat = $rowcat["cat"];
    // Total Mouse
    $mouse = "SELECT COUNT(pettype) AS mouse FROM alagapp_db.tbl_petprofile WHERE pettype LIKE 'Mouse'";
    $resmouse = $connect->query($mouse);
    $resmouse->execute();
    $rowmouse = $resmouse->fetch(PDO::FETCH_ASSOC);
    $totalmouse = $rowmouse["mouse"];
    $bird = "SELECT COUNT(pettype) AS bird FROM alagapp_db.tbl_petprofile WHERE pettype LIKE 'Bird'";
    $resbird = $connect->query($bird);
    $resbird->execute();
    $rowbird = $resbird->fetch(PDO::FETCH_ASSOC);
    $totalbird = $rowbird["bird"];
?>