<?php
//Starts the php session
session_start();
include 'includes/class.autoload.inc.php';


try {
  //Create Connection
// Check connection
  if ($pdo === false) {
    die("ERROR: Could not connect. ");
  }
  echo "Connected successfully";

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //Get user inputs
  $userid = $_POST['userid'];
  $sectionid = $_POST['sectionid'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $roleofuser = $_POST['roleofuser'];


  //Input Data into mysql
  $sql = "INSERT INTO users (userid, sectionid,firstname,lastname, email,pass,roleofuser) VALUES ('$userid', '$sectionid', '$firstname', '$lastname','$email', '$pass', '$roleofuser')";



  $pdo->exec($sql);
  echo "New record created successfully";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


?>