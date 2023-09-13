<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-6.6.0/src/Exception.php';
require 'PHPMailer-6.6.0/src/PHPMailer.php';
require 'PHPMailer-6.6.0/src/SMTP.php';

function send_mail($to,$str_cc,$str_bcc,$subject,$body,$from_addr,$from_name,$from_password){
  $from_name = "Dawat e Islami UK";
  $from_addr="web@dawateislami.co.uk";
  $from_password="{M238C.z]=^]48R";
  $cc_cnt ="";
  $bcc_cnt = "";
  if($str_cc!=''){
    $cc_addr=explode(",",$str_cc);
    $cc_cnt=count($cc_addr);
  }

  if($str_bcc!=''){
    $bcc_addr=explode(",",$str_bcc);
    $bcc_cnt=count($bcc_addr);
  }

  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  try {
    //Server settings
    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->Host = 'smtp.hostinger.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
    $mail->Username = $from_addr;                           // SMTP username
    $mail->Password = $from_password;                       // SMTP password
    $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                      // TCP port to connect to
    //Recipients
    $mail->setFrom($from_addr, 'Dawat e Islami UK');
    $mail->addAddress($to);     // Add a recipient
    $mail->addReplyTo($from_addr, $from_name);

    if($cc_cnt>=0){
		  for($i=0;$i<$cc_cnt;$i++){
			  $mail->addCC(trim($cc_addr[$i]));
		  }
    }

    if($bcc_cnt>=0){
      for($i=0;$i<$bcc_cnt;$i++){
        $mail->addBCC(trim($bcc_addr[$i]));
      }
    }
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('Academic_cv.pdf');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $body;

    $mail->send();
    //echo 'Message has been sent';
    return "sent";
  } catch (Exception $e) {
    //echo 'Message could not be sent.';
    //return 'Mailer Error: ' . $mail->ErrorInfo;
    return "failed";
  }
}
?>