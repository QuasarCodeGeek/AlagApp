
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
                                <h3 class='text-white mt-3'><b>Pet Profile</b></h3>  
                                <div class='row m-auto mt-2 p-2 pt-3 pb-3 bg bg-success rounded'>
                                  <div class='col-3'>";
                                  if($row['petpict'] == ""){
                                    echo "<img style='width: 15rem;' class='m-2 mx-auto d-block rounded' src='../../assets/default/paw.png' alt='profile_picture'>";
                                  } else {
                                    echo "<img style='width: 15rem;' class='m-2 mx-auto d-block rounded' src='../../assets/pet/".$row['petpict']."' alt='profile_picture'>";
                                  }
                                    //<img id='petProfile' class='m-auto rounded' src='../../assets/img/".$row['pettype']."/".$row['petbreed'].".jpg' alt='petProfile'>
                                  echo "</div>
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
                                          <label>DOB: ".date("M d,Y", strtotime($row['petbdate']))."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 rounded bg bg-light'>
                                          <label>Age: ".$row['petage']."</label>
                                        </div>
                                      </div>
                                      <div class='col-4'>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 pb-2 rounded bg bg-light'>
                                          <label>Weight(Kg): ".$row['petweight']."</label>
                                        </div>
                                        <div class='row-2 m-auto mb-2 w-auto h-auto p-2 pb-2 rounded bg bg-light'>
                                          <label>Color/Marking: ".$row['petmark']."</label>
                                        </div>
                                        <div class='row'>
                                          <div class='col'>
                                              <button type='button' class='btn btn-info w-100' onClick='petImg(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#profileModal'>
                                              <i class='bi bi-pencil-square'></i> Pict</button>
                                          </div>
                                          <div class='col'>
                                            <button type='button' class='btn btn-warning w-100' onClick='petEdit(".$row['petid'].")' data-bs-toggle='modal' data-bs-target='#boxModal'>
                                            <i class='bi bi-pencil-square'></i> Edit</button>
                                          </div>
                                          <div class='col' hidden>
                                          <button class='btn btn-primary' type='button' onClick='getRecord(".$row['petid'].")' data-bs-toggle='offcanvas' data-bs-target='#offcanvasRight' aria-controls='offcanvasRight'>Medical Record</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div> 
                                  </div>
                                </div> 
                                
                                <div class='row mx-auto my-2 bg bg-success rounded'>
                                <div class='col-7 pb-2'>
                                  <h4 class='text-white p-2'><b>E-Vaccine Card</b></h4>";
                                  include("./petCard.php");
                                  echo "
                                </div>
                                <div class='col-5 pb-2'>                
                                  <h4 class='text-white p-2'><b>E-Prescription Note</b></h4>";
                                  include("./petNote.php");
                                echo "
                                </div>
                            </div>
                            </div>";
                              $i++;
                          }
                      } else {
                          echo "<div class='col'>
                            <div class='card p-3'>
                              <label class='fw-bold text-center text-success'>No Record
                              </label>
                            </div>
                          </div>
                          </div><br>";
                      }
                    ?>