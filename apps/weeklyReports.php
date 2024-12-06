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
  <title>Weekly Reports</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" style="text/css" href="styles/weeklyReports.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <style>
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
    h2 {
      margin-top: 5%;
    }

    .form-horizontal {
      width: 50%;
      margin: 0 auto;
    }

    table {
      width: 90%;
      margin-top: 75px;
      margin-left: auto;
      margin-right: auto;
      border-collapse: collapse;
      position: relative;
    }

    #updateBTN {
      background-color: #A9F3E9;
    }

    .headRow {
      border-bottom: 1px solid black;
    }

    .modal-content {
      background-color: #008C81;
    }

    .modal {
      text-shadow: .7px .7px #000000;
      color: #F3F7FC;
    }

    .form-check-label {
      font-size: 20px;
    }

    th,
    td {
      padding: 0.25rem;
    }

    .summarybox {
      box-shadow: 0 0 5px rgba(0, 0, 0, .05), 2px 2px 5px rgba(0, 0, 0, .1);
      border-radius: 4px;
      width: 90%;
      margin-left: auto;
      margin-right: auto;
    }

    h1,
    h3 {
      text-align: center;
    }

    .borderOnWeek {
      border-right: 1px solid black;
    }

    /* basic positioning */
    .legend {
      list-style: none;
      margin-left: auto;
      width: 45%;
      margin-right: auto;
    }

    .legend li {
      float: left;
      margin-right: 10px;
    }

    .legend span {
      border: 1px solid #ccc;
      float: left;
      width: 20px;
      height: 20px;
      margin: 4px;
    }

    /* your colors */
    .legend .ontime {
      background-color: #A9F3E9;
    }

    .legend .latesubmission {
      background-color: #f3caa9;
    }

    .legend .nosubrevoked {
      background-color: #FCD0CF;
    }

    .legend .incomplete {
      background-color: #f3f2a9;
    }
    .dropdown-menu,
    .dropdown-toggle {
      margin-left: 700px;
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
    
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      /* color optimization */
      background-color: var(--background-color);
      line-height: 1.6;
      font-size: 18px; 
      font-family: 'Roboto', sans-serif;
       }
       #countnotif {
      border-radius: 50%;
      position: relative;
      top: -10px;
      left: -10px;
    }

       /* Adjust Buttons */
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
    .btn:hover {
      /* color optimization */
      background-color: var(--button-hover-color);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
      color: black;
    }
    
    .jumpbtn{
      margin-left: 5%;
    }
    @media only screen and (max-width: 950px) {
      h3.capTitle{
        margin-left: 0px;
      }
      a.titleLabel{
        font-size:20px;
      }
      img.wsuimg{
       margin-top:-110px;
       margin-left:300px;
      }
       .dropdown-toggle{
        margin-left:-100px;
      }
      .dropdown-menu{
        margin-left:-150px;
      }
    }
    @media only screen and (max-width: 600px) {
      .form-horizontal {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        margin-top: 5%;
      }

      .borderOnWeek {
        border: none;
      }

      .headRowSum {
        margin-left:auto;
        margin-right: auto;;
      }

      .weektable {
        overflow-x: auto;
      }

      
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

      td:before {
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
      }
      .jumpbtn{
        margin-left:auto;
        margin-right:auto;
        width:60%;
      }
    }
  </style>
</head>

<body>
  <!-- Start Navigation bar code -->
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
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <img src="images/bell.svg" alt="My bell SVG" /> <?php if ($statusCount['COUNT(*)'] !== 0) { ?><span class="badge text-bg-danger" id="countnotif">
            <?php 
              echo $statusCount['COUNT(*)'];
            } ?>
          </span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="notificationsGTA.php">View Messages</a></li>
        </ul>
      </li>
      <h3 class ="capTitle"><a class = "titleLabel"style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;" href="gtaDash.php">Capstone
          Course Evaluation System</a></h3>
      <img class = "wsuimg"style="width:40px; height:40px;display: inline-block;"
        src="images/wsulogo.svg.png"
        alt="">
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
              <a class="nav-link active" href="weeklyReports.php">
                Weekly Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gtaDashPickGroups.php">
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
  <!-- End Navigation bar code -->
    <!-- Title -->
  <center>
    <h2>Weekly Reports</h2>
  </center>
  <?php
