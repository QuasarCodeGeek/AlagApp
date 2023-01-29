<?php
    require("./api/_connector.php");
    $notif = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_petprofile.* FROM alagapp_db.tbl_scheduler 
    INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid
    WHERE alagapp_db.tbl_scheduler.userid = ".$user." AND qset = '1' ORDER BY qdate DESC, qtime DESC";
    $setres = $connect->query($notif);
    $setres->execute();

    if($setres->rowCount()>0){
        $i=1;
        echo "<div class='row m-auto my-2'><div class='bg bg-success rounded p-2 text-center'>
            <label class='text-white'>What's New?</label>
        </div></div>";
        while($setrow = $setres->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='card p-2 m-2'>
                <div class='border border-2 border-success rounded'>
                    <div class='row m-auto'>
                        <label class='fw-bold text-center text-success'>You have a new schedule!</label>
                    </div>
                    <div class='row m-auto'>
                        <label class='col flex-start fw-bold text-success m-2'>Pet: ".$setrow['petname']."</label>
                        <label class='col flex-end m-2'>".date("H:s a",strtotime($setrow['qtime']))." ".date("M d, Y",strtotime($setrow['qdate']))." </label>
                    </div>
                    <div class='row m-auto'>
                        <span class='text-center'>Service: ".$setrow['qdescription']."</span>
                    </div>
                </div>
                <div class='row m-auto'>
                    <form action='api/removeNotif.php' method='POST'>
                        <input type='text' name='qid' value='".$setrow['qid']."' hidden>
                        <input type='text' name='userid' value='".$setrow['userid']."' hidden>
                        <button type='submit' name='submit' class='btn fw-bold text-success'>View Scheduler</button>
                    </form>
                </div>
            </div>";
            $i++;
        }
    }

?>