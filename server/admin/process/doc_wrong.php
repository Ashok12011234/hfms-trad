<?php
session_start();
include '../../classes/probDomCls/Admin.php';
    
    if(isset($_GET['io'])){
      $id = $_GET['id'];
      $name = $_GET['uname'];
      $mail = $_GET['mail'];
      
      $admin_temp = Admin::getInstance();
      $admin_temp->ask_more_docs($id,$name,$mail,$_GET['io']); 
      
    }
    else{
        header('Location:../index.php');
    }


?>