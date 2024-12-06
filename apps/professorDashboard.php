<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include 'includes/class.autoload.inc.php';
$util = new Apputil();
$util->checkLogin(__FILE__);
$professorEmail = $_SESSION['email'];

?>
<!DOCTYPE html>
<html>

<head>
  <title>Grade Assignments</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
  <style type="text/css" class="init">
    :root {
      --primary-color: #008C81;
      --background-color: #F5F5F5;
      --text-color: #008C81;
      --button-color: #88D7C0;
      --button-hover-color: #F0F0F0;
      --container-bg-color: #F5F5F5;
      --section-bg-color: #FFFFFF;
    }

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
    .uneditable-input:focus {
      border-color: #008C81;
      box-shadow: 0 0 0 0.2rem rgba(0, 140, 129, 0.25);
      outline: 0 none;
    }

    html,
    body {
      margin: 0;
      height: 100%;
      /* color optimization */
      line-height: 1.6;
      /* Increase line-height for better readability */
    }

    #submitbtn {
      margin-left: 5%;
    }

    /* Nav Bar */
    .btn,
    #submitbtn {
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


    .textarea {
      width: 500px;
      min-height: 100px;
      border: 1px solid #ccc;
      max-height: 150px;
      overflow-x: hidden;
      overflow-y: auto;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      /* color optimization */
      background-color: var(--background-color);
      line-height: 1.6;
      font-size: 18px;
    }


    .navbar {
      /* Color optimization */
      background-color: var(--primary-color);
      padding: 10px;
      font-weight: 700;
      font-family: 'Roboto', sans-serif;
      line-height: 1.6;
      font-size: 18px;
    }

    .nav-item {
      color: #008C81;
    }

    nav-link:active {
      background-color: #A9F3E9;
    }

    .formtab {
      background-color: var(--section-bg-color);
      margin: auto;
      color: var(--input-text-color);
      border-radius: 20px;
      box-shadow: 0 0 5px rgba(0, 0, 0, .05), 2px 2px 5px rgba(0, 0, 0, .1);
    }

    table {
      box-shadow: 0 0 5px rgba(0, 0, 0, .05), 2px 2px 5px rgba(0, 0, 0, .1);
      border-radius: 4px;
      margin-left: auto;
      margin-right: auto;
    }

    .tab-content {
      margin: 5px;
    }

    .table {
      padding: 10px;
    }

    button .updatebtn {
      background-color: #A9F3E9;
      margin: 10px;
      font-weight: bold;
    }

    #sectionTab li {
      background: #c3c3c3;
    }

    #assignmentTab li {
      background: #f4f4f4;
    }

    #groupTab li {
      background: #dbdbdb;
    }

    #sectionTab .active {
      background: #76aaa3;
    }

    #assignmentTab .active {
      background: #d4f9f4;
    }

    #groupTab .active {
      background: #98dad1;
    }

    #sectionTab {
      margin-top: 30px;

    }

    .grouptd:nth-child(1) {
      width: 25%;
    }

    th,
    td {
      padding: 20px;
    }

    ul {
      margin: 10px;
    }

    .dropdown-toggle {
      margin-left: 750px;
      color: black;
    }

    @media only screen and (max-width: 600px) {
      #sectionTab {
        margin-top: 27%;

      }
    }
    @media only screen and (max-width: 950px) {

      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      /* Hide table headers (but not display: none;, for accessibility) */
      thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }

      tr {
        border: 1px solid #ccc;
      }

      td {
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
      }

      .textarea {
        width: 300px;
      }

      td:before {
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
      }

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

      .dropdown-toggle {
        margin-left: -100px;
      }

      h1.assignmentTitle {
        margin-top: 60px;
        margin-bottom: -50px;
      }
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script type="text/javascript" src="/media/js/site.js?_=92cc172c443885309a1244c9d5b706d4" data-domain="datatables.net"
    data-api="https://plausible.sprymedia.co.uk/api/event"></script>
  <script src="/media/js/dynamic.php?comments-page=examples%2Fapi%2Fform.html"></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
</head>

