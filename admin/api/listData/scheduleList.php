<?php
    require("API/connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_scheduler";

    $res = $connect->prepare($sql);
    $res->execute();

    $sql2 = "SELECT COUNT(qid) AS entry FROM alagapp_db.tbl_scheduler";
    $res2 = $connect->query($sql2);
    $res2->execute();
    $row1 = $res2->fetch(PDO::FETCH_ASSOC);

    $sqlp = "SELECT COUNT(qstatus) AS pending FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Pending'";
    $resp = $connect->query($sqlp);
    $resp->execute();
    $rowp = $resp->fetch(PDO::FETCH_ASSOC);

    $sqla = "SELECT COUNT(qstatus) AS accepted FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Accepted'";
    $resa = $connect->query($sqla);
    $resa->execute();
    $rowa = $resa->fetch(PDO::FETCH_ASSOC);
    
    $sqld = "SELECT COUNT(qstatus) AS denied FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Denied'";
    $resd = $connect->query($sqld);
    $resd->execute();
    $rowd = $resd->fetch(PDO::FETCH_ASSOC);

    $sqlo = "SELECT COUNT(qstatus) AS done FROM alagapp_db.tbl_scheduler WHERE qstatus LIKE 'Done'";
    $reso = $connect->query($sqlo);
    $reso->execute();
    $rowo = $reso->fetch(PDO::FETCH_ASSOC);
?>
    <!-- <div class="nav">
        <label><a href="index.php"><button>Back</button></a></label>
        <label class="btn"><a href = "API/sched_new.php">Add Schedule</a><label><br>
        <label class="num">Number of Total Schedules: <?php echo $row1['entry'] ?></label><br>
        <label class="num">Number of Pending Schedules: <?php echo $rowp['pending'] ?></label><br>
        <label class="num">Number of Accepted Schedules: <?php echo $rowa['accepted'] ?></label><br>
        <label class="num">Number of Denied Schedules: <?php echo $rowd['denied'] ?></label><br>
        <label class="num">Number of Finished Schedules: <?php echo $rowo['done'] ?></label><br>
    </div> -->
<?php 
    echo "<table class='table table-striped'>
    <thead>
        <tr>
            <th scope='col'>Sched ID</th>
            <th scope='col'>User ID</th>
            <th scope='col'>Pet ID</th>
            <th scope='col'>Description</th>
            <th scope='col'>Queue Date</th>
            <th scope='col'>Status</th>
        </tr>
    </thead>
    <tbody>";

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "<tr scope='row'>
            <td>".$i."</td>
            <td>".$row['userid']."</td>
            <td>".$row['petid']."</td>
            <td>".$row['qdescription']."</td>
            <td>".$row['qdate']."</td>
            <td>".$row['qstatus']."</td>

            <td><button type='button' class='btn' onClick='scheduleEdit(".$row['qid'].")' data-bs-toggle='modal' data-bs-target='#boxModal')>Edit</button>
            <br>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan = '5'> No records found! </td></tr> </tbody>
        </table>";
    }
?>