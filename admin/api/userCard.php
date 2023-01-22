<?php
    require("connector.php");

    $sql = "SELECT * FROM alagapp_db.tbl_userlist ORDER BY userfname";

    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='col-3'>
                    <a type='button' class='btn w-100 bg bg-light border border-3 border-success rounded-pill m-2' style='width:20rem;' href='api/profile.php?userid=".$row['userid']."'>
                    <div class='row m-auto'>
                        <div class='col-4 m-auto'>";
                        if($row['userpict'] == "" && $row['usergender']=='M'){
                            echo "<img style='width: 4rem; height: 4rem;' class='card-img rounded-circle' src='../assets/default/male.png' alt='profile_picture'>";
                        } else if ($row['userpict'] == "" && $row['usergender']=='F') {
                            echo "<img style='width: 4rem; height: 4rem;' class='card-img rounded-circle' src='../assets/default/female.png' alt='profile_picture'>";
                        } else {
                            echo "<img style='width: 4rem; height: 4rem;' class='card-img rounded-circle' src='../assets/uploads/".$row['userpict']."' alt='profile_picture'>";
                        }
                        echo "</div>
                        <div class='col-8 m-auto'> 
                            <label class='card-text m-auto text-wrap'><b>".$row['userfname']."</b> ".$row['userlname']."</label>
                        </div>
                    </div>
                    </a>
            </div>";
            $i++;
        }
    } else {
        echo "Nothing follows";
    }
?>