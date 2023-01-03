<?php
                      $account = $_GET["userid"];
                      $sql = "SELECT * FROM alagapp_db.tbl_userlist
                          WHERE userid = ".$account." ";
                  
                      $res = $connect->prepare($sql);
                      $res->execute();
                  
                      if($res->rowCount()>0){
                          $row = $res->fetch(PDO::FETCH_ASSOC);
                          echo"<div class='col-3'>";
                              if($row['userpict'] == "" && $row['usergender']=='M'){
                                echo "<img id='userProfile' class='rounded' src='../../assets/default/male.png' alt='profile_picture'>";
                              } else if ($row['userpict'] == "" && $row['usergender']=='F') {
                                echo "<img id='userProfile' class='rounded' src='../../assets/default/female.png' alt='profile_picture'>";
                              } else {
                                echo "<img id='userProfile' class='rounded' src='../../assets/uploads/".$row['userpict']."' alt='profile_picture'>";
                              }
                              echo "</div>
                              <div class='col-5'>
                                  <div class='row mb-2 p-2 rounded bg bg-light'>
                                    <label>Name: ".$row['userfname']." ".$row['usermname']." ".$row['userlname']."</label><br>
                                    <label>Email: ".$row['useremail']."</label><br>
                                    <label>Birth Date: ".$row['userbdate']."</label><br>
                                    <label>Gender: ".$row['usergender']."</label><br>
                                    <label>Address: ".$row['userstreet']." ".$row['userdistrict']." ".$row['usermunicipality']." ".$row['userprovince']."</label>
                                  </div>
                                  <div class='row'>
                                    <div class='col'>
                                      <button type='button' class='p-2 btn btn-warning w-100' onClick='userEdit(".$row['userid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
                                      <i class='bi bi-pencil-square'></i> Edit</button>
                                    </div>
                                    <div class='col'>
                                      <button type='button' class='p-2 btn btn-info w-100' onClick='PetNew(".$row['userid'].")' data-bs-toggle='modal' data-bs-target='#newModal')>
                                      <i class='bi bi-plus-square'></i> Add Pet</button>
                                    </div>
                                  </div>
                              </div>
                              <div class='col-4'>
                                <div class='row-2 m-auto mb-2 p-2 bg bg-light rounded'>
                                    <label>Pets: ".$totalnpet."</label>
                                </div>
                                <div class='row-2 m-auto mb-2 p-2 bg bg-light rounded'>
                                    <label>Schedules: ".$totalnsched."</label>
                                </div>
                                <div class='row-2 m-auto mb-2 p-2 bg bg-light rounded'>
                                    <label>Vaccine Card: ".$totalncard."</label>
                                </div>
                                <div class='row-2 m-auto mb-2 p-2 bg bg-light rounded'>
                                    <label>Prescription Note: ".$totalnnonte."</label>
                                </div>
                              </div>";
                      } else {
                          echo "No Record";
                      }
                    ?>