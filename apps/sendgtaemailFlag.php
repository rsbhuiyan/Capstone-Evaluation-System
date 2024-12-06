<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'includes/class.autoload.inc.php'; //Include autoloader class
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/./PHPMailer/src/Exception.php';
require_once __DIR__ . '/./PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/./PHPMailer/src/SMTP.php';
if(isset($_POST["sendEmail"])){
    $messageText = $_POST["message-text"];
    $givenByUser = isset($_POST["givenByUser"]) ? $_POST["givenByUser"] : "";
    $givenToUser = isset($_POST["givenToUser"]) ? $_POST["givenToUser"] : "";
    $recipientName = isset($_POST["recipient-name"]) ? $_POST["recipient-name"] : "";
    $studentid = isset($_POST["studentid"]) ? $_POST["studentid"] : "";
    $studentsView = new StudentsView();
    $stuInfo = $studentsView->selectallStudentInfo($studentid);
    $commentsView = new CommentsView();

 
    $mail = new PHPMailer(true);
   // var_dump($stuInfo);
//   if(empty($_POST["email"])){
//     header("Location: studentpage.php?id=" .$studentid ."email=error"");
//     die();
  
  try{
    echo "Message text: " .$messageText . "<br>";
    echo "Recipient Name: " .$recipientName . "<br>";
    echo "Student id: " .$studentid . "<br>";
    $commentsContr = new CommentsContr();
    if($commentsContr->insertComment($messageText, $givenByUser, $givenToUser, 1, $studentid)){
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
    $mail->Username = 'capstonecoursewsu@gmail.com';
    $mail->Password = "qdwubpvghqvpdrxf";
    $mail->SetFrom('capstonecoursewsu@gmail.com', 'Capstone Course WSU');
    $mail->AddAddress($recipientName);
    $mail->addReplyTo('capstonecoursewsu@gmail.com', 'Capstone Course WSU');
    
    $mail->isHTML(true);
    $mail->Subject = 'ACTION REQUIRED: Capstone Course Evaluation System' ;
    $mail->Body = '<p>You have recieved a notification from the professor.</p><p> Please sign into your account to view the message.</p>' ;
    
      $mail->Send();
    echo "email sent";
    }
     }catch(Exception $e){
         echo "Error";
     }
      header("Location: studentpage.php?id=" .$studentid ."&email=success");
}else{
   echo "error";
}