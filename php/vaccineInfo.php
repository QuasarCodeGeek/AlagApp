<?php
    require("API/connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_vaxxinfo";

    $res = $connect->prepare($sql);
    $res->execute();

?>
<div class="container mx-auto row">
<?php
    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo
            "<div class='card m-1 p-1 ol-flex' style='width: 12rem;'>
            <div class='card-body'>
            <button type='button' class='btn btn-success w-100' onClick='vaccineEdit(".$row['vaxid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')><h6 class='card-title'>".$row['vaxname']."</h6></button><br><br>
            <label class='card-text float-start' style='font-size: 12px;'>Type:</label><strong class='card-text float-end' style='font-size: 12px;'>".$row['vaxtype']."</strong><br>
            <label class='card-text float-start' style='font-size: 12px;'>Brand:</label><strong class='card-text float-end' style='font-size: 12px;'>".$row['vaxbrand']."</strong><br>
            <label class='card-text float-start' style='font-size: 12px;'>Stock:</label><strong class='card-text float-end' style='font-size: 12px;'>".$row['vaxused']."</strong>
        </div>
        </div>";
        $i++;
        }
    }  else {
        echo "
        </div>";
    }
?>