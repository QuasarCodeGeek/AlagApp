<?php
    require("../API/connector.php");
    $hanap = $_GET["search"];
    $search = "SELECT * FROM alagapp_db.tbl_scheduler WHERE 
        userid LIKE '%".$hanap."%' OR 
        petid LIKE '%".$hanap."%' OR
        qdescription LIKE '%".$hanap."%' OR
        qdate LIKE '%".$hanap."%' OR
        qstatus LIKE '%".$hanap."%'";
    $research = $connect->query($search);
    $research->execute();

    $join1 = "SELECT alagapp_db.tbl_userlist.userfname
    FROM alagapp_db.tbl_scheduler
    INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_scheduler.userid = alagapp_db.tbl_userlist.userid";
    $entry1 = $connect->query($join1);
    $entry1->execute();

    $join2 = "SELECT alagapp_db.tbl_petprofile.petname
    FROM alagapp_db.tbl_scheduler
    INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid";
    $entry2 = $connect->query($join2);
    $entry2->execute();
?>
<div class="container mx-auto row">
<?php
    if($research->rowCount()>0 && $entry1->rowCount()>0 && $entry2->rowCount()>0){
        $i=1;
        while($rowsearch = $research->fetch(PDO::FETCH_ASSOC)){
            $rowentry1 = $entry1->fetch(PDO::FETCH_ASSOC);
            $rowentry2 = $entry2->fetch(PDO::FETCH_ASSOC);
        echo
        "<div class='card m-1 p-1 col-flex' style='width: 12rem;'>
            <div class='card-body'>
                <button type='button' class='btn btn-outline-success w-100' onClick='scheduleEdit(".$rowsearch['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$rowentry2['petname']."</h6></button><br><br>
                <label class='card-text float-start' style='font-size: 12px;'>Owner:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowentry1['userfname']."</strong><br>
                <p class='card-text float-start p-1 rounded w-100' style='font-size: 12px; background-color: #E8F5E9;'>Description:<br>".$rowsearch['qdescription']."</p><br>
                <label class='card-text float-start' style='font-size: 12px;'>Date:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['qdate']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Status:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['qstatus']."</strong>
            </div>
        </div>";
        $i++;
        }
    }  else {
        echo "
        </div>";
    }
?>
