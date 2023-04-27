<?php
//include("./MailSender.php");
//include("./connection.php");
$path = dirname(dirname( dirname(__FILE__) ));
require $path.'/classes/sysLvlCls/MailSender.php';
require $path.'/classes/sysLvlCls/connection.php';

class Admin
{
  private static $instance;
  private $connection;
  //singleton design pattern

  private function __construct()
  {
    $servername = Database::HOST;
    $username = Database::USERNAME;
    $password = Database::PASSWORD;
    $database = Database::NAME;
    $connection = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }

    $this->connection = $connection;
  }

  public static function getInstance()
  {
    if (self::$instance == null) {
      self::$instance = new Admin();
    }

    return self::$instance;
  }

  public function log_in($username, $pw){
    if($username=='admin' && $pw=='ad@nike76'){
     return TRUE;
      
  }
  else{
    return FALSE;
  }
  }

  public function log_out()
  {

    header('Location:login.php');
  }

  public function vertify_document($id, $name, $mail, $type)
  {
    if ($type == "HOSPITAL") {
      $sql = "UPDATE newaccount SET Status='PENDING',Doc_Status='Correct' WHERE NewAccountID='$id'";

      if ($this->connection->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: ../check_bank.php?id=" . $id);
      } else {
        echo "Error updating record: " . $this->connection->error;
      }
    } else {
      $this->approve_account($id, $name, $mail);
    }
  }

  public function ask_more_docs($id, $name, $mail, $content)
  {
    $sql = "UPDATE newaccount SET Status='PENDING',Doc_Status='False' WHERE NewAccountID='$id'";

    if ($this->connection->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $this->connection->error;
    }
    
    $status = MailSender::sendMail($name, $mail, "Your Document Details are incomplete", $content);
    if ($status) {
      header('Location:../mail_sent.php');
    }
    
  }

  public function ask_more_bank_docs($id, $name, $mail, $content)
  {

    $sql = "UPDATE newaccount SET Status='PENDING',Bank_Status='False' WHERE NewAccountID='$id'";

    if ($this->connection->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $this->connection->error;
    }

    $status = MailSender::sendMail($name, $mail, "Your Document Details are incomplete", $content);
    if ($status) {
      header('Location:../mail_sent.php');
    }
  }

  // public function vertify_bank

  public function approve_account($id, $name, $mail)
  {
    $sql = "UPDATE newaccount SET Status='APPROVED',Doc_Status='Correct',Bank_Status='Correct' WHERE NewAccountID='$id'";

    if ($this->connection->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $this->connection->error;
    }

    $sql = "SELECT Password,AccountType,BankName, AccountNumber  FROM newaccount WHERE NewAccountID='$id' ;";
    $result = $this->connection->query($sql);
    $row = $result->fetch_assoc();
    $pw = $row['Password'];
    if ($row['AccountType'] == "PROVIDER") {


      $sql1 = "INSERT INTO provider (ProviderId, UserName,Email, Password, Name) VALUES ('$id', '$name', '$mail', '$pw', '$name');";

      $result = $this->connection->query($sql1);
    } else {
      $bnk  = $row['BankName'];
      $accno = $row['AccountNumber'];
      $sql1 = "INSERT INTO hospital (HospitalId, UserName,Email, Password, Name,BankName,AccountNumber) VALUES ('$id', '$name', '$mail', '$pw', '$name','$bnk','$accno');";

      $result = $this->connection->query($sql1);
    }





    $content = "Hello " . $name . "!!!  <h3>Your Request for joining HMS has been accepted.</h3> <p> Now You can Login with your username and Password.<p> <h4> When Logging in you need to give intial stock details.</h4> <p> Have a great day. </p><i> Lovely wishes from HMS !!!</i>";
    $status = MailSender::sendMail($name, $mail, "Your Account Has been vertified", $content);
    if ($status) {
      header('Location:../account_created.php');
    } else {
      echo "Sorry Mail can't be sent!!";
    }
  }
}
