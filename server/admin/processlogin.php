<?php
include '../classes/probDomCls/Admin.php';
if(isset($_POST['username'])){
    $admin_temp = Admin::getInstance();
    session_start();
    if($admin_temp->log_in(secure_encrypt($_POST['username']),secure_encrypt($_POST['password']))){
        $_SESSION['admin'] = $admin_temp;
        header('Location: index.php');
    }
    else{
       header('Location:login.php?msg=failed');
    }
      
    
}

function secure_encrypt($input) {
    $trim = trim($input);
    $slashesremoved = stripslashes($input);
    return $input;
  }

?>