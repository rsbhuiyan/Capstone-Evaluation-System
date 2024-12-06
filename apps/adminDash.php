<?php
session_start(); //Start a new or resume a session
include 'includes/class.autoload.inc.php'; //Include file that will automatically load
$util = new Apputil(); //Instantiate a new Apputil object
$util->checkLogin(__FILE__); //Call the checkLogin method of the Apputil object, passing the name of the current file as an argument
$adminEmail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" style="text/css" href="styles/adminDash.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
    <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=8f7cff5ee7757412879aedf3efbfaee01">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <style type="text/css" class="init">
     
body {
  margin: 0;
  padding: 0;
  font-family: 'Roboto', sans-serif;
  /* color optimization */
  background-color: var(--background-color);
  line-height: 1.6;
  /* Increase line-height for better readability */
  line-height: 1.6;
  font-size: 18px;
margin-top: 20px;
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
      .semestername{
        margin-top:30px;
        margin-bottom: -200px;
      }
      .tab-content {
  margin: 5px;
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
       
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
      }
    }
    
    </style>
    <script type="text/javascript" src="/media/js/site.js?_=1d5abd169416a09a2b389885211721dd"
        data-domain="datatables.net" data-api="https://plausible.sprymedia.co.uk/api/event"></script>
    <script src="https://media.ethicalads.io/media/client/ethicalads.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    <!-- Navigation bar at the top of page with a fixed postion -->
    <nav class="navbar fixed-top" style="background-color:#008C81">
        <div class="container-fluid">
            <button style = "color: #F3F7FC;" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h3 class = "capTitle"><a class = "titleLabel"style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;"
                    href="chooseSemester.php">Capstone
                    Course Evaluation System</a></h3>
            <img class = "wsuimg"style="width:40px; height:40px;display: inline-block;" src="images/wsulogo.svg.png"
                alt="Wayne State University Logo">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h4 style="color:#008C81; text-shadow: .7px .7px #000000;" class="offcanvas-title" id="offcanvasNavbarLabel">
                        Capstone Course Evaluation System</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php
                    $usersView = new UsersView();
                    $userinfo = $usersView->allUserInfo($adminEmail);
                    ?>
                    <h5>Hello
                        <?php echo $userinfo[0]['firstname']; ?>! | Role:
                        <?php echo ucfirst($userinfo[0]['roleofuser']); ?>
                    </h5>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active " aria-current="page" href="chooseSemester.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adminDashAddSemester.php">Add Semester/Section</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="adminDashAddProfessors.php">Add Professor</a>
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
    <?php
    if (isset($_GET["id"])) {
        $semesterid = $_GET["id"];
    }
    $semesterView = new SemesterView();
    $semesterName = $semesterView->getSemesterbyId($semesterid);

    ?>
    <button style=" margin-top:8%; margin-left:15px; width:5%; text-decoration: none; color: black;" class="btn"><a
            style="color:black;text-decoration: none;" href="chooseSemester.php"> Back </a></button>
    <center>
        <h1 class = "semestername" style="margin-bottom:-4%;font-size:3em; font-weight:bolder">
            <?php echo $semesterName['semester_name']; ?>
        </h1>
    </center>
    <ul class="nav nav-tabs" id="sectionTab" role="tablist">
        <?php
        $arrayforsections = array();
        $sectionView = new SectionView();
        //Pass the semesterid into the getSecinSem method 
        $query2 = $sectionView->getSecinSem($semesterid);
        $countTab2 = 1;
        // Loop through each group and add it to the $arrayforsetions variable
        if ($query2 != null) {
            foreach ($query2 as $key => $value1) {
                $arrayforsections[$key] = $value1;
                // If section name is not null, display a button as a list item with class "nav-item" and "presentation"
                if ($value1['section_name'] != null) { ?>
                              <li class="nav-item" role="presentation">
                                <!-- Set button text equal to section name -->
                                <!-- id is set to the section id, data-bs-target sets id of tab panel to controls  -->
                                    <button style="color: black;" class="nav-link <?php if ($countTab2 == 1) {
                                        echo "active";
                                    } ?> " id="section<?php echo $value1['sectionid']; ?>-tab" data-bs-toggle="tab"
                                    data-bs-target="#section<?php echo $value1['sectionid']; ?>" type="button" role="tab"
                                    aria-controls="section<?php echo $value1['sectionid']; ?>" aria-selected="true">
                                        <?php echo $value1['section_name']; ?>
                                    </button>
                                </li>
                        <?php }
                $countTab2++;
            }
        } ?>
    </ul>
    <div class="tab-content" id="sectionTabContent">
        <?php
        $countTab2 = 1;
        $cntMyTab = 0;
        $newSection = array();
        foreach ($arrayforsections as $key => $value1) {
            if (isset($value1['sectionid'])) {
                $newSection[$value1['sectionid']] = 0;
            }
            $cntMyTab++; ?>
            <div class="tab-pane fade  show <?php if ($countTab2 == 1) {
                echo "active";
            } ?>" id="section<?php echo $value1['sectionid']; ?>" role="tabpanel"
                aria-labelledby="section<?php echo $value1['sectionid']; ?>-tab" tabindex="0"><?php
                   $countTab2++; ?>
                <ul class="nav nav-tabs" id="assignmentTab" role="tablist">
                    <?php
                    $groupTableView = new GroupTableView();
                    $arrayforgroups = array();
                    // Get the groups for the current section
                    $groups = $groupTableView->groupinSec($value1['sectionid']);
                    $countTab3 = 1;
                    $cntLiTags = 0;
                    if ($groups != null) {
                        foreach ($groups as $key => $value3) {
                            $arrayforgroups[$key] = $value3;
                            //If group name is not null, display a button as a list item with class "nav-item" and "presentation"
                            if ($value3['groupName'] != null) { ?>
                                <li class="nav-item" role="presentation">
                                    <!-- Set button text equal to section name -->
                                    <!-- id is set to the group id, data-bs-target sets id of tab panel to controls  -->
                                    <button style="color: black;" class="nav-link <?php if ($countTab3 == 1) {
                                        echo "active";
                                    } ?> " id="group<?php echo $value3['groupid']; ?>-tab" data-bs-toggle="tab"
                                        data-bs-target="#group<?php echo $value3['groupid']; ?>" type="button" role="tab"
                                        aria-controls="group<?php echo $value3['groupid']; ?>" aria-selected="true">
                                        <?php echo $value3['groupName']; ?>
                                    </button>
                                </li>
                            <?php }
                            $countTab3++;
                        }
                    } ?>
                </ul>
                <div class="tab-content" id="groupTabContent">
                    <?php
                    $countTab3 = 1;
                    $newGroup = array();
                    foreach ($arrayforgroups as $key => $value3) {
                        if (isset($value3['groupid'])) {
                            $newGroup[$value3['groupid']] = 0;
                        }
                        $cntMyTab++;
                        ?>
                        <div class="tab-pane fade  show <?php if ($countTab3 == 1) {
                            echo "active";
                        } ?>" id="group<?php echo $value3['groupid']; ?>" role="tabpanel"
                            aria-labelledby="group<?php echo $value3['groupid']; ?>-tab" tabindex="0">
                            <?php $countTab3++ ?>
                            <br>
                            <center>
                                <h1 style="font-size:3em;">
                                    <?php echo $value3['groupName'] ?>
                                </h1>
                            </center>
                            <?php
                            $usersView = new UsersView();
                            $profInfo = $usersView->selectProfFromSec($value1['section_name']);
                            $gtaAssignmentView = new GtaAssignmentView();
                            $gta = $gtaAssignmentView->getGTAbyGroup($value3['groupid']);
                           
                            $studentsView = new StudentsView();
                            $students = $studentsView->studentGroup($value3['groupid']);
                            ?>
                            <center>
                                <div>
                                    <h3 style="display: inline;">Professor:
                                        <?php echo $profInfo[0]['firstname'];
                                        echo " " . $profInfo[0]['lastname']; ?>
                                    </h3>
                                    <?php if ($gta != null) { ?>
                                            <h3 style="margin-left:20%;display: inline;">Assigned GTA:
                                                <?php echo $gta['firstname'] ?>
                                                <?php echo $gta['lastname'] ?>
                                            </h3>
                                    <?php } ?>
                                </div>
                            </center>
				<!-- Start UO list for the navigation tabs -->
				<ul class="nav nav-tabs" id="gradesTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button style="color: black;" class="nav-link active"
							id="group<?php echo $value3['groupid'] ?>weeklyReport-tab" data-bs-toggle="tab"
							data-bs-target="#group<?php echo $value3['groupid'] ?>weeklyReport-tab-pane"
							type="button" role="tab"
							aria-controls="group<?php echo $value3['groupid'] ?>weeklyReport-tab-pane"
							aria-selected="true">Weekly Report</button>
					</li>
					<li class="nav-item" role="presentation">
						<button style="color: black;" class="nav-link"
							id="group<?php echo $value3['groupid'] ?>documents-tab" data-bs-toggle="tab"
							data-bs-target="#group<?php echo $value3['groupid'] ?>documents-tab-pane" type="button"
							role="tab" aria-controls="group<?php echo $value3['groupid'] ?>documents-tab-pane"
							aria-selected="false">Documents</button>
					</li>
					<li class="nav-item" role="presentation">
						<button style="color: black;" class="nav-link"
							id="group<?php echo $value3['groupid'] ?>github-tab" data-bs-toggle="tab"
							data-bs-target="#group<?php echo $value3['groupid'] ?>github-tab-pane" type="button"
							role="tab" aria-controls="group<?php echo $value3['groupid'] ?>github-tab-pane"
							aria-selected="false">Github</button>
					</li>
					<li class="nav-item" role="presentation">
						<button style="color: black;" class="nav-link" class="nav-link" id="group<?php echo $value3['groupid'] ?>midterm-tab" data-bs-toggle="tab"
							data-bs-target="#group<?php echo $value3['groupid'] ?>midterm-tab-pane" type="button" role="tab"
							aria-controls="group<?php echo $value3['groupid'] ?>midterm-tab-pane" aria-selected="false">Midterm</button>
					</li>
					<li class="nav-item" role="presentation">
						<button style="color: black;" class="nav-link" class="nav-link" id="group<?php echo $value3['groupid'] ?>final-tab" data-bs-toggle="tab"
							data-bs-target="#group<?php echo $value3['groupid'] ?>final-tab-pane" type="button" role="tab" aria-controls="final-tab-pane"
							aria-selected="group<?php echo $value3['groupid'] ?>false">Final</button>
					</li>
				</ul>
				<div class="tab-content" id="gradeTabContent">
					<div class="tab-pane fade show active"
						id="group<?php echo $value3['groupid'] ?>weeklyReport-tab-pane" role="tabpanel"
						aria-labelledby="group<?php echo $value3['groupid'] ?>weeklyReport-tab" tabindex="0">
						<!--Weekly Reports heading with the name of the student   -->
						<?php
						if ($students != null) {
                            ?>
                            <div class="weeklyreportSum" id="main">
                                <center>
                                <br>
                                    <h2 class="weeklyreportsTitle">Weekly Reports for
                                        <h1 class="weeklyreportstuname">
                                            <?php echo $value3['groupName']; ?>
                                        </h1>
                                    </h2>
                                </center>
                                <!-- Can scroll horizontally on a small screen -->
                                <div class="table-responsive ">
                                <table id="groupstudentreports" class="table">
                                <thead>
                                <tr class="headRowSum">
                                    <th>Date Submitted</th>
                                    <th>Week</th>
                                    <th>Evaluation</th>
                                </tr>
                                </thead>
                                <!-- Create header row for the table headers -->
                                <tbody>
                                <?php
                                $weeklyReportsView = new WeeklyReportsView();
                                // Calls the getAllWeeklyReportData method, pass $studentid, assign $query_run
                                $groupWeeks = $weeklyReportsView->getAllWeeklyReportData($students[0]['studentid']);
                               
                                if ($groupWeeks) {
                                    // loops through each element in $query_run and assigns to $row
                                    foreach ($groupWeeks as $row) {
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
                        </div>
						<?php foreach ($students as $key => $stuval) { ?>
								<br><br>
                                            <div class="weeklyreportSum" id="main">
                                                <center>
                                                <br>
                                                    <h2 class="weeklyreportsTitle">Weekly Reports for
                                                        <h1 class="weeklyreportstuname">
                                                            <?php echo $stuval['name']; ?>
                                                        </h1>
                                                    </h2>
                                                </center>
                                                <!-- Can scroll horizontally on a small screen -->
                                                <div class="table-responsive ">
                                                <!-- Table headers to display student data -->
                                                <table id="individualstudentreports<?php echo $stuval['studentid']; ?>" class="table">
                                                    <thead>
                                                        <tr class="headRowSum">
                                                            <th>Week</th>
                                                            <th>Date Submitted</th>
                                                            <th>Submitted</th>
                                                            <th>Status</th>
                                                            <th>Evaluation</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <!-- OPening PHP Tag -->
                                                    <?php
                                                    // Create new object of the weeklyreportsview 
                                                    $weeklyReportsView = new WeeklyReportsView();
                                                    // Calls the getAllWeeklyReportData method, pass $studentid, assign $query_run
                                                    $query_run = $weeklyReportsView->getAllWeeklyReportData($stuval['studentid']);
                                                    if ($query_run) {
                                                        // loops through each element in $query_run and assigns to $row
                                                        foreach ($query_run as $row) { 
                                                            if ($row['studentid'] != -1) {
                                                            ?>
                                                        <!-- Start table row -->
                                                            <tr>
                                                           <!-- Creates table cell that displays the week -->
                                                                <td>
                                                                    <?php echo $row['week']; ?>
                                                                </td>
                                                                <!-- Creates table cell that displays the date sumbitted -->
                                                                <td>
                                                                    <?php echo date('Y-m-d', strtotime($row['dateSubmitted'])); ?>
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
                                                                 $('#individualstudentreports<?php echo $stuval['studentid']; ?>').DataTable();
                                                             });
                                                             </script>
                                                        <?php }
                                                    } }?>
                                                    </tbody>
                                                </table>
									</div>
								</div><?php
                                        }
                                    } ?>
                                </div>
                                <div class="tab-pane fade" id="group<?php echo $value3['groupid'] ?>documents-tab-pane"
                                    role="tabpanel" aria-labelledby="group<?php echo $value3['groupid'] ?>documents-tab"
                                    tabindex="0">
                                    <center>
                                        <h1>Document Plans</h1>
                                    </center>
                                    <?php
                                    if ($students != null) {
                                        foreach ($students as $key => $stuval) { ?>
                                            <div class="profGrades" style=" margin-top:30px;" id="main">
                                                <h2>Grades for <?php echo $stuval['name']; ?> </h2>
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
                                                            $studentsGrade = $gradesView->getGradesbyGroup($stuval['studentid'], $value3['groupid'], $profInfo[0]['userid']);
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
                                                                    $studentsGrade = $gradesView->getGradesbyGroup($stuval['studentid'], $value3['groupid'], $gta['userid']);
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
                                                                                    <?php }  else if ($value['assignment'] == "Ethics") { ?>
                                                                                    <div class="col-md-6" style="margin-top:10px;">
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
                                                                </div><?php
                                                            }
                                                        } ?>
                                                    </div>
                                                    <div class="tab-pane fade" id="group<?php echo $value3['groupid'] ?>github-tab-pane"
                                                        role="tabpanel" aria-labelledby="group<?php echo $value3['groupid'] ?>github-tab"
                                                        tabindex="0">
                                                        <center>
                                                            <h1>Prototypes & Github</h1>
                                                        </center>
                                                        
                                                        <?php
                                                        if ($students != null) {
                                                            foreach ($students as $key => $stuval) { ?>
													<br>
                                                    <div class="profGrades" style=" margin-top:30px;" id="main">
                                                                <h2>Grades for <?php echo $stuval['name']; ?></h2>
                                                                <section class="pricing-section">
                                                                    <div class="container">
                                                                        <div class="row justify-content-around">
                                                                            <div class="col-xl-5 col-lg-6 col-md-8">
                                                                                <div class="section-title text-center title-ex1">
                                                                                <h2>Professors Grades</h2>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Pricing Table starts -->
                                                                    <div class="row" style="display:flex; justify-content: space-around;">
                                                                        <?php
                                                                        $gradesView = new GradesView();
                                                                        $studentsGrade = $gradesView->getGradesbyGroup($stuval['studentid'], $value3['groupid'], $profInfo[0]['userid']);
                                                                        
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
                                                                                    </div><?php
                                                                                }
                                                                            }
                                                                        } ?>
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
                                                                        $studentsGrade = $gradesView->getGradesbyGroup($stuval['studentid'], $value3['groupid'], $gta['userid']);
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
                                                            <?php } ?>
                                                    <?php    } ?>
                                                    </div>
                                                    <div class="tab-pane fade" id="group<?php echo $value3['groupid'] ?>midterm-tab-pane"
                                                        role="tabpanel" aria-labelledby="group<?php echo $value3['groupid'] ?>midterm-tab"
                                                        tabindex="0">
                                                        <?php
                                                        if ($students != null) {
                                                            foreach ($students as $key => $stuval) { ?>
                                                                <div class="profGrades" style=" margin-top:30px;" id="main">
                                                                <h2>Midterm Grade for <?php echo $stuval['name']; ?></h2>
                                                                <section class="pricing-section">
                                                                    <div class="container">
                                                                    <div class="row justify-content-around">
                                                                        <div class="col-xl-5 col-lg-6 col-md-8">
                                                                        <div class="section-title text-center title-ex1">
                                                                            <h2>Given by GTA
                                                                            </h2>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Pricing Table starts -->
                                                                    <div class="row" style="display:flex; justify-content: space-around;">
                                                                        <?php
                                                                        $gradesView = new GradesView();
                                                                        $studentsGrade = $gradesView->getGradesbyGroup($stuval['studentid'], $value3['groupid'], $gta['userid']);
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
                                                                                            <?php echo $value['documentGrade'] ?>
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
                                                        <?php }
                                                    } ?>
                                                </div>
                                                <div class="tab-pane fade" id="group<?php echo $value3['groupid'] ?>final-tab-pane"
                                                    role="tabpanel" aria-labelledby="group<?php echo $value3['groupid'] ?>final-tab"
                                                    tabindex="0">
                                                    <?php
                                                    if ($students != null) {
                                                        foreach ($students as $key => $stuval) { ?>
                                                            <div class="profGrades" style=" margin-top:30px;" id="main">
                                                            <h2>Final Grade for <?php echo $stuval['name']; ?></h2>
                                                            <section class="pricing-section">
                                                                <div class="container">
                                                                <div class="row justify-content-around">
                                                                    <div class="col-xl-5 col-lg-6 col-md-8">
                                                                    <div class="section-title text-center title-ex1">
                                                                        <h2>Given by GTA
                                                                        </h2>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Pricing Table starts -->
                                                                <div class="row" style="display:flex; justify-content: space-around;">
                                                                    <?php
                                                                    $gradesView = new GradesView();
                                                                    $studentsGrade = $gradesView->getGradesbyGroup($stuval['studentid'], $value3['groupid'], $gta['userid']);
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
                                                                                        <?php echo $value['documentGrade'] ?>
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
                                                    <?php }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
				</div>
			</div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>