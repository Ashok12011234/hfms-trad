<?php
$path = dirname(dirname( dirname(__FILE__) ));
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require $path.'/assets/PHPMailer-master/src/Exception.php';
require $path.'/assets/PHPMailer-master/src/PHPMailer.php';
require $path.'/assets/PHPMailer-master/src/SMTP.php';

Class MailSender
{
  public static function sendMail($name, $address, $subject, $content) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";            
    $mail->SMTPDebug  = 1;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "shangopimora@gmail.com";
    $mail->Password   = "gopinath";
             
// if(isset($_POST['io'])){
    //echo $_POST['io'];
    $mail->IsHTML(true);
    $mail->AddAddress($address, $name);
    $mail->SetFrom("shangopimoras@gmail.com", "Hospital Management System");
    
    
    $mail->Subject = $subject;
    $content = $content." ";

    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
      return false;
      var_dump($mail);
    } 
    else {
      return true; 
    }  
  }
}   
?>
