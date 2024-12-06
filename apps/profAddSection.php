<?php
session_start();
include 'includes/class.autoload.inc.php';
$util = new Apputil();
$util->checkLogin(__FILE__);
$professorEmail = $_SESSION['email'];
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Section</title>
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="stylesheet" style="text/css" href="styles/profAddSection.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" style="text/css" href="styles/profAddSection.css">
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

    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      /* color optimization */
      background-color: var(--background-color);
      line-height: 1.6;
      font-size: 18px;
    }

    /* Change textbox from blue to green */

    textarea:focus,
    input[type="text"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {
      border-color: #008C81;
      box-shadow: 0 0 0 0.2rem rgba(0, 140, 129, 0.25);
      outline: 0 none;
    }

    .error {
      color: #FF6E6B;
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
    .dropdown-toggle {
      margin-left: 750px;
      color: black;
    }

    .container {
      max-width: 700px;
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
      width: 100%;
      padding: 50px 60px;
      border-radius: 8px;
      margin-bottom: 20px;
      color: var(--input-text-color);
    }
    .add-section-btn{
      width:15%;
      margin-top: 40px;
      margin-bottom: -30px;
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

      .dropdown-toggle {
        margin-left: -100px;
      }

      h2 {
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

      body {
        font-size: 16px;
      }

      .ftco-section {
        width: 100%;
        height: 80%;
        margin-top: 35%;
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
              <a class="nav-link active" href="profAddSection.php">
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
  <br><br><br>
  <?php
  //variables
  $isError = false;
  $sectionNameErr = "";
  $section_name = isset($_POST["section_name"]) ? $_POST["section_name"] : "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["semester_name"])) {
      $semester_name = $_SESSION["semester_name"];
      $email = $_SESSION["email"];
    } else {
      $semester_name = " a public semester";
    }
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
        $semesterView = new SemesterView();
        $result = $semesterView->semNameAndId();
        $selectSemester = $result[0]['semesterid'];
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
      $semesterView = new SemesterView();
      $result = $semesterView->semNameAndId();
      $selectSemester = $result[0]['semesterid'];

      $usersView = new UsersView();
      $result1 = $usersView->selectTheOneProf($email);
      $selectProf = $result1['userid'];

      $sectionController = new SectionContr();
      if ($sectionController->insertSection($section_name, $selectSemester, $selectProf)) {
        echo '<div style = "margin-top: 60px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Section added successfully!</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';

        $section_name = "";
        $selectProf = "";
        $selectSemester = "";
      }
    } else {
      // $selectedError = "You must select both semester and professor to pick a section";
    }
  }
  ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="ftco-section rounded">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="emailForm" method="POST">
            <div class="d-flex">
              <div class="w-100">
                <center>
                  <h3 class="mb-1">Add A Section</h3>
                </center>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="hidden" name="action" value="sectionSub">
              <label class="form-control-placeholder" for="section_name">Section Name</label>
              <input type="text" class="form-control" name="section_name" value="" placeholder="Section010"
                autocomplete="off" />
              <span class="error">
                <?php echo $sectionNameErr; ?>
              </span>
            </div>
            <div class="form-group mt-6">
              <input class="btn btn-block mb-4 rounded add-section-btn" type="submit" name="submit" value="Add" />
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