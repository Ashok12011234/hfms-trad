<?php
include("navbar.php");
if (array_key_exists("hosdashboard", $_SESSION) || array_key_exists("prodashboard", $_SESSION)) {
} else {
  $_SESSION["hosdashboard"] = "1";
  $_SESSION["prodashboard"] = "2";
  $_SESSION["options"] = "";
}

//include("AuthenticationService.php");

if (AuthenticationService::isActive()) {

  $user = Hospital::getInstance(1);
  $type=1;
  

} else {
$type=0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">



  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/Hospital-page.css">
  <title>Dashboard</title>
</head>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="donate.js"></script>


<script>
  function submit(elem, equip_type, hos_or_prov) {

    var e = document.getElementById("types" + hos_or_prov + equip_type + elem.value);
    var equipment = e.options[e.selectedIndex].text;

    var f = document.getElementById("input" + hos_or_prov + equip_type + elem.value);
    var quantity = f.value;
    console.log(f);
    $.ajax({
      url: 'MakeRequest.php',
      type: 'POST',
      data: {
        id: elem.value,
        equipment: equipment,
        userType: hos_or_prov,
        quantity: quantity
      },
      success: function(result) {

      }
    });
  }

  function next(elem, user_type) {


    var e = document.getElementById("category" + user_type + elem.value);

    switch (e.value) {
      case "1":
        var typeModal = new bootstrap.Modal(document.getElementById("bedModal" + user_type + elem.value), {
          keyboard: false
        });
        typeModal.show();
        break;
      case "2":
        var typeModal = new bootstrap.Modal(document.getElementById("ceylinderModal" + user_type + elem.value), {
          keyboard: false
        });
        typeModal.show();
        break;
      case "3":
        var typeModal = new bootstrap.Modal(document.getElementById("vaccineModal" + user_type + elem.value), {
          keyboard: false
        });
        typeModal.show();
        break;
      case "4":
        var typeModal = new bootstrap.Modal(document.getElementById("bloodModal" + user_type + elem.value), {
          keyboard: false
        });
        typeModal.show();
        break;
    }

  }

  function request(elem, user_type) {

    var categoryModal = new bootstrap.Modal(document.getElementById('itemCategoryModal' + user_type + elem.value), {
      keyboard: false
    });
    categoryModal.show();

  }

  function prev(elem, user_type) {

    var categoryModal = new bootstrap.Modal(document.getElementById('itemCategoryModal' + user_type + elem.value), {
      keyboard: false
    });
    categoryModal.show();

  }

  function filterByType() {
    var e = document.getElementById("filtertype");


    $.ajax({
      url: 'filter.php',
      type: 'POST',
      data: {
        filterType: e.value
      },
      success: function(result) {


        window.location.reload();
      }
    });

  }

  function next1() {
    var e = document.getElementById("filtertype");
    var x = e.value;
    if (x == 3) {
      x = 1;
    }
    var typeModal = new bootstrap.Modal(document.getElementById("filtermodali" + x), {
      keyboard: false
    });

    typeModal.show();

  }

  function filterByEquipment() {
    var e1 = document.getElementById("filtertype");
    var x = e1.value;
    if (x == 3) {
      x = 1;
    }
    var e2 = document.getElementById("filtereqiptype" + x);



    $.ajax({
      url: 'filter.php',
      type: 'POST',
      data: {
        filterType: e1.value + e2.value
      },
      success: function(result) {
        window.location.reload();
      }
    });

  }

  function filterBySpecific() {
    var e1 = document.getElementById("filtertype");
    var x = e1.value;
    if (x == 3) {
      x = 1;
    }
    var e2 = document.getElementById("filtereqiptype" + x);
    var e3 = document.getElementById("filterspecifictype" + e2.value);




    $.ajax({
      url: 'filter.php',
      type: 'POST',
      data: {
        filterType: e1.value + e2.value + e3.value
      },
      success: function(result) {
        window.location.reload();
      }
    });

  }

  function loadFilterOptions() {
    var e1 = document.getElementById("filtertype");
    var x = e1.value;
    if (x == 3) {
      x = 1;
    }
    var e2 = document.getElementById("filtereqiptype" + x);


    var typeModal = new bootstrap.Modal(document.getElementById("filtermodalii" + e2.value), {
      keyboard: false
    });

    typeModal.show();

  }

  function refresh() {
    $.ajax({
      url: 'refresh.php',
      type: 'POST',
      data: {},
      success: function(result) {
        window.location.reload();
      }
    });
  }
</script>



<body>
  <!-- Headings and title-->

  <div class="row justify-content-between mt-5 ms-2 me-2">
    <div class="col-md-8 ">

      <button style="<?php
                      if ($type != 1) {

                        echo 'display:none;';
                      }
                      ?>" type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#filtermodal" style="display:inline;"><i class='fas fa-filter'></i>Filter</button>

      <br>
    </div>
    <div class="col-md-4">
      <div class="input-group">


        <input type="text" class="form-control" name="searchBox" id="searchBox" placeholder="Search for Hospital or Provider" aria-label="Recipient's username" aria-describedby="basic-addon2">

      </div>
    </div>
  </div>
  <!-- Headings and title end-->
  <h2 class="mt-3 ms-5 me-2">Hospitals</h2>
  <!--Content-->
  <div class="container mt-5 mb-4">
    <div class="row">


      <!-- Hospital-->
      <?php
      $arry = $user->get_staredHospital();
      foreach ($arry as $indexStar) {

        if (isset($_POST['SearchContent'])) {
          $content = $_POST['SearchContent'];
          $sql = "SELECT * FROM hospital WHERE ( `hospital`.`HospitalId` =  '$indexStar' AND (UserName LIKE '%$content%' OR Name LIKE '%$content%' OR Website LIKE '%$content%' OR Address LIKE '%$content%'));";;
        } else {
          $sql = "SELECT * FROM hospital WHERE `hospital`.`HospitalId` =  '$indexStar'";
        }
        if ($result = QueryExecutor::query($sql)) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
          foreach ($rows as $row) {
            $current = Hospital::getInstance($row["HospitalId"]);
            if ($current->filter($_SESSION["hosdashboard"])) {
              if ($type == 1) {
                if ($current == $user) {
                  continue;
                }
              }

              include 'hospitalCard.php';
            }
          }
        }
      }
      ?>
    </div>
  </div>
  <!-- Provider-->
  <h2 class="mt-3 ms-5 me-2" style="<?php
                                    if ($type == 0) {

                                      echo 'display:none;';
                                    }
                                    ?>">Providers</h2>
  <div class="container mt-5 mb-4">
    <div class="row">
      <?php
      $arry = $user->get_staredProvider();
      foreach ($arry as $indexStar) {

        if (isset($_POST['SearchContent'])) {
          $content = $_POST['SearchContent'];
          $sql = "SELECT * FROM provider WHERE ( `provider`.`ProviderId` =  '$indexStar' AND (UserName LIKE '%$content%' OR Name LIKE '%$content%' OR Website LIKE '%$content%' OR Address LIKE '%$content%'));";;
        } else {
          $sql = "SELECT * FROM provider WHERE `provider`.`ProviderId` =  '$indexStar'";
        }
        if ($result = QueryExecutor::query($sql)) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);

          foreach ($rows as $row) {
            $current = Provider::getInstance($row["ProviderId"]);
            if ($current->filter($_SESSION["prodashboard"]) && $type == 1) {

              include 'providerCard.php';
            }
          }
        }
      }







      ?>
    </div>
  </div>




  <!--Footer-->
  <!-- Footer -->
  <footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="https://www.facebook.com/hpbsrilanka/" target="_blank" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://twitter.com/hpbsrilanka" target="_blank" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>


        <a href="https://www.youtube.com/channel/UC6XsnLgVVzNkjTCpRVJ6u3w" target="_blank" class="me-4 text-reset">


          <i class="fab fa-youtube"></i>
        </a>
        <a href="https://www.instagram.com/hpbsrilanka" target="_blank" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>

      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-sm-6 col-lg-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Contact
            </h6>

            <p>



              <a class="link-success" href="mailto: healthpromo@sltnet.lk"><i class="fas fa-envelope me-3"></i> healthpromo@sltnet.lk</a>

            </p>
            <p><a class="link-success" href="tel:+94 11 2696 606"><i class="fas fa-phone me-3"></i> +94 11
                2696 606</a></p>
            <p> <a class="link-success" href="fax:+94 11 2692 613"><i class="fas fa-print me-3"></i> +94 11
                2692 613</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-sm-6 col-lg-3  mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;&nbsp; Our Address

            </h6>
            <p>
              <b> Health Promotion Bureau </b> <br>
              No.2, Kynsey Road, <br>
              Colombo 08, <br>
              Sri Lanka.
            </p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-sm-3 col-md-6 col-lg-2  mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Links
            </h6>
            <p>

              <a class="link-success" href="https://hpb.health.gov.lk/en" target="_blank" class="text-reset">Ministry Home</a>
            </p>
            <p>
              <a class="link-success" href="https://hpb.health.gov.lk/en/covid-19" target="_blank" class="text-reset">Covid Info</a>
            </p>

            <p>
              <a class="link-success" href="https://hpb.health.gov.lk/en/technical-units" target="_blank" class="text-reset">Technical Units</a>

            </p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-sm-9  col-md-6 col-lg-4  mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              &nbsp;&nbsp; Important Contacts
            </h6>
            <p>
            <ul class="footer-menu">

              <li style="text-align: left;"><b>Suwasariya Hotline:</b>&nbsp;&nbsp;&nbsp;<a class="link-success" href="tel:1999">1999</a></li>
              <li style="text-align: left;"><b>Epidemiology Unit:</b>&nbsp;&nbsp;&nbsp;<a class="link-success" href="tel:+940112695112">+94 011 269 5112</a></li>
              <li style="text-align: left;"><b>Quarantine Unit:</b>&nbsp;&nbsp;&nbsp;<a class="link-success" href="tel:+940112112705">+94 011 211 2705</a></li>
              <li style="text-align: left;"><b>Disaster Management Unit:</b>&nbsp;&nbsp;&nbsp;<a class="link-success" href="tel:+940113071073">+94 011 307 1073</a></li>



            </ul>
            </p>

          </div>
          <!-- Grid column -->


        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2021 Copyright:
      <a class="text-reset fw-bold" href="#">Hospital Management System</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->




  <!-- Filter Modal -->
  <div class="modal fade" id="filtermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select id="filtertype" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected value="1">Hospital</option>
            <option value="2">Provider</option>
            <option value="3">All</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="filterByType()">Ok</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" onclick="next1()" data-bs-dismiss="modal">Next</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Filter Modal  i hos-->

  <div class="modal fade" id="filtermodali1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select id="filtereqiptype1" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected value="1">Bed</option>
            <option value="2">Cylinder</option>
            <option value="3">Blood</option>
            <option value="4">Vaccine</option>

          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="filterByEquipment()">Ok</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="loadFilterOptions()">Next</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter Modal  i prov-->

  <div class="modal fade" id="filtermodali2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select id="filtereqiptype2" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected value="1">Bed</option>
            <option value="2">Cylinder</option>

          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="filterByEquipment()">Ok</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="loadFilterOptions()">Next</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter Modal  ii bed-->

  <div class="modal fade" id="filtermodalii1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select class="form-select form-select-sm" id="filterspecifictype1" aria-label=".form-select-sm example">
            <option selected value="1">Normal</option>
            <option value="2">ICU</option>

          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="filterBySpecific()">Ok</button>


        </div>
      </div>
    </div>
  </div>

  <!-- Filter Modal  ii ceylinder-->

  <div class="modal fade" id="filtermodalii2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select class="form-select form-select-sm" id="filterspecifictype2" aria-label=".form-select-sm example">
            <option selected value="1">Small</option>
            <option value="2">Medium</option>
            <option value="3">Large</option>

          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="filterBySpecific()">Ok</button>


        </div>
      </div>
    </div>
  </div>

  <!-- Filter Modal  ii blood-->

  <div class="modal fade" id="filtermodalii3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select class="form-select form-select-sm" id="filterspecifictype3" aria-label=".form-select-sm example">
            <option selected value="1">A+</option>
            <option value="3">B+</option>
            <option value="5">O+</option>
            <option value="7">AB+</option>
            <option value="2">A-</option>
            <option value="4">B-</option>
            <option value="6">O-</option>
            <option value="8">AB-</option>

          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="filterBySpecific()">Ok</button>


        </div>
      </div>
    </div>
  </div>

  <!-- Filter Modal  ii vaccine-->

  <div class="modal fade" id="filtermodalii4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Filter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select class="form-select form-select-sm" id="filterspecifictype4" aria-label=".form-select-sm example">
            <option selected value="1">Oxford Astrasenica</option>
            <option value="2">Phizer</option>
            <option value="3">Moderna</option>
            <option value="4">Sinopharm</option>
            <option value="5">Sputnik</option>

          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="filterBySpecific()">Ok</button>


        </div>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST['starHospitalId']) && ($_POST['star'] == "unStarHos")) {
    $currentHospital->add_staredHospital($_POST['starHospitalId']);
    //print_r($current->get_staredHospital());
  } else if (isset($_POST['starHospitalId']) && $_POST['star'] == "starHos") {
    $currentHospital->remove_staredHospital($_POST['starHospitalId']);
    //Redirect_to("google.com");
    //print_r($current->get_staredHospital());
    //Redirect_to("google.com"); 
  }
  if (isset($_POST['starProviderId']) && ($_POST['star'] == "unStarProv")) {
    $currentHospital->add_staredProvider($_POST['starProviderId']);
    //print_r($current->get_staredHospital());
  } else if (isset($_POST['starProviderId']) && $_POST['star'] == "starProv") {
    $currentHospital->remove_staredProvider($_POST['starProviderId']);
    //Redirect_to("google.com");
    //print_r($current->get_staredHospital());
    //Redirect_to("google.com"); 
  }

  ?>

