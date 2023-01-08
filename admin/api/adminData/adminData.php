<?php
                      $sql = "SELECT * FROM alagapp_db.tbl_admin where adminid = 1 ";
                  
                      $res = $connect->prepare($sql);
                      $res->execute();
                  
                      if($res->rowCount()>0){
                          $row = $res->fetch(PDO::FETCH_ASSOC);
                          echo"<div class='col-6'>";
                              if($row['pict'] == "" && $row['gender']=='M'){
                                echo "<img style='width: 23rem;' id='userProfile' class='rounded m-2' src='../../../assets/default/male.png' alt='profile_picture'>";
                              } else if ($row['pict'] == "" && $row['gender']=='F') {
                                echo "<img style='width: 23rem;' id='userProfile' class='rounded m-2' src='../../assets/default/female.png' alt='profile_picture'>";
                              } else {
                                echo "<img style='width: 23rem;' id='userProfile' class='rounded m-2' src='../../../assets/uploads/".$row['pict']."' alt='profile_picture'>";
                              }
                              echo "</div>
                              <div class='col-6'><div class='m-2'>
                                  <div class='row mb-2 p-2 rounded bg bg-light'><br>
                                    <label>Name: ".$row['fname']." ".$row['mname']." ".$row['lname']."</label><br>
                                    <label>Username: ".$row['admincode']."</label><br>
                                    <label>Birth Date: ".$row['bdate']."</label><br>
                                    <label>Gender: ".$row['gender']."</label><br>
                                    <label>Address: ".$row['street']." ".$row['district']." ".$row['municipality']." ".$row['province']."</label>
                                  </div>
                                  <div class='row m-auto'>
                                    <div class='col'>
                                        <button type='button' class='p-2 btn btn-info w-100' data-bs-toggle='modal' data-bs-target='#profileModal'>Change Profile</button>
                                    </div>
                                    <div class='col'>
                                        <button type='button' class='p-2 btn btn-warning w-100' onClick='adminEdit(".$row['adminid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>Edit</button>
                                    </div>
                                  </div>
                              </div></div>";
                      } else {
                          echo "No Record";
                      }
                    ?>