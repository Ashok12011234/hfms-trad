<div class='col-md-6 col-xl-4 mb-4'>

  <div class='card'>
    <div class='card-body'>
      <div class='mb-3' style='min-height: 150px; background-color: teal;display: flex;justify-content: center;'>
        <img style="object-fit:cover;height:200px;border: solid 1px #CCC" src="<?php
                                                                              echo $current->get_profile();
                                                                              ?>" alt="Hospital" class="center col-12">
      </div>
      <div class='row justify-content-between mb-1'>
        <h3 class='col-9 card-title'>
          <?php
          echo $current->get_name();

          if ($type == 1) {
            if ($user == $current) {
              echo '<br>(Me)';
            }
          }
          ?>
        </h3>
        <i style="<?php
                  if ($type == 2 || $type == 1) {
                    if ($user == $current) {
                      echo 'display:none;';

                    }
                  } else {
                    echo 'display:none;';
                  }
                  ?>" class='<?php
                              if ($type == 1 || $type == 2) {
                                if (in_array($row["HospitalId"], $user->get_staredHospital())) {
                                  echo "fas";
                                } else {
                                  echo "far";
                                }
                              }
                              ?> fa-star col fa-lg ms-4' name='hospitalStar' id=<?php echo $current->get_id() ?> onclick="starHospitalUser(this)"></i>


      </div>
      <p class='ms-2' style='font-size: 13px; margin-bottom:-5px; '><i class='fas fa-map-marker-alt'></i>&nbsp;
        <?php
        echo $current->get_address();
        ?>
      </p>
      <p class='m-2' style='font-size: 13px;'><i class='fas fa-phone'></i> &nbsp;<?php echo $current->get_phoneno(); ?></p>
      <div class='row'>
        <div class='col-6 Hospital-Facilities'>
          <p style='margin-bottom: -25px; margin-top: 2px;'>Bed</p> <br />
          <div class='row justify-content-start ms-1'>
            <div class='col-6'>
              <p class="<?php

                        if ($current->get_bed()->check_normal()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">Normal Bed </p>
            </div>
            <div class='col-6'>
              <p class="<?php

                        if ($current->get_bed()->check_icu()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">ICU Bed </p>
            </div>
          </div>
          <p style='margin-bottom: -25px; margin-top: 2px;'>Blood</p> <br />
          <div class='row justify-content-start ms-1'>
            <div class='col-4'>
              <p class="<?php

                        if ($current->get_blood()->check_aplus()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">A+</p>
            </div>
            <div class='col-4'>
              <p class="<?php

                        if ($current->get_blood()->check_oplus()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">O+</p>
            </div>
            <div class='col-4'>
              <p class="<?php

                        if ($current->get_blood()->check_bplus()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">B+</p>
            </div>
            <div class='col-4'>
              <p style='font-size: 11.5px;' class="<?php

                                                    if ($current->get_blood()->check_abplus()) {
                                                      echo 'available';
                                                    } else {
                                                      echo 'shortage';
                                                    }
                                                    ?>">
                AB+</p>
            </div>
            <div class='col-4'>
              <p class="<?php

                        if ($current->get_blood()->check_aminus()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">A-</p>
            </div>
            <div class='col-4'>
              <p class="<?php

                        if ($current->get_blood()->check_ominus()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">O-</p>
            </div>
            <div class='col-4'>
              <p class="<?php

                        if ($current->get_blood()->check_bminus()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">B-</p>
            </div>
            <div class='col-4'>
              <p class="<?php

                        if ($current->get_blood()->check_abminus()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">AB-</p>
            </div>
          </div>

          <p style='margin-bottom:  -25px; margin-top: 2px;'>Oxygen Cylinder </p><br />
          <div class='row justify-content-start ms-1'>
            <div class='col-6'>
              <p class="<?php

                        if ($current->get_ceylinder()->check_small()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">Small</p>
            </div>
            <div class='col-6'>
              <p class="<?php

                        if ($current->get_ceylinder()->check_medium()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">Medium</p>

            </div>
            <div class='col-6'>
              <p class="<?php

                        if ($current->get_ceylinder()->check_large()) {
                          echo 'available';
                        } else {
                          echo 'shortage';
                        }
                        ?>">Large </p>

            </div>
          </div>
        </div>
        <div class='col-6 '>
          <p style='margin-bottom: 0px;'>Vaccine</p> <br />
          <div class='row justify-content-start ms-1'>
            <p class="<?php

                      if ($current->get_vaccine()->check_oxford()) {
                        echo 'available';
                      } else {
                        echo 'shortage';
                      }
                      ?>">Oxford-Astrazeneca</p>
            <p class="<?php

                      if ($current->get_vaccine()->check_pfizer()) {
                        echo 'available';
                      } else {
                        echo 'shortage';
                      }
                      ?>">Pfizer-BioNTech</p>
            <p class="<?php

                      if ($current->get_vaccine()->check_moderna()) {
                        echo 'available';
                      } else {
                        echo 'shortage';
                      }
                      ?>">Moderna</p>
            <p class="<?php

                      if ($current->get_vaccine()->check_sinopharm()) {
                        echo 'available';
                      } else {
                        echo 'shortage';
                      }
                      ?>">Sinopharm</p>
            <p class="<?php

                      if ($current->get_vaccine()->check_sputnik()) {
                        echo 'available';
                      } else {
                        echo 'shortage';
                      }
                      ?>">Sputnik V</p>
          </div>
        </div>
      </div>
      <Button class='btn btn-success w-100 mt-4 me-2' style="<?php

                                                              if ($type != 1 || ($user == $current)) {
                                                                echo 'display:none;';
                                                              }
                                                              ?>" onclick="request(this,1)" value="<?php echo $current->get_id() ?>">Request</Button>


      <Button class='btn btn-success w-100 mt-4 me-2' style="<?php
                                                              if ($type == 1 ||  $type == 2) {
                                                                echo 'display:none;';
                                                              }
                                                              ?>" data-bs-toggle="modal" onclick="donateID(this)" value="<?php echo $current->get_id() ?>" data-bs-target="#donationmodal" value="<?php echo $current->get_id() ?>">Donate</Button>

    </div>
  </div>
</div>

<!--itemCategoryModal of hospital-->
<div class="modal fade" id="itemCategoryModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Select item category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <select id="category1<?php echo $current->get_id() ?>" class="form-select" name="category" aria-label="Default select example">

          <option <?php
                  if ($current->get_bed()->providable()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="1">BED</option>
          <option <?php
                  if ($current->get_ceylinder()->providable()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="2"> Oxygen cylinder</option>
          <option <?php
                  if ($current->get_vaccine()->providable()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="3">Vaccine</option>

          <option <?php
                  if ($current->get_blood()->providable()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="4">Blood</option>
        </select>

      </div>
      <div class="modal-footer">

        <button class="btn btn-primary" onclick="next(this,'1')" value="<?php echo $current->get_id() ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Next</button>
      </div>

    </div>
  </div>
</div>
<!--bedModal of hospital-->
<div class="modal fade" id="bedModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="types11<?php echo $current->get_id() ?>" class="form-select" name="types" aria-label="Default select example">

          <option <?php
                  if ($current->get_bed()->check_normal()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="11">Normal Bed</option>
          <option <?php
                  if ($current->get_bed()->check_icu()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="12">ICU Bed</option>

        </select>
        </br>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Quantity</label>
          <input id="input11<?php echo $current->get_id() ?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
        </div>
      </div>
      <div class="modal-footer">
        <div class="d-grid gap-2 d-md-block">
          <button class="submit btn btn-primary" onclick="prev(this,'1')" value="<?php echo $current->get_id() ?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

          <button class="submit btn btn-primary" onclick="submit(this,'1','1')" value="<?php echo $current->get_id() ?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--ceylinderModal of hospital-->
<div class="modal fade" id="ceylinderModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="types12<?php echo $current->get_id() ?>" class="form-select" name="types" aria-label="Default select example">

          <option <?php
                  if ($current->get_ceylinder()->check_small()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="21">Small Ceylinder</option>
          <option <?php
                  if ($current->get_ceylinder()->check_medium()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="22">Medium Ceylinder</option>
          <option <?php
                  if ($current->get_ceylinder()->check_large()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="23">Large Ceylinder</option>

        </select>
        </br>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Quantity</label>
          <input id="input12<?php echo $current->get_id() ?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
        </div>
      </div>
      <div class="modal-footer">
        <div class="d-grid gap-2 d-md-block">
          <button class="submit btn btn-primary" onclick="prev(this,'1')" value="<?php echo $current->get_id() ?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

          <button class="btn btn-primary" type="button" onclick="submit(this,'2','1')" value="<?php echo $current->get_id() ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--vaccineModal of hospital-->
<div class="modal fade" id="vaccineModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="types13<?php echo $current->get_id() ?>" class="form-select" name="types" aria-label="Default select example">

          <option <?php
                  if ($current->get_vaccine()->check_oxford()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="31">Oxford Astrasenica</option>
          <option <?php
                  if ($current->get_vaccine()->check_pfizer()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="32">Phizer</option>

          <option <?php
                  if ($current->get_vaccine()->check_moderna()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="33">Moderna</option>
          <option <?php
                  if ($current->get_vaccine()->check_sinopharm()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="34">Sinopharm</option>
          <option <?php
                  if ($current->get_vaccine()->check_sputnik()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="35">Sputnik</option>
        </select>

        </br>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Quantity</label>
          <input id="input13<?php echo $current->get_id() ?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
        </div>

      </div>
      <div class="modal-footer">
        <div class="d-grid gap-2 d-md-block">
          <button class="submit btn btn-primary" onclick="prev(this,'1')" value="<?php echo $current->get_id() ?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

          <button class="btn btn-primary" type="button" onclick="submit(this,'3','1')" value="<?php echo $current->get_id() ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--bloodModal of hospital -->
<div class="modal fade" id="bloodModal1<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="types14<?php echo $current->get_id() ?>" class="form-select" name="types" aria-label="Default select example">

          <option <?php
                  if ($current->get_blood()->check_aplus()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="41">A+</option>
          <option <?php
                  if ($current->get_blood()->check_aminus()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="42">A-</option>

          <option <?php
                  if ($current->get_blood()->check_bplus()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="43">B+</option>
          <option <?php
                  if ($current->get_blood()->check_bminus()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="44">B-</option>
          <option <?php
                  if ($current->get_blood()->check_oplus()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="45">O+</option>
          <option <?php
                  if ($current->get_blood()->check_ominus()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="46">O-</option>
          <option <?php
                  if ($current->get_blood()->check_abplus()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="47">AB+</option>
          <option <?php
                  if ($current->get_blood()->check_abminus()) {
                  } else {
                    echo "disabled";
                  }
                  ?> value="48">AB-</option>


        </select>

        </br>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Quantity</label>
          <input id="input14<?php echo $current->get_id() ?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
        </div>

      </div>
      <div class="modal-footer">
        <div class="d-grid gap-2 d-md-block">
          <button class="submit btn btn-primary" onclick="prev(this,'1')" value="<?php echo $current->get_id() ?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

          <button class="btn btn-primary" type="button" onclick="submit(this,'4','1')" value="<?php echo $current->get_id() ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>