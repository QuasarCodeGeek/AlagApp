<?php
    include("./../connector.php");
    $owner = $_GET['userid'];

    $sqlrec = "SELECT * FROM alagapp_db.tbl_record WHERE userid = ".$owner." AND petid = ".$row['petid']."";

    $reso = $connect->prepare($sqlrec);
    $reso->execute();
?>
<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Pet Name Medical Record</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
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
                    <td>".$r['rdate']."</td>
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
</div>