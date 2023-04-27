<?php
// Start the session

session_start();
include '../classes/probDomCls/Admin.php';
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
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
    <link rel="stylesheet" href="../assets/css/Hospital-page.css">

    <title>Admin Panel</title>



</head>

<body>

    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success" style="background-color: #e3f2fd;">
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
        <a class="navbar-brand ms-3" href="#" style="font-size: x-large;  font-size: 1.5em; font-family: Monospace; font-weight: bold;">Life Share</a>
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto me-2" style="font-size: large;">
                <li class='nav-item ms-2'> <a class='nav-link' href='check_new.php'>Check New</a></li>
                <li class='nav-item ms-2'> <a class='nav-link' href='./check_change.php'>Check Pending</a></li>
                <li class='nav-item ms-2'> </li>
            </ul>
        </div>

        <!--Navbar notification panel-->
        <div class="dropdown me-4 ms-auto" style="user-select: none;">


            <div class="dropdown-menu mt-4" aria-labelledby="hospitalNotificationBell" id="hospitalNotificationsPanel">
                <p class="fs-6">No notifications to show</p>
                <div onclick="myhref('#');" style="cursor: pointer;">
                    <p class="fw-light">Lorem ipsum dolor sit amet, coiai adipisicing.</p>
                </div>
                <hr style="margin-bottom: 0px;">
                <div style="cursor: pointer;">
                    <p class="fw-light">Lorem ipsum dolor sit amet, coiai adipisicing.</p>
                </div>
                <hr style="margin-bottom: 0px;">
                <div style="cursor: pointer;">
                    <p class="fw-light">Lorem ipsum dolor sit amet, coiai adipisicing.</p>
                </div>


            </div>
        </div>

        <!--Navbar Signout panel-->
        <div class="dropdown" style="user-select: none;">
            <div id="hospitalDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="user-name me-4 ms-1" id="hospitalDropdownButton"><i class='fas fa-sign-out-alt'></i> Log out</span>
            </div>

        </div>
        </div>
        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
    <!--Navbar end-->

    <!-- Headings and title-->

    <div class="row justify-content-between mt-5 ms-2 me-2">
        <div class="col-md-8 ">
            <h2 id="title1">All Hospitals & Providers</h2>
            <br>
        </div>
        <div class="col-md-4">
            <div id="search1" class="input-group">
                <input type=" text" class="form-control" placeholder="Search for Hospital or Provider" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('hospitalDropdownButton').onclick = function() {
            window.location.href = 'process_logout.php';
        };
    </script>



    <!-- Headings and title end-->

    <!--Content-->