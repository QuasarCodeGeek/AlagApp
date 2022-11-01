<?php
    require("../API/connector.php");
    $hanap = $_GET["search"];
    $search = "SELECT * FROM alagapp_db.tbl_vaxxinfo WHERE 
        vaxname LIKE '%".$hanap."%' OR 
        vaxtype LIKE '%".$hanap."%' OR
        vaxbrand LIKE '%".$hanap."%' OR
        vaxused LIKE '%".$hanap."%'";
    $research = $connect->query($search);
    $research->execute();

?>
<div class="container mx-auto row">
<?php
    if($research->rowCount()>0){
        $i=1;
        while($rowsearch = $research->fetch(PDO::FETCH_ASSOC)){
        echo
        "<div class='card m-1 p-1 col-flex' style='width: 12rem;'>
            <div class='card-body'>
                <button type='button' class='btn btn-outline-success w-100' onClick='vaccineEdit(".$rowsearch['vaxid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$rowsearch['vaxname']."</h6></button><br><br>
                <label class='card-text float-start' style='font-size: 12px;'>Type:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['vaxtype']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Brand:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['vaxbrand']."</strong><br>
                <label class='card-text float-start' style='font-size: 12px;'>Stock:</label><strong class='card-text float-end' style='font-size: 12px;'>".$rowsearch['vaxused']."</strong>
            </div>
        </div>";
        $i++;
        }
    }  else {
        echo "
        </div>";
    }
?>
