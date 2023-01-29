<?php
    include("./connector.php");
    $pet = $_GET['petid'];

    $sqlrec = "SELECT * FROM alagapp_db.tbl_record WHERE petid = ".$pet."";

    $reso = $connect->prepare($sqlrec);
    $reso->execute();
?>

    <div class='col'>
        <button type='button' class='p-2 btn btn-info w-100' onClick='recordNew(<?php echo $pet; ?>)' data-bs-toggle='modal' data-bs-target='#newModal')>
        <i class='bi bi-plus-square'></i> Add New Record</button>
    </div>
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