<?php



include("classes/probDomCls/member.php");
session_start();


$id = $_POST['id'];
$equipment = $_POST['equipment'];
$userType= $_POST['userType'];
$quantity=$_POST['quantity'];
$id2=$_SESSION["acID"];
if($userType=='1'){
    $sql = "INSERT INTO HHrequest
(RequestId,
ProviderId,
HospitalId,
State,
Equipment,
Quantity)
VALUES
(
  '0',
'$id',
'$id2',
'REQUESTED',
'$equipment',
'$quantity');
";
}
else{
    $sql = "INSERT INTO HPrequest
    (RequestId,
    ProviderId,
    HospitalId,
    State,
    Equipment,
    Quantity)
    VALUES
    ('0',
    '$id',
    '$id2',
    'REQUESTED',
    '$equipment',
    '$quantity');
    "; 
}



if ($result = QueryExecutor::query($sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql ;
  }









?>

