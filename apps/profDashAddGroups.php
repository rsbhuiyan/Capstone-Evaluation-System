<?php
session_start();
include 'includes/class.autoload.inc.php';
$util = new Apputil(); //Instantiate a new Apputil object
$util->checkLogin(__FILE__); //Call the checkLogin method of the Apputil object, passing the name of the current file as an argument
$professorEmail = $_SESSION['email'];
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Capstone Course Evaluation System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="stylesheet" style="text/css" href="styles/profDashAddGroups.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

    .navbar {
      /* Color optimization */
      background-color: var(--primary-color);
      padding: 10px;
      font-weight: 700;


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

    .nav-btn {
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

    .nav-btn:hover {
      /* color optimization */
      background-color: var(--button-hover-color);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    .dropdown-toggle {
      margin-left: 750px;
      color: black;
    }

    @media only screen and (max-width: 950px) {
      .ftco-section {
        width: 100%;
        height: 80%;
        margin-top: 15%;
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

      .semestername {
        margin-top: 10%;
      }
      .error {
        color: red;
      }

      .success {
        color: green;
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
              <a class="nav-link" href="profAddSection.php">
                Add Section
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="profDashAddGroups.php">
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
  $email = $_SESSION['email'];
  //grab current semester
  $semesterView = new SemesterView();
  $sem = $semesterView->currentSemester();
  $semester_name = $sem[0]['semester_name'];
  $_SESSION['semester_name'] = $semester_name;
  $errorMessage = "";
  $successMessage = "";
  $studentSuccessMessage = "";
  ?>
  <?php
  //checks if save group button was pressed
  if (isset($_POST['save_multiple_data'])) {
    //stores all the group names inserted in a array
    $groupName = $_POST['groupName'];
    $section = $_POST['section'];
    foreach ($groupName as $index => $groupNames) {
      $name = $groupNames;
      $groupView = new GroupTableView();
      $nRows = $groupView->checkIfGroupExists("$name");

      if (!$nRows) {
        //Input Data into mysql
        $successMessage = "Group(s) Saved!";

        $groupController = new GroupTableContr();

        if ($groupController->insertGroup("$name", $section)) {
          echo '<div style = "margin-top: 60px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Group added successfully!</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';

        }
      } else {
        $errorMessage = "* Group already inserted";
      }
    }

  }
  $studentSuccessMessage = "";
  $studentRemoveMessage = "";
  if (isset($_POST['saveGroup'])) {
    $students = $_POST['selectStudents'];
    $groups = $_POST['selectGroup'];
    foreach ($students as $student) {
      $studentController = new StudentsContr();
      $studentController->updateGroup("$student", "$groups");
      echo '<div style = "margin-top: 60px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Student(s) added to group successfully!</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }
  if (isset($_POST['deleteStudent'])) {
    $students = $_POST['selectStudents'];
    foreach ($students as $student) {
      $studentController = new StudentsContr();
      $studentController->deleteStudent("$student");
      echo '<div style = "margin-top: 60px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Student(s) are now inactive!</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }
  ?>
  <br><br><br>
  <h2 class="semestername" style="margin-left:10px;">
    <?php echo $semester_name ?>
  </h2>
  <br>

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
            } ?>" id="<?php echo $value['sectionid']; ?>-tab" data-bs-toggle="tab"
              data-bs-target="#<?php echo $value['sectionid']; ?>" type="button" role="tab" aria-controls="home-tab-pane"
              aria-selected="true"><?php echo $value['section_name']; ?></button>
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
      } ?>" id="<?php echo $value['sectionid']; ?>" role="tabpanel"
        aria-labelledby="<?php echo $value['sectionid']; ?>-tab" tabindex="0">
        <div class="container ">
          <div class="row">
            <div class="ftco-section">
              <div class="col">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="groupForm" method="POST">
                  <div class="d-flex">
                    <div class="w-100">
                      <h3 class="mb-1">Add A Group</h3>
                      <a href="javascript:void(0)" style="background:#88d7c0; color: black;"
                        class="add-more-form float-end btn btn-primary">Add More</a>
                    </div>
                  </div>
                  <div class="main-form mt-3 border-bottom">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group mb-3">
                          <label for="">Name</label>
                          <input autocomplete="off" type="text" name="groupName[]" class="form-control" required
                            placeholder="Enter Group Name">
                          <input type="hidden" name="section" value="<?php echo $value['sectionid']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="paste-new-forms"></div>
                  <div class="form-group mt-4">
                    <button style="background:#88d7c0; color: black;" type="submit" name="save_multiple_data"
                      class="btn btn-primary">Save Group(s)</button>
                    <span class="error">
                      <?php echo $errorMessage; ?>
                    </span>
                    <span>
                      <?php echo $successMessage; ?>
                    </span>
                  </div>
                </form>
              </div>
            </div>
            <div class="ftco-section">
              <div class="col">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="studentGroupForm" method="POST">
                  <div class="d-flex">
                    <div class="w-100">
                      <h3 class="mb-1">Assign your students to a group</h3>
                    </div>
                  </div>
                  <div class="form-group mt-4">
                    <input type="hidden" name="action" value="other">
                    <label class="form-control-placeholder" for="groupMember">Group: </label>
                    <?php
                    $section = $value['sectionid']; // Replace with the correct section ID
                    $groupView = new GroupTableView();
                    $result = $groupView->groupinSec($section);
                    $value = ['sectionid' => $section]; // Define $value with the correct section data
                    ?>
                    <select name="selectGroup">
                      <?php foreach ($result as $results): ?>
                        <option value="<?php echo $results['groupid'] ?>"><?php echo $results['groupName']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div style="background:#ffffff; color: black;" class="card mt-5">
                    <div style="background:#ffffff; color: black;" class="card-body">
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
                          if ($students != null) {
                            if (is_array($students) && count($students) > 0) {
                              foreach ($students as $student) { ?>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="selectStudents[]" value="<?php echo $student['studentid'] ?>">
                                    <?php echo $student['first_name'] . " " . $student['last_name'] ?>
                                  </label>
                                </div>
                              <?php } ?>
                            <?php } else { ?>
                              <p>No available students.</p>
                            <?php }
                          } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mt-4">
                    <button style="background:#88d7c0; color: black;" type="submit" name="saveGroup"
                      class="btn btn-primary">Assign students</button>
                    <span class="error">
                      <?php echo $errorMessage; ?>
                    </span>
                    <button style="background:#FCD0CF; color: black;" type="submit" name="deleteStudent"
                      class="btn btn-primary">Delete Student(s)</button>
                    <span class="error">
                      <?php echo $studentSuccessMessage; ?>
                    </span>
                    <span class="error">
                      <?php echo $studentRemoveMessage; ?>
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
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function () {
      $(document).on('click', '.remove-btn', function () {
        $(this).closest('.main-form').remove();
      });

      $(document).on('click', '.add-more-form', function () {
        $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                                <div class="row">\
                                    <div class="col-md-12">\
                                        <div class="form-group mb-3">\
                                            <label for="">Name</label>\
                                            <input type="text" name="groupName[]" class="form-control" required placeholder="Enter Additional Groups">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn btn btn-danger">Remove</button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>');
      });

    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>