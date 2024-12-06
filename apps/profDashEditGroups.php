<?php
session_start();
include 'includes/class.autoload.inc.php';
$professorEmail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Groups</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="stylesheet" style="text/css" href="styles/profDashEditGroups.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
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
      margin-left: auto;
      margin-right: auto;
    }

    .btn:hover {
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
        margin-top: 35%;
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
              <a class="nav-link" href="profDashAddGroups.php">
                Add Groups
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="profDashEditGroups.php">
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
  $searchError = "";
  $successMessage = "";
  $studentSuccessMessage = "";
  $groupName = isset($_POST["searchGroup"]) ? $_POST["searchGroup"] : "";
  ?>
  <br><br><br>
  <h2 style="margin-left:10px;">
    <?php echo $semester_name ?>
  </h2>
  <br>

  <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Group Members</h1>
          <h10 class="mb-1">*Select the checkbox for students you would like to remove.</h10>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="groupForm" method="POST">
            <div class="mb-3">
              <input type="hidden" class="form-control" name="groupid" id="groupid">
            </div>
            <div class="form-group mt-6">
              <input type="hidden" name="action" value="other">
            </div>
            <div class="mb-3" id="student-names">
              <!-- New student name inputs will be appended here -->
            </div>
            <div class="mb-3" id="student-ids">
              <!-- New student name inputs will be appended here -->
            </div>
            <div class="mb-3">
            </div>
        </div>

        <button style="width:50%;margin-left:auto;margin-right:auto;" type="submit" name="Submit"
          class="form-control btn btn-block mb-4 rounded">Remove</button>

        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="editmodal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Group Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="groupForm" method="POST">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Group Name:</label>
              <input type="text" class="form-control" name="groupName1" id="groupName1">
              <input type="hidden" class="form-control" name="groupid1" id="groupid1">
            </div>
            <div class="form-group mt-6">
              <input type="hidden" name="action" value="other">
              <label for="recipient-name" class="col-form-label">GTA:</label>
              <?php
              $usersView = new UsersView();
              $user = $usersView->selectTheOneProf($email);
              $userid = $user['userid'];
              $result = $usersView->getProfGtas($userid);
              ?>
              <select name="selectGtas1" id="selectGTA1">
                <?php foreach ($result as $results): ?>
                  <option value="<?php echo $results['gta'] ?>"><?php echo $results['firstname']; ?>   <?php echo $results['lastname']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3" id="student-names1">
              <!-- New student name inputs will be appended here -->
            </div>
            <div class="mb-3" id="student-ids1">
              <!-- New student name inputs will be appended here -->
            </div>
            <div class="mb-3">
              <input type="hidden" class="form-control" name="gtaName1" id="gtaName1">
            </div>
        </div>

        <button style="width:50%;margin-left:auto;margin-right:auto;" type="submit" name="Submit1"
          class="form-control btn btn-block mb-4 rounded">Save</button>

        </form>
      </div>
    </div>
  </div>

  <!--#####################################################################################################################################-->

  <!-- Delete POP UP FORM (Bootstrap MODAL) -->
  <!--id of pop up modal form: deletemodal matches javascript funrction-->
  <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Remove GTA from Group</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="groupForm" method="POST">

          <div class="modal-body">
            <input type='hidden' name='deleteuser' id='deleteuser'>
            <input type='hidden' name='deleteGroupid' id='deleteGroupid'>
            <input type='hidden' name='toggleActive' id='toggleActive'>

            <h4>Do you want to unassign this GTA from the group?</h4>
            <h5>Another GTA will be able to pick this group.</h5>

          </div>
          <div class="modal-footer">
            <button type="button" style="background-color: #88d7c0; color:black;" class="btn btn-secondary"
              data-bs-dismiss="modal">Go back</button>

            <button type="submit" style="background-color: #88d7c0; color:black;" name="delete"
              class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="col">
      <div id='scroll'>
        <section class="ftco-section">
          <table class="table table-bordered">
            <div class="professor-edit" id="professorEditPopUP">
              <h3 class="mb-1">Groups</h3>
              <h6 class="mb-1">Must assign a group students and a GTA to properly edit </h6>
              <span class="error">
                <?php echo $searchError; ?>
              </span>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="groupForm" method="POST">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Search group:</label>
                  <input type="text" class="form-control" name="searchGroup" value=""">
                          <button style = " background:#88d7c0; color:black;" type="submit" name="SubmitSearch"
                    class="btn mb-4 rounded">Search</button>
                    
                </div>
              </form>
              <div class="grid text-center">
                <tr>
                  <div class="input-group">
                    <th>Group Name</th>
                  </div>
                  <div class="input-group">
                    <th>GTA</th>
                  </div>
                  <div class="input-group">
                    <th>Members</th>
                  </div>
                  <div class="input-group">
                    <th>Edit Group Name/GTA</th>
                  </div>
                  <div class="input-group">
                    <th>Remove Member(s)</th>
                  </div>

                </tr>
              </div>
              <?php
              //controls for a edit function for updating the group list
              if (isset($_POST['Submit'])) {
                //loop thru array with group names and use the studentid array to assign new name
                //dont need a another for loop for studentid, just use same index as the one in group names array
                $groupid = $_POST['groupid'];
                $studentid = $_POST['studentid'];

                $name = isset($_POST["name"]) ? $_POST["name"] : "";



                if ($name != NULL) {
                  foreach ($name as $index => $names) {
                    $studentids = $studentid[$index];

                    $studentContr = new StudentsContr();
                    if ($studentContr->removeGroup($studentids)) {
                      echo '<div style = "margin-top: 60px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Student(s) removed from group!</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    } else {
                      echo "Failed to remove student.";
                    }
                  }
                }
              }

              if (isset($_POST['Submit1'])) {
                //loop thru array with group names and use the studentid array to assign new name
                //dont need a another for loop for studentid, just use same index as the one in group names array
                $groupid = $_POST['groupid1'];
                $groupName = $_POST['groupName1'];
                $studentid = $_POST['studentid1'];

                //$groupid = $_POST['groupid1'];
                // $groupName = $_POST['groupName1'];
                //$studentid = $_POST['studentid1'];
              
                $gtas = $_POST['selectGtas1'];
                $name = isset($_POST["name"]) ? $_POST["name"] : "";
                //get section of group
                $GroupTableView = new GroupTableview();
                $section = $GroupTableView->getGroupSection($groupid);
                $sectionid = $section['sectionid'];

                $GroupTableContr = new GroupTableContr();
                $GtaAssignment = new GtaAssignmentContr();

                if ($GroupTableContr->groupEditName($groupid, $groupName) && $GtaAssignment->groupEditGta($groupid, $sectionid, $gtas)) {
                  echo '<div style = "margin-top: 60px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Group updated successfully!</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                } else {
                  echo "Failed to edit group!";
                }

              }
              //code to remove addigned GTA to group
              //if button name is clicked
              if (isset($_POST["delete"])) {
                $userid = $_POST['deleteuser'];
                $groupid = $_POST['deleteGroupid'];
                $gtaAssignmentContr = new GtaAssignmentContr();
                if ($gtaAssignmentContr->removeGroupGta($userid, $groupid)) {
                  echo '<div style = "margin-top: 60px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>GTA unassigned from group!</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';

                } else {
                  echo "Failed to remove student.";
                }
              }
              ?>
              <!--Connecting to group Table-->
              <?php
              //Get current semester id
              $semesterid = $sem[0]['semesterid'];
              //code to gather data based on group name
              $groupName = isset($_POST["searchGroup"]) ? $_POST["searchGroup"] : "";
              $groupView = new GroupTableView();
              $query_run = $groupView->specificGroupInfo($groupName, $semesterid);
              if (empty($query_run)) {
                $searchError = "No Records found";
                $query_run = $groupView->groupInfo($semesterid);
              }

              $userid = "";
              //show only professors with account access
              
              if ($query_run) {
                foreach ($query_run as $row) {
                  ?>
                  <!--Professors Table-->
                  <tbody>
                    <tr>
                      <td style="display:none;">
                        <?php echo $row['groupid']; ?>
                      </td>
                      <td style="display:none;">
                        <?php echo $row['groupid']; ?>
                      </td>
                      <td>
                        <?php echo $row['groupName']; ?>
                      </td>
                      <td>
                        <?php echo $row['firstname'] . " " . $row['lastname']; ?>
                      </td>
                      <td>
                        <?php echo $row['GROUP_CONCAT(name)']; ?>
                      </td>
                      <td style="display:none;">
                        <?php echo $row['GROUP_CONCAT(studentid)']; ?>
                      </td>
                      <td style="display:none;">
                        <?php echo $row['gta']; ?>
                      </td>
                      <td style="display:none;">
                        <?php echo $row['sectionid']; ?>
                      </td>
                      <td>
                        <button type="button " style="background-color: #88d7c0; color:black;"
                          class="btn btn-sucess removebtn">Edit</button>
                      </td>
                      <td>
                        <button type="button " style="background-color: #88d7c0; color:black;"
                          class="btn btn-sucess editbtn">Remove</button>
                      </td>
                      <td style="display:none;">
                        <button type="button" style="background-color: #88d7c0; color:black;"
                          class="btn btn-delete deletebtn">Delete</button>
                      </td>
                    </tr>
                    </tr>
                  </tbody>
                  <?php
                }
              } else {
                echo "No group found";
              }
              ?>
          </table>
          <p id="notice"></p>
      </div>
      </section>
    </div>
  </div>
  </div>

  <?php
  if (isset($_GET["update"])) {
    if ($_GET["update"] == "success") {
      echo '<script type="text/javascript">
      window.onload = function () { alert("update success!"); } 
          </script>';
    }
    if ($_GET["update"] == "error") {
      echo '<span class = "error"> *update did not happen</span>';
    }
  }

  //delete function toast updates
  if (isset($_GET["delete"])) {
    if ($_GET["delete"] == "success") {
      echo '<script type="text/javascript">
      window.onload = function () { alert("delete success!"); } 
          </script>';
    }
    if ($_GET["delete"] == "error") {
      echo '<span class = "error"> *delete did not happen</span>';
    }
  }
  ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"
    integrity="sha512-6UofPqm0QupIL0kzS/UIzekR73/luZdC6i/kXDbWnLOJoqwklBK6519iUnShaYceJ0y4FaiPtX/hRnV/X/xlUQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
    integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function () {
      $('.deletebtn').on('click', function () {
        //id of delete pop modal
        $('#deletemodal').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();

        console.log(data);
        $('#deleteuser').val(data[6]);
        $('#deleteGroupid').val(data[0]);
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $('.editbtn').on('click', function () {

        $('#editmodal').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();

        console.log(data);
        $('#groupid').val(data[0]);
        $('#groupName').val(data[2].trim());
        $('#gtaName').val(data[3]);
        var gtaName = data[3];
        $('#selectGTA option[value="' + data[6] + '"]').attr("selected", "selected");
        var names = data[4].split(",");

        // Remove any existing student name inputs
        $('#student-names').empty();

        // Generate a new checkbox for each student name
        for (var i = 0; i < names.length; i++) {
          var inputHtml = '<div class="mb-3">' +
            '<label class="form-check-label">' +
            '<input type="checkbox" class="form-check-input" name="name[' + i + ']" value="' + names[i].trim() + '">' +
            names[i].trim() +
            '</label>' +
            '</div>';
          $('#student-names').append(inputHtml);
        }

        var studentid = data[5].split(",");

        // Remove any existing student name inputs
        $('#student-ids').empty();

        // Generate a new input for each student name
        for (var j = 0; j < studentid.length; j++) {
          var inputHtml2 = '<div class="mb-3">' +
            '<input type="hidden" class="form-check-input" name="studentid[' + j + ']" value="' + studentid[j].trim() + '">' +
            '</div>';
          $('#student-ids').append(inputHtml2);
        }
        $('#gta').val(data[6]);

      });
    });

  </script>

  <script>
    $(document).ready(function () {
      $('.removebtn').on('click', function () {

        $('#editmodal1').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
          return $(this).text();
        }).get();

        console.log(data);
        $('#groupid1').val(data[0]);
        $('#groupName1').val(data[2].trim());
        $('#gtaName1').val(data[3]);
        var gtaName1 = data[3];
        $('#selectGTA1 option[value="' + data[6] + '"]').attr("selected", "selected");
        var names1 = data[4].split(",");

        // Remove any existing student name inputs
        $('#student-names1').empty();

        // Generate a new checkbox for each student name
        for (var i = 0; i < names1.length; i++) {
          var inputHtml1 = '<div class="mb-3">' +
            '<label class="form-check-label">' +
            '<input type="checkbox" class="form-check-input" name="name1[' + i + ']" value="' + names1[i].trim() + '">' +
            names1[i].trim() +
            '</label>' +
            '</div>';
          $('#student-names').append(inputHtml1);
        }

        var studentid1 = data[5].split(",");

        // Remove any existing student name inputs
        $('#student-ids1').empty();

        // Generate a new input for each student name
        for (var j = 0; j < studentid1.length; j++) {
          var inputHtml3 = '<div class="mb-3">' +
            '<input type="hidden" class="form-check-input" name="studentid1[' + j + ']" value="' + studentid1[j].trim() + '">' +
            '</div>';
          $('#student-ids1').append(inputHtml3);
        }
        $('#gta1').val(data[6]);

      });
    });

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>