<body>
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
              <a class="nav-link active" href="professorDashboard.php">
                Grade Assignments
              </a>
            </li>
            <div class="nav-item">
              <a class="nav-link" href="logout.php">
                <button type="button" style=" background-color: var(--button-color);" class="btn" id="right-panel-link"
                  href="#right-panel">Sign out</button>
              </a>
            </div>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <br>
  <?php if (isset($_GET["update"])) {
    if ($_GET["update"] == "success") {
      echo '<div style = "margin-top:40px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Update Success</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

    }
  } ?>
  <!------------------------------------Section Tabs --------------------------------- -->
  <br><br>
  <!-- List of tabs to switch in beetween sections -->
  <center>
    <h1 class="assignmentTitle">Grade Assignments</h1>
  </center>
  <ul class="nav nav-tabs" id="sectionTab" role="tablist">
    <?php
    $semesterView = new SemesterView();
    $sem = $semesterView->currentSemester();
    $semesterid = $sem[0]['semesterid'];
    // Create an empty array called "new-array"
    $new_array = array();
    //Create a new instance of the sectionView class
    $sectionView = new SectionView();
    //returns sections
    $stmt = $sectionView->selectSection($semesterid, $userinfo[0]['userid']);
    //Inilize count variable to 1
    $countTab = 1;
    //If there are no sections, display this message. 
    if ($stmt == 0) { ?>
      <h3>you do not have any sections </h3>
      <!-- Otherwise loop through each semester and.. -->
    <?php } else {
      // Add the current semester to the $new_array variable 
      foreach ($stmt as $key => $value) {
        $new_array[$key] = $value;
        // If section name is not null 
        if ($value['section_name'] != null) { ?>
          <li class="nav-item" role="presentation">
            <!-- Set button text equal to section name -->
            <button style="color: black;" class="nav-link <?php if ($countTab == 1) {
              echo "active";
            } ?> id=" <?php echo $value['sectionid']; ?>-tab" data-bs-toggle="tab"
              data-bs-target="#<?php echo $value['sectionid']; ?>" type="button" role="tab" aria-controls="home-tab-pane"
              aria-selected="true"><?php echo $value['section_name']; ?></button>
          </li>
          <?php
        }
        $countTab++;
      }
    } ?>
  </ul>
  <div class="tab-content" id="sectionTabContent">
    <?php
    $countTab = 1;
    $groupCount = array();
    foreach ($new_array as $key => $value) {
      if (isset($value['sectionid'])) {
        $groupCount[$value['sectionid']] = 0;
      }
      ?>
      <div class="tab-pane fade show <?php if ($countTab == 1) {
        echo "active";
      } ?>" id="<?php echo $value['sectionid']; ?>" role="tabpanel"
        aria-labelledby="<?php echo $value['sectionid']; ?>-tab" tabindex="0">
        <?php
        $groupView = new GroupTableView();
        $query = $groupView->groupinSec($value['sectionid']);
        // add 1 to count variable
        $countTab++;
        ?>
        <ul class="nav nav-tabs" id="groupTab" role="tablist">
          <?php
          $groupTableView = new GroupTableView();
          $arrayforgroups = array();
          // Get the groups for the current section
          $groups = $groupTableView->groupinSec($value['sectionid']);
          $countTab2 = 1;
          // Loop through each group and add it to the $new_array variable
          if ($groups != null) {
            foreach ($groups as $key => $value1) {
              $arrayforgroups[$key] = $value1;
              // If group name is not null, display a button as a list item with class "nav-item" and "presentation"
              if ($value1['groupName'] != null) { ?>
                <li class="nav-item" role="presentation">
                  <!-- Set button text equal to section name -->
                  <!-- id is set to the group id, data-bs-target sets id of tab panel to controls  -->
                  <button style="color: black;" class="nav-link <?php if ($countTab2 == 1) {
                    echo "active";
                  } ?> " id="group<?php echo $value1['groupid']; ?>-tab" data-bs-toggle="tab"
                    data-bs-target="#group<?php echo $value1['groupid']; ?>" type="button" role="tab"
                    aria-controls="group<?php echo $value1['groupid']; ?>" aria-selected="true"><?php echo $value1['groupName']; ?></button>
                </li>
                <?php
              }
              $countTab2++;
            }
          }
          ?>
        </ul>
        <!-- div for content inside of group tabs -->
        <div class="tab-content" id="groupTabContent">
          <?php
          $countTab2 = 1;
          $cntMyTab = 0;
          $newGroup = array();
          foreach ($arrayforgroups as $key => $value1) {
            if (isset($value1['groupid'])) {
              $newGroup[$value1['groupid']] = 0;
            }
            $cntMyTab++;
            ?>
            <div class="tab-pane fade  show <?php if ($countTab2 == 1) {
              echo "active";
            } ?>" id="group<?php echo $value1['groupid']; ?>" role="tabpanel"
              aria-labelledby="group<?php echo $value1['groupid']; ?>-tab" tabindex="0">
              <?php
              $countTab2++; ?>
              <ul class="nav nav-tabs" id="assignmentTab" role="tablist">
                <?php $arrayforAssignments = array("Development Plan", "Software Requirement Specification", "Design Plan", "Test Plan", "Prototype 1", "Prototype 2", "Prototype 3", "Final Presentation");
                $countAssignments = 0;
                $countArray = array();
                $countTab3 = 1;
                $cntLiTags = 0;
                foreach ($arrayforAssignments as $value3) {
                  $countAssignments++;
                  $cntLiTags++;
                  ?>
                  <li class="nav-item" role="presentation"
                    onclick="updateForm('group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>')">
                    <button style="color: black;" class="nav-link id=" group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>-tab" data-bs-toggle="tab"
                      data-bs-target="#group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                      type="button" role="tab"
                      aria-controls="group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                      aria-selected="true"><?php echo $value3 ?></button>
                  </li>
                  <?php $countTab3++;
                } ?>
              </ul>
              <div class="tab-content" id="assignmentTabContent<?php echo $cntMyTab; ?>">
                <?php
                $arrayforAssignments = array("Development Plan", "Software Requirement Specification", "Design Plan", "Test Plan", "Prototype 1", "Prototype 2", "Prototype 3", "Final Presentation");
                $countAssignments = 0;
                $countTab3 = 1;
                foreach ($arrayforAssignments as $value3) {
                  $countAssignments++;
                  ?>
                  <?php if (($value3 == "Prototype 1") || ($value3 == "Prototype 2") || ($value3 == "Prototype 3") || ($value3 == "Final Presentation")) { ?>
                    <div class="tab-pane mytabassignments formtab"
                      id="group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>" role="tabpanel"
                      aria-labelledby="group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>-tab"
                      tabindex="0">
                      <?php $countTab3++; ?>
                      <br>
                      <center>
                        <h1>
                          <?php echo $value3 ?>
                        </h1>
                      </center>
                      <center>
                        <h3>for
                          <?php echo $value1['groupName'] ?>
                        </h3>
                      </center>
                      <br><br>
                      <button type="submit" id="submitbtn"
                        form="Profaddgroupgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                        name="groupgradeEval" class="btn"> Submit Grade</button>
                      <br><br>
                      <form action="addAssignmentGrade.php"
                        id="Profaddgroupgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                        method="POST">
                        <table id="exampleAssignment<?php echo $countAssignments; ?>Group<?php echo $value1['groupid']; ?>"
                          class="display">
                          <thead>
                            <tr>
                              <th>Group</th>
                              <th>
                                <?php echo $value3 ?> Grade
                              </th>
                              <th>Notes</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $groupTableView = new GroupTableView();
                            $groupinfo = $groupTableView->selectGroupInfo($value1['groupid']);
                            $usersView = new UsersView();
                            $user = $usersView->selectTheOneProf($professorEmail);
                            ?>
                            <tr>
                              <td rowspan="9" class="grouptd">
                                <?php echo $groupinfo[0]['groupName']; ?>
                                <input type="hidden" name="groupsName" id="groupsName" value=<?php echo $groupinfo[0]['groupid']; ?>>
                                <input type="hidden" name="groupid" id="groupid" value=<?php echo $value1['groupid']; ?>>
                                <input type="hidden" name="assignmentType" id="assignmentType" value="<?php echo $value3; ?>">
                                <input type="hidden" name="givenByUser" id="givenByUser" value="<?php echo $user['userid']; ?>">
                              </td>
                              <td><select name="documentGrade"
                                  id="documentGradegroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Grade</option>
                                  <option value="A">A</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="B-">B-</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="C-">C-</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="D-">D-</option>
                                  <option value="F">F</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                                  id="groupNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="groupNotes"></textarea></td>
                            </tr>
                            <tr>
                              <th>Consistency</th>
                              <th>Notes</th>
                            </tr>
                            <tr>
                              <td> <select name="Consistency"
                                  id="Consistencygroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Grade</option>
                                  <option value="A">A</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="B-">B-</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="C-">C-</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="D-">D-</option>
                                  <option value="F">F</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                                  id="consistencyNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="consistencyNotes" value="" contenteditable></textarea></td>
                            </tr>
                            <tr>
                              <th>Functionality</th>
                              <th>Notes</th>
                            </tr>
                            <tr>
                              <td> <select name="functionality"
                                  id="functionalitygroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Grade</option>
                                  <option value="A">A</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="B-">B-</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="C-">C-</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="D-">D-</option>
                                  <option value="F">F</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                                  id="functionalityNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="functionalityNotes" value="" contenteditable></textarea></td>
                            </tr>
                            <tr>
                              <th>Topics & Correctness</th>
                              <th>Notes</th>
                            </tr>
                            <tr>
                              <td> <select name="topicsCorrect"
                                  id="topicsCorrectgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Grade</option>
                                  <option value="A">A</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="B-">B-</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="C-">C-</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="D-">D-</option>
                                  <option value="F">F</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                                  id="topicsNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="topicsNotes" value="" contenteditable></textarea></td>
                            </tr>
                            <tr>
                              <th>Group Status</th>
                              <th>Notes</th>
                            </tr>
                            <tr>
                              <td> <select name="groupStatus"
                                  id="groupStatusgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Status</option>
                                  <option value="Advanced">Advanced</option>
                                  <option value="Good">Good</option>
                                  <option value="Achieved">Achieved</option>
                                  <option value="Behind">Behind</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                                  id="statusNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="statusNotes" value="" contenteditable></textarea></td>
                            </tr>
                          </tbody>
                        </table>
                        <br><br>
                        <table>
                          <thead>
                            <tr>
                              <th>Do They Have a client</th>
                              <th>Is the Client Satisfied</th>
                              <th>Client remarks</th>
                            </tr>
                          </thead>
                          <tbody>
                            <td>
                              <select name="haveClient"
                                id="haveClientgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                <option value="em" selected>Choose</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                <option value="n/a">N/A</option>
                              </select>
                            </td>
                            <td>
                              <select name="clientSatisfied"
                                id="clientSatisfiedgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                <option value="em" selected>Choose</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                <option value="n/a">N/A</option>
                              </select>
                            </td>
                            <td><textarea class="textarea resize-ta" role="textbox"
                                oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                                id="clientNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                name="clientNotes" value="" contenteditable></textarea></td>

                          </tbody>
                        </table>
                        <br><br>
                        <center>
                          <h5 style="margin-left:auto; margin-right:auto;">
                            Individual Grades for
                            <?php echo $value3 ?>
                          </h5>
                        </center>
                        <table id="example1" class="display">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Presentation Grade</th>
                              <th>Github Activity</th>
                              <th>Notes</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $studentsView = new StudentsView();
                            $query2 = $studentsView->studentGroup($value1['groupid']);
                            if ($query2 != null) {
                              foreach ($query2 as $key => $value) {
                                ?>
                                <tr>
                                  <td>
                                    <?php echo $value['name']; ?>
                                    <input type="hidden" name="student<?php echo $value['studentid']; ?>"
                                      id="<?php echo $value['studentid']; ?>group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                      value="<?php echo $value['studentid']; ?>">
                                  </td>
                                  <td><select name="<?php echo $value['studentid']; ?>grade"
                                      id="<?php echo $value['studentid']; ?>gradegroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                      <option value="" selected>Choose Grade</option>
                                      <option value="A">A</option>
                                      <option value="A-">A-</option>
                                      <option value="B+">B+</option>
                                      <option value="B">B</option>
                                      <option value="B-">B-</option>
                                      <option value="C+">C+</option>
                                      <option value="C">C</option>
                                      <option value="C-">C-</option>
                                      <option value="D+">D+</option>
                                      <option value="D">D</option>
                                      <option value="D-">D-</option>
                                      <option value="F">F</option>
                                    </select></td>
                                  <td><select name="<?php echo $value['studentid']; ?>github"
                                      id="<?php echo $value['studentid']; ?>githubgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                      <option value="" selected>Choose Grade</option>
                                      <option value="A">A</option>
                                      <option value="A-">A-</option>
                                      <option value="B+">B+</option>
                                      <option value="B">B</option>
                                      <option value="B-">B-</option>
                                      <option value="C+">C+</option>
                                      <option value="C">C</option>
                                      <option value="C-">C-</option>
                                      <option value="D+">D+</option>
                                      <option value="D">D</option>
                                      <option value="D-">D-</option>
                                      <option value="F">F</option>
                                    </select></td>
                                  <td><textarea class="textarea resize-ta" role="textbox"
                                      oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
                                      id="<?php echo $value['studentid']; ?>notesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                      name="<?php echo $value['studentid']; ?>notes" value="" contenteditable></textarea></td>
                                  <!-- <td><input type="textarea" id="<?php echo $value['studentid']; ?>notes"
                                    name="<?php echo $value['studentid']; ?>notes" value=""></td> -->
                                </tr>
                              <?php }
                            } ?>
                          </tbody>
                        </table>
                      </form>

                    </div>
                  <?php } else { ?>
                    <div class="tab-pane mytabassignments fade formtab"
                      id="group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>" role="tabpanel"
                      aria-labelledby="group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>-tab"
                      tabindex="0">
                      <?php $countTab3++ ?>
                      <br>
                      <center>
                        <h1>
                          <?php echo $value3 ?>
                        </h1>
                      </center>
                      <center>
                        <h3>for
                          <?php echo $value1['groupName'] ?>
                        </h3>
                      </center>
                      <br><br>
                      <button id="submitbtn" class="btn" type="submit"
                        form="Profaddgroupgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                        name="groupgradeEval"> Submit Grade</button>
                      <br><br>
                      <form action="addAssignmentGrade.php"
                        id="Profaddgroupgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                        method="POST">
                        <table id="exampleAssignment<?php echo $countAssignments; ?>Group<?php echo $value1['groupid']; ?>"
                          class="display">
                          <thead>
                            <tr>
                              <th>Group</th>
                              <th>
                                <?php echo $value3 ?> Grade
                              </th>
                              <th>Notes</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $groupTableView = new GroupTableView();
                            $groupinfo = $groupTableView->selectGroupInfo($value1['groupid']);
                            $usersView = new UsersView();
                            $user = $usersView->selectTheOneProf($professorEmail);
                            ?>
                            <tr>
                              <td rowspan="9" class="grouptd">
                                <?php echo $groupinfo[0]['groupName']; ?>
                                <input type="hidden" name="groupsName" id="groupsName" value=<?php echo $groupinfo[0]['groupid']; ?>>
                                <input type="hidden" name="groupid" id="groupid" value=<?php echo $value1['groupid']; ?>>
                                <input type="hidden" name="assignmentType" id="assignmentType" value="<?php echo $value3; ?>">
                                <input type="hidden" name="givenByUser" id="givenByUser" value="<?php echo $user['userid']; ?>">
                              </td>
                              <td><select name="documentGrade"
                                  id="documentGradegroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Grade</option>
                                  <option value="A">A</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="B-">B-</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="C-">C-</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="D-">D-</option>
                                  <option value="F">F</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  id="groupNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="groupNotes" value="" contenteditable></textarea></td>
                            </tr>
                            <tr>
                              <th>Consistency</th>
                              <th>Notes</th>
                            </tr>
                            <tr>
                              <td> <select name="Consistency"
                                  id="Consistencygroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Grade</option>
                                  <option value="A">A</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="B-">B-</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="C-">C-</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="D-">D-</option>
                                  <option value="F">F</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  id="consistencyNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="consistencyNotes" value="" contenteditable></textarea></td>
                            </tr>
                            <tr>
                              <th>Grammar</th>
                              <th>Notes</th>
                            </tr>
                            <tr>
                              <td> <select name="Grammar"
                                  id="Grammargroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Grade</option>
                                  <option value="A">A</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="B-">B-</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="C-">C-</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="D-">D-</option>
                                  <option value="F">F</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  id="grammarNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="grammarNotes" value="" contenteditable></textarea></td>
                            </tr>
                            <tr>
                              <th>Topics & Correctness</th>
                              <th>Notes</th>
                            </tr>
                            <tr>
                              <td> <select name="topicsCorrect"
                                  id="topicsCorrectgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                  <option value="" selected>Choose Grade</option>
                                  <option value="A">A</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B">B</option>
                                  <option value="B-">B-</option>
                                  <option value="C+">C+</option>
                                  <option value="C">C</option>
                                  <option value="C-">C-</option>
                                  <option value="D+">D+</option>
                                  <option value="D">D</option>
                                  <option value="D-">D-</option>
                                  <option value="F">F</option>
                                </select></td>
                              <td><textarea class="textarea resize-ta" role="textbox"
                                  id="topicsNotesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                  name="topicsNotes" value="" contenteditable></textarea></td>
                            </tr>
                            <tr>
                              <th>Resubmission after Notes?</th>
                            </tr>
                            <td> <select name="edited"
                                id="editedgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                <option value="" selected>Resubmit?</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                              </select></td>
                            </tr>
                          </tbody>
                        </table>
                        <br><br>
                        <center>
                          <h5 style="margin-left:auto; margin-right:auto;">
                            Individual Grades for
                            <?php echo $value3 ?>
                          </h5>
                        </center>
                        <table id="example1" class="display">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Presentation Grade</th>
                              <th>Notes</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $studentsView = new StudentsView();
                            $query2 = $studentsView->studentGroup($value1['groupid']);
                            if ($query2 != null) {
                              foreach ($query2 as $key => $value) {
                                ?>
                                <tr>
                                  <td>
                                    <?php echo $value['name']; ?>
                                    <input type="hidden" name="student<?php echo $value['studentid']; ?>"
                                      id="<?php echo $value['studentid']; ?>group<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                      value="<?php echo $value['studentid']; ?>">
                                  </td>
                                  <td><select name="<?php echo $value['studentid']; ?>grade"
                                      id="<?php echo $value['studentid']; ?>gradegroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>">
                                      <option value="" selected>Choose Grade</option>
                                      <option value="A">A</option>
                                      <option value="A-">A-</option>
                                      <option value="B+">B+</option>
                                      <option value="B">B</option>
                                      <option value="B-">B-</option>
                                      <option value="C+">C+</option>
                                      <option value="C">C</option>
                                      <option value="C-">C-</option>
                                      <option value="D+">D+</option>
                                      <option value="D">D</option>
                                      <option value="D-">D-</option>
                                      <option value="F">F</option>
                                    </select></td>
                                  <td><textarea class="textarea resize-ta" role="textbox"
                                      id="<?php echo $value['studentid']; ?>notesgroup<?php echo $value1['groupid'] ?>assignment<?php echo $countAssignments; ?>"
                                      name="<?php echo $value['studentid']; ?>notes" value="" contenteditable></textarea></td>
                                  <!-- <td><input type="textarea" id="<?php echo $value['studentid']; ?>notes"
                                    name="<?php echo $value['studentid']; ?>notes" value=""></td> -->
                                </tr>
                              <?php }
                            } ?>
                          </tbody>
                        </table>
                      </form>
                    </div>
                  <?php }
                } ?>
              </div>
            </div>
            <?php
          } ?>
        </div>
      </div>
    <?php } ?>
  </div>
  <script>
    function calcHeight(value) {
      let numberOfLineBreaks = (value.match(/\n/g) || []).length;
      // min-height + lines x line-height + padding + border
      let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
      return newHeight;
    }

    let textarea = document.querySelector(".resize-ta");
    textarea.addEventListener("keyup", () => {
      textarea.style.height = calcHeight(textarea.value) + "px";
    });
  </script>
  <script language="JavaScript" type="text/javascript">
    function updateForm(tabid) {
      var divid = document.getElementById(tabid);

      console.log(document.getElementById(tabid));
      var x = divid.querySelector("#groupid");
      var val = x.value;
      console.log(val);
      var y = divid.querySelector("#assignmentType");
      var val1 = y.value;
      console.log(val1);
      var z = divid.querySelector("#givenByUser");
      var val2 = z.value;
      console.log(val2);

      $.ajax({
        url: "reportByAssignmentAndGroup.php",    //the page containing php script
        type: "post",    //request type,
        data: { groupid: val, assignmentType: val1, givenByUser: val2 },
        success: function (response) {
          console.log(response);
          var obj = JSON.parse(response);
          console.log(obj);
          var grade = obj[0].documentGrade;
          var notes = obj[0].groupNotes;
          var consistency = obj[0].consistency;
          var consistencyNotes = obj[0].consistencyNotes;
          var grammar = obj[0].grammar;
          var grammarNotes = obj[0].grammarNotes;
          var topicsCorrect = obj[0].topicsCorrectness;
          var topicsNotes = obj[0].topicsNotes;
          var resubmit = obj[0].resubmitDocument;
          var haveClient = obj[0].hasClient;
          var clientSatisfied = obj[0].clientSatisfied;
          var clientNotes = obj[0].clientNotes;
          var groupStatus = obj[0].groupStatus;
          var statusNotes = obj[0].statusNotes;
          var functionality = obj[0].functionality;
          var functionalityNotes = obj[0].functionalityNotes;

          console.log("grade = " + grade);
          console.log("groupnotes = " + notes);
          console.log("consistency = " + consistency);
          console.log("grammar = " + grammar);
          console.log("topicscorrect = " + topicsCorrect);
          console.log("resubmit = " + resubmit);

          console.log(grade);

          $('#documentGrade' + tabid + ' option[value="' + grade + '"]').attr("selected", "selected");
          $('#Consistency' + tabid + ' option[value="' + consistency + '"]').attr("selected", "selected");
          $('#consistencyNotes' + tabid).val(consistencyNotes);
          $('#Grammar' + tabid + ' option[value="' + grammar + '"]').attr("selected", "selected");
          $('#grammarNotes' + tabid).val(grammarNotes);
          $('#topicsCorrect' + tabid + ' option[value="' + topicsCorrect + '"]').attr("selected", "selected");
          $('#topicsNotes' + tabid).val(topicsNotes);
          $('#edited' + tabid + ' option[value="' + resubmit + '"]').attr("selected", "selected");
          $('#haveClient' + tabid + ' option[value="' + haveClient + '"]').attr("selected", "selected");
          $('#clientSatisfied' + tabid + ' option[value="' + clientSatisfied + '"]').attr("selected", "selected");
          $('#groupStatus' + tabid + ' option[value="' + groupStatus + '"]').attr("selected", "selected");
          $('#statusNotes' + tabid).val(statusNotes);
          $('#functionality' + tabid + ' option[value="' + functionality + '"]').attr("selected", "selected");
          $('#functionalityNotes' + tabid).val(functionalityNotes);
          $('#groupNotes' + tabid).val(notes);
          $('#clientNotes' + tabid).val(clientNotes);
          var objLength = obj.length;
          for (let i = 0; i < obj.length; i++) {
            var studentid = obj[i].studentid;
            var presentationGrade = obj[i].presentationGrade;
            var notes = obj[i].notes;
            var github = obj[i].githubActivity
            $('#' + studentid + 'grade' + tabid + ' option[value="' + presentationGrade + '"]').attr("selected", "selected");
            $('#' + studentid + 'github' + tabid + ' option[value="' + github + '"]').attr("selected", "selected");
            $('#' + studentid + 'notes' + tabid).val(notes);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(errorThrown);
        }
      });
    }

  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>


</html>