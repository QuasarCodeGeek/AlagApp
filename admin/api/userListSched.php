      <ul class="list-group list-group-flush">
        <?php
            $sql = "SELECT * FROM alagapp_db.tbl_userlist";
        
            $res = $connect->prepare($sql);
            $res->execute();
        
            if($res->rowCount()>0){
                $i=1;
                while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    if($row['userid'] == $userid){
                        echo "<li class='list-group-item bg bg-success rounded-pill mb-2'>";
                    } else {
                        echo "<li class='list-group-item border border-3 border-success bg bg-light rounded-pill mb-2'>";
                    }
                    echo "
                                  <a type='button' class='btn w-100 text-start' href='./sched_profile.php?userid=".$row['userid']."'>
                                    <div class='row'>
                                        <div class='col-4'>";
                                            if($row['userpict'] == "" && $row['usergender']=='M'){
                                                echo "<img style='width: 3rem; height: 3rem;' class='rounded-circle' src='../../assets/default/male.png' alt='profile_picture'>";
                                            } else if ($row['userpict'] == "" && $row['usergender']=='F') {
                                                echo "<img style='width: 3rem; height: 3rem;' class='rounded-circle' src='../../assets/default/female.png' alt='profile_picture'>";
                                            } else {
                                                echo "<img style='width: 3rem; height: 3rem;' class='rounded-circle' src='../../assets/uploads/".$row['userpict']."' alt='profile_picture'>";
                                            }
                                    echo "</div>
                                    <div class='col-8 m-auto'>
                                        <label class='text-wrap ";
                                        if($row['userid'] == $userid){
                                            echo "text-white";
                                        }
                                        echo " '><b>".$row['userfname']."</b> ".$row['userlname']."</label>
                                    </div>
                                  </div>
                                  </a>
                                  </li>
                    </li>";
                    $i++;
                }
            } else {
                echo "Nothing follows";
            }
        ?>
      </ul>