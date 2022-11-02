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
    // Total Card Issued
    // Total Vaccine Administered
    // Pet to Card Ratio
    // Total Notes
    // Pet to Note Ratio
    // Total Active Notes
    // Total Inactive Notes
    // Active to Inactive Notes Ratio
    // Total Schedule
    // Pet to Sched Ratio
    // AM to PM Sched Ratio
    // Total Pending
    // Total Accepted
    // Total Denied
    // Total Cancelled
    // Total Finished
    // Total Chat Count
    // Total Call Count
    // Total Voice Call
    // Total Video Call
    // Voice to Video Call Ratio

?>