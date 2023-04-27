<?php
session_start();
include '../../classes/probDomCls/Admin.php';

    if(isset($_GET['yes'])){
        $admin_temp = Admin::getInstance();
        $admin_temp->approve_account($_GET['id'],$_GET['uname'],$_GET['mail']); 
    }
    else{
        header('Location:../index.php');
    }
?>