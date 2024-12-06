<?php
include 'includes/class.autoload.inc.php';

//controls for assignment.php


if(isset($_POST["submit"])){ 
    // student name
    $name = $_POST['name'];
   //Letter Grade
   

    $usersContr = new UsersContr();

    if($usersContr->professorEdit($groupName, $name))
    {
        header("Location: .php?update=success");
    }
    else
    {
        header("Location: .php?update=error");
    }


}


?>