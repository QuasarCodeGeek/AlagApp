<?php
    include("./connector.php");

    $sqlrec = "SELECT alagapp_db.tbl_sms.*, alagapp_db.tbl_scheduler.*, alagapp_db.tbl_userlist.*, alagapp_db.tbl_petprofile.petname
    FROM (((alagapp_db.tbl_sms
    INNER JOIN alagapp_db.tbl_scheduler ON alagapp_db.tbl_sms.qid = alagapp_db.tbl_scheduler.qid)
    INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid)
    INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid)
    ORDER BY xid DESC";

    $reso = $connect->prepare($sqlrec);
    $reso->execute();
?>

    <div class="p-2">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Owner</th>
                <th>Pet</th>
                <th>Description</th>
                <th>Appointment Date</th>
                <th>Date Time Sent</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($reso->rowCount()>0){
                    $i=1;
                    while($r = $reso->fetch(PDO::FETCH_ASSOC)){
                        echo"<tr>
                        <td>".$i."</td>
                        <td>".$r['userfname']." ".$r['userlname']."</td>
                        <td>".$r['petname']."</td>
                        <td>".$r['qdescription']."</td>
                        <td>".date("M d, Y", strtotime($r['qdate']))."</td>
                        <td>".date("M d, Y", strtotime($r['xdate']))." ".date("h:s:i a", strtotime($r['xtime']))."</td>
                        </tr>";
                        $i++;
                    }

                } else {
                    echo "<tr><td colspan=\"6\" class='text-center'>No Record</td></tr>";
                }
            ?>
        </tbody>
        </table>
    </div>