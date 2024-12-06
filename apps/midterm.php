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
    <!-- Css for the web application -->
    <title>Grade Midterm</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="wsulogo.svg.png">
    <link rel="stylesheet" style="text/css" href="styles/midterm.css">
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
    <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=8f7cff5ee7757412879aedf3efbfaee01">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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

        .btn {
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

        th,
        td {
            padding: 10px;
        }

        ul {
            margin: 10px;
        }

        #groupTab li {
            background: #c3c3c3;
        }

        #studentTab li {
            background: #dbdbdb;
        }

        #groupTab .active {
            background: #76aaa3;
        }

        #studentTab .active {
            background: #d4f9f4;
        }

        html,
        body {
            margin: 0;
            height: 100%;
        }

        h1,
        h4 {
            margin-left: 15px;
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

        @media (min-width: 950px) {
            .section-title h2 {
                font-size: 28px;
            }
        }

        @media (min-width: 950px) {
            .section-title h2 {
                font-size: 34px;
            }
        }

        .section-title.title-ex1 h2 {
            padding-bottom: 20px;
        }

        @media (min-width: 950px) {
            .section-title.title-ex1 h2 {
                padding-bottom: 30px;
            }
        }

        @media (min-width: 950px) {
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

        @media (min-width: 950px) {
            .section-title.title-ex1 h2:before {
                bottom: 17px;
            }
        }

        @media (min-width: 950px) {
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

        @media (min-width: 950px) {
            .section-title.title-ex1 h2:after {
                bottom: 17px;
            }
        }

        @media (min-width: 950px) {
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

        .dropdown-menu,
        .dropdown-toggle {
            margin-left: 700px;
        }

        table {
            width: 80%;
        }

        /* To make webpage responsive to other devices */
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

            table {
                width: 100%;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            .textarea {
                width: 280px;
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
                /* padding-left: 50%; */
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
        }
    </style>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
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
                    style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;"
                    href="gtaDash.php">Capstone
                    Course Evaluation System</a></h3>
            <img class="wsuimg" style="width:40px; height:40px;display: inline-block;" src="images/wsulogo.svg.png"
                alt="">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h4 style="color:#008C81; text-shadow: .7px .7px #000000;" class="offcanvas-title"
                        id="offcanvasNavbarLabel">
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
                            <a class="nav-link" href="gtaDashPickGroups.php">
                                Choose Groups
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="midterm.php">
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
                                <button type="button" class="btn" id="right-panel-link" href="#right-panel">Sign
                                    out</button>
                            </a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <br><br><br>
    <!-- To Display the title of the webpage in the center -->
    <center>
        <h1>Midterm Grade</h1>
    </center>
    <br>
    <?php if (isset($_GET["update"])) {
        if ($_GET["update"] == "success") {
            echo '<div style = "margin-top:40px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Update Success</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

        }
    } ?>
    <ul class="nav nav-tabs" id="groupTab" role="tablist">
        <?php
        // Create an empty array called "new-array"
        $new_array = array();
        $usersView = new UsersView();
        $user = $usersView->selectTheOneProf($gtaemail);
        $semesterView = new SemesterView();
        $sem = $semesterView->currentSemester();
        $semesterid = $sem[0]['semesterid'];
        $groupTableView = new GroupTableView();
        $query = $groupTableView->selectgtaGroups($user['userid'], $semesterid);

        //Inilize count variable to 1
        $count = 1;
        if ($query != null) {
            foreach ($query as $key => $value) {
                $new_array[$key] = $value;
                // If group name is not null , display a button as a list item with class "nav-item" and "presentation"
                if ($value['groupName'] != null) { ?>
                    <li class="nav-item" role="presentation">
                        <!-- Set button text equal to group name -->
                        <button style="color: black;" class="nav-link <?php if ($count == 1) {
                            echo "active";
                        } ?>" id="<?php echo $value['groupid']; ?>-tab" data-bs-toggle="tab"
                            data-bs-target="#<?php echo $value['groupid']; ?>" type="button" role="tab"
                            aria-controls="<?php echo $value['groupid']; ?>" aria-selected="true">
                            <?php echo $value['groupName']; ?>
                        </button>
                    </li>
                    <?php
                }
                $count++;
            }
        } ?>
    </ul>
    <!-- Displays the Group the in the tabs -->
    <div class="tab-content" id="groupTabContent">
        <?php
        $countTab = 1;
        $groupCount = array();
        foreach ($new_array as $key => $value) {
            if (isset($value['groupid'])) {
                $groupCount[$value['groupid']] = 0;
            }
            ?>
            <div class="tab-pane fade show <?php if ($countTab == 1) {
                echo "active";
            } ?>" id="<?php echo $value['groupid']; ?>" role="tabpanel"
                aria-labelledby="<?php echo $value['groupid']; ?>-tab" tabindex="0">
                <?php /* add 1 to count variable */$countTab++; ?>
                <ul class="nav nav-tabs" id="studentTab" role="tablist">
                    <?php
                    $arrayforstudents = array();
                    $groupTableView = new GroupTableView();
                    //Pass the semesterid into the getSecinSem method 
                    $query2 = $groupTableView->getgtaGroup($value['groupid']);
                    $countTab2 = 1;
                    // Loop through each group and add it to the $arrayforsetions variable
                    if ($query2 != null) {
                        foreach ($query2 as $key => $value1) {
                            $arrayforstudents[$key] = $value1;
                            // If group name is not null, display a button as a list item with class "nav-item" and "presentation"
                            if ($value1['name'] != null) { ?>
                                <li class="nav-item" role="presentation">
                                    <!-- Set button text equal to group name -->
                                    <!-- id is set to the group id, data-bs-target sets id of tab panel to controls  -->
                                    <button style="color: black;" class="nav-link "
                                        onclick="updateForm('group<?php echo $value['groupid'] ?>student<?php echo $value1['studentid']; ?>-tab-pane')"
                                        id="group<?php echo $value['groupid'] ?>student<?php echo $value1['studentid']; ?>-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#group<?php echo $value['groupid'] ?>student<?php echo $value1['studentid']; ?>-tab-pane"
                                        type="button" role="tab"
                                        aria-controls="group<?php echo $value['groupid'] ?>student<?php echo $value1['studentid']; ?>-tab-pane"
                                        aria-selected="false">
                                        <?php echo $value1['name']; ?>
                                    </button>
                                </li>
                            <?php }
                            $countTab2++;
                        }
                    } ?>
                </ul>
                <!-- div for content inside of group tabs -->
                <div class="tab-content" id="studentTabContent">
                    <?php
                    $countTab2 = 1;
                    $cntMyTab = 0;
                    $newStudent = array();
                    foreach ($arrayforstudents as $key => $value1) {
                        if (isset($value1['studentid'])) {
                            $newStudent[$value1['studentid']] = 0;
                        }
                        $cntMyTab++; ?>
                        <div class="tab-pane fade"
                            id="group<?php echo $value['groupid'] ?>student<?php echo $value1['studentid']; ?>-tab-pane"
                            role="tabpanel"
                            aria-labelledby="group<?php echo $value['groupid'] ?>student<?php echo $value1['studentid']; ?>-tab"
                            tabindex="0">
                            <?php
                            $countTab2++; ?>
                            <button id="updateBTN" type="submit"
                                form="addgroupgroup<?php echo $value1['groupid']; ?>student<?php echo $value1['studentid']; ?>"
                                name="midtermGrade" class="btn updatebtn"> Submit Grade</button>
                            <br><br>
                            <form class="midtermForm" action="addAssignmentGrade.php"
                                id="addgroupgroup<?php echo $value1['groupid']; ?>student<?php echo $value1['studentid']; ?>"
                                method="POST">
                                <table>
                                    <!-- Grading for the midterm -->
                                    <thead>
                                        <tr>
                                            <th style="display:none">Group</th>
                                            <th>Midterm Grade</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Displays the groups -->
                                        <tr>
                                            <td style="display:none;">
                                                <input type="hidden" name="groupid" id="groupid" value=<?php echo $value1['groupid']; ?>>
                                                <input type="hidden" name="assignmentType" id="assignmentType" value="Midterm">
                                                <input type="hidden" name="givenByUser" id="givenByUser"
                                                    value="<?php echo $user['userid']; ?>">
                                                <input type="hidden" name="studentid" id="studentid"
                                                    value="<?php echo $value1['studentid']; ?>">
                                            </td>
                                            <!-- Drop down menu for the midterm -->
                                            <td><select name="<?php echo $value1['studentid']; ?>grade"
                                                    id="<?php echo $value1['studentid']; ?>gradegroup<?php echo $value['groupid'] ?>student<?php echo $value1['studentid']; ?>-tab-pane">
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
                                                <!-- Text area for the midterm grade -->
                                            <td><textarea class="textarea resize-ta" role="textbox"
                                                    id="<?php echo $value1['studentid']; ?>notesgroup<?php echo $value['groupid'] ?>student<?php echo $value1['studentid']; ?>-tab-pane"
                                                    name="<?php echo $value1['studentid']; ?>notes" value=""
                                                    contenteditable></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <br>
                            <!-- Pricing section for the past grades -->
                            <section class="pricing-section">
                                <div class="container">
                                    <div class="row justify-content-around">
                                        <div class="col-xl-5 col-lg-6 col-md-8">
                                            <div class="section-title text-center title-ex1">
                                                <h2>Past Grades for
                                                    <!-- Displays the name of the student which is being graded -->
                                                    <?php echo $value1['name']; ?>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Pricing Table starts -->
                                    <div class="row" style="display:flex; justify-content: space-around;">
                                        <?php
                                        $gradesView = new GradesView();
                                        $studentsGrade = $gradesView->getGradesbyGroup($value1['studentid'], $value['groupid'], $userinfo[0]['userid']);
                                        if ($studentsGrade != NULL) {
                                            foreach ($studentsGrade as $key => $value) {
                                                if ($value['assignment'] == "Development Plan" || $value['assignment'] == "Software Requirement Specification" || $value['assignment'] == "Design Plan" || $value['assignment'] == "Test Plan") { ?>
                                                    <div class="col-md-6" style="margin-top:10px;">
                                                        <div class="price-card">
                                                            <h2>
                                                                <!-- Displays the assignment which is being graded -->
                                                                <?php echo $value['assignment'] ?>
                                                            </h2>
                                                            <p>
                                                                <!-- Displays the group notes for the assignment -->
                                                                <?php echo $value['groupNotes'] ?>
                                                            </p>
                                                            <!-- Displays the grade for the document in the pricing card section -->
                                                            <p class="price"><span>
                                                                    <?php echo $value['documentGrade'] ?>
                                                                </span></p>
                                                            <table class="pricing-offers">
                                                                <tr>
                                                                    <th>Consistency</th>
                                                                    <th>Consistency Notes</th>
                                                                </tr>
                                                                <tr>
                                                                      <!-- Displays the Consistency grade in the pricing card section -->
                                                                    <td>
                                                                        <?php echo $value['consistency'] ?>
                                                                    </td>
                                                                      <!-- Displays the Consistency notes in the pricing card section -->
                                                                    <td>
                                                                        <?php echo $value['consistencyNotes'] ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <!-- Display the Title of grammar and grammar notes in the price card section -->
                                                                    <th>Grammar</th>
                                                                    <th>Grammar Notes</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                          <!-- Displays the Grammar grade in the pricing card section -->
                                                                        <?php echo $value['grammar'] ?>
                                                                    </td>
                                                                    <td>
                                                                          <!-- Displays the Grammar notes in the pricing card section -->
                                                                        <?php echo $value['grammarNotes'] ?>
                                                                    </td>
                                                                </tr>
                                                                  <!-- Displays the title in the pricing card section -->
                                                                <tr>
                                                                    <th>Topics and Correctness</th>
                                                                    <th>Topics notes</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                          <!-- Displays the Topic correctness in the pricing card section -->
                                                                        <?php echo $value['topicsCorrectness'] ?>
                                                                    </td>
                                                                    <td>
                                                                          <!-- Displays the Topic correctness notes in the pricing card section -->
                                                                        <?php echo $value['topicsNotes'] ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                      <!-- Displays title of resubmitted in the pricing card section -->
                                                                    <th>Resubmitted?</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                          <!-- Displays if the group resubmitted the document in the pricing card section -->
                                                                        <?php echo $value['resubmitDocument'] ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                      <!-- Displays title in the pricing card section -->
                                                                    <th>Individual Grade</th>
                                                                    <th>Individual Notes</th>
                                                                </tr>
                                                                <tr>
                                                                      <!-- Displays the presentation grade in the pricing card section -->
                                                                    <td>
                                                                        <?php echo $value['presentationGrade'] ?>
                                                                    </td>
                                                                    <td>
                                                                          <!-- Displays the notes in the pricing card section -->
                                                                        <?php echo $value['notes'] ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- Same code from above but for prototype while above was for the document -->
                                                <?php } else if ($value['assignment'] == "Prototype 1" || $value['assignment'] == "Prototype 2" || $value['assignment'] == "Prototype 3" || $value['assignment'] == "Final Presentation") {
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
                        <?php
                    } ?>
                </div>
            </div>
        <?php } ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
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
            console.log(z);
            var student = divid.querySelector("#studentid");
            var thestudentid = student.value;
            console.log(thestudentid);
            $.ajax({
                url: "midtermreport.php",    //the page containing php script
                type: "post",    //request type,
                data: { groupid: val, assignmentType: val1, givenByUser: val2, studentid: thestudentid },
                success: function (response) {
                    console.log(response);
                    var obj = JSON.parse(response);
                    console.log(obj);
                    var studentid = obj
                    var objLength = obj.length;

                    var presentationGrade = obj[0].presentationGrade;
                    var notes = obj[0].notes;
                    var studentid = obj[0].studentid;
                    console.log("studentid " + studentid);
                    $('#' + studentid + 'grade' + tabid + ' option[value="' + presentationGrade + '"]').attr("selected", "selected");
                    $('#' + studentid + 'notes' + tabid).val(notes);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    </script>
</body>

</html>