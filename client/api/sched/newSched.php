<?php
    require("../_connector.php");

    if(isset($_POST["submit"])){
        $user = $_POST["userid"];
        $pet = $_POST["petid"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $status = $_POST["status"];

        if($user=="" || $pet=="" || $description=="" || $date=="" || $status==""){
            echo "<script>window.location='../../schedPage.php?userid=".$user."'</script>";
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_scheduler(
                userid,
                petid,
                qdescription,
                qdate,
                qstatus) VALUES(
                    :userid,
                    :petid,
                    :qdescription,
                    :qdate,
                    :qstatus)";

            $result = $connect->prepare($sql);

            $values = array(
                ":userid"=>$user,
                ":petid"=>$pet,
                ":qdescription"=>$description,
                ":qdate"=>$date,
                ":qstatus"=>$status
            );

            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>window.location='../../schedPage.php?userid=".$user."'</script>";
             } else {
                 echo "<script>window.location='../../schedPage.php?userid=".$user."'</script>";
             }
        }
    }
?>
<form method="POST" action="api/sched/newSched.php">
    <?php
    $user = $_REQUEST["userid"];

        session_start();
        if($_SESSION["newsession"] !=  $user+date("Ymd")){
        echo "<script>window.location='../../index.php'</script>";
        }
    ?>
    <div class="form-group">
        <input name="userid" type="text" value="<?php echo $user; ?>"  hidden></input>
    </div>
    <div class="form-group">
        <label class="form-label">Pet</label>
        <select name="petid" class="form-select">
            <option selected>Choose Pet</option>
            <?php
                $pet = "SELECT * FROM alagapp_db.tbl_petprofile WHERE userid = ".$user."";
                $petres = $connect->prepare($pet);
                $petres->execute();
        
                
                if($petres->rowCount()>0){
                    $i=1;
                    while($row = $petres->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value=".$row['petid'].">".$row['petname']."</option>";
                        $i++;
                    }
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
        <!--<input name="description" class="form-control" placeholder="Enter Description" type="text">-->
    </div>
    <div class="form-group">
        <label class="form-label">Date</label>
        <input name="date" class="form-control" type="date">
    </div>
    <div class="form-group">
        <input name="status" class="form-control" value="Pending" hidden>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button name="submit" type="submit" class="btn btn-primary">Submit Schedule</button>
    </div>
</form>