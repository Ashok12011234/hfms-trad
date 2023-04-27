<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body style="box-shadow: 0px 0px;">
    <section class="login-clean">
        <form method="post" action="processlogin.php">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <input class="form-control-plaintext" type="text" value="Admin Panel" readonly="">
            </div>
            <div class="form-group input-group">
                <span class="input-group-text"><i class="fa fa-user" style="font-size:15px;"></i></span>
                <input class="form-control" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group input-group">
                <span class="input-group-text"><i class="fa fa-lock" style="font-size:15px;"></i></span>
                <input class="form-control"  type="password" name="password" placeholder="Password " required>
            </div>
            <?php if(isset($_GET['msg'])){?>
            <div class="form-group">
                <p class="text-danger">UserName or Password is wrong. Please Retry..</p>

            </div>
            <?php }?>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" style="background: var(--green);">Log in</button>
            </div>
            <div class="float-clear"></div>
            
        </form>
    </section>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

