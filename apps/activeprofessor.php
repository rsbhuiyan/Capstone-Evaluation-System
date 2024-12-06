<?php
include 'includes/class.autoload.inc.php';
//Controller for adminDashAddProfessor

//Delete Professor button
//Toggles activeUser from 1 to 0

//if button name is clicked for deactivate professor
if(isset($_POST["activeprofessor"])){

    $userid = $_POST['deleteuser'];
    $usersContr = new UsersContr();

    if($usersContr->activeUser($userid))
    {
        header("Location: adminDashAddProfessors.php?delete=success");
        

    }
    else
    {
        header("Location: adminDashAddProfessors.php?delete=success");
    }
}

//if button name is clicked
if(isset($_POST["activateProfessor"])){

    $userid = $_POST['activateuser'];
    $usersContr = new UsersContr();

    if($usersContr->reactivateUser($userid))
    {
        header("Location: adminDashAddProfessors.php?update=success");
    }
    else
    {
        header("Location: adminDashAddProfessors.php?update=success");
    }
}
?>


