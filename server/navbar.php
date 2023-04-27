<?php
session_start();
include("AuthenticationService.php");



include("classes/probDomCls/member.php");
//include("AuthenticationService.php");

if (AuthenticationService::isActive()) {
    $user =Hospital::fetchByUserName(AuthenticationService::getUser());
     
    $type=1;
      
  
} else {
  $type=0;
}
?>


<!--Navbar Start-->
<nav class="navbar navbar-expand-lg navbar-dark bg-success" style="background-color: #e3f2fd;">
  <a class="navbar-brand ms-3" href="#" style="font-size: x-large;  font-size: 1.5em; font-family: Monospace; font-weight: bold;">Life Share</a>


  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto me-2" style="font-size: large;">
      <li class="nav-item ms-2">


        <a href="./hospitalDashoard.php" class="nav-link">Home</a>


      </li>

      <li style="<?php
                  if ($type != 0) {

                    echo 'display:none;';
                  }
                  ?>" class="nav-item ms-2">
        <a class="nav-link" href="http://localhost:8000/oauth2/sign_in?rd=/hospitalDashoard.php">Login</a>
      </li>
      
     

      <li style="<?php
                  if ($type == 0) {

                    echo 'display:none;';
                  }
                  ?>" class="nav-item ms-2">
        <a class="nav-link" href="stared.php">Stared</a>
      </li>

      <li style="<?php
                  if ($type== 0) {

                    echo 'display:none;';
                  }
                  ?>" class="nav-item ms-2">
        <a class="nav-link" href="./requestDashboard.php">Requests</a>
      </li>
     


    </ul>
  </div>

 

  <!--Navbar Signout panel-->
  <div style="<?php
              if ($type == 0) {

                echo 'display:none;';
              }
              ?>" class="dropdown" style="user-select: none;">
    <div id="hospitalDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">


      <img src="<?php if ($type != 0){echo $user->get_profile();} ?>" alt="usericon" style="width: 40px;height: 40px;border-radius: 50%;" class="ms-2">

      <span class="user-name me-4 ms-1" id="hospitalDropdownButton"><?php
                                                                    if ($type!= 0) {
                                                                      echo $user->get_username();
                                                                    }
                                                                    ?></span>

    </div>
    <div class="dropdown-menu mt-3" aria-labelledby="hospitalDropdownButton" id="hospitalDropdownPanel">
      <a href="#" style="text-decoration: none; color: black;">

        <h2><?php
            if ($type != 0) {
              echo $user->get_name();
            } ?><img src="<?php if ($type != 0){echo $user->get_profile();} ?>" alt="usericon" style="width: 60px;height: 60px;border-radius: 50%;float: right;" class="ms-2"></h2>
      </a>
      <p class="ms-2" style="font-size: 15px; margin-bottom:-5px; "><i class="fas fa-map-marker-alt"></i>&nbsp;

        <?php
        if ($type != 0) {
          echo $user->get_address();
        }
        ?>
      </p>
      <p class="m-2" style="font-size: 15px;"><i class="fas fa-phone"></i> &nbsp;<?php
                                                                                  if ($type != 0) {
                                                                                    echo $user->get_phoneno();
                                                                                  } ?></p>
      <hr>
      <ul style="list-style: none;">

        <li style="margin-bottom: 10px;"><a href="#" id="hospitalSignoutPannel">
            Help</a></li>
            
        <li><a href="http://localhost:8000/oauth2/sign_out?rd=/hospitalDashoard.php" id="hospitalSignoutPannel">

            Logout</a></li>
            <!--
            <li><button type="button" class="btn btn-primary"  onclick="logout()">Logout</button></li>
      -->
          </ul>
    </div>
  </div>



  <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">


    <span class="navbar-toggler-icon"></span>
  </button>

</nav>
<!--Navbar end-->




<!--Donation model-->

<div class="modal fade" id="donationmodal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Donation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" id="newModalForm">


          <div class="mb-3 row">
            <label for="email" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" name="email" id="email">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="cardholder" class="col-sm-4 col-form-label">Card Holder's Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="name" id="name" require>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="cardnum" class="col-sm-4 col-form-label">Card Number</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="cardnum" id="cardnum" require>
            </div>
          </div>



          <!-- Expiry-->
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label" for="expiry">Card Expiry Date</label>
            <div class="controls col-sm-8" id="expiry">
              <div class="row">
                <div class="col-sm-6">
                  <select class="span3 form-select form-select-sm" name="expiry_month">
                    <option></option>
                    <option value="01">Jan </option>
                    <option value="02">Feb </option>
                    <option value="03">Mar </option>
                    <option value="04">Apr </option>
                    <option value="05">May </option>
                    <option value="06">June </option>
                    <option value="07">July </option>
                    <option value="08">Aug </option>
                    <option value="09">Sep </option>
                    <option value="10">Oct </option>1
                    <option value="11">Nov </option>
                    <option value="12">Dec </option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <select class="span2 form-select form-select-sm" name="expiry_year">
                    <option></option>

                    <option value="21">2021</option>
                    <option value="22">2022</option>
                    <option value="23">2023</option>
                    <option value="13">2024</option>
                    <option value="15">2025</option>
                    <option value="16">2026</option>
                    <option value="17">2027</option>
                    <option value="18">2028</option>
                    <option value="19">2029</option>
                    <option value="20">2030</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="cardholder" class="col-sm-4 col-form-label">Card CVV</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="cardcvv" id="cardcvv">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="cardholder" class="col-sm-4 col-form-label">Amount (Rs)</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="amount" id="amount">
            </div>
          </div>
          </br>
          <div class="modal-footer container">
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Donate</button>
            </div>
          </div>

        </form>

      </div>


    </div>
  </div>
</div>

<!-- donation results Modal -->

<div class="modal fade" id="donationresult0" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Success!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Your donation process is succeed please check your email.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="donationresult1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Failed!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Your donation process is failed.Please retry again.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#donationmodal" data-bs-toggle="modal" data-bs-dismiss="modal">Retry</button>
      </div>
    </div>
  </div>
</div>
