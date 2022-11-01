<?php
    require("../API/connector.php");
    $hanap = $_GET["search"];
    $search = "SELECT * FROM alagapp_db.tbl_vaxxcard WHERE 
        userid LIKE '%".$hanap."%' OR 
        petid LIKE '%".$hanap."%' OR
        vaxid LIKE '%".$hanap."%' OR
        fdose LIKE '%".$hanap."%' OR
        sdose LIKE '%".$hanap."%' OR
        booster LIKE '%".$hanap."%'";
    $research = $connect->query($search);
    $research->execute();

    $join1 = "SELECT alagapp_db.tbl_userlist.userfname
    FROM alagapp_db.tbl_vaxxcard
    INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_vaxxcard.userid = alagapp_db.tbl_userlist.userid";
    $entry1 = $connect->query($join1);
    $entry1->execute();

    $join2 = "SELECT alagapp_db.tbl_petprofile.petname
    FROM alagapp_db.tbl_vaxxcard
    INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_vaxxcard.petid = alagapp_db.tbl_petprofile.petid";
    $entry2 = $connect->query($join2);
    $entry2->execute();

    $join3 = "SELECT alagapp_db.tbl_vaxxinfo.vaxname
    FROM alagapp_db.tbl_vaxxcard
    INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_vaxxcard.vaxid = alagapp_db.tbl_vaxxinfo.vaxid";
    $entry3 = $connect->query($join3);
    $entry3->execute();
?>
<div class="container mx-auto row">
<?php
    if($research->rowCount()>0 && $entry1->rowCount()>0 && $entry2->rowCount()>0 && $entry3->rowCount()>0){
        $i=1;
        while($rowsearch = $research->fetch(PDO::FETCH_ASSOC)){
            $rowentry1 = $entry1->fetch(PDO::FETCH_ASSOC);
            $rowentry2 = $entry2->fetch(PDO::FETCH_ASSOC);
            $rowentry3 = $entry3->fetch(PDO::FETCH_ASSOC);
        echo
        "<div class='card m-1 p-1 col-flex' style='width: 12rem;'>
            <div class='card-body'>
                <button type='button' class='btn btn-outline-success w-100' onClick='cardEdit(".$rowsearch['cid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$rowentry2['petname']."</h6></button><br><br>
                <label class='card-text float-start' style='font-size: 12px;'>Owner:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowentry1['userfname']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Vaccine:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowentry3['vaxname']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>1st Dose:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['fdose']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>2nd Dose:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['sdose']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Booster:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['booster']."</strong>
            </div>
        </div>";
        $i++;
        }
    }  else {
        echo "
        </div>";
    }
?>
