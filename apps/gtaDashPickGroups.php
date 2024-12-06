<?php
session_start();
include 'includes/class.autoload.inc.php';
$util = new Apputil();
$util->checkLogin(__FILE__);
$gtaemail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pick Groups</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" style="text/css" href="styles/gtaDashPickGroups.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <!-- Font awesome library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
  <style>
    /* Change the outline colors in text box */
    /* input.form-control:focus { */
    /* outline: 2px solid green; */
    /* } */
    :root {
      --primary-color: #008C81;
      --background-color: #F5F5F5;
      --text-color: #008C81;
      --button-color: #88D7C0;
      --button-hover-color: #F0F0F0;
      --container-bg-color: #F5F5F5;
      --section-bg-color: #FFFFFF;
      --table-header-color: #008C81;
    }

    /* Set box sizing property to border box for all elements on webpage */
    * {
      box-sizing: border-box;
    }

    /* Defined with a margin and padding of 0 */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      /* color optimization */
      background-color: var(--background-color);
      line-height: 1.6;
      /* Increase line-height for better readability */
      font-size: 18px;
      /* Increase font size for better readability */
    }

    /* Nav Bar */

    .navbar {
      /* Color optimization */
      background-color: var(--primary-color);
      padding: 10px;
      font-weight: 700;
    }

    .nav-item {
      color: #008C81;
    }

    nav-link:active {
      background-color: #A9F3E9;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      margin-top: 20px;
      margin-bottom: 20px;
      /*margin-bottom to separate the containers */
      padding: 20px;
      background-color: var(--container-bg-color);
      /*light grey background color */
      border-radius: 8px;
      /*border-radius for a softer look */
    }

    .ftco-section {
      background-color: var(--section-bg-color);
      width: 100%;
      padding: 20px 30px;
      border-radius: 8px;
      margin-bottom: 20px;
      color: var(--input-text-color);
    }


    .ftco-section h3 {
      margin-bottom: 20px;
      font-size: 24px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    /* Adding the scroll bar to the two tables */
    .table-scroll {
      max-height: 400px;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
      /* For smooth scrolling on iOS devices */
    }

    table tr:first-child th {
      color: black;
    }

    th,
    td {
      text-align: left;
      padding: 12px;
      border-bottom: 1px solid #ccc;
    }


    .form-control {
      color: var(--input-text-color);
      /* Use a more accessible font color for the text input */
    }

    .btn {
      width: 50%;
      margin-left: auto;
      margin-right: auto;
      display: block;
      padding: 6px 12px;
      border-radius: 4px;
      color: black;
      /* color optimization */
      background-color: var(--button-color);
      transition: background-color 0.3s ease;
      /* Add smooth transition for button hover effect */
      border: none;
      cursor: pointer;
      font-size: 16px;
    }

    .btn:hover {
      /* color optimization */
      background-color: var(--button-hover-color);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);

    }

    .center-button {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #countnotif {
      border-radius: 50%;
      position: relative;
      top: -10px;
      left: -10px;
    }

    .dropdown-menu,
    .dropdown-toggle {
      margin-left: 700px;
    }

    /* To make the page responsive */
    @media only screen and (max-width: 600px) {
    h1 {
      font-size: 2.2em;
      margin-top: 10%;
    }

    .ftco-section {
      width: 100%;
      margin-top: 30%;
    }

    label {
      font-size: 30px;
    }

    input[type=submit] {
      font-size: 20px;
    }

    h3 {
      text-align: center;
    }
  }

  @media only screen and (max-width: 950px) {
    h3.capTitle {
      margin-left: 0px;
    }

    a.titleLabel {
      font-size: 20px;
    }

    img.wsuimg {
      margin-top: -110px;
      margin-left: 300px;
    }

    .dropdown-toggle {
      margin-left: -100px;
    }

    .dropdown-menu {
      margin-left: -150px;
    }
  }

  </style>
</head>

