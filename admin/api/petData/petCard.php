<?php
    $owner = $_GET["userid"];
    $sql = "SELECT * FROM alagapp_db.tbl_petprofile WHERE userid = ".$owner." ORDER BY petname";

    $res = $connect->prepare($sql);
    $res->execute();

    if($res->rowCount()>0){
        $i=1;
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='col-3'>
                    <a type='button' class='btn w-100 bg bg-light border border-3 border-success rounded m-2' style='width:20rem;' href='./petData/petProfile.php?userid=".$row['userid']."'>
                    <div class='row m-auto'>
                        <div class='col-4 m-auto'>";
                        if($row['petpict'] == ""){
                            echo "<img style='width: 4rem; height: 4rem;' class='card-img rounded-circle' src='../../assets/pet/paw.png' alt='profile_picture'>";
                        } else {
                            echo "<img style='width: 4rem; height: 4rem;' class='card-img rounded-circle' src='../../assets/pet/".$row['petpict']."' alt='profile_picture'>";
                        }
                        echo "</div>
                        <div class='col-8 m-auto'> 
                            <label class='card-text m-auto text-wrap'><b>".$row['petname']."</b><br> ".$row['petbreed']."</label>
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