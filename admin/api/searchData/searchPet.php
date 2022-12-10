<?php
    require("../API/connector.php");
    $hanap = $_GET["search"];
    $search = "SELECT * FROM alagapp_db.tbl_petprofile WHERE 
        petname LIKE '%".$hanap."%' OR 
        petbreed LIKE '%".$hanap."%' OR
        petweight LIKE '%".$hanap."%' OR
        petheight LIKE '%".$hanap."%' OR
        petbdate LIKE '%".$hanap."%' OR
        petage LIKE '%".$hanap."%' OR
        petgender LIKE '%".$hanap."%'";
    $research = $connect->query($search);
    $research->execute();

    $join = "SELECT alagapp_db.tbl_petprofile.petname, alagapp_db.tbl_petprofile.petbreed, alagapp_db.tbl_userlist.userfname
    FROM alagapp_db.tbl_petprofile
    INNER JOIN alagapp_db.tbl_userlist ON alagapp_db.tbl_petprofile.userid = alagapp_db.tbl_userlist.userid";

    $entry = $connect->query($join);
    $entry->execute();
?>
<div class="container mx-auto row">
<?php
    if($research->rowCount()>0 && $entry->rowCount()>0){
        $i=1;
        while($rowsearch = $research->fetch(PDO::FETCH_ASSOC)){
            $rowentry = $entry->fetch(PDO::FETCH_ASSOC);
        echo
        "<div class='card m-1 p-1 col-flex' style='width: 12rem;'>
            <div class='card-body'>
                <button type='button' class='btn btn-outline-success w-100' onClick='petEdit(".$rowsearch['petid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$rowsearch['petname']."</h6></button><br><br>
                <label class='card-text float-start' style='font-size: 12px;'>Owner:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowentry['userfname']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Breed:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['petbreed']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Weight(Kg):</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['petweight']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Height(Ft):</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['petheight']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Birth Date:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['petbdate']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Age:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['petage']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Gender:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['petgender']."</strong>
                </div>
        </div>";
        $i++;
        }
    }  else {
        echo "
        </div>";
    }
?>
