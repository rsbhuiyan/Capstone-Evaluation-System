<?php
include './class.autoload.include.php'; //Include file that will automatically load

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
if(isset($_POST["reset-request-submit"])){
  if(empty($_POST["email"])){
      header("Location: ../reset-password.php?reset=error");
    die();
  }
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $tokenHexed = bin2hex($token);

    $protocol =  isset($_SERVER["HTTPS"]) ? "https://" : "http://"; 
    $host =  $_SERVER["HTTP_HOST"];
    $urlBase = explode('/', $_SERVER["REQUEST_URI"]);
    array_pop($urlBase);
    array_pop($urlBase);
    $base = implode('/', $urlBase); 
    $url = $protocol . $host . $base ."/create-new-password.php?selector=" .$selector. "&validator=" . $tokenHexed;

    $expires = date("U")+1800;
    $isError = false;
    $mail = new PHPMailer(true);
    
     
    // if (empty($_POST["email"])) {
    //   $emailErr = "* Email is required";
    //   $isError = true;
    //   header("Location: ../reset-password.php?reset=error");

    // } 
      $userEmail = $_POST["email"];
      // $_SESSION['email'] = $userEmail;
      if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "* Invalid email";
        $email = "";
        $isError = true;
         header("Location: ../reset-password.php?reset=error");
         die();
      }
    //UserView object to do query calls
    $userobj = new UsersView();
    $passwordSet = $userobj->allUserInfo($userEmail);
    var_dump($passwordSet);
    if ($passwordSet==null) {
      echo "password set is null";
      $emailErr = "* Sorry that email is not in our database. Please seek out an admin for assistance.";
      $email = "";
      $isError = true;
        header("Location: ../reset-password.php?reset=errorexists");
        die();
    }
      
    
    $server = 'mysql:dbname=ccesdb;host=127.0.0.1';
    $database = 'ccesdb';
    $username = 'john';
    $password = 'pass1234'; 
    $pdo = new PDO($server, $username, $password);

  // Check connection
  if($pdo === false){
    die("ERROR: Could not connect. " );
  }
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $sql = $pdo->prepare("DELETE FROM pwdReset WHERE pwdResetEmail=?");
    $stmt = $sql->execute([$userEmail]);

    $sql = $pdo->prepare("INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)");

    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    echo "hashedToken: " .$hashedToken ."<br>";
    $stmt = $sql->execute([$userEmail, $selector, $hashedToken, $expires]);

    $pdo = null;
    try{
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
    $mail->Username = 'capstonecoursewsu@gmail.com';
    $mail->Password = "qdwubpvghqvpdrxf";
    
    $mail->SetFrom('capstonecoursewsu@gmail.com', 'Capstone Course WSU');
    $mail->AddAddress($userEmail);
    $mail->addReplyTo('capstonecoursewsu@gmail.com', 'Capstone Course WSU');
    
    $mail->isHTML(true);
    $mail->Subject = 'Set password for CCES.';
    $mail->Body = '<p>We recieved a password set request. The link to set your password is below. If you did
    not make this request, you can ignore this email.</p>
    <p>Here is your password reset link: <br>
    <a href = "'. $url .'">' .$url. '</a></p>
    ';
    
       $mail->Send();
    echo "email sent";
    }catch(Exception $e){
        echo "Error";
    }
        header("Location: ../reset-password.php?reset=success");
}else{
        header("Location: ../login.php");
}