// Call php functions to get signed in GTAs groups
  $email = $_SESSION['email'];
  $usersView = new UsersView();
  $user = $usersView->selectTheOneProf($email);
  $semesterView = new SemesterView();
  $sem = $semesterView->currentSemester();
  $semesterid = $sem[0]['semesterid'];
  $groupTableView = new GroupTableView();
  $query = $groupTableView->selectgtaGroups($user['userid'], $semesterid);
  ?>
  <br>
  <!-- Start form for GTA to select Group -->
  <form class="first-form form-horizontal text-center " method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="row justify-content-center align-items-center ">
      <div class="col-auto">
        <h2 style="color:#008C81" for="selectGroup">GROUP:</h2>
      </div>
      <div class="col-auto">
        <select name="selectGroup">
          <option selected>Select Group</option>
          <?php
          if ($query != null) {
            for ($m = 0; $m < count($query); $m++) { ?>
              <option value="<?php echo $query[$m]['groupid'] ?>"><?php echo $query[$m]['groupName']; ?></option>
            <?php }
          } ?>
        </select>
      </div>
      <div class="col-auto">
        <input class=" btn btn-block rounded" type="submit" name="submit"
          value="Select" />
      </div>
    </div>
  </form>
  <!-- END form for GTA to select Group -->
  <?php
  $groupid = "";
  // get selected groupid
  if (!empty($_POST['selectGroup'])) {
    $groupid = $_POST['selectGroup'];
  }
  if (isset($_GET["gd"])) {
    $groupid = $_GET["gd"];
  }
  if ($groupid != null) {
    $studentsView = new StudentsView();
    $query2 = $studentsView->studentGroup($groupid);
    $weeklyReportsContr = new WeeklyReportsContr();
    $weeklyReportsView = new WeeklyReportsView();

    $studentids = array();
// this part of the code is creating enough rows for each student in the group depending
// on the number of weeks in the semester. If they have already been created it will not 
// duplicate but just pull them up in the WeeklyReports Table
    $numberofweeks = $weeklyReportsView->numberOfWeeks();
    if ($numberofweeks != null) {
      $weeks = $numberofweeks[0]['weeksout'];
    }
    if ($query2 != null) {
      foreach ($query2 as $key => $value) {
        for ($x = 1; $x <= $weeks; $x++) {
          $cnt = $weeklyReportsView->countWeeksforStudent($x, $value['studentid']);
          if ($cnt = !null & $cnt["count(1)"] == 0) {
            $weeklyReportsContr->insertNewWeek($x, $value['studentid'], $groupid);
          }
        }
      }
    }
    ?>
    <!-- START POP-UP MODAL FOR WEEKLY REPORT FORM -->
    <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div style="text-align:center;" class="modal-header">
            <h1 class="modal-title fs-3" name="weeklyreporttitle" id="staticBackdropLabel"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="addWeek.php" method="POST" id="signin-form">
              <div class="radiobtn1">
                <input type="hidden" class="form-control" name="studentid" id="studentid">
                <input type="hidden" class="form-control" name="week" id="week">
                <input type="hidden" class="form-control" name="groupid" id="groupid" value="<?php echo $groupid; ?>">
                <fieldset id="group1">
                  <label style="font-size:25px;" class="form-control-placeholder" for="submitted">Submitted:</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input subTime" type="radio" name="selectSubmitted" id="inlineRadio1"
                      value="on time">
                    <label class="form-check-label" for="inlineRadio1">On Time</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input subTime" type="radio" name="selectSubmitted" id="inlineRadio2"
                      value="late submission">
                    <label class="form-check-label" for="inlineRadio2">Late Submission</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input subTime" type="radio" name="selectSubmitted" id="inlineRadio3"
                      value="no submission">
                    <label class="form-check-label" for="inlineRadio3">No Submission</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input subTime" type="radio" name="selectSubmitted" id="inlineRadio4"
                      value="revoked">
                    <label class="form-check-label" for="inlineRadio4">Revoked</label>
                  </div>
                  <span class="error"> </span>
              </div>
              <div class="form-group mt-3">
                <label style="font-size:25px;" class="form-control-placeholder" for="submitted">Status:</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input statReport" type="radio" name="selectStatus" id="inlineRadio1"
                    value="advanced">
                  <label class="form-check-label" for="inlineRadio1">Advanced</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input statReport" type="radio" name="selectStatus" id="inlineRadio2"
                    value="good">
                  <label class="form-check-label" for="inlineRadio2">Good</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input statReport" type="radio" name="selectStatus" id="inlineRadio3"
                    value="achieved">
                  <label class="form-check-label" for="inlineRadio3">Achieved</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input statReport" type="radio" name="selectStatus" id="inlineRadio4"
                    value="behind">
                  <label class="form-check-label" for="inlineRadio4">Behind</label>
                </div>
                <span class="error"> </span>
              </div>
              <div class="form-group mt-3">
                <label style="font-size:25px;" class="form-control-placeholder" for="evaluation">Evaluation:</label>
                <textarea class="form-control" name="evaluation" id="evaluation" cols="100" rows="8"></textarea>
                <span class="error"> </span>
              </div>
              <span class="error"></span>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="updateBTN" type="submit" form="signin-form" name="add-week" class="btn">Update Data</button>
          </div>
        </div>
      </div>
    </div>
    <!-- CLOSE POP-UP MODAL FOR STUDENT WEEKLY REPORT FORM -->

    <!-- START POP-UP MODAL FOR GROUP WEEKLY REPORT FORM -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <?php
            $groupTableView = new GroupTableView();
            $groupinfo = $groupTableView->selectGroupInfo($groupid);
            ?>
            <h1 class="modal-title fs-5" id="exampleModalLabel">Weekly Report:
              <?php echo $groupinfo[0]['groupName']; ?>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="addWeek.php" method="POST" id="addgroupweekeval">
              <div class="hiddenitems">
                <input type="hidden" class="form-control" name="weeknum" id="weeknum">
                <input type="hidden" class="form-control" name="groupid" id="groupid" value="<?php echo $groupid; ?>">
              </div>
              <div class="form-group mt-3">
                <label style="font-size:25px;" class="form-control-placeholder"
                  for="evaluationforgroup">Evaluation:</label>
                <textarea class="form-control" name="evaluationforgroup" id="evaluationforgroup" cols="100"
                  rows="8"></textarea>
                <span class="error"> </span>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="updateBTN" type="submit" form="addgroupweekeval" name="groupeval" class="btn">Update Data</button>
          </div>
        </div>
      </div>
    </div>
    <!-- CLOSE POP-UP MODAL FOR GROUP WEEKLY REPORT FORM -->

    <br>

    <div class="weektable">
    <!-- anchor tag link to jump to bottom of page for summary tables -->
    <?php echo '<a class ="btn jumpbtn btn-block rounded btn-primary" href="#anchor-name">Jump to Summary</a>' ?>
      <center>
        <h1>
          <?php if ($groupinfo != null) {
            echo $groupinfo[0]['groupName']; ?>

          </h1>
        </center>
        <!-- once the form is complete this alert box will appear -->
        <?php if (isset($_GET["update"])) {
        if ($_GET["update"] == "success") {
          echo '<div style = "width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Update Success</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

        }
      } ?>
        <center>
          <!-- legend to explain different colors of weekly reports buttons -->
          <ul class="legend">
            <li style="font-weight:bolder;">LEGEND</li>
            <li><span class="ontime"></span> On Time</li>
            <li><span class="latesubmission"></span> Late Submission</li>
            <li><span class="nosubrevoked"></span> No Submission / Revoked</li>
            <li><span class="incomplete"></span> Incomplete</li>
          </ul>
        </center>
      <?php } ?>
<!-- START TABLE FOR WEEKLY REPORT DISPLAY -->
      <table>
        <thead>
          <tr class="headRow">
            <?php
            if ($query2 != null) { ?>
              <th class="borderOnWeek"> Week </th>
              <th> Group report </th>
              <?php $studentcnt = 0;
              foreach ($query2 as $key => $value) {
                $studentids[$studentcnt] = $value['studentid'];
                $studentcnt++;
                ?>
                <th>
                  <?php echo $value['name'];
              }
            } ?>
            </th>
          </tr>
        </thead>

        <?php
        // START code to display first day of each week
        $semesterView = new SemesterView();
        $startAndEnd = $semesterView->startandEndDate();
        if ($startAndEnd != null) {
          $start = $startAndEnd[0]['startDate'];
          $end = $startAndEnd[0]['endDate'];
          $start_date = date('Y-m-d', strtotime($start));
          $end_date = date('Y-m-d', strtotime($end));

          $arrayofalldates = array();
        }
        function getWeekDates($date, $start_date, $end_date)
        {
          $datearray = array();
          $week = date('W', strtotime($date));
          $year = date('Y', strtotime($date));
          $from = date("Y-m-d", strtotime("{$year}-W{$week}+1")); //Returns the date of monday in week
          $newDate = date("m-d-Y", strtotime("{$from}"));
          if ($from < $start_date)
            $from = $start_date;
          $to = date("Y-m-d", strtotime("{$year}-W{$week}-6")); //Returns the date of sunday in week
          if ($to > $end_date)
            $to = $end_date;
          //  echo "Start Date-->".$from."End Date -->".$to;//Output : Start Date-->2012-09-03 End Date-->2012-09-09
          array_push($datearray, $newDate);
          return $datearray;
        }
        for ($date = $start_date; $date <= $end_date; $date = date('Y-m-d', strtotime($date . ' + 7 days'))) {
          $arrayofdates = getWeekDates($date, $start_date, $end_date);
          array_push($arrayofalldates, $arrayofdates);
        }
        // END code to display first day of each week
        $stmt = $weeklyReportsView->getWeeks($groupid);
        for ($x = 1; $x <= $weeks; $x++) {
          if ($stmt != null) {
            ?>
            <tr>
              <td>
                <!-- print out week number and date -->
                <?php echo $x;
                echo "<br>";
                echo $arrayofalldates[$x - 1][0]; ?>
                <!-- START code to display button for group pop-up button if already submitted
                show ✓ and if it has not been filled out show X -->
                <?php
                $weeklyReportsGroupView = new WeeklyReportsView();
                $results1 = $weeklyReportsGroupView->isGroupReportSubmitted($x, $groupid);
                if ($results1 != null) {
                  if (($results1[0]["evaluation"] != null) || (!empty($results1[0]["evaluation"])) ) {
                    ?>
                  <td class="weekTH">
                    <button id="<?php echo $x; ?>" type="button"
                      style="border: 1px solid #A9F3E9; box-shadow: 0 0.5px 0 #666, 0 3px 0 #444, 0 4px 4px rgba(169,243,233, 0.6);"
                      class="weekbtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      ✓
                    </button>
                  </td>
                <?php }
                } else { ?>
                <td class="weekTH">
                  <button id="<?php echo $x; ?>" type="button"
                    style="border: 1px solid #FCD0CF; box-shadow: 0 0.5px 0 #666, 0 3px 0 #444, 0 4px 4px rgba(252,208,207, 0.6);"
                    class=" weekbtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    X
                  </button>
                </td>
                <!-- END code to display button for group pop-up button-->
              <?php } ?>
              <?php if ($studentids != null) {
                $studentcnt = 0;
                foreach ($studentids as $value) { ?>
                  <td style="display:none;">
                  <!-- hide studentid -->
                    <?php echo $value; ?>
                  </td>
                  <td style="display:none;">
                  <!-- hide week number -->
                    <?php echo $x; ?>
                  </td>
                  <?php
                  $weeklyReportsView = new WeeklyReportsView();
                  $results = $weeklyReportsView->isReportSubmitted($x, $value);
                  if ($results[0]["submitted"] != null) {
                    // if report is submitted and marked "on time" then the button to open
                    // the student pop up modal will have a green background
                    if ($results[0]["submitted"] === "on time") { ?>
                      <td>
                        <button id="<?php echo $studentcnt; ?> " type="button" style="background-color:#A9F3E9;"
                          class=" btn btn-block rounded editbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          <?php echo "submitted: " . $results[0]["submitted"] . " | status: " . $results[0]["status"]; ?>
                        </button>
                      </td>
                      <?php
                      // if report is submitted and marked "late submission" then the button to open
                      // the student pop up modal will have a orange background
                    } else if ($results[0]["submitted"] === "late submission") { ?>
                        <td>
                          <button id="<?php echo $studentcnt; ?> " type="button" style="background-color:#f3caa9;"
                            class=" btn btn-block rounded editbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          <?php echo "submitted: " . $results[0]["submitted"] . " | status: " . $results[0]["status"]; ?>
                          </button>
                        </td>
                      <?php
                      // if report is submitted and marked "no submission" then the button to open
                      // the student pop up modal will have a red background
                    } else if ($results[0]["submitted"] === "no submission") { ?>
                          <td>
                            <button id="<?php echo $studentcnt; ?> " type="button" style="background-color:#FCD0CF;"
                              class=" btn btn-block rounded editbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          <?php echo "submitted: " . $results[0]["submitted"] . " | status: " . $results[0]["status"]; ?>
                            </button>
                          </td>
                      <?php
                        // if report is submitted and marked "revoked" then the button to open
                      // the student pop up modal will have a red background
                    } else if ($results[0]["submitted"] === "revoked") { ?>
                            <td>
                              <button id="<?php echo $studentcnt; ?> " type="button" style="background-color:#FCD0CF;"
                                class=" btn btn-block rounded editbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          <?php echo "submitted: " . $results[0]["submitted"] . " | status: " . $results[0]["status"]; ?>
                              </button>
                            </td>
                            </td>
                      <?php
                    }
                     // if the form has not been submitted for that week/student then the button to open
                    // the student pop up modal will have a yellow background and say "Incomplete"
                  } else { ?>
                    <td>
                      <button id="<?php echo $studentcnt; ?> " type="button" style="background-color:#f3f2a9;"
                        class=" btn btn-block rounded editbtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Incomplete
                      </button>
                    </td>
                  <?php } ?>
                  <?php $studentcnt++;
                }
              } ?>
            </tr>
            <?php
          }
        } ?>

      </table>
    </div>

    <br>
    <!-- summary section -->
    <?php
    if ($query2 != null) { ?>
      <?php $studentcnt = 0;
      foreach ($query2 as $key => $value) {
        $studentids[$studentcnt] = $value['studentid'];
        $studentcnt++; ?>
<!-- functions below to count the different submitted and status values -->
        <?php
        $weeklyReportsViewSub = new WeeklyReportsView();
        $weeklyReportsViewStat = new WeeklyReportsView();
        $submittedVal = $weeklyReportsViewSub->countSubmittedValues($value['studentid']);
        $statusVal = $weeklyReportsViewStat->countStatusValues($value['studentid']);
        ?>
        <div class="summarybox">
          <!-- hidden anchor link for jump -->
          <h2 style="opacity:0;" id="anchor-name">Summary</h2>
          <h1 style="color:#008C81">Summary</h1>
          <!-- start table loop for each student for count values of submitted types and status types -->
          <table>
            <br>
            <h3>
              <?php echo $value['name']; ?>
            </h3>
            <thead>
              <tr class="headRowSum">
                <th
                  style="background-color:#008C81; text-shadow: .7px .7px #000000; color:#F3F7FC; border-right: 1px solid black;">
                  Submitted Values:</th>
                <?php if ($submittedVal != null) {
                  foreach ($submittedVal as $key => $value1) { ?>
                    <th>
                      <?php echo $value1['submitted']; ?>
                    </th>
                  <?php }
                } ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Count</td>
                <?php if ($submittedVal != null) {
                  foreach ($submittedVal as $key => $value1) { ?>
                    <td>
                      <?php echo $value1['SUM(qty)']; ?>
                    </td>
                  <?php }
                } ?>
              </tr>
            </tbody>
          </table>
          <table>
            <thead>
              <tr class="headRowSum">
                <th
                  style="background-color:#008C81; text-shadow: .7px .7px #000000; color:#F3F7FC; border-right: 1px solid black;">
                  Status Values:</th>
                <?php if ($statusVal != null) {
                  foreach ($statusVal as $key => $value2) { ?>
                    <th>
                      <?php echo $value2['status']; ?>
                    </th>
                  <?php }
                } ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Count</td>
                <?php if ($statusVal != null) {
                  foreach ($statusVal as $key => $value2) { ?>
                    <td>
                      <?php echo $value2['SUM(qty)']; ?>
                    </td>
                  <?php }
                } ?>
              </tr>
            </tbody>
          </table>
        </div>
        <br>
      <?php }
    }
  } ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

  <script language="JavaScript" type="text/javascript">
    // javascript to get information to open the group modal
    $(document).ready(function () {
      $('.weekbtn').on('click', function () {
        $('#exampleModal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();

        console.log(data);
        var id = $(this).attr("id");
        var groupid = $('#groupid').val();
        console.log("id = " + id);
        $('#weeknum').val(id);
        // ajax for opening group modal if the information is filled out it fills out the form
        $.ajax({
          url: "reportByWeekAndGroup.php",    //the page containing php script
          type: "post",    //request type,
          data: { week: id, groupid: groupid },
          success: function (response) {
            console.log(response);
            var obj = JSON.parse(response);
            console.log(obj);
            var eval = obj[0].evaluation;
            var week = obj[0].week;
            var groupName = obj[0].groupName;
            $('#evaluationforgroup').val(eval);
            $('#exampleModalLabel').html("Week " + week + " report for " + groupName);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
          }
        });
      });
    });

    $(document).ready(function () {
      $('.editbtn').on('click', function () {
    // javascript to get information to open the student modal
        $('#staticBackdrop').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();

        console.log(data);
        var id = $(this).attr("id");
        console.log("id = " + id);
        var offset = (id * 3) + 2;
        $('#studentid').val(data[offset]);
        $('#week').val(data[offset + 1]);
       // ajax for opening group modal if the information is filled out it fills out the form
        $.ajax({
          url: "reportByWeekAndStudent.php",    //the page containing php script
          type: "post",    //request type,
          data: { studentid: data[offset], week: data[offset + 1] },
          success: function (response) {
            console.log(response);
            var obj = JSON.parse(response);
            console.log(obj);
            var subVal = obj[0].submitted;
            var statVal = obj[0].status;
            var eval = obj[0].evaluation;
            var name = obj[0].name;
            var week = obj[0].week;
            console.log("name = " + name);
            console.log("week = " + week);
            console.log("subval = " + subVal);
            console.log("statVal = " + statVal);
            $('#evaluation').val(eval);
            $('#staticBackdropLabel').html(name + "'s Week " + week + " Report");
            var input = document.querySelectorAll('.subTime');
            var input2 = document.querySelectorAll('.statReport');
            for (var i = 0; i < input.length; i++) {
              if (input[i].value == subVal) {
                input[i].checked = true;
              } else {
                input[i].checked = false;
              }
            }
            for (var i = 0; i < input2.length; i++) {
              if (input2[i].value == statVal) {
                input2[i].checked = true;
              } else {
                input2[i].checked = false;
              }
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
          }
        });
      });
    });
  </script>
</body>

</html>