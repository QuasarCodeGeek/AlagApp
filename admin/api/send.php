<?php
    require("connector.php");
    session_start();
    if(isset($_POST['sms'])){
        $d=strtotime("tomorrow");
        $tomorrow = date("Y-m-d", $d);

        $sql = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.*, alagapp_db.tbl_petprofile.petname
        FROM ((alagapp_db.tbl_scheduler
        INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
        INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
        WHERE qdate = '".$tomorrow."'";
                
        $res = $connect->prepare($sql);
        $res->execute();

        if($res->rowCount()>0){
            while($row = $res->fetch(PDO::FETCH_ASSOC)){
                $qid = $row['qid'];
                $number = $row['usermobile'];
                $owner = $row['userfname']." ".$row['userlname'];
                $pet = $row['petname'];
                $date = $row['qdate'];
                $time = $row['qtime'];
                $msg = "Good day ".$owner."! Your appointment is set on ".date("M d, Y", strtotime($date)).". Thank you!";
            
                /*$url = "https://api.itexmo.com/api/broadcast";
                $data = array(
                    "Email"=> "jaysonreyes.jsr11@gmail.com",
                    "Password"=> "jsr111100",
                    "Recipients"=> ["$number"],
                    "Message"=> $msg,
                    "ApiCode"=> "TR-JAYCE366810_UB1FG",
                    "SenderId"=> "ITEXMO SMS"
                );

                $options = array(
                    "http" => array(
                        "method" => "POST",
                        "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                        "content" => http_build_query($data)
                    )
                );

                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);

                if ($result === FALSE) {
                    $_SESSION["trigger"]="failed";
                    echo "<script>window.location='sched_chrono.php'</script>";
                }*/
                //echo $result;

                $date = date("Y-m-d");
                $time = date("h:s:i");

                $insert = "INSERT INTO alagapp_db.tbl_sms (qid, xtime, xdate) VALUES (:qid, :xtime, :xdate)";
                $ress = $connect->prepare($insert);
                $val = array(
                    ":qid"=>$qid,
                    ":xtime"=>$time,
                    ":xdate"=>$date
                );
                $ress->execute($val);

                $_SESSION["trigger"]="success";
                echo "<script>window.location='sched_chrono.php'</script>";
            }
        } else {
            $_SESSION["trigger"]="failed";
            echo "<script>window.location='sched_chrono.php'</script>";
        }
    } else {
        $_SESSION["trigger"]="failed";
        echo "<script>window.location='sched_chrono.php'</script>";
    } 
?>