<?php
    require("../_connector.php");

    if(isset($_POST["submit"])){
        $qid = $_POST["qid"];
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $status = $_POST["status"];
                            
                        
        if($user=="" || $pet=="" || $description=="" || $date=="" || $status==""){
            echo "<script>window.location='../../schedPage.php?userid=".$user."'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_scheduler SET
                userid = :userid,
                petid = :petid,
                qdescription = :qdescription,
                qdate = :qdate,
                qstatus = :qstatus

                WHERE qid = :qid";

            $values = array(
                ":qid"=>$qid,
                ":userid"=>$user,
                ":petid"=>$pet,
                ":qdescription"=>$description,
                ":qdate"=>$date,
                ":qstatus"=>$status
            );
                 
            $result = $connect->prepare($sql);
            $result->execute($values);
                            
            if($result->rowCount()>0) {
                echo "<script>window.location='../../schedPage.php?userid=".$user."'</script>";
            } else {
                echo "<script>window.location='../../schedPage.php?userid=".$user."'</script>";
            }
        }
    }
?>
<form method="POST" action="api/sched/editSched.php">
    <?php
    $qid = $_REQUEST["qid"];

    $sql_sched = "SELECT alagapp_db.tbl_scheduler.*, alagapp_db.tbl_petprofile.petname 
    FROM alagapp_db.tbl_scheduler
    INNER JOIN alagapp_db.tbl_petprofile ON alagapp_db.tbl_scheduler.petid = alagapp_db.tbl_petprofile.petid
    WHERE tbl_scheduler.qid = :qid";
    try{
        $sched_res = $connect->prepare($sql_sched);
        $value = array("qid"=>$qid);
        $sched_res->execute($value);

        $userid = "";
        $petid = "";
        $pet = "";
        $description = "";
        $date = "";
        $status = "";
        
        if($sched_res->rowCount()==1){
            $row = $sched_res->fetch(PDO::FETCH_ASSOC);

            $userid = $row["userid"];
            $petid = $row["petid"];
            $pet = $row["petname"];
            $description = $row["qdescription"];
            $date = $row["qdate"];
            $status = $row["qstatus"];
        }

        session_start();
        if($_SESSION["newsession"] !=  $userid+date("Ymd")){
        echo "<script>window.location='../../index.php'</script>";
        }
    } catch(PDOException $e){
        echo $e;
        die("An error has occured!");
    }
    ?>
    <div class="form-group">
        <label class="form-label">You can only edit once and when</label>
    </div>
    <div class="form-group">
        <input name="qid" type="text" value="<?php echo $qid; ?>"  hidden></input>
        <input name="userid" type="text" value="<?php echo $userid; ?>"  hidden></input>
    </div>
    <div class="form-group">
        <label class="form-label">Pet</label>
        <select name="petid" class="form-select">
            <option selected value="<?php echo $petid; ?>"><?php echo $pet; ?></option>
            <?php
                $pet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE userid = ".$userid."";
                $petres = $connect->prepare($pet);
                $petres->execute();
        
                
                if($petres->rowCount()>0){
                    $i=1;
                    while($rowpet = $petres->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value=".$rowpet['petid'].">".$rowpet['petname']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Description</label>
        <input name="description" class="form-control" type="text" value="<?php echo $description; ?>">
    </div>
    <div class="form-group">
        <label class="form-label">Date</label>
        <input name="date" class="form-control" type="date" value="<?php echo $date; ?>">
    </div>
    <div class="form-group">
        <label class="form-label">Current Status</label>
        <input name="status" class="form-control" type="text" value="<?php echo $status; ?>" readonly>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button name="submit" type="submit" class="btn btn-info">Save</button>
    </div>
</form>