<?php

include('common.php');
include('navbar.php');

$User = $user;
if ($user->get_state() == "NEW") {
    $id = $User->get_id();
    $sql = "SELECT * FROM `blooddetail` WHERE 'HospitalId'=$id;";
    $result = QueryExecutor::query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    if (!$row) {
        //echo "<script>console.log('$row')</script>";
        if ($type == 1) {
            $blood = "INSERT INTO `blooddetail`(`HospitalId`, `AplusAvailability`, `AminusAvailability`, `BplusAvailability`, `BminusAvailability`, `OplusAvailability`, `OminusAvailability`, `ABplusAvailability`, `ABminusAvailability`) VALUES ('$id','NO','NO','NO','NO','NO','NO','NO','NO');";
            QueryExecutor::query($blood);
            $vaccine = "INSERT INTO `vaccinedetail`(`HospitalId`, `OxfordAvailability`, `PfizerAvailability`, `ModernalAvailability`, `SinopharmAvailability`, `SputnikAvailability`) VALUES ('$id','NO','NO','NO','NO','NO');";
            QueryExecutor::query($vaccine);
            $hos_bed = "INSERT INTO `hospitalbeddetail`( `HospitalId`, `NormalAvailability`, `ICUAvailability`) VALUES ('$id','NO','NO');";
            QueryExecutor::query($hos_bed);
            $hos_cylinder = "INSERT INTO `hospitalcylinderdetail`(`HospitalId`, `SmallAvailability`, `MediumAvailability`, `LargeAvailability`) VALUES ('$id','NO','NO','NO');";
            QueryExecutor::query($hos_cylinder);
        } else if ($type == 2) {
            $pro_bed = "INSERT INTO `providerbeddetail`(`ProviderId`, `NormalAvailability`, `ICUAvailability`) VALUES ('$id','NO','NO');";
            QueryExecutor::query($pro_bed);
            $pro_cylinder = "INSERT INTO `providercylinderdetail`(`ProviderId`, `SmallAvailability`, `MediumAvailability`, `LargeAvailability`) VALUES ('$id','NO','NO','NO');";
            QueryExecutor::query($pro_cylinder);
        }
    }
}

