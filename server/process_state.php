<?php
if(isset($_POST['Status'])){
    echo $_POST['Status'];
    echo $_POST['type'];
}

include("navbar.php");
include("classes/probDomCls/request.php");

if (array_key_exists("id", $_POST)) {
    if ($_POST["type"] == RequestType::HH_REQUEST) {
        $request = new HHRequest($_POST["id"]);
    } else {
        $request = new HPRequest($_POST["id"]);
    }
    
    $request->assignAll();
 //   $request->buildChat();
 //   $chat = $request->getChat();
} else {
    # code...
}


if($_POST['Status']=="Accept"){
    $request->accept($_POST['count']);
}
if($_POST['Status']=="Cancel"){
    $request->cancel();
}
if($_POST['Status']=="Decline"){
    $request->decline();
}
if($_POST['Status']=="Transport"){
    $request->transport();
}
if($_POST['Status']=="Exchange"){
    $request->confirmExchange();
}
?>