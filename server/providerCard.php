<div class='col-md-6 col-xl-4 mb-4'>

  <div class='card'>
    <div class='card-body'>
      <div class='mb-3' style='min-height: 150px; background-color: teal;display: flex;justify-content: center;'>
        <img style="object-fit:cover;height:200px;border: solid 1px #CCC" src="<?php
                                                                              echo $current->get_profile();
                                                                              ?>" alt="Provider" class="center col-12">
      </div>
      <div class='row justify-content-between mb-1'>
        <h3 class='col-10 card-title'><?php

                                      echo $current->get_name();

                                      if ($type == 2) {
                                        if ($user == $current) {
                                          echo '<br>(Me)';
                                        }

                                      }
                                      ?>

        </h3>

        <i style="<?php
                  if ($type == 1) {
                    if ($user == $current) {
                      echo 'display:none;';
                    }
                  } else {
                    echo 'display:none;';
                  }
                  ?>" class='<?php
                              if ($type == 1) {
                                if (in_array($row["ProviderId"], $user->get_staredProvider())) {
                                  echo "fas";
                                } else {
                                  echo "far";
                                }
                              }
                              ?> fa-star col fa-lg ms-3 providerStar' name='providerStar' id=<?php echo $current->get_id() ?> onclick="starProviderUser(this)"></i>

      </div>

      <p class='ms-2' style='font-size: 13px; margin-bottom:-5px; '><i class='fas fa-map-marker-alt'></i>&nbsp;
        <?php echo $current->get_address(); ?></p>
      <p class='m-2' style='font-size: 13px;'><i class='fas fa-phone'></i> &nbsp;<?php echo $current->get_phoneno(); ?></p>

      <p style='margin-bottom: -25px; margin-top: 2px;'>Bed</p> <br />
      <div class='row justify-content-start ms-1'>
        <div class='col-6'>
          <p class="<?php

                    if ($current->get_bed()->check_normal()) {
                      echo 'available';
                    } else {
                      echo 'shortage';
                    }
                    ?>">Normal Bed</p>
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
      <p style='margin-bottom:  -25px; margin-top: 2px;'>Oxygen Cylinder </p><br />
      <div class='row justify-content-start ms-1'>
        <div class="col-3 <?php

                          if ($current->get_ceylinder()->check_small()) {
                            echo 'available';
                          } else {
                            echo 'shortage';
                          }
                          ?>">
          <p>Small</p>
        </div>
        <div class="col-3 <?php

                          if ($current->get_ceylinder()->check_medium()) {
                            echo 'available';
                          } else {
                            echo 'shortage';
                          }
                          ?>">
          <p>Medium</p>
        </div>
        <div class="col-3 <?php

                          if ($current->get_ceylinder()->check_large()) {
                            echo 'available';
                          } else {
                            echo 'shortage';
                          }
                          ?>">

          <p>Large</p>
        </div>
      </div>

      <Button class='btn btn-success w-100 mt-4 me-2' style="<?php
                                                              if ($type == 0 || (1 == $current->get_id() && $type == 2)) {
                                                                echo 'display:none;';
                                                              }
                                                              ?>" onclick="request(this,2)" value="<?php echo $current->get_id() ?>">Request</Button>



    </div>
  </div>
</div>


<!--itemCategoryModal of provider-->
<div class="modal fade" id="itemCategoryModal2<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Select item category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <select id="category2<?php echo $current->get_id() ?>" class="form-select" name="category" aria-label="Default select example">

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

        </select>

      </div>
      <div class="modal-footer">

        <button class="btn btn-primary" onclick="next(this,2)" value="<?php echo $current->get_id() ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Next</button>
      </div>

    </div>
  </div>
</div>

<!--bedModal of provider-->
<div class="modal fade" id="bedModal2<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="types21<?php echo $current->get_id() ?>" class="form-select" name="types" aria-label="Default select example">

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
          <input id="input21<?php echo $current->get_id() ?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
        </div>
      </div>
      <div class="modal-footer">
        <div class="d-grid gap-2 d-md-block">
          <button class="submit btn btn-primary" onclick="prev(this,'2')" value="<?php echo $current->get_id() ?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

          <button class="submit btn btn-primary" onclick="submit(this,'1','2')" value="<?php echo $current->get_id() ?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--ceylinderModal of provider-->
<div class="modal fade" id="ceylinderModal2<?php echo $current->get_id(); ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Select the specific type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="types22<?php echo $current->get_id() ?>" class="form-select" name="types" aria-label="Default select example">

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
          <input id="input22<?php echo $current->get_id() ?>" type="text" class="form-control" id="exampleFormControlInput1" value="20">
        </div>
      </div>
      <div class="modal-footer">
        <div class="d-grid gap-2 d-md-block">
          <button class="submit btn btn-primary" onclick="prev(this,'2')" value="<?php echo $current->get_id() ?>" type="button" data-bs-toggle="modal" data-bs-dismiss="modal">Previous</button>

          <button class="btn btn-primary" type="button" onclick="submit(this,'2','2')" value="<?php echo $current->get_id() ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>