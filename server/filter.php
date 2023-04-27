<?php
session_start();
$filterType = $_POST['filterType'];

switch($filterType){
    
    case '1':
        $_SESSION["hosdashboard"]="1";
        $_SESSION["prodashboard"]="0";
        break;
    case '11':
        $_SESSION["hosdashboard"]="11";
        $_SESSION["prodashboard"]="0";
        break;
    case '12':
        $_SESSION["hosdashboard"]="12";
        $_SESSION["prodashboard"]="0";
     
        break;
    case '13':
        $_SESSION["hosdashboard"]="13";
        $_SESSION["prodashboard"]="0";
       
        break;
    case '14':
        $_SESSION["hosdashboard"]="14";
        $_SESSION["prodashboard"]="0";
        break;
    case '2':
        $_SESSION["hosdashboard"]="0";
        $_SESSION["prodashboard"]="2";
       echo "poda punda";
        break;
    case '21':
        $_SESSION["hosdashboard"]="0";
        $_SESSION["prodashboard"]="21";
        break;
    case '22':
        $_SESSION["hosdashboard"]="0";
        $_SESSION["prodashboard"]="22";
        break;
    case '111':
        $_SESSION["hosdashboard"]="111";
        $_SESSION["prodashboard"]="0";
        break;
    case '112':
        $_SESSION["hosdashboard"]="112";
        $_SESSION["prodashboard"]="0";
        break;
    case '121':
        $_SESSION["hosdashboard"]="121";
        $_SESSION["prodashboard"]="0";
        break;
    case '122':
        $_SESSION["hosdashboard"]="122";
        $_SESSION["prodashboard"]="0";
    break;
    case '123':
        $_SESSION["hosdashboard"]="123";
        $_SESSION["prodashboard"]="0";
    break;
    case '131':
        $_SESSION["hosdashboard"]="131";
        $_SESSION["prodashboard"]="0";
    break;
    case '132':
        $_SESSION["hosdashboard"]="132";
        $_SESSION["prodashboard"]="0";
    break;
    case '133':
        $_SESSION["hosdashboard"]="133";
        $_SESSION["prodashboard"]="0";
    break;
    case '134':
        $_SESSION["hosdashboard"]="134";
        $_SESSION["prodashboard"]="0";
    break;
    case '135':
        $_SESSION["hosdashboard"]="135";
        $_SESSION["prodashboard"]="0";
    break;
    case '136':
        $_SESSION["hosdashboard"]="136";
        $_SESSION["prodashboard"]="0";
    break;
    case '137':
        $_SESSION["hosdashboard"]="137";
        $_SESSION["prodashboard"]="0";
    break;
    case '138':
        $_SESSION["hosdashboard"]="138";
        $_SESSION["prodashboard"]="0";
    break;
    case '141':
        $_SESSION["hosdashboard"]="141";
        $_SESSION["prodashboard"]="0";
    break;
    case '142':
        $_SESSION["hosdashboard"]="142";
        $_SESSION["prodashboard"]="0";
    break;
    case '143':
        $_SESSION["hosdashboard"]="143";
        $_SESSION["prodashboard"]="0";
    break;
    case '144':
        $_SESSION["hosdashboard"]="144";
        $_SESSION["prodashboard"]="0";
    break;
    case '145':
        $_SESSION["hosdashboard"]="145";
        $_SESSION["prodashboard"]="0";
    break;

    case '211':
        $_SESSION["hosdashboard"]="0";
        $_SESSION["prodashboard"]="211";
    break;
    case '212':
        $_SESSION["hosdashboard"]="0";
        $_SESSION["prodashboard"]="212";
    break;
    case '221':
        $_SESSION["hosdashboard"]="0";
        $_SESSION["prodashboard"]="221";
    break;
    case '222':
        $_SESSION["hosdashboard"]="0";
        $_SESSION["prodashboard"]="222";
    break;
    case '223':
        $_SESSION["hosdashboard"]="0";
        $_SESSION["prodashboard"]="223";
    break;
   
    case '3':
        $_SESSION["hosdashboard"]="1";
        $_SESSION["prodashboard"]="2";
        break;
    case '31':
        $_SESSION["hosdashboard"]="11";
        $_SESSION["prodashboard"]="21";
        break;
    case '32':
        $_SESSION["hosdashboard"]="12";
        $_SESSION["prodashboard"]="22";
     
        break;
    case '33':
        $_SESSION["hosdashboard"]="13";
        $_SESSION["prodashboard"]="0";
       
        break;
    case '34':
        $_SESSION["hosdashboard"]="14";
        $_SESSION["prodashboard"]="0";
        break;
    
    case '311':
        $_SESSION["hosdashboard"]="111";
        $_SESSION["prodashboard"]="211";
        break;
    case '312':
        $_SESSION["hosdashboard"]="112";
        $_SESSION["prodashboard"]="212";
        break;
    case '321':
        $_SESSION["hosdashboard"]="121";
        $_SESSION["prodashboard"]="221";
        break;
    case '322':
        $_SESSION["hosdashboard"]="122";
        $_SESSION["prodashboard"]="222";
    break;
    case '323':
        $_SESSION["hosdashboard"]="123";
        $_SESSION["prodashboard"]="223";
    break;
    case '331':
        $_SESSION["hosdashboard"]="131";
        $_SESSION["prodashboard"]="0";
    break;
    case '332':
        $_SESSION["hosdashboard"]="132";
        $_SESSION["prodashboard"]="0";
    break;
    case '333':
        $_SESSION["hosdashboard"]="133";
        $_SESSION["prodashboard"]="0";
    break;
    case '334':
        $_SESSION["hosdashboard"]="134";
        $_SESSION["prodashboard"]="0";
    break;
    case '335':
        $_SESSION["hosdashboard"]="135";
        $_SESSION["prodashboard"]="0";
    break;
    case '336':
        $_SESSION["hosdashboard"]="136";
        $_SESSION["prodashboard"]="0";
    break;
    case '337':
        $_SESSION["hosdashboard"]="137";
        $_SESSION["prodashboard"]="0";
    break;
    case '338':
        $_SESSION["hosdashboard"]="138";
        $_SESSION["prodashboard"]="0";
    break;
    case '341':
        $_SESSION["hosdashboard"]="141";
        $_SESSION["prodashboard"]="0";
    break;
    case '342':
        $_SESSION["hosdashboard"]="142";
        $_SESSION["prodashboard"]="0";
    break;
    case '343':
        $_SESSION["hosdashboard"]="143";
        $_SESSION["prodashboard"]="0";
    break;
    case '344':
        $_SESSION["hosdashboard"]="144";
        $_SESSION["prodashboard"]="0";
    break;
    case '345':
        $_SESSION["hosdashboard"]="145";
        $_SESSION["prodashboard"]="0";
    break;
    }


?>