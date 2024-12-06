<?php
include 'includes/class.autoload.inc.php';

//controls for a edit function for updating the GTA list and professor list
//adminDashAddprofesor
//professorDashAddGTA

//Process the update request for the update-code-request form in profDashAddGTA
if(isset($_POST["update-code-request"])){
    // get rerferences
    $userid = $_POST['userid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    // creates a new instance
    $usersContr = new UsersContr();
    //calls GTAEdit methd of the class
    if($usersContr->GTAEdit($userid, $firstname, $lastname, $email))
    {
        //redirect to profDashAddGta
        header("Location: profDashAddGta.php?update=success");
    }
    else
    {
        //redirect to profDashAddGta
        header("Location: profDashAddGta.php?update=success");
    }
}

//process the delete user acount access request
if(isset($_POST["activegta"])){
    //ID reference
    $userid = $_POST['deleteuser'];
    //new instance of UsersContr
    $usersContr = new UsersContr();
    //Call the activeUser method
    if($usersContr->activeUser($userid))
    {   
        //redirect to profDashAddGTA
        header("Location: profDashAddGta.php?delete=success");
    }
    else
    {
        //redirect to profDashAddGTA
        header("Location: profDashAddGta.php?delete=success");
    }
}

//process the edit modal requests 
if(isset($_POST["update-GTA"])){
    //get ID reference
    $userid = $_POST['activateuser'];
    //create new instance of UsersContr
    $usersContr = new UsersContr();
    //call reactivate user method
    if($usersContr->reactivateUser($userid))
    {
        //redirect to profDashAddGTA
        header("Location: profDashAddGta.php?delete=success");
    }
    else
    {
        //redirect to profDashAddGTA
        header("Location: profDashAddGta.php?delete=success");
    }
}
?>