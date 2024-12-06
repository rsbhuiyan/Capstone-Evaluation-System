<?php
session_start();
include 'includes/class.autoload.inc.php';
$util = new Apputil();
$util->checkLogin(__FILE__);
$professorEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>

<head>
	<title>Upload Students</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
	<link rel="stylesheet" style="text/css" href="styles/profDashAddStudents.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<style>

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
		}

  label {
			font-size: 20px;
		}

		.error {
			color: #FF0000;
			font-size: 18px;
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
  width: 30%;
  margin: auto;
  box-sizing: border-box;
  padding: 70px 30px;
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

	.dropdown-toggle {
      margin-left: 750px;
      color:black;
    }
        @media only screen and (max-width: 950px) {
			.ftco-section {
				width: 100%;
				margin-top: 45%;
			}
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
	  h2{
		margin-top:20px;
		margin-bottom:-150px;
	  }
    }
	</style>
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
      <h3 class = "capTitle"><a class = "titleLabel"style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;" href="profDash.php">Capstone
          Course Evaluation System</a></h3>
          <img class = "wsuimg" style="width:40px; height:40px;display: inline-block;"src="images/wsulogo.svg.png" alt="Wayne State University Logo">
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
              <a class="nav-link active" href="profDashAddStudents.php">
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
	<?php
	/////////////////////////////////////////////////////////////////////excel upload//////////////////////////////////////////////////////////////////////////////
	$email = $_SESSION['email'];
	$semester_name = $_SESSION['semester_name'];
	$selectSection = isset($_POST["selectSection"]) ? $_POST["selectSection"] : "";
	$accessIdErr = "";
	$isError = false;
	$successMessage = "";
	$submitError = "";
	$submitMessage = "";
	$selectedError = "";
	$activeStudent = 1;
	$students = array();
	require('library/php-excel-reader/excel_reader2.php');
	require('library/SpreadsheetReader.php');

	if (isset($_POST['Submit'])) {

		//only accepts files from xls, xlms, csv, and ods
		$mimes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		$mimes2 = ['text/csv'];
		$mimes3 = ['application/vnd.oasis.opendocument.spreadsheet'];
		$mimes4 = ['application/vnd.ms-excel'];

		if (in_array($_FILES["file"]["type"], $mimes) || in_array($_FILES["file"]["type"], $mimes2) || in_array($_FILES["file"]["type"], $mimes3) || in_array($_FILES["file"]["type"], $mimes4)) {

			$fall2020 = 'fall2020';
			$uploadFilePath = 'uploads/' . $fall2020 . '/' . basename($_FILES['file']['name']);
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);

			$Reader = new SpreadsheetReader($uploadFilePath);
			$totalSheet = count($Reader->sheets());
			$Reader->ChangeSheet(0);

			$count = 0;
			foreach ($Reader as $Row) {

				$count++;
				$accessid = isset($Row[0]) ? $Row[0] : '';
				$name = isset($Row[1]) ? $Row[1] : '';

				if ($count == 1)
					continue; //  skips titles from excel file while inserting
				if (!preg_match("/^[a-zA-Z]{2}+[0-9]{4}$/", $accessid)) {
					$isError = true;
					echo "<br /> * " . $accessid . " is not a valid access id.<br>";
					$accessIdErr = "Non Valid Access ID added. Please Reupload";
					continue;
				}
				$server = 'mysql:dbname=ccesdb;host=127.0.0.1';
				$database = 'ccesdb';
				$username = 'john';
				$password = 'pass1234';

				$pdo = new PDO($server, $username, $password);

				// Check connection
				if ($pdo === false) {
					die("ERROR: Could not connect. ");
				}
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$studentObj = new StudentsView();
				$nRows = $studentObj->userAccessid($accessid);

				if (!$nRows) {
					//Input Data into mysql
					$studentController = new StudentsContr();
					$studentController->insertUserStudent("$accessid", "$name", "$selectSection", "$activeStudent");
					$students[] = $accessid;
				} else {
					echo "<br /> * " . $accessid . " is already entered as a student <br>";
					$accessIdErr = "Cannot add existing students in section";
					continue;
				}
			}
			if ($isError) {
				$accessIdErr = "* Invalid Access ID contained in file. Please reupload file";
				//removes students inserted into table if one of the other students in excel file was inputted wrong
				foreach ($students as $student) {
					$sql = "DELETE FROM students WHERE accessID = '$student'";
					$pdo->exec($sql);
				}
				unset($students);
			} else {
				$successMessage = "* Data Inserted in database";
				echo '<div style = "margin-top: 90px;width:30%;margin-bottom:-20px; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Students are now in the system!</strong> 
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  </div>';
			}
		} else {
			$submitError = "<br />Not a XLSX, XLS, CSV, or ODS file";

		}

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	?>
	<br><br><br>
	<h2 style="margin-left:10px;">
		<?php echo $semester_name ?>
	</h2>
	<div class="container">
		<div class="row">
			<div class="ftco-section">
				<div class="col">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
						enctype="multipart/form-data">
						<span style = "color:88D7C0;">
							<?php echo $successMessage; ?>
						</span>
						<div class="d-flex">
							<div class="w-100">
								<h3 class="mb-1">Upload Students</h3>
								<div class="form-group">
									<label>Upload Spreadsheet File (.CSV, .ODS, .XLS, .XLSX)</label>
									<input type="file" name="file" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group mt-4">
							<input type="hidden" name="action" value="other">
							<label class="form-control-placeholder" for="professor">Section</label>
							<select name="selectSection">
								<?php
								$usersView = new UsersView();
								$user = $usersView->selectTheOneProf($email);
								$userid = $user['userid'];
								$semesterView = new SemesterView();
  								$sem = $semesterView->currentSemester();
 								$semesterid = $sem[0]['semesterid'];
								$sectionView = new SectionView();
								$result = $sectionView->selectSecinSem($userid, $semesterid);
								for ($m = 0; $m < count($result); $m++) { ?>
									<?php echo $result[$m]['sectionid'] ?>
									<option value="<?php echo $result[$m]['sectionid'] ?>"><?php echo $result[$m]['section_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group mt-3">

							<button type="submit" name="Submit"

								class="form-control btn btn-block mb-4 rounded">Upload</button>
							<span class="error">
								<?php echo $accessIdErr; ?>
							</span>
							<span class="error">
								<?php echo $selectedError; ?>
							</span>
						</div>
				</div>

				</form>
				<p class = "error">
					<?php echo $submitError ?>
				</p>
			</div>
		</div>
	</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
		crossorigin="anonymous"></script>








	<?php
	$email = $_SESSION['email'];
	//grab current semester
	$semesterView = new SemesterView();
	$sem = $semesterView->currentSemester();
	$semester_name = $sem[0]['semester_name'];
	$_SESSION['semester_name'] = $semester_name;
	$studentAddedMessage = "";
	$studentRemoveMessage = "";

	?>
	<?php


	if (isset($_POST['deleteStudent'])) {
		$students = $_POST['selectStudents'];


		foreach ($students as $student) {
			$studentController = new StudentsContr();
			$studentController->deleteStudent("$student");
			$studentRemoveMessage = "Student(s) removed!";
		}

	}

	if (isset($_POST['reAddStudent'])) {
		$inactiveStudents = $_POST['selectInactiveStudents'];


		foreach ($inactiveStudents as $inactiveStudent) {
			$studentController = new StudentsContr();
			$studentController->reAddStudent("$inactiveStudent");
			$studentAddedMessage = "Student(s) is back in the course!";
		}

	}
	?>
	<br>
	<h2 style="text-align: center;">
		<?php echo "View Students" ?>
	</h2>

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<?php

		$new_array = array();
		$usersView = new UsersView();
		$user = $usersView->selectTheOneProf($email);
		$sectionView = new SectionView();
		$stmt = $sectionView->selectSecinSem($user['userid'], $sem[0]['semesterid']);
		// $stmt = $pdo->query("SELECT sectionid, section_name FROM section where professor = '".$user['userid']. "' AND semesterid = ". $sem[0]['semesterid']);
		$count = 1;
		if ($stmt != null) {
			foreach ($stmt as $key => $value) {
				$new_array[$key] = $value;
				if ($value['section_name'] != null) { ?>
					<li class="nav-item" role="presentation">
						<button style="color: black;" class="nav-link <?php if ($count == 1) {
							echo "active";
						} ?>"
							id="<?php echo $value['sectionid']; ?>-tab" data-bs-toggle="tab"
							data-bs-target="#<?php echo $value['sectionid']; ?>" type="button" role="tab"
							aria-controls="home-tab-pane" aria-selected="true"><?php echo $value['section_name']; ?></button>
					</li>
				<?php

				}
				$count++;
			}
		} ?>
	</ul>
	<div class="tab-content" id="myTabContent">
		<?php
		$count = 1;
		foreach ($new_array as $key => $value) {
			?>
			<div class="tab-pane fade show <?php if ($count == 1) {
				echo "active";
			} ?>" id="<?php echo $value['sectionid']; ?>"
				role="tabpanel" aria-labelledby="<?php echo $value['sectionid']; ?>-tab" tabindex="0">
				<div class="container " style="margin-top:5%;">
					<div class="row">
						<div class="ftco-section">
							<div class="col">
								<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="studentGroupForm"
									method="POST">
									<div class="d-flex">
										<div class="w-100">
											<h3 class="mb-1">Unassigned Active Students</h3>
										</div>
									</div>
									<div style="color: black;" class="card mt-5">
										<div style="color: black;" class="card-body">
											<div class="form-group mb-3">
												<label for="">Students</label>
												<?php
												$section = $value['sectionid']; // Replace with the correct section ID
												$studentView = new StudentsView();
												$students = $studentView->selectStudentsNoGroup($section);
												$value = ['sectionid' => $section]; // Define $value with the correct section data
												?>
												<div class="checkbox-group">
													<?php
													if (is_array($students) && count($students) > 0) {
														foreach ($students as $student) { ?>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="selectStudents[]"
																		value="<?php echo $student['studentid'] ?>">
																	<?php echo $student['first_name'] . " " . $student['last_name'] ?>
																</label>
															</div>
														<?php } ?>
													<?php } else { ?>
														<p>No available students.</p>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group mt-4">
										<button style="background:#FCD0CF; color: black;" type="submit" name="deleteStudent"
											class="btn btn-primary">Delete Student(s)</button>
										<span>
											<?php echo $studentRemoveMessage; ?>
										</span>
									</div>
								</form>
							</div>
						</div>

						<div class="ftco-section">
							<div class="col">
								<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="studentGroupForm"
									method="POST">
									<div class="d-flex">
										<div class="w-100">
											<h3 class="mb-1">Inactive Students</h3>
										</div>
									</div>

									<div style=" color: black;" class="card mt-5">
										<div style="color: black;" class="card-body">
											<div class="form-group mb-3">
												<label for="">Students</label>
												<?php
												$section = $value['sectionid']; // Replace with the correct section ID
												$studentView = new StudentsView();
												$students = $studentView->selectStudentsNoGroup($section);
												$value = ['sectionid' => $section]; // Define $value with the correct section data
											

												$section = $value['sectionid']; // Replace with the correct section ID
												$studentView = new StudentsView();
												$inactiveStudents = $studentView->selectInactiveStudents($section);
												$value = ['sectionid' => $section]; // Define $value with the correct section data
												?>
												<div class="checkbox-group">
													<?php
													if (is_array($inactiveStudents) && count($inactiveStudents) > 0) {
														foreach ($inactiveStudents as $inactiveStudent) { ?>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="selectInactiveStudents[]"
																		value="<?php echo $inactiveStudent['studentid'] ?>">
																	<?php echo $inactiveStudent['first_name'] . " " . $inactiveStudent['last_name'] ?>
																</label>
															</div>
														<?php } ?>
													<?php } else { ?>
														<p>No inactive students in section.</p>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group mt-4">
										<button style = "color:black;" type="submit" name="reAddStudent"
											class="btn btn-primary">Re-Add Student(s)</button>
										<span>
											<?php echo $studentAddedMessage; ?>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$count++;
		}
		?>

	</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
		crossorigin="anonymous"></script>

</body>

</html>