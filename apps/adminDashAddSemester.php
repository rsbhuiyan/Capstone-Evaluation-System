<?php
session_start();
include 'includes/class.autoload.inc.php';
$util = new Apputil();
$util->checkLogin(__FILE__);
$adminEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Add Semester Form</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="stylesheet" style="text/css" href="styles/adminDashAddSemester.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <style>
    body {
      margin: 0;
      height: 100%;
      background-color: var(--background-color);
      font-family: 'Roboto', sans-serif;
      /* color optimization */
      line-height: 1.6;
      /* Increase line-height for better readability */
      font-size: 18px;
    }

    /* adding a hove and style to buttons */
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

    .ftco-section {
      background-color: var(--section-bg-color);
      width: 30%;
      margin: auto;
      color: var(--input-text-color);
      box-sizing: border-box;
      padding: 70px 30px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0, 0, 0, .05), 2px 2px 5px rgba(0, 0, 0, .1);
      /* Added border-radius for a softer look */
    }
    
@media only screen and (max-width: 950px) {
  .ftco-section {
    width: 90%;
    margin-top: 30%;
    margin-left: auto;
    margin-right: auto;

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
}
  </style>
</head>

<body>
  <nav class="navbar fixed-top navbar-static-top" style="background-color:#008C81">
    <div class="container-fluid">
      <button style="color:#F3F7FC;" class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h3 class="capTitle"><a class="titleLabel"
          style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;" href="adminDash.php">Capstone
          Course Evaluation System</a></h3>
      <img class="wsuimg" style="width:40px; height:40px;" src="images/wsulogo.svg.png"
        alt="Wayne State University Logo">
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h4 style="color:#008C81; text-shadow: .7px .7px #000000;" class="offcanvas-title" id="offcanvasNavbarLabel">
            Capstone Course Evaluation System</h4>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- Nav Bar-->
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
              <a class="nav-link " aria-current="page" href="chooseSemester.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="adminDashAddSemester.php">Add Semester/Section</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="adminDashAddProfessors.php">Add Professor</a>
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
  $action = isset($_POST['action']) ? $_POST['action'] : null;
  $semester_name = isset($_POST["semester_name"]) ? $_POST["semester_name"] : "";
  $startDate = isset($_POST["startDate"]) ? $_POST["startDate"] : "";
  $endDate = isset($_POST["endDate"]) ? $_POST["endDate"] : "";
  $section_name = isset($_POST["section_name"]) ? $_POST["section_name"] : "";
  $selectSemester = isset($_POST["selectSemester"]) ? $_POST["selectSemester"] : "";
  $selectProf = isset($_POST["selectProf"]) ? $_POST["selectProf"] : "";
  $startDateErr = $endDateErr = $semErr = $sectionNameErr = $selectedError = "";
  $isError = false;
  switch ($action) {
    case 'semForm':
      if (empty($_POST["semester_name"])) {
        $semErr = "* Semester Name is required";
        $isError = true;
      } else {
        $semester_name = ucfirst($_REQUEST['semester_name']);
        if (!preg_match("/^Fall\d{4}|Winter\d{4}|Summer\d{4}$/", $semester_name)) {
          $semErr = "* Semester Name is not in the correct format. Please list the semester (Fall/Winter/Summer) followed immediately by the year(2023). Case and space sensitive.";
          $isError = true;
          $semester_name = "";
        } else {
          $semesterview = new SemesterView;
          $semesterExists = $semesterview->checkSemesterExists($semester_name);
          if ($semesterExists != null) {
            $semErr = "* Sorry! That semester already exists";
            $isError = true;
            $semester_name = "";
          }
        }
      }
      if (empty($_POST["startDate"])) {
        $startDateErr = "* Start Date is required";
        $isError = true;
      } else {
        $startDate = $_REQUEST['startDate'];
        if(!preg_match("~(0[1-9]|1[012])[-/](0[1-9]|[12][0-9]|3[01])[-/](19|20)\d\d~", $startDate)){
          $startDateErr = "* Date in not proper format please enter in mm/dd/yyyy";
          $isError = true;
          $startDate = "";
        }
      }
      if (empty($_POST["endDate"])) {
        $endDateErr = "* End Date is required";
        $isError = true;
      } else {
        $endDate = $_REQUEST['endDate'];
        if(!preg_match("~(0[1-9]|1[012])[-/](0[1-9]|[12][0-9]|3[01])[-/](19|20)\d\d~", $endDate)){
          $endDateErr = "* Date in not proper format please enter in mm/dd/yyyy";
          $isError = true;
          $endDate = "";
        }
      }
      if (!$isError) {
        $semesterController = new SemesterContr();
        if ($semesterController->insertSemester("$semester_name", "$startDate", "$endDate")) {
          echo '<div style = "margin-top: 80px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Semester added succesfully!</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
          $semester_name = "";
          $startDate = "";
          $endDate = "";
        }
      }
      //$pdo=null;
      break;
    case 'other':
      if (empty($_POST["section_name"])) {
        $sectionNameErr = "* Section Name is required";
        $isError = true;
      } else {
        $section_name = ucfirst($_REQUEST['section_name']);
        if (!preg_match("/^Section\d{3}$/", $section_name)) {
          $sectionNameErr = "* Section Name is not in the correct format. Please type 'Section' followed immediately by the section numer (001). Case and space sensitive.";
          $isError = true;
          $section_name = "";
        } else {
          $selectSemester = $_POST['selectSemester'];
          $sectionview = new SectionView;
          $sectionExists = $sectionview->checkSectionExists($section_name, $selectSemester);
          if ($sectionExists != null) {
            $sectionNameErr = "* Sorry! That section already exists.";
            $isError = true;
            $section_name = "";
          }
        }
      }
      if (!$isError) {
        if (!empty($_POST['selectSemester']) && !empty($_POST['selectProf'])) {
          $selectSemester = $_POST['selectSemester'];
          $selectProf = $_POST['selectProf'];
          $sectionController = new SectionContr();
          if ($sectionController->insertSection($section_name, $selectSemester, $selectProf)) {
            echo '<div style = "margin-top: 80px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Section added succesfully!</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            $section_name = "";
            $selectProf = "";
            $selectSemester = "";
          }
        } else {
          $selectedError = "You must select both semester and professor to pick a section";
        }
      }
      break;
  } ?>
  <!-- Add a Semester Container -->
  <div class="container " style="margin-top:10%;">
    <div class="row">
      <div class="ftco-section rounded">
        <div class="col">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="emailForm" method="POST">
            <div class="d-flex">
              <div class="w-100">
                <h3 class="mb-1 title">Add A Semester</h3>
              </div>
            </div>
            <div class="form-group mt-3">
              <label class="form-control-placeholder" for="semester_name">Semester Name</label>
              <input type="hidden" name="action" value="semForm">
              <input type="text" class="form-control" name="semester_name" value="" placeholder="Fall2020"
                autocomplete="off" />
            </div>
            <span class="error">
              <?php echo $semErr; ?>
            </span>
            <!-- Div class date inputs  -->
            <div class="form-group mt-3 date inputs">
              <input type="hidden" name="action" value="semForm">
              <label class="form-control-placeholder" for="startDate">Start Date</label>
              <input type="text" id="datepicker" autocomplete="off" name="startDate" value="">
            </div>
            <span class="error">
              <?php echo $startDateErr; ?>
            </span>
            <div class="form-group mt-3 date inputs">
              <input type="hidden" name="action" value="semForm">
              <label class="form-control-placeholder" for="endDate">End Date&nbsp;</label>
              <input type="text" id="datepicker1" autocomplete="off" name="endDate" value="">
            </div>
            <span class="error">
              <?php echo $endDateErr; ?>
            </span>
            <div class="form-group mt-3">
              <input class="form-control btn btn-block mb-4 rounded" type="submit" name="submit" value="Add" />
            </div>
          </form>
        </div>
      </div>
      <!-- Add a section container -->
      <div class="ftco-section rounded">
        <div class="col">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="emailForm" method="POST">
            <div class="d-flex">
              <div class="w-100">
                <h3 class="mb-1 title">Add A Section</h3>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="hidden" name="action" value="other">
              <label class="form-control-placeholder" for="section_name">Section Name</label>
              <input type="text" class="form-control" name="section_name" value="" placeholder="Section010"
                autocomplete="off" />
              <span class="error">
                <?php echo $sectionNameErr; ?>
              </span>
            </div>
            <div class="form-group mt-4">
              <input type="hidden" name="action" value="other">
              <label class="form-control-placeholder" for="semester_name">Semester</label>
              <select name="selectSemester">
                <?php $semesterView = new SemesterView();
                $result = $semesterView->semNameAndId();
                if ($result != null) {
                  for ($m = 0; $m < count($result); $m++) { ?>
                    <?php echo $result[$m]['semesterid'] ?>
                    <option value="<?php echo $result[$m]['semesterid'] ?>"><?php echo $result[$m]['semester_name']; ?>
                    </option>
                  <?php }
                } ?>
              </select>
            </div>
            <div class="form-group mt-4">
              <input type="hidden" name="action" value="other">
              <label class="form-control-placeholder" for="professor">Professor</label>
              <select name="selectProf">
                <?php $userView = new UsersView();
                $result2 = $userView->professorInfo();
                if ($result2 != null) {
                  for ($m = 0; $m < count($result2); $m++) { ?>
                    <option value="<?php echo $result2[$m]['userid'] ?>"><?php echo $result2[$m]['firstname']; ?>     <?php echo $result2[$m]['lastname']; ?></option>
                  <?php }
                } ?>
              </select>
            </div>
            <span class="error">
              <?php echo $selectedError; ?>
            </span>
            <div class="form-group mt-3">
              <input class="form-control btn btn-block mb-4 rounded" type="submit" name="submit" value="Add" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function () {
      $("#datepicker").datepicker();
      $("#datepicker1").datepicker();
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>