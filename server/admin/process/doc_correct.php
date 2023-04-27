<?php
session_start();
include '../../classes/probDomCls/Admin.php';

    if(isset($_GET['yes'])){
        $admin_temp = Admin::getInstance();
        $admin_temp->vertify_document($_GET['id'],$_GET['uname'],$_GET['mail'],$_GET['ishos']); 
    }
    else{
        header('Location:../index.php');
    }
?>