<body>
  <?php
  $usersView = new UsersView();
  $userinfo = $usersView->allUserInfo($gtaemail);
  ?>
  <nav class="navbar fixed-top" style="background-color:#008C81">
    <div class="container-fluid">
      <button style="color:#F3F7FC" class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <li style="list-style-type: none" class="nav-item dropdown ml-auto">
        <?php $commentsView = new CommentsView();
        $statusCount = $commentsView->getStatusCount($userinfo[0]['userid']);
        ?>
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="images/bell.svg" alt="My bell SVG" />
          <?php if ($statusCount['COUNT(*)'] !== 0) { ?><span class="badge text-bg-danger" id="countnotif">
              <?php
              echo $statusCount['COUNT(*)'];
          } ?>
          </span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="notificationsGTA.php">View Messages</a></li>
        </ul>
      </li>
      <h3 class="capTitle"><a class="titleLabel"
          style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;" href="gtaDash.php">Capstone
          Course Evaluation System</a></h3>
      <img class="wsuimg" style="width:40px; height:40px;display: inline-block;" src="images/wsulogo.svg.png" alt="">
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h4 style="color:#008C81; text-shadow: .7px .7px #000000;" class="offcanvas-title" id="offcanvasNavbarLabel">
            Capstone Course Evaluation System</h4>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <?php
          $usersView = new UsersView();
          $userinfo = $usersView->allUserInfo($gtaemail);
          ?>
          <h5>Hello
            <?php echo $userinfo[0]['firstname']; ?>! | Role:
            <?php echo $userinfo[0]['roleofuser']; ?>
          </h5>
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="gtaDash.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="weeklyReports.php">
                Weekly Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="gtaDashPickGroups.php">
                Choose Groups
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="midterm.php">
                Grade Midterm
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="finalGrade.php">
                Grade Final
              </a>
            </li>
            <div class="nav-item">
              <a class="nav-link" href="logout.php">
                <button type="button" class="btn" id="right-panel-link" href="#right-panel">Sign out</button>
              </a>
            </div>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <?php
  //create variables
  
  $isError = false;
  $errorMessage = "";
  $successMessage = "";
  $studentSuccessMessage = "";
  $groupDeleteMessage = "";
  $students = isset($_POST["selectStudents"]) ? $_POST["selectStudents"] : "";
  $groups = isset($_POST["selectGroups"]) ? $_POST["selectGroups"] : "";
  $gtaGroups = isset($_POST['selectYourGroups']) ? $_POST['selectYourGroups'] : "";

  //Saves the group in a array
  if (isset($_POST['saveGroup'])) {
    $usersView = new UsersView();
    $user = $usersView->selectTheOneProf($gtaemail);
    $userid = $user['userid'];

    $gtaAssignmentView = new GtaAssignmentView();
    $sections = $gtaAssignmentView->selectSectionGta($userid);
    $section = $sections['sectionid'];

    //add group to GTA
    if($groups !=null){
    foreach ($groups as $group) {
      $gtaAssignmentContr = new GtaAssignmentContr();
      $gtaAssignmentContr->assignGta($section, $userid, $group);
      echo '<div style = "margin-top: 60px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Group(s) added!</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }
  }
  ?>
<!-- To check if there is a group and display the group. If there are no groups, display the error message. -->
  <div class="container" style="margin-top:5%;">
    <div class="row">
      <div class="ftco-section rounded">
        <div class="col">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="groupSelection" method="POST">
            <div class="d-flex">
              <div class="w-100">
                <h3 class="mb-1">Choose your Groups</h3>
              </div>
            </div>
            <div style="background:#FFFFFF; color: black;" class="card mt-5">
              <div style="background:#FFFFFF; color: black;" class="card-body">
                <div class="form-group mb-3">
                  <label for="">Available Groups:</label>
                  <?php

                  $usersView = new UsersView();
                  $user = $usersView->selectTheOneProf($gtaemail);
                  $userid = $user['userid'];

                  $gtaAssignmentView = new GtaAssignmentView();
                  $sections = $gtaAssignmentView->selectSectionGta($userid);
                  if ($sections != null) {
                    $section = $sections['sectionid'];
                    $groupTableView = new GroupTableView();
                    $groups = $groupTableView->selectOpenGroups($section);
                    ?>
                    <div class="checkbox-group">
                      <?php if (is_array($groups) && !empty($groups)) { ?>
                        <?php foreach ($groups as $group) { ?>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="selectGroups[]" value="<?php echo $group['groupid'] ?>">
                              <?php echo $group['groupName'] ?>
                            </label>
                          </div>
                        <?php } ?>
                      <?php } else { ?>
                        <p>No available groups.</p>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- assign button -->
              <div class="form-group mt-4">
                <button style="background:#88d7c0; color: black;" type="submit" name="saveGroup"
                  class="btn btn-primary">Assign</button>
                <span>
                  <?php echo $studentSuccessMessage; ?>
                </span>
                <span class="error">
                  <?php echo $errorMessage; ?>
                </span>
              </div>
            </form>
          <?php } ?>
        </div>
      </div>

      <!-- To display the groups that the GTA has assigned themselves-->
      <div class="ftco-section rounded">
        <div class="col">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="groupSelection" method="POST">
            <div class="d-flex">
              <div class="w-100">
                <h3 class="mb-1">Your Groups</h3>
              </div>
            </div>
            <div style="background:#FFFFFF; color: black;" class="card mt-5">
              <div style="background:#FFFFFF; color: black;" class="card-body">
                <div class="form-group mb-3">

                  <?php
                  $usersView = new UsersView();
                  $user = $usersView->selectTheOneProf($gtaemail);
                  $userid = $user['userid'];

                  $groupTableView = new GroupTableView();
                  $groups = $groupTableView->selectGtasGroups($userid);
                  ?>

                  <!-- To display the groups -->
                  <div class="checkbox-group">
                    <?php if (is_array($groups) && count($groups) > 0) { ?>
                      <?php foreach ($groups as $group) { ?>
                        <div class="checkbox">
                          <label>
                            <input type="hidden" name="selectYourGroups[]" value="<?php echo $group['groupid'] ?>">
                            <?php echo $group['groupName'] ?>
                          </label>
                        </div>
                      <?php } ?>
                    <?php } else { ?>
                      <p>No groups assigned to you.</p>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>