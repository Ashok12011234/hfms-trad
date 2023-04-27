<?php
include("classes/probDomCls/member.php");
include("AuthenticationService.php");
session_start();


header("Location: http://localhost:8000/oauth2/sign_in");


$error = Member::login(AuthenticationService::getUser(), "LifeShare#14");


?>
