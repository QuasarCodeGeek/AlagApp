<?php
    require("./_connector.php");

    if(isset($_POST['submit'])){
        $setter = $_POST['qid'];
        $user = $_POST['userid'];

        $set = 0;

        $notif = "UPDATE alagapp_db.tbl_scheduler SET qset = :set
        WHERE qid = ".$setter."";
        $val = array(":set"=>$set);
        $setres = $connect->prepare($notif);
        $setres->execute($val);

        echo "<script>window.location='../schedPage.php?userid=".$user."'</script>";
    }
?>