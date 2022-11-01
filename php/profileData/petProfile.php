<?php
    require("../connector.php");

    $account = $_GET["userid"];
    $sql = "SELECT * FROM alagapp_db.tbl_petprofile
        WHERE userid = ".$account." ";

    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo"
            <div class='row m-1 p-1 bg bg-primary'>
                <div class='col-6 bg bg-info'>
                    <img class='userProfile' src='assets/img/albedo.png' alt='profile_picture'><br>
                    <button type='button' class='btn' onClick='petEdit(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit Pet</button>
                </div>
                <div class='col-6 bg bg-warning'>
                    <label>Name: ".$row['petname']."</label><br>
                    <label>Species: ".$row['pettype']."</label><br>
                    <label>Breed: ".$row['petbreed']."</label><br>
                    <label>Gender: ".$row['petgender']."</label><br>
                    <label>DOP: ".$row['petbdate']."</label><br>
                    <label>Age: ".$row['petage']."</label><br>
                    <label>Weight(Kg): ".$row['petweight']."</label><br>
                    <label>Height(Ft): ".$row['petheight']."</label>
                </div>
            </div><br>

            <div class='row'>
            <div class='col-6'>";
            
            $vax = "SELECT alagapp_db.tbl_vaxxcard.cid,
                alagapp_db.tbl_vaxxcard.petid,
                alagapp_db.tbl_vaxxcard.vaxid,
                alagapp_db.tbl_vaxxinfo.vaxname,
                alagapp_db.tbl_vaxxcard.fdose,
                alagapp_db.tbl_vaxxcard.sdose,
                alagapp_db.tbl_vaxxcard.booster 
                FROM alagapp_db.tbl_vaxxcard
                INNER JOIN alagapp_db.tbl_vaxxinfo ON alagapp_db.tbl_vaxxcard.vaxid = alagapp_db.tbl_vaxxinfo.vaxid
                WHERE petid = ".$row['petid']."";

                $resvax = $connect->prepare($vax);
                $resvax->execute();

                if($resvax->rowCount()>0){
                    $j=1;
                    while($rowvax = $resvax->fetch(PDO::FETCH_ASSOC)){
                    echo"
                        <div class='row m-1 p-1 bg bg-primary'>
                        <button type='button' class='btn' onClick='cardEdit(".$rowvax['cid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit</button>
            
                        <label>Vaccine: ".$rowvax['vaxname']."</label><br>
                        <label>First Dose: ".$rowvax['fdose']."</label><br>
                        <label>Second Dose: ".$rowvax['sdose']."</label><br>
                        <label>Booster: ".$rowvax['booster']."</label>
                        </div><br>";
                        $j++;
                    }
                    echo "<button type='button' class='btn' onClick='cardNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Add Vaccination</button>";
                } else {
                    echo "No Record<br>";
                    echo "<button type='button' class='btn' onClick='cardNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Add Vaccination</button>";
                }

            echo "</div>
            <div class='col-6'>";
            $note = "SELECT * FROM alagapp_db.tbl_notedetail
                WHERE petid = ".$row['petid']."";

                $resnote = $connect->prepare($note);
                $resnote->execute();

                if($resnote->rowCount()>0){
                    $p=1;
                    while($rownote = $resnote->fetch(PDO::FETCH_ASSOC)){
                    echo"
                        <div class='row m-1 p-1 bg bg-success'>
                        <button type='button' class='btn' onClick='prescriptionEdit(".$rownote['nid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit</button>
            
                        <label>Description: ".$rownote['ndescription']."</label><br>
                        <label>Date Issued: ".$rownote['ndate']."</label><br>
                        <label>Status: ".$rownote['nstatus']."</label>
                        </div><br>";
                        $p++;
                    }
                    echo "<button type='button' class='btn' onClick='prescriptionNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Add Prescription</button>";
                } else {
                    echo "No Record<br>";
                    echo "<button type='button' class='btn' onClick='prescriptionNew()' data-bs-toggle='modal' data-bs-target='#newModal')>Add Prescription</button>";
                }

            echo "</div>
            </div>
            <br>";
            $i++;
        }
    } else {
        echo "No Record";
    }
?>