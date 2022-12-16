<?php
    require("../_connector.php");

    if(isset($_POST["submit"])){
        $qid = $_POST["qid"];
        $user = $_POST["userid"];
        $status = "Cancelled";
                            
                        
        if($qid=="" || $status==""){
            echo "<script>alert('Invalid!');
            window.location='../../schedPage.php?userid=".$user."'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_scheduler SET
                qstatus = :qstatus

                WHERE qid = :qid";

            $values = array(
                ":qid"=>$qid,
                ":qstatus"=>$status
            );
                 
            $result = $connect->prepare($sql);
            $result->execute($values);
                            
            if($result->rowCount()>0) {
                echo "<script>alert('Schedule Cancelled!');
                window.location='../../schedPage.php?userid=".$user."'</script>";
            } else {
                echo "<script>alert('Unable to Cancel Schedule!');
                window.location='../../schedPage.php?userid=".$user."'</script>";
            }
        }
    }
?>
<form method="POST" action="api/sched/cancelSched.php">
    <?php
    $qid = $_REQUEST["qid"];

    $sql_sched = "SELECT * FROM alagapp_db.tbl_scheduler WHERE tbl_scheduler.qid = :qid";
    try{
        $sched_res = $connect->prepare($sql_sched);
        $value = array("qid"=>$qid);
        $sched_res->execute($value);

        $status = "";
        
        if($sched_res->rowCount()==1){
            $row = $sched_res->fetch(PDO::FETCH_ASSOC);

            $status = $row["qstatus"];
            $user = $row['userid'];
        }
    } catch(PDOException $e){
        echo $e;
        die("An error has occured!");
    }
    ?>
    <div class="form-group">
        <label class="form-label">Are you sure you want to cancel this schedule?</label><br>
        <label class="form-label">Cancelling this means you can't reschedule it and you will need to request for a new schedule.</label>
    </div>
    <div class="form-group">
        <input name="userid" type="text" value="<?php echo $user; ?>"  hidden></input>
        <input name="qid" type="text" value="<?php echo $qid; ?>"  hidden></input>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button name="submit" type="submit" class="btn btn-danger">Cancel</button>
    </div>
</form>