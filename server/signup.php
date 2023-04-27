<?php
include("classes/sysLvlCls/Signupper.php");

session_start();
if (!array_key_exists("signupper", $_SESSION)) {
    $signupper = new Signupper();
}
else {
    $signupper = $_SESSION["signupper"];
}
$error = "";
$success = "";

if (array_key_exists("next", $_POST)) {
    $signupData["post"] = $_POST;
    if (isset($_FILES)) {
        $signupData["files"] = $_FILES;
    }
    $result = $signupper->signup($signupData);
    $error = $result["error"];
    if (!empty($result["next"])) {
        $_POST["next"] = $result["next"];
    }
}

if (array_key_exists("next", $_POST) && $_POST["next"] == "nine-success") {
    session_unset();
}else {
    $_SESSION["signupper"] = $signupper;
}

function displayDev(String $devId): void
{
    if ((!array_key_exists("next", $_POST) && $devId == "one-sendOTP")
        || (array_key_exists("next", $_POST) && $_POST["next"] == $devId)) {
        echo "block";
    } else {
        echo "none";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sign up</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Signup-page.css">
</head>

<body style="box-shadow: 0px 0px;">
    <section class="login-clean mb-3" style="padding-top:
        <?php
        if (array_key_exists("next", $_POST) && $_POST["next"] == "seven-bankAC") {
            echo "4%";
        } 
        else if ($error != "") {
            echo "10%";
        }
        else {
            echo "13%";
        }
        ?>
    ;">
        <div class="form-collection">
            <h2 class="sr-only">Signup Form</h2>
            <div class="illustration">
                <input class="form-control-plaintext" type="text" value="Life Share" readonly="">
            </div>
            <!--one-sendOTP-->
            <div id="one-sendOTP" style="display:
                <?php
                displayDev("one-sendOTP");
                ?>
            ;">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="emailAddress" id="emailAddress" amearia-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <button id="sendOTP" class="btn btn-primary btn-block" type="submit" name="next" value="two-verify" style="background: var(--green);">Send OTP</button>
                </form>
            </div>
            <!--two-verify-->
            <div id="two-verify" style="display:
                <?php
                displayDev("two-verify");
                ?>
            ;">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="OTP-3" class="form-label">Enter the OTP code</label>
                        <div class="float-clear"></div>
                        <?php
                        for ($i = 3; $i >= 0; $i--) {
                            echo '<input type="number" class="form-control OTP" name="OTP-' . $i . '" max="9" min="0" size="1" style="text-align:center;" required>';
                        }
                        ?>
                        <div class="float-clear"></div>
                    </div>
                    <?php
                        if (!empty($error)) {
                            echo '<a class="forgot" href="signup.php">Resend</a>';
                        }
                    ?>
                    <button id="verify" class="btn btn-primary btn-block" type="submit" name="next" value="three-username" style="background: var(--green);">Verify</button>
                </form>
            </div>
            <!--three-username-->
            <div id="three-username" style="display:
                <?php
                displayDev("three-username");
                ?>
            ;"> <!--(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[-+_!@#$%^&*.,?])
            ---------------
            ^[a-zA-Z0-9]([._-](?![._-])|[a-zA-Z0-9]){3,18}[a-zA-Z0-9]$-->
                <form action="" method="POST">
                    <label for="username" class="form-label">New username</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fa fa-user" style="font-size:15px;"></i></span>
                        <input type="email" class="form-control" id="username" name="username" 
                            aria-label="Recipient's username" aria-describedby="basic-addon2" required
                            pattern="^{8,16}$" oninvalid="this.setCustomValidity('Enter a username that looks like email patterns with the length 8-16.')">
                    </div>
                    <button id="username-next" class="btn btn-primary btn-block" type="submit" name="next" value="four-password" style="background: var(--green);">Next</button>
                </form>
            </div>
            <!--four-password-->
            <div id="four-password" style="display:
                <?php
                displayDev("four-password");
                ?>
            ;">
                <form action="" method="POST">
                    <label for="password" class="form-label">New password</label>
                    <div class="form-group input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-lock" style="font-size:15px;"></i></span>
                        <input id="npassword" class="form-control" type="password" name="password" required
                        pattern="^(?=.*[A-Z]{1,13})(?=.*[!@#$&*]{1,13})(?=.*[0-9]{1,13})(?=.*[a-z]{1,13}).{8,16}$"
                        oninvalid="this.setCustomValidity('Enter a strong password with the length 8-16.')">
                        <span class="input-group-text eye" id="addon-wrapping">
                            <i id="eye-icon-open-np" class="fa fa-eye eye-icon-np"></i>
                            <i class="fa fa-eye-slash eye-icon-np"></i>
                        </span>
                    </div>
                    <button id="password-next" class="btn btn-primary btn-block" type="submit" name="next" value="five-confirm-password" style="background: var(--green);">Next</button>
                </form>
            </div>
            <!--five-confirm-password-->
            <div id="five-confirm-password" style="display:
                <?php
                displayDev("five-confirm-password");
                ?>
            ;">
                <form action="" method="POST">
                    <label for="password" class="form-label">Re-enter the password</label>
                    <div class="form-group input-group mb-2">
                        <span class="input-group-text"><i class="fa fa-lock" style="font-size:15px;"></i></span>
                        <input id="cpassword" class="form-control" type="password" name="cPassword" required>
                        <span class="input-group-text eye" id="addon-wrapping">
                            <i id="eye-icon-open-cp" class="fa fa-eye eye-icon-cp"></i>
                            <i class="fa fa-eye-slash eye-icon-cp"></i>
                        </span>
                    </div>
                    <button id="confirm-password" class="btn btn-primary btn-block" type="submit" name="next" value="six-acType" style="background: var(--green);">Confirm</button>
                </form>
            </div>
            <!--six-acType-->
            <div id="six-acType" style="display:
                <?php
                displayDev("six-acType");
                ?>
            ;">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="acType" class="form-label">Select type of your account</label>
                        <select class="form-select" id="acType" name="acType" aria-label="Default select example">
                            <option value="HOSPITAL">Hospital</option>
                            <option value="PROVIDER">Provider</option>
                        </select>
                    </div>
                    <button id="acType-next" class="btn btn-primary btn-block" type="submit" name="next" value="seven-bankAC" style="background: var(--green);">Next</button>
                </form>
            </div>
            <!--seven-bankAC-->
            <div id="seven-bankAC" style="display:
                <?php
                displayDev("seven-bankAC");
                ?>
            ;">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="bankType" class="form-label">Select bank</label>
                        <select class="form-select" id="bankType" name="bankType" aria-label="Default select example">
                            <!--option selected></option-->
                            <option value="BOC">Bank of Ceylon</option>
                            <option value="PEOPLE">People's Bank</option>
                            <option value="HNB">Hatton National Bank PLC</option>
                            <option value="COMMERCIAL">Commercial Bank of Ceylon</option>
                            <option value="NSB">National Savings Bank</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="acNo" class="form-label">Account number</label>
                        <input type="number" class="form-control" id="acNo" name="acNo" required>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload any evidence to verify your bank account</label>
                        <input class="form-control" type="file" id="formFile" name="bankEvidence" style="padding: 0px;" required>
                    </div>
                    <a class="forgot" href="./assets/documents/PageDocuments/Signup/BankEvidence.pdf" target="blank">FAQ</a>
                    <button id="bankAC-next" class="btn btn-primary btn-block" type="submit" name="next" value="eight-evidence" style="background: var(--green);">Next</button>
                </form>
            </div>
            <!--eight-evidence-->
            <div id="eight-evidence" style="display:
                <?php
                displayDev("eight-evidence");
                ?>
            ;">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload any evidence to verify your Institution</label>
                        <input class="form-control" type="file" id="formFile" name="instituteEvidence" style="padding: 0px;" required>
                    </div>
                    <a class="forgot" href="#" target="blank">FAQ</a>
                    <button id="evidence-submit" class="btn btn-primary btn-block" type="submit" name="next" value="nine-success" style="background: var(--green);">Submit</button>
                </form>
            </div>
            <!--nine-success-->
            <div id="nine-success" style="display:
                <?php
                displayDev("nine-success");
                ?>
            ;">
                <div class="alert alert-primary p-2" role="alert">
                    <p style="text-align: justify;font-weight: 600;">Successfully <b>SIGNUP</b> request has been sent to the Health Ministry for the confirmation. You'll receive response mail from the Health Ministry within 2-4 days.</p>
                    STAY TUNED WITH US!!!
                </div>
            </div>
            <div class="float-clear"></div>
            <div style="text-align: center;">
                <a class="forgot" href="./login.php" style="display: inline;">Log in</a>
                <span style="color: #198754;"> | </span>
                <a class="forgot" href="./hospitalDashoard.php" style="display: inline;">Visit as a guest</a>
            </div>
            <?php
            if ($error != "") {
                echo '<div class="alert alert-danger mx-0 mt-2 mb-1" role="alert">' . $error . '</div>';
            }
            ?>
        </div>
    </section>
    <div id="mail-sending" class="container text-center my-5 p-4">
        <p>Mail is being sent</p>
        <!--p class="lead">You will be redirected to Check New Request Page very shortly</p-->
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $("input[type=number]").on("mousewheel", function(e) {
            $(e.target).blur();
        });

        $(".eye-icon-cp").click(function() {
            if ($("#cpassword").attr("type") === "password") {
                $("#cpassword").attr("type", "text");
            } else {
                $("#cpassword").attr("type", "password");
            }
            $(".eye-icon-cp").css("display", "block");
            $(this).css("display", "none");
        });

        $(".eye-icon-np").click(function() {
            if ($("#npassword").attr("type") === "password") {
                $("#npassword").attr("type", "text");
            } else {
                $("#npassword").attr("type", "password");
            }
            $(".eye-icon-np").css("display", "block");
            $(this).css("display", "none");
        });

        $("#sendOTP").click(function() {
            if ($("#emailAddress").val() != "" && $("#emailAddress").is(':valid')) {
                $("#mail-sending").css("display", "block");
                $("section").css("display", "none");
            }
        });
    </script>
</body>

</html>
