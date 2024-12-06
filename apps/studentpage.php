<?php
session_start(); //resume session
include 'includes/class.autoload.inc.php'; //Include autoloader class
$professorEmail = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Student Page</title>
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
  <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=8f7cff5ee7757412879aedf3efbfaee01">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- DataTables CSS library -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" style="text/css" href="styles/studentPage.css">
  <!-- STYLE SHEET -->
  <style type="text/css" class="init">
    textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    input[type="textarea"]:focus,
    .uneditable-input:focus {
      border-color: #008C81;
      box-shadow: 0 0 0 0.2rem rgba(0, 140, 129, 0.25);
      outline: 0 none;
    }

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

    html,
    body {
      margin: 0;
      height: 100%;
    }

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

    th,
    td {
      padding: 10px;
    }

    ul {
      margin: 10px;
    }

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

    h1,
    h3 {
      text-align: center;

    }

    /* Style active navigation links */
    nav-link:active {
      background-color: #A9F3E9;
    }

    .headRowSum {
      background-color: #008C81;
      color: white;
      text-shadow: .7px .7px #000000;
      text-align: center;
      vertical-align: middle;
    }

    .nav-link {
      color: black;
    }

    /* Style tab content */
    .tab-content {
      margin: 20px;
    }

    /* Style tables */
    .table {
      padding: 0;
      margin: 0;
      box-shadow: 0 0 5px rgba(0, 0, 0, .05), 2px 2px 5px rgba(0, 0, 0, .1);
      border-radius: 4px;
    }

    .table tbody {
      margin: 0;
    }

    /* Style the tab navigation element */
    #myTab {
      margin-top: 70px;
    }

    #main {
      display: flex;
      align-items: center;
      justify-content: center;
      ;
      /* Vertical align the elements to the center */
    }

    .weeklyreportsTitle {
      margin: 0;
    }

    #flagbtn {
      margin-left: 20px;
      font-weight: bold;
      padding: 10px;

      /* Push this element to the right */
    }

    /* Style only when screen width is less than or equal to 600px */
    @media only screen and (max-width: 600px) {
      #myTab {
        margin-top: 27%;

      }
    }

    .btn {
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

    .dropdown-toggle {
      margin-left: 750px;
      color: black;
    }

    .btn:hover {
      /* color optimization */
      background-color: var(--button-hover-color);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    body {
      margin-top: 20px;
      background-color: var(--background-color);
    }

    .section-title {
      position: relative;
    }

    .section-title h2 {
      color: #1d2025;
      position: relative;
      margin: 0;
      font-size: 24px;
    }

    @media (min-width: 768px) {
      .section-title h2 {
        font-size: 28px;
      }
    }

    @media (min-width: 992px) {
      .section-title h2 {
        font-size: 34px;
      }
    }

    .section-title.title-ex1 h2 {
      padding-bottom: 20px;
    }

    @media (min-width: 768px) {
      .section-title.title-ex1 h2 {
        padding-bottom: 30px;
      }
    }

    @media (min-width: 992px) {
      .section-title.title-ex1 h2 {
        padding-bottom: 40px;
      }
    }

    .section-title.title-ex1 h2:before {
      content: "";
      position: absolute;
      left: 0;
      bottom: 12px;
      width: 110px;
      height: 1px;
      background-color: #d6dbe2;
    }

    @media (min-width: 768px) {
      .section-title.title-ex1 h2:before {
        bottom: 17px;
      }
    }

    @media (min-width: 992px) {
      .section-title.title-ex1 h2:before {
        bottom: 25px;
      }
    }

    .section-title.title-ex1 h2:after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 12px;
      width: 40px;
      height: 1px;
      background-color: #0cc652;
    }

    @media (min-width: 768px) {
      .section-title.title-ex1 h2:after {
        bottom: 17px;
      }
    }

    @media (min-width: 992px) {
      .section-title.title-ex1 h2:after {
        bottom: 25px;
      }
    }

    .section-title.title-ex1.text-center h2:before {
      left: 50%;
      transform: translateX(-50%);
    }

    .section-title.title-ex1.text-center h2:after {
      left: 50%;
      transform: translateX(-50%);
    }

    .section-title.title-ex1.text-right h2:before {
      left: auto;
      right: 0;
    }

    .section-title.title-ex1.text-right h2:after {
      left: auto;
      right: 0;
    }

    .section-title.title-ex1 p {
      font-family: "Montserrat", sans-serif;
      color: #8b8e93;
      font-size: 14px;
      font-weight: 300;
    }

    table {
      box-shadow: 0 0 5px rgba(0, 0, 0, .05), 2px 2px 5px rgba(0, 0, 0, .1);
      border-radius: 4px;
      margin-left: auto;
      margin-right: auto;
    }

    .price-card {
      background-color: var(--section-bg-color);
      padding: 40px 35px;
      position: relative;
      border-radius: 2px;
      overflow: hidden;
      box-shadow: 0 0 5px rgba(0, 0, 0, .05), 2px 2px 5px rgba(0, 0, 0, .1);
    }

    .price-card:before {
      /* position: absolute; */
      content: "";
      top: 0;
      right: -35px;
      width: 88px;
      height: 88px;
      background: #0cc652;
      opacity: 0.2;
      border-radius: 8px;
      transform: rotate(45deg);
    }

    .price-card:after {
      position: absolute;
      content: "";
      top: 30px;
      right: -35px;
      width: 88px;
      height: 88px;
      background: #0cc652;
      opacity: 0.2;
      border-radius: 8px;
      transform: rotate(45deg);
    }

    .price-card h2 {
      font-size: 26px;
      font-weight: 600;
    }


    .price-card.featured {
      background: #fff;
      border: 1px solid #ebebeb;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .price-card:hover .btn {
      background: #0cc652;
      border-color: #0cc652;
    }

    p.price span {
      display: inline-block;
      padding: 45px 15px 50px;
      padding-right: 0;
      font-size: 50px;
      font-weight: 600;
      color: #0cc652;
      position: relative;
    }

    p.price span:before {
      position: absolute;
      content: "Grade";
      font-size: 16px;
      top: 25px;
      font-weight: 300;
      left: 0;
    }

    .pricing-offers {
      padding: 0 0 10px;
    }

    .btn.btn-mid {
      height: 40px;
      line-height: 40px;
      padding: 0 20px;
    }

    @media only screen and (max-width: 950px) {
      h3.capTitle {
        margin-left: 0px;
      }

      a.titleLabel {
        font-size: 20px;
        font-weight: bold;
      }

      img.wsuimg {
        margin-top: -110px;
        margin-left: 300px;
      }
    }
  </style>
  <!------------------------------------Script for student data---------------------------------------->
  <!-- Used for data tables and attributes for data analytics -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="/media/js/site.js?_=1d5abd169416a09a2b389885211721dd" data-domain="datatables.net"
    data-api="https://plausible.sprymedia.co.uk/api/event"></script>
  <!-- Add tracking -->
  <script src="https://media.ethicalads.io/media/client/ethicalads.min.js"></script>
  <!-- JQuery Library -->
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- JQuery Data Tables Plug In -->
  <script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <!-- Extends Data Tables to include bootstrap styling -->
  <script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
</head>
<?php
if (isset($_GET["id"])) {
  $studentid = $_GET["id"];
}
?>

<body>
  <!-----------------------------------Nav Bar------------------------------------------------------------>
  <!-- Navigation bar with a sticky position and green -->
  <nav class="navbar fixed-top" style="background-color:#008C81">
    <div class="container-fluid">
      <button style="color:#F3F7FC" class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <li style="list-style-type: none" class="nav-item dropdown ml-auto">
        <a class="dropdown-toggle" href="sentMessages.php"> <img style="width:30px; height:30px;" src="images/mail.png"
            alt="envelope" /><span class="badge text-bg-danger" id="countnotif"></span></a>
      </li>
      <h3 class="capTitle"><a class="titleLabel"
          style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;" href="profDash.php">Capstone
          Course Evaluation System</a></h3>
      <img class="wsuimg" style="width:40px; height:40px;display: inline-block;" src="images/wsulogo.svg.png"
        alt="Wayne State University Logo">
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h4 style="color:#008C81; text-shadow: .7px .7px #000000;" class="offcanvas-title" id="offcanvasNavbarLabel">
            Capstone Course Evaluation System</h4>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <?php
          $usersView = new UsersView();
          $userinfo = $usersView->allUserInfo($professorEmail);
          ?>
          <h5>Hello
            <?php echo $userinfo[0]['firstname']; ?>! | Role:
            <?php echo ucfirst($userinfo[0]['roleofuser']); ?>
          </h5>
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="profDash.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profDashAddGta.php">
                Add GTAs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profDashAddStudents.php">
                Add Students
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profAddSection.php">
                Add Section
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profDashAddGroups.php">
                Add Groups
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profDashEditGroups.php">
                Edit Groups
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="professorDashboard.php">
                Grade Assignments
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
  <br>
  <!-----------------------------------Weekly Reports Tab------------------------------------------------------------>

  <!--Connecting to Students Table-->
  <!--Begin PHP -->
  <?php
  // Check id paramter sent in profDash.php 
// When a professor clicks on a student name button, their student id data will be 
//sent here
  if (isset($_GET['id'])) {
    //assign id to $studentid
    $studentid = $_GET['id'];
    //create object of StudentsView class
    $studentsView = new StudentsView();
    // Call studentInfo method, passes $studentid, returns $name
    $name = $studentsView->studentInfo($studentid);
    $groupid = $studentsView->selectGroupidfromStudent($studentid);
    //  Close PHP    
  }
  $gtaAssignmentView = new GtaAssignmentView();
  $gta = $gtaAssignmentView->getGTAbyGroup($groupid['groupid']);
  ?>

  <!-- Start UO list for the navigation tabs -->
  <ul style="margin-top:40px;" class="nav nav-tabs" id="myTab" role="tablist">
    <!-- Weekly Reports Tab -->
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button"
        role="tab" aria-controls="home-tab-pane" aria-selected="true">Weekly Report</button>
    </li>
    <!-- Documents Tab -->
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button"
        role="tab" aria-controls="profile-tab-pane" aria-selected="false">Documents</button>
    </li>
    <!--GitHub Tab -->
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button"
        role="tab" aria-controls="contact-tab-pane" aria-selected="false">Github</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="midterm-tab" data-bs-toggle="tab" data-bs-target="#midterm-tab-pane" type="button"
        role="tab" aria-controls="midterm-tab-pane" aria-selected="false">Midterm</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="final-tab" data-bs-toggle="tab" data-bs-target="#final-tab-pane" type="button"
        role="tab" aria-controls="final-tab-pane" aria-selected="false">Final</button>
    </li>
  </ul>
  <!-- Starts the contained content for the Weekly Reports tab -->
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
      <!--Weekly Reports heading with the name of the student   -->
      <div id="main">
        <h1 class="weeklyreportsTitle">Weekly Reports for
          <?php if ($name) {
            echo $name[0]->name;
          } ?>
        </h1>
        <button id="flagbtn" type="button" style="margin-left:50%;" class="btn btn-block rounded" data-bs-toggle="modal"
          data-bs-target="#flagForm">
          <img src="images/flag.svg">
        </button>
      </div>
      <div class="modal fade" id="flagForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Send GTA an Email</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="sendgtaemailFlag.php" method="POST" id="email-form">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">
                    Notify
                    <?php echo $gta['firstname'] ?>
                    <?php echo $gta['lastname'] ?> about an issue involving
                    <?php echo $name[0]->name; ?>
                  </label>
                  <input type="hidden" class="form-control" name="givenToUser" id="givenToUser"
                    value="<?php echo $gta['userid']; ?>">
                  <input type="hidden" class="form-control" name="givenByUser" id="givenByUser" value="<?php echo $userinfo[0]['userid'];
                  ; ?>">
                  <input type="hidden" class="form-control" name="studentid" id="studentid"
                    value="<?php echo $studentid; ?>">
                  <input type="hidden" class="form-control" id="recipient-name" name="recipient-name"
                    value="<?php echo $gta['email']; ?>">
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Message:</label>
                  <textarea class="form-control" name="message-text" id="message-text"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="email-form" name="sendEmail" class="btn">Send message</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Holds content for Weekly Reports-->
      <div class="tab-content" id="myTabContent">
        <?php if (isset($_GET["email"])) {
          if ($_GET["email"] == "success") {
            echo '<div style = "width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Notification sent successfully!</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
          }
        } ?>
        <!-- Opening tag for a container that holds content for the different tabs -->
        <p id="notice"></p>
        <!-- Can scroll horizontally on a small screen -->
        <div class="table-responsive">
          <!-- Table headers to display student data -->
          <table id="individualstudentreports" class="table">
            <thead>
              <tr>
                <th>Date Submitted</th>
                <th>Week</th>
                <th>Submitted</th>
                <th>Status</th>
                <th>Evaluation</th>
              </tr>
            </thead>
            <!-- Create header row for the table headers -->
            <tbody>
              <!-- OPening PHP Tag -->
              <?php
              // Create new object of the weeklyreportsview 
              $weeklyReportsView = new WeeklyReportsView();
              // Calls the getAllWeeklyReportData method, pass $studentid, assign $query_run
              $query_run = $weeklyReportsView->getAllWeeklyReportData($studentid);
              if ($query_run) {
                // loops through each element in $query_run and assigns to $row
                foreach ($query_run as $row) {
                  if ($row['studentid'] != -1) {
                    ?>
                    <!-- Start table row -->
                    <tr>
                      <!-- Creates table cell that displays the date sumbitted -->
                      <td>
                        <?php echo date('Y-m-d', strtotime($row['dateSubmitted'])); ?>
                      </td>
                      <!-- Creates table cell that displays the week -->
                      <td>
                        <?php echo $row['week']; ?>
                      </td>
                      <!-- Creates table cell that displays the sumbitted value-->
                      <td>
                        <?php echo $row['submitted']; ?>
                      </td>
                      <!-- Creates table cell that displays the status-->
                      <td>
                        <?php echo $row['status']; ?>
                      </td>
                      <td>
                        <?php echo $row['evaluation']; ?>
                      </td>
                    </tr>
                    <!-- Show data tables plugin -->
                    <script>
                      // Executes javascript function when document is ready
                      $(document).ready(function () {
                        // Call datatable plugin with the table ID "individualstudentreports"
                        $('#individualstudentreports').DataTable();
                      });
                    </script>
                    <?php
                  }
                }
              }
              ?>
            </tbody>
          </table>
          <br>
          <h1 class="weeklyreportsTitle" style="text-align:left;">Weekly Reports for Group</h1>
          <table id="groupstudentreports" class="table">
            <thead>
              <tr>
                <th>Date Submitted</th>
                <th>Week</th>
                <th>Evaluation</th>
              </tr>
            </thead>
            <!-- Create header row for the table headers -->
            <tbody>
              <?php
              if ($query_run) {
                // loops through each element in $query_run and assigns to $row
                foreach ($query_run as $row) {
                  if ($row['studentid'] == -1) {
                    ?>
                    <!-- Start table row -->
                    <tr>
                      <!-- Creates table cell that displays the date sumbitted -->
                      <td>
                        <?php echo date('Y-m-d', strtotime($row['dateSubmitted'])); ?>
                      </td>
                      <!-- Creates table cell that displays the week -->
                      <td>
                        <?php echo $row['week']; ?>
                      </td>
                      <td>
                        <?php echo $row['evaluation']; ?>
                      </td>
                    </tr>
                    <!-- Show data tables plugin -->
                    <script>
                      // Executes javascript function when document is ready
                      $(document).ready(function () {
                        // Call datatable plugin with the table ID "individualstudentreports"
                        $('#groupstudentreports').DataTable();
                      });
                    </script>
                    <?php
                  }
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- Closing Tag fo weekly reports -->
      </div>
    </div>
    <!-- Start Javascript  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
    <!------------------------------------Document Plans Tab--------------------------------------------------------------------->
    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
      <div id="main">
        <h1>Document Grades for
          <?php if ($name) {
            echo $name[0]->name;
          } ?>
        </h1>
        <br></br>
        <button type="button" id="flagbtn" class="btn" href="#right-panel" style="margin-left:43%;">
          <a href="professordashboard.php" style="text-decoration:none;color:black;">Add Grade
          </a>
        </button>
      </div>

      <!-- Table -->
      <br>
      <section class="pricing-section">
        <div class="container">
          <div class="row justify-content-around">
            <div class="col-xl-5 col-lg-6 col-md-8">
              <div class="section-title text-center title-ex1">
                <h2>Professor Grades
                </h2>
              </div>
            </div>
          </div>
          <!-- Pricing Table starts -->
          <div class="row" style="display:flex; justify-content: space-around;">
            <?php
            $gradesView = new GradesView();
            $studentsGrade = $gradesView->getGradesbyGroup($studentid, $groupid['groupid'], $userinfo[0]['userid']);
            if ($studentsGrade != NULL) {
              foreach ($studentsGrade as $key => $value) {
                if ($value['assignment'] == "Development Plan" || $value['assignment'] == "Software Requirement Specification" || $value['assignment'] == "Design Plan" || $value['assignment'] == "Test Plan") { ?>
                  <div class="col-md-6" style="margin-top:10px;">
                    <div class="price-card">
                      <h2>
                        <?php echo $value['assignment'] ?>
                      </h2>
                      <p>
                        <?php echo $value['groupNotes'] ?>
                      </p>
                      <p class="price"><span>
                          <?php echo $value['documentGrade'] ?>
                        </span></p>
                      <table class="pricing-offers">
                        <tr>
                          <th>Consistency</th>
                          <th>Consistency Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['consistency'] ?>
                          </td>
                          <td>
                            <?php echo $value['consistencyNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Grammar</th>
                          <th>Grammar Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['grammar'] ?>
                          </td>
                          <td>
                            <?php echo $value['grammarNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Topics and Correctness</th>
                          <th>Topics notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['topicsCorrectness'] ?>
                          </td>
                          <td>
                            <?php echo $value['topicsNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Resubmitted?</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['resubmitDocument'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Individual Grade</th>
                          <th>Individual Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['presentationGrade'] ?>
                          </td>
                          <td>
                            <?php echo $value['notes'] ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                <?php }
              }
            } ?>
          </div>
        </div>
      </section>
      <br>
      <section class="pricing-section">
        <div class="container">
          <div class="row justify-content-around">
            <div class="col-xl-5 col-lg-6 col-md-8">
              <div class="section-title text-center title-ex1">
                <h2>GTAs Grades
                </h2>
              </div>
            </div>
          </div>
          <!-- Pricing Table starts -->
          <div class="row" style="display:flex; justify-content: space-around;">
            <?php
            $gradesView = new GradesView();
            $studentsGrade = $gradesView->getGradesbyGroup($studentid, $groupid['groupid'], $gta['userid']);
            if ($studentsGrade != NULL) {
              foreach ($studentsGrade as $key => $value) {
                if ($value['assignment'] == "Development Plan" || $value['assignment'] == "Software Requirement Specification" || $value['assignment'] == "Design Plan" || $value['assignment'] == "Test Plan") { ?>
                  <div class="col-md-6" style="margin-top:10px;">
                    <div class="price-card">
                      <h2>
                        <?php echo $value['assignment'] ?>
                      </h2>
                      <p>
                        <?php echo $value['groupNotes'] ?>
                      </p>
                      <p class="price"><span>
                          <?php echo $value['documentGrade'] ?>
                        </span></p>
                      <table class="pricing-offers">
                        <tr>
                          <th>Consistency</th>
                          <th>Consistency Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['consistency'] ?>
                          </td>
                          <td>
                            <?php echo $value['consistencyNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Grammar</th>
                          <th>Grammar Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['grammar'] ?>
                          </td>
                          <td>
                            <?php echo $value['grammarNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Topics and Correctness</th>
                          <th>Topics notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['topicsCorrectness'] ?>
                          </td>
                          <td>
                            <?php echo $value['topicsNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Resubmitted?</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['resubmitDocument'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Individual Grade</th>
                          <th>Individual Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['presentationGrade'] ?>
                          </td>
                          <td>
                            <?php echo $value['notes'] ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                <?php } else if ($value['assignment'] == "Ethics") { ?>
                    <div class="col-md-6">
                      <div class="price-card">
                        <h2>
                        <?php echo $value['assignment'] ?>
                        </h2>
                        <p class="price"><span>
                          <?php echo $value['presentationGrade'] ?>
                          </span></p>
                        <table class="pricing-offers">
                          <th>Reason</th>
                          </tr>
                          <tr>
                            <td>
                            <?php echo $value['notes'] ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                <?php }
              }
            } ?>
          </div>
        </div>
      </section>

    </div>

    <!------------------------------------Github Tab--------------------------------------------------------------------->
    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
      <h2>Prototypes & Github</h2>
      <section class="pricing-section">
        <div class="container">
          <div class="row justify-content-around">
            <div class="col-xl-5 col-lg-6 col-md-8">
              <div class="section-title text-center title-ex1">
                <h2>Professor Grades
                </h2>
              </div>
            </div>
          </div>
          <!-- Pricing Table starts -->
          <div class="row" style="display:flex; justify-content: space-around;">
            <?php
            $gradesView = new GradesView();
            $studentsGrade = $gradesView->getGradesbyGroup($studentid, $groupid['groupid'], $userinfo[0]['userid']);
            if ($studentsGrade != NULL) {
              foreach ($studentsGrade as $key => $value) {
                if ($value['assignment'] == "Prototype 1" || $value['assignment'] == "Prototype 2" || $value['assignment'] == "Prototype 3" || $value['assignment'] == "Final Presentation") {
                  ?>
                  <div class="col-md-6" style="margin-top:10px;">
                    <div class="price-card">
                      <h2>
                        <?php echo $value['assignment'] ?>
                      </h2>
                      <p>
                        <?php echo $value['groupNotes'] ?>
                      </p>
                      <p class="price"><span>
                          <?php echo $value['documentGrade'] ?>
                        </span></p>
                      <table class="pricing-offers">
                        <tr>
                          <th>Consistency</th>
                          <th>Consistency Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['consistency'] ?>
                          </td>
                          <td>
                            <?php echo $value['consistencyNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Functionality</th>
                          <th>Functionality Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['functionality'] ?>
                          </td>
                          <td>
                            <?php echo $value['functionalityNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Topics and Correctness</th>
                          <th>Topics notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['topicsCorrectness'] ?>
                          </td>
                          <td>
                            <?php echo $value['topicsNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Group Status</th>
                          <th>Group Status Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['groupStatus'] ?>
                          </td>
                          <td>
                            <?php echo $value['statusNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Individual Grade</th>
                          <th>Individual Notes</th>
                          <th>Github Activity</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['presentationGrade'] ?>
                          </td>
                          <td>
                            <?php echo $value['notes'] ?>
                          </td>
                          <td>
                            <?php echo $value['githubActivity'] ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                <?php }
              }
            } ?>
          </div>
        </div>
      </section>
      <br>
      <section class="pricing-section">
        <div class="container">
          <div class="row justify-content-around">
            <div class="col-xl-5 col-lg-6 col-md-8">
              <div class="section-title text-center title-ex1">
                <h2>GTA Grades
                </h2>
              </div>
            </div>
          </div>
          <!-- Pricing Table starts -->
          <div class="row" style="display:flex; justify-content: space-around;">
            <?php
            $gradesView = new GradesView();
            $studentsGrade = $gradesView->getGradesbyGroup($studentid, $groupid['groupid'], $gta['userid']);
            if ($studentsGrade != NULL) {
              foreach ($studentsGrade as $key => $value) {
                if ($value['assignment'] == "Prototype 1" || $value['assignment'] == "Prototype 2" || $value['assignment'] == "Prototype 3" || $value['assignment'] == "Final Presentation") {
                  ?>
                  <div class="col-md-6" style="margin-top:10px;">
                    <div class="price-card">
                      <h2>
                        <?php echo $value['assignment'] ?>
                      </h2>
                      <p>
                        <?php echo $value['groupNotes'] ?>
                      </p>
                      <p class="price"><span>
                          <?php echo $value['documentGrade'] ?>
                        </span></p>
                      <table class="pricing-offers">
                        <tr>
                          <th>Consistency</th>
                          <th>Consistency Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['consistency'] ?>
                          </td>
                          <td>
                            <?php echo $value['consistencyNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Functionality</th>
                          <th>Functionality Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['functionality'] ?>
                          </td>
                          <td>
                            <?php echo $value['functionalityNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Topics and Correctness</th>
                          <th>Topics notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['topicsCorrectness'] ?>
                          </td>
                          <td>
                            <?php echo $value['topicsNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Group Status</th>
                          <th>Group Status Notes</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['groupStatus'] ?>
                          </td>
                          <td>
                            <?php echo $value['statusNotes'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Individual Grade</th>
                          <th>Individual Notes</th>
                          <th>Github Activity</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['presentationGrade'] ?>
                          </td>
                          <td>
                            <?php echo $value['notes'] ?>
                          </td>
                          <td>
                            <?php echo $value['githubActivity'] ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                <?php }
              }
            } ?>
          </div>
        </div>
      </section>
    </div>
    <!------------------------------------Midterm Tab--------------------------------------------------------------------->
    <div class="tab-pane fade" id="midterm-tab-pane" role="tabpanel" aria-labelledby="midterm-tab" tabindex="0">
      <section class="pricing-section">
        <div class="container">
          <div class="row justify-content-around">
            <div class="col-xl-5 col-lg-6 col-md-8">
              <div class="section-title text-center title-ex1">
                <h2>Midterm Grade
                </h2>
              </div>
            </div>
          </div>
          <!-- Pricing Table starts -->
          <div class="row" style="display:flex; justify-content: space-around;">
            <?php
            $gradesView = new GradesView();
            $studentsGrade = $gradesView->getGradesbyGroup($studentid, $groupid['groupid'], $gta['userid']);
            if ($studentsGrade != NULL) {
              foreach ($studentsGrade as $key => $value) {
                if ($value['assignment'] == "Midterm") {
                  ?>
                  <div class="col-md-7">
                    <div class="price-card">
                      <h2>
                        <?php echo $value['assignment'] ?>
                      </h2>
                      <p class="price"><span>
                          <?php echo $value['presentationGrade'] ?>
                        </span></p>
                      <table class="pricing-offers">
                        <th>Reason</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['notes'] ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                <?php }
              }
            } ?>
          </div>
        </div>
      </section>
    </div>
    <!------------------------------------Final Tab--------------------------------------------------------------------->
    <div class="tab-pane fade" id="final-tab-pane" role="tabpanel" aria-labelledby="final-tab" tabindex="0">
      <section class="pricing-section">
        <div class="container">
          <div class="row justify-content-around">
            <div class="col-xl-5 col-lg-6 col-md-8">
              <div class="section-title text-center title-ex1">
                <h2>Final Grade
                </h2>
              </div>
            </div>
          </div>
          <!-- Pricing Table starts -->
          <div class="row" style="display:flex; justify-content: space-around;">
            <?php
            $gradesView = new GradesView();
            $studentsGrade = $gradesView->getGradesbyGroup($studentid, $groupid['groupid'], $gta['userid']);
            if ($studentsGrade != NULL) {
              foreach ($studentsGrade as $key => $value) {
                if ($value['assignment'] == "Final") {
                  ?>
                  <div class="col-md-7">
                    <div class="price-card">
                      <h2>
                        <?php echo $value['assignment'] ?>
                      </h2>
                      <p class="price"><span>
                          <?php echo $value['presentationGrade'] ?>
                        </span></p>
                      <table class="pricing-offers">
                        <th>Reason</th>
                        </tr>
                        <tr>
                          <td>
                            <?php echo $value['notes'] ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                <?php }
              }
            } ?>
          </div>
        </div>
      </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
</body>

</html>