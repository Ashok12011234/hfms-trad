<?php
include("common.php");
include("navbar.php");

include("classes/sysLvlCls/File.php");

if (isset($_POST['updateDetails'])) {
    if ($_POST['password-confirm'] == $user->get_password()) {
        // $hospitalName = mysqli_real_escape_string($GLOBALS['connection'], $_POST['hospitalName']);
        // $hospitalName = trim($_POST['hospitalName'], "\n\r\t\v\0");
        $hospitalName = QueryExecutor::real_escape_string($_POST['hospitalName']);
        $email =  QueryExecutor::real_escape_string($_POST['email']);
        $phoneNo =  QueryExecutor::real_escape_string($_POST['phoneNo']);
        $accountNumber =  QueryExecutor::real_escape_string($_POST['accountNumber']);
        $bankName =  QueryExecutor::real_escape_string($_POST['bankName']);
        $website =  QueryExecutor::real_escape_string($_POST['website']);
        $address =  QueryExecutor::real_escape_string($_POST['address']);
        $user->set_name($hospitalName);
        $user->set_email($email);
        $user->set_phoneno($phoneNo);
        $user->set_accountNo($accountNumber);
        $user->set_bankName($bankName);
        $user->set_website($website);
        $user->set_address($address);

        $id = $user->get_id();
        if ($type == 1) {
            $target = "assets/documents/DatabaseFiles/Hospital/Profile/$id";
        } else if ($type == 2) {
            $target = "assets/documents/DatabaseFiles/Provider/Profile/$id";
        }
        $image = basename($_FILES["profile_picture"]["name"]);
        if ($image != "") {
            $result = File::upload($_FILES["profile_picture"], FileType::IMAGE, $target);
            if (isset($result["fileName"])) {
                $user->set_profile(QueryExecutor::real_escape_string($result["fileName"]));
            }
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
    <link rel="stylesheet" href="./assets/css/profilePage.css">
    <link rel="stylesheet" href="./assets/css/Hospital-page.css">
    <title>Edit Profile</title>
</head>

<body>

    <!-- Body -->
    <div class="rounded bg-white m-4 pt-3 pe-3 ps-3 body-contentx">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="200px" <?php echo "src='" . $user->get_profile() . "'" ?>>
                        <div class="input-group  input-group-sm mb-3" style="width: 300px;">
                            <input type="file" class="form-control" id="inputGroupFile02" name="profile_picture">
                            <label class="input-group-text" for="inputGroupFile02">Update</label>
                        </div>
                        <span class="font-weight-bold"><?php echo $user->get_username() ?></span>
                        <span class="text-black-50"><?php echo $user->get_name() ?></span>
                        <span> </span>
                    </div>
                </div>
                <div class="col-md-8 border-right ">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile</h4>
                        </div>
                        <div class="row mt-3">
                            <?php
                            echo "<div class='col-md-12'><label class='labels fw-bold'>Username</label><input type='text' name='username' class='form-control' placeholder='' value=" . $user->get_username() . " disabled ></div>
                                <div class='col-md-12'><label class='labels fw-bold'>";
                            if ($type == 1) {
                                echo "Hospital";
                            } else if ($type == 2) {
                                echo "Company";
                            }
                            echo " Name</label><input type='text' name='hospitalName' class='form-control' placeholder='' value=" . $user->get_name() . "></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Email ID</label><input type='text' name='email' class='form-control' placeholder='' value=" . $user->get_email() . "></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Phone</label><input type='text' name='phoneNo' class='form-control' placeholder='' value=" . $user->get_phoneno() . "></div>
                                <div class='row'><div class='col-6'><label class='labels fw-bold'>Account Number</label><input type='text' name='accountNumber' class='form-control' placeholder='' value='" . $user->get_accountNo() . "' disabled></div><div class='col-6'><label class='labels fw-bold'>Bank Name</label><input type='text' class='form-control' name='bankName' placeholder='' value='" . $user->get_bankName() . "' disabled></div></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Website</label><input type='text' name='website' class='form-control' placeholder='' value=" . $user->get_website() . "></div>
                                <div class='col-md-12'><label class='labels fw-bold'>Address</label><input type='text' name='address' class='form-control' placeholder='' value='" . $user->get_address() . "'></div>";
                            ?>
                        </div>
                        <div class="modal fade" id="confirmPasswordModal" aria-hidden="true" aria-labelledby="confirmPasswordModal" tabindex=" -1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalToggleLabel">Enter your password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-6">
                                            <label for="Username" class="col-form-label">Username:</label>
                                            <input type="text" class="form-control" id="Username" value="<?php echo $user->get_username(); ?>" disabled>
                                        </div>
                                        <div class="mb-6">
                                            <label for="password-confirm" class="col-form-label">Password:</label>
                                            <input type="password" class="form-control" id="password-confirm" name="password-confirm">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input class="btn btn-primary float-clear mb-3" type="submit" name="updateDetails" id="updateDetails">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" style="margin-left: 45%;margin-top:20px;" name="updateProfile" id="updateProfile" data-bs-toggle="modal" data-bs-target="#confirmPasswordModal">Confirm</button>


                    </div>
                </div>
            </div>
        </form>
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
            $('#updateProfile').on('click', function(e) {
                e.preventDefault();
                $('#confirmPasswordModal').modal('show');
                $('password-confirm').focus();
            })
            $("#resources-form").on('submit', function(e) {
                //e.preventDefault();
                location.reload();
                //$('#confirmPasswordModal').modal('show');
            });
        });
    </script>

</html>