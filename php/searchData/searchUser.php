<?php
    require("../API/connector.php");
    $hanap = $_GET["search"];
    $search = "SELECT * FROM alagapp_db.tbl_userlist WHERE 
        userfname LIKE '%".$hanap."%' OR 
        usermname LIKE '%".$hanap."%' OR
        userlname LIKE '%".$hanap."%' OR
        userdistrict LIKE '%".$hanap."%' OR
        usermunicipality LIKE '%".$hanap."%' OR
        userprovince LIKE '%".$hanap."%' OR
        useremail LIKE '%".$hanap."%'";
    $research = $connect->query($search);
    $research->execute();

?>
<div class="container mx-auto row">
<?php
    if($research->rowCount()>0){
        $i=1;
        while($rowsearch = $research->fetch(PDO::FETCH_ASSOC)){
        echo
        "<div class='card m-1 p-1 ol-flex' style='width: 12rem;'>
            <div class='card-body'>
                <button type='button' class='btn btn-outline-success w-100' onClick='userEdit(".$rowsearch['userid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$rowsearch['userfname']."</h6></button><br>
                <label class='card-text float-start' style='font-size: 12px;'>Middle Name:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['usermname']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Surname:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['userlname']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>B-Date:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['userbdate']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Gender:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['usergender']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Street:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['userstreet']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Barangay:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['userdistrict']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Municipality:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['usermunicipality']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Province:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['userprovince']."</strong><br>
            </div>
        </div>";
        $i++;
        }
    }  else {
        echo "
        </div>";
    }
?>
