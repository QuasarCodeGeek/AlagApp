
        <?php
            $sql = "SELECT * FROM alagapp_db.tbl_userlist";
        
            $res = $connect->prepare($sql);
            $res->execute();
        
            if($res->rowCount()>0){
                $i=1;
                while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    echo "<div class='col-3'>
                    <div class='card border border-success border-3 rounded-pill m-2 bg bg-light' style='width: 20rem;'>
                        <a type='button' class='btn w-100 text-start' href='./api/chat.php?userid=".$row['userid']."'>
                            <div class='row m-auto'>
                                <div class='col-4 m-auto'>";
                                            if($row['userpict'] == "" && $row['usergender']=='M'){
                                                echo "<img style='width: 4rem; height: 4rem;' class='rounded-circle' src='../assets/default/male.png' alt='profile_picture'>";
                                            } else if ($row['userpict'] == "" && $row['usergender']=='F') {
                                                echo "<img style='width: 4rem; height: 4rem;' class='rounded-circle' src='../assets/default/female.png' alt='profile_picture'>";
                                            } else {
                                                echo "<img style='width: 4rem; height: 4rem;' class='rounded-circle' src='../assets/uploads/".$row['userpict']."' alt='profile_picture'>";
                                            }
                                echo "</div>
                                <div class='card-body col-8 m-auto'>
                                    <label class='text-wrap'><b>".$row['userfname']."</b> ".$row['userlname']."</label>";
                                    if($row['userstatus'] == 1){
                                        echo "<label class='text-wrap text-danger'>New Message</label>";
                                    }
                                echo "</div>
                            </div>
                        </a>
                    </div>
                    </div>";
                    $i++;
                }
            } else {
                echo "Nothing follows";
            }
        ?>