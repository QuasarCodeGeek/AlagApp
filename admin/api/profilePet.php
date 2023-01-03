<?php
                      $petaccount = $_GET["userid"];
                      $sql = "SELECT * FROM alagapp_db.tbl_petprofile
                          WHERE userid = ".$petaccount." ";
                  
                      $res = $connect->prepare($sql);
                      $res->execute();

                      if($res->rowCount()>0){
                          $i=1;
                          while($row = $res->fetch(PDO::FETCH_ASSOC)){
                              echo"
                              <div class='row rounded m-auto mb-2' style='background-color: #81C784;'>  
                                <div class='row m-auto mt-2 p-2 bg bg-success rounded'>
                                  <div class='col-3'>
                                    <img id='petProfile' class='m-auto rounded' src='../../assets/img/".$row['pettype']."/".$row['petbreed'].".jpg' alt='petProfile'>
                                  </div>
                                  <div class='col-9'>
                                    <div class='row mt-2'>
                                      <div class='col-4'>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Name: ".$row['petname']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Species: ".$row['pettype']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Breed: ".$row['petbreed']."</label>
                                        </div>
                                      </div>
                                      <div class='col-4'>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Gender: ".$row['petgender']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>DOB: ".$row['petbdate']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Age: ".$row['petage']."</label>
                                        </div>
                                      </div>
                                      <div class='col-4'>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Weight(Kg): ".$row['petweight']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Height(Ft): ".$row['petheight']."</label>
                                        </div>
                                        <div>
                                          <button type='button' class='btn btn-warning w-100' onClick='petEdit(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
                                          <i class='bi bi-pencil-square'></i> Edit</button>
                                        </div>
                                      </div>
                                    </div> 
                                  </div>
                                </div>  
                  
                              <div class='row mx-auto my-2'>
                                <div class='col-6 bg bg-success rounded-start'>";
                                  include("./petCard.php");
                                  echo "
                                </div>
                                <div class='col-6 bg bg-success rounded-end'>";
                                  include("./petNote.php");
                                echo "
                                </div>
                            </div>
                            </div>";
                              $i++;
                          }
                      } else {
                          echo "<div class='col'>
                          <div class='row bg bg-light rounded'>
                            <label class='p-2 text-center '>No Record
                            </label></div>
                          </div>
                          </div><br>";
                      }
                    ?>