<?php
session_start(); //Start a new or resume a session

if(isset($_POST["reset-password-submit"])){

    $selector =$_POST["selector"];
    $validator =$_POST["validator"];
    $password =$_POST["pwd"];
    $passwordRepeat =$_POST["pwd-repeat"];

    if(empty($password) && empty($passwordRepeat)){
        $_SESSION['passwordError']= "*Password is required";
        $_SESSION['passwordCError']= "*Password Confirmation is required";
        header("Location: ../create-new-password.php?selector=" . $selector . "&validator=" . $validator);
        exit();
    }
    if(empty($password)){
        $_SESSION['passwordError']= "*Password is required";
        header("Location: ../create-new-password.php?selector=" . $selector . "&validator=" . $validator);
        exit();
    }
        else if(empty($passwordRepeat)){
            $_SESSION['passwordCError']= "*Password Confirmation is required";
            header("Location: ../create-new-password.php?selector=" . $selector . "&validator=" . $validator);
            exit();
        }
    elseif (($password != $passwordRepeat) || ($passwordRepeat != $password)){
        $_SESSION['passwordError']= "*Passwords do not match";
        $_SESSION['passwordCError']= "*Password do not match";
        header("Location: ../create-new-password.php?selector=" . $selector . "&validator=" . $validator);
        exit();
    }

    $currentDate = date("U");
   
    $server = 'mysql:dbname=ccesdb;host=127.0.0.1';
    $database = 'ccesdb';
    $username = 'john';
    $pass = 'pass1234'; 
  $pdo = new PDO($server, $username, $pass);

  // Check connection
  if($pdo === false){
    die("ERROR: Could not connect. " );
  }
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $sql = "SELECT * from pwdReset where pwdResetSelector= ?";
  $query = $pdo->prepare($sql);
  $query->execute([$selector]);
  
  if ($query->rowCount() > 0){
      $row = $query->fetchAll();
  }
    $tokenBin = hex2bin($validator);
    $tokenHash = password_hash($tokenBin, PASSWORD_DEFAULT);
    $tokenCheck = password_verify($tokenBin, $row[0]['pwdResetToken']);

    if($tokenCheck === false){
        echo "You need to re-submit your request.";
    }elseif($tokenCheck === true){
        $tokenEmail = $row[0]['pwdResetEmail'];
        $sql = "SELECT * from users where email=?";
        $query = $pdo->prepare($sql);
        $query->execute([$tokenEmail]);
        if ($query ->rowCount() > 0){
            $row = $query->fetchAll();
        }
        
       $sql = "UPDATE users set pass = ? WHERE email = ?";
       $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
       $result = $pdo->prepare($sql)->execute([$newPwdHash, $tokenEmail]);
        
       $sql = "DELETE from pwdReset WHERE pwdResetEmail=?";
       $query = $pdo->prepare($sql);
        $query->execute([$tokenEmail]);
       if($query ->rowCount() > 0){
            echo "deleted from db successfully.";
            header("Location: ../login.php?newpwd=passwordupdated");
            }else{
            echo "ERROR: Could not execute";
        }
    }
}else{
    header("Location: ../login.php");
}