<?php
    include("./connector.php");
    $pet = $_GET['petid'];

    $sqlrec = "SELECT * FROM alagapp_db.tbl_record WHERE petid = ".$pet." ORDER BY rid DESC";

    $reso = $connect->prepare($sqlrec);
    $reso->execute();

    $pet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE petid = ".$pet."";

    $pres = $connect->prepare($pet);
    $pres->execute();
    $prow = $pres->fetch(PDO::FETCH_ASSOC);
?>
    <div class="row m-auto"><div class="col-6">
        <label class="fw-bold fs-3">Pet Name: <?php echo $prow['petname'];?></label>
    </div>

    <div class='col-6'>
        <button type='button' class='p-2 btn btn-info w-100' onClick='recordNew(<?php echo $pet; ?>)' data-bs-toggle='modal' data-bs-target='#newModal')>
        <i class='bi bi-plus-square'></i> Add New Record</button>
    </div></div>
    <div class="p-2">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Weight</th>
                <th>Temp.</th>
                <th>History</th>
                <th>Treatment</th>
                <th>Vet</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($reso->rowCount()>0){
                    $i=1;
                    while($r = $reso->fetch(PDO::FETCH_ASSOC)){
                        echo"<tr>
                        <td>".date("M d, Y", strtotime($r['rdate']))."</td>
                        <td>".$r['rweight']."</td>
                        <td>".$r['rtemp']."</td>
                        <td>".$r['rhistory']."</td>
                        <td>".$r['rtreatment']."</td>
                        <td>".$r['rvet']."</td>
                        <td>
                            <button type='button' class='btn btn-warning rounded flex-end' onClick='recordEdit(".$r['rid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
                            <i class='bi bi-pencil-square'></i></button>
                        </td>
                        </tr>";
                        $i++;
                    }

                }
            ?>
        </tbody>
        </table>
    </div>