</body>



<script type="text/javascript">
  function myhref(web) {
    window.location.href = web;
  }
</script>
<script type="text/javascript">
  function starProviderUser(x) {
    //console.log(x.id);
    var id = x.id;
    if (x.className == "far fa-star col fa-lg ms-3 providerStar") {
      $.ajax({
        url: "hospitalDashboard.php",
        type: "POST",
        data: {
          starProviderId: id,
          star: "unStarProv"
        },
        success: function(data) {
          x.className = "fas fa-star col fa-lg ms-3 providerStar";
        }
      });
    } else {
      $.ajax({
        url: "hospitalDashboard.php",
        type: "POST",
        data: {
          star: "starProv",
          starProviderId: id
        },
        success: function(data) {
          console.log(data);
          x.className = "far fa-star col fa-lg ms-3 providerStar";
        }
      });
    }

  }

  function starHospitalUser(x) {
    //console.log(x.id);
    var id = x.id;
    if (x.className == "far fa-star col fa-lg ms-4") {
      $.ajax({
        url: "hospitalDashboard.php",
        type: "POST",
        data: {
          starHospitalId: id,
          star: "unStarHos"
        },
        success: function(data) {
          x.className = "fas fa-star col fa-lg ms-4";
        }
      });
    } else {
      $.ajax({
        url: "hospitalDashboard.php",
        type: "POST",
        data: {
          star: "starHos",
          starHospitalId: id
        },
        success: function(data) {
          console.log(data);
          x.className = "far fa-star col fa-lg ms-4";
        }
      });
    }

  }
</script>

</html>
