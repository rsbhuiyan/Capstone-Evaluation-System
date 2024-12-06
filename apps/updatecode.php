<?php
include 'includes/class.autoload.inc.php';

//controls for a edit function for updating the professor list
//in adminDashAddProfessor


if(isset($_POST["update-code-request"])){
    $userid = $_POST['userid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];


    $usersContr = new UsersContr();

    if($usersContr->professorEdit($userid, $firstname, $lastname, $email))
    {
        
        header("Location: adminDashAddProfessors.php?update=success");
    }
    else
    {
        header("Location: adminDashAddProfessors.php?update=error");
    }


}
?>