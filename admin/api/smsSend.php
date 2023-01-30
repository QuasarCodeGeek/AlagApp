<?php
    require("connector.php");
        $d=strtotime("tomorrow");
        $tomorrow = date("Y-m-d", $d);

        $sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.*, alagapp_db.tbl_petprofile.petname
        FROM ((alagapp_db.tbl_scheduler
        INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
        INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
        WHERE qdate = '".$tomorrow."' ORDER BY qtime ASC";
                
        $res = $connect->prepare($sql);
        $res->execute();

        if($res->rowCount()>0){
            $i=1;
            $url = "https://api.itexmo.com/api/broadcast";
            $email = "jaysonreyes.jsr11@gmail.com";
            $password = "jsr111100";
            $api = "TR-JAYCE366810_UB1FG";
            $id = "ALAGAPP SMS";
            while($row = $res->fetch(PDO::FETCH_ASSOC)){
                $number = $row['usermobile'];
                $owner = $row['userfname']." ".$row['userlname'];
                $pet = $row['petname'];
                $date = $row['qdate'];
                $time = $row['qtime'];
                $msg = "Good day ".$owner."! Your appointment is set on ".date("M d, Y", strtotime($date)).". Thank you!";
                echo "
                <form action='".$url."?Email=".$email."&Password=".$password."&Recipients=[\"".$number."\"]&Message=".$msg."&ApiCode=".$api."&SenderId=".$id."' method='POST'>
                    <button type='submit' name='submit'>Send SMS</button>
                </form>";   
                $i++;     
            }    
        }
?>