if ((isset($_POST['updateResources']))) {
    //print_r($User);
    if ($_POST['password-confirm'] == $User->get_password()) {
        if ($type == 1) {
            $User->set_bed();
            $User->set_vaccine();
            $User->set_blood();
            $User->set_ceylinder();
        } else if ($type == 2) {
            $User->set_bed();
            $User->set_ceylinder();
        }
        if ($user->get_state() == "NEW") {
            $user->set_state("INITIATED");
        }
    }
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
    <link rel="stylesheet" href="./assets/css/Hospital-page.css">
    <link rel="stylesheet" href="./assets/css/profilePage.css">
    <title>Update Resources</title>
</head>

<body>
    <!-- body -->
    <div class="justify-content-center d-flex body-contentx">
        <div class="rounded bg-white m-5" style="width: 75%;">
            <div class="row justify-content-center ps-5">
                <form action="" method="post" id="resources-form">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-right">Resources</h4>
                        </div><br>
                        <div class="col-md-12">
                            <label class="labels fw-bold fs-5 mt-2">Bed</label>
                            <div class="row  ms-1 me-2">
                                <?php
                                $UserID = $User->get_id();
                                if ($type == 1) {
                                    $sql = "SELECT * FROM `hospitalbeddetail`  WHERE HospitalId=$UserID;";
                                } elseif ($type == 2) {
                                    $sql = "SELECT * FROM `providerbeddetail`  WHERE ProviderId=$UserID;";
                                }
                                $result = QueryExecutor::query($sql);
                                $row = $result->fetch_assoc();
                                ?>
                                <div class="col-6 fw-light"><label for="normalBed">Normal Bed</label> <input class="form-check-input float-end text-end me-2" type="checkbox" name="bed[]" id="normalBed" value="normalBed" <?php if ($row['NormalAvailability'] == "YES") {
                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            ?>></div>
                                <div class="col-6 fw-light"> <label for="icuBed">ICU Bed</label> <input class="form-check-input float-end text-end me-2" type="checkbox" name="bed[]" id="icuBed" value="icuBed" <?php
                                                                                                                                                                                                                    if ($row['ICUAvailability'] == "YES") {
                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    ?>></div>
                            </div>
                        </div>
                        <?php
                        if ($type == 1) {
                            echo '<div class="col-md-12">
                            <label class="labels fw-bold fs-5 mt-2">Blood</label>
                            <div class="row ms-1 me-2">';

                            $sql = "SELECT * FROM `blooddetail`  WHERE HospitalId=$UserID;";
                            $result = QueryExecutor::query($sql);
                            $row = $result->fetch_assoc();
                            //print_r($row);
                        ?>
                            <div class="col-3 fw-light"><label for="bloodAp">A+</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodAp" value="bloodAp" <?php
                                                                                                                                                                                                            if ($row['AplusAvailability'] == "YES") {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            }
                                                                                                                                                                                                            ?>></div>
                            <div class="col-3 fw-light"><label for="bloodBp">B+</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodBp" value="bloodBp" <?php
                                                                                                                                                                                                            if ($row['BplusAvailability'] == "YES") {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            }
                                                                                                                                                                                                            ?>></div>
                            <div class="col-3 fw-light"><label for="bloodOp">O+</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodOp" value="bloodOp" <?php
                                                                                                                                                                                                            if ($row['OplusAvailability'] == "YES") {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            }
                                                                                                                                                                                                            ?>></div>
                            <div class="col-3 fw-light"><label for="bloodABp">AB+</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodABp" value="bloodABp" <?php
                                                                                                                                                                                                                if ($row['ABplusAvailability'] == "YES") {
                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>></div>
                    </div>
                    <div class="row mt-2 ms-1 me-2">
                        <div class="col-3 fw-light"><label for="bloodAn">A-</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodAn" value="bloodAn" <?php
                                                                                                                                                                                                        if ($row['AminusAvailability'] == "YES") {
                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                        }
                                                                                                                                                                                                        ?>></div>
                        <div class="col-3 fw-light"><label for="bloodBn">B-</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodBn" value="bloodBn" <?php
                                                                                                                                                                                                        if ($row['BminusAvailability'] == "YES") {
                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                        }
                                                                                                                                                                                                        ?>></div>
                        <div class="col-3 fw-light"><label for="bloodOn">O-</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodOn" value="bloodOn" <?php
                                                                                                                                                                                                        if ($row['OminusAvailability'] == "YES") {
                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                        }
                                                                                                                                                                                                        ?>></div>
                        <div class="col-3 fw-light"><label for="bloodABn">AB-</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="blood[]" id="bloodABn" value="bloodABn" <?php
                                                                                                                                                                                                            if ($row['ABminusAvailability'] == "YES") {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            }
                                                                                                                                                                                                            ?>></div>
                    </div>
            </div>
        <?php } ?>
        <div class="col-md-12">
            <label class="labels fw-bold fs-5 mt-2">Oxygen Cylinder</label>
            <div class="row ms-1 me-2">
                <?php
                if ($type == 1) {
                    $sql = "SELECT * FROM `hospitalcylinderdetail`  WHERE HospitalId=$UserID;";
                } elseif ($type == 2) {
                    $sql = "SELECT * FROM `providercylinderdetail`  WHERE ProviderId=$UserID;";
                }
                $result = QueryExecutor::query($sql);
                $row = $result->fetch_assoc();
                ?>
                <div class="col-4 fw-light"><label for="oxCylinderSmall">Small Cylinder</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="cylinder[]" id="oxCylinderSmall" value="oxCylinderSmall" <?php
                                                                                                                                                                                                                                        if ($row['SmallAvailability'] == "YES") {
                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        ?>></div>
                <div class="col-4 fw-light"><label for="oxCylinderMedium">Medium Cylinder</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="cylinder[]" id="oxCylinderMedium" value="oxCylinderMedium" <?php
                                                                                                                                                                                                                                            if ($row['MediumAvailability'] == "YES") {
                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            ?>></div>
                <div class="col-4 fw-light"><label for="oxCylinderLarge">Large Cylinder</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="cylinder[]" id="oxCylinderLarge" value="oxCylinderLarge" <?php
                                                                                                                                                                                                                                        if ($row['LargeAvailability'] == "YES") {
                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        ?>></div>
            </div>
        </div>
        <?php
        if ($type == 1) {
            echo '<div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="labels fw-bold fs-5 mt-2">Vaccine</label>
                            <div class="row ms-1 me-2">';

            $sql = "SELECT * FROM `VaccineDetail`  WHERE HospitalId=$UserID;";
            $result = QueryExecutor::query($sql);
            $row = $result->fetch_assoc();
            //print_r($row);
        ?>
            <div class="fw-light"><label for="oxfordAsterzeneca">Oxford-Astrazeneca</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="oxfordAsterzeneca" value="oxfordAsterzeneca" <?php
                                                                                                                                                                                                                                        if ($row['OxfordAvailability'] == "YES") {
                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        ?>></div>
            <div class="fw-light"><label for="pfizer">Pfizer-BioNTech</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="pfizer" value="pfizer" <?php
                                                                                                                                                                                                    if ($row['PfizerAvailability'] == "YES") {
                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>></div>
            <div class="fw-light"><label for="moderna">Moderna</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="moderna" value="moderna" <?php
                                                                                                                                                                                            if ($row['ModernalAvailability'] == "YES") {
                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>></div>
            <div class="fw-light"><label for="sinopharm">Sinopharm</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="sinopharm" value="sinopharm" <?php
                                                                                                                                                                                                    if ($row['SinopharmAvailability'] == "YES") {
                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>></div>
            <div class="fw-light"><label for="sputnik">Sputnik V</label><input class="form-check-input float-end text-end me-2" type="checkbox" name="vaccine[]" id="sputnik" value="sputnik" <?php
                                                                                                                                                                                                if ($row['SputnikAvailability'] == "YES") {
                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>></div>
        </div>
    </div>
<?php } ?>
</div>
<div class="modal fade" id="confirmPasswordModal" aria-hidden="true" aria-labelledby="confirmPasswordModal" tabindex=" -1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Enter your password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="Username" class="col-form-label">Username:</label>
                    <input type="text" class="form-control" id="Username" value="<?php echo $User->get_username(); ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="col-form-label">Password:</label>
                    <input type="password" class="form-control" id="password-confirm" name="password-confirm">
                </div>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary float-clear mb-3" type="submit" name="updateResources" id="updateResources">
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary" style="margin-left: 45%; margin-top: -30px; margin-bottom: 30px;" name="confirmPasswordbutton" id="confirmPasswordbutton" data-bs-toggle="modal" data-bs-target="#confirmPasswordModal">Confirm</button>

</div>

</form>
</div>
</div>
</div>
</div>

</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" />
< script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function myhref(web) {
            window.location.href = web;
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#confirmPasswordbutton').on('click', function(e) {
                e.preventDefault();
                $('#confirmPasswordModal').modal('show');
            })
            $("#resources-form").on('submit', function(e) {
                //e.preventDefault();
                location.reload();
                //$('#confirmPasswordModal').modal('show');
            });
        });
    </script>

</html>