<?php
                      $account = $_GET["userid"];
                      $sql = "SELECT * FROM alagapp_db.tbl_userlist
                          WHERE userid = ".$account." ";
                  
                      $res = $connect->prepare($sql);
                      $res->execute();
                  
                      if($res->rowCount()>0){
                          $row = $res->fetch(PDO::FETCH_ASSOC);
                            echo"<div class='row m-auto'><div class='col-10'>
                                <h3 class='text-white p-2'>
                                    <b>Owner: ".$row['userfname']." ".$row['usermname']." ".$row['userlname']."</b>
                                </h3>
                            </div>
                            <div class='col-2'>    
                                <h3 class='text-white p-2'>
                                    <b>Back to List</b>
                                </h3>
                            </div>
                              </div>";
                      } else {
                          echo "No Record";
                      }
                    ?>