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
  <title>Professor Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="stylesheet" style="text/css" href="styles/profDash.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
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

    html,
    body {
      margin: 0;
      padding: 0;

    }

    .bgimg:after {
      content: '';
      background: url('images/1280-ZoomBackgrounds_CAM3.jpg') repeat center center;
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      z-index: -2;
      opacity: 0.55;
      /* Here is your opacity */
    }

    .bgimg {
      position: relative;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
      padding: 35px;
      font-weight: bolder;
      text-align: center;
      color: #F3F7FC;
      text-shadow: .7px .7px #000000;
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

    .dropdown-toggle {
      margin-left: 750px;
      color: black;
      display: inline-block;
    }

    @media only screen and (max-width: 950px) {
      .ftco-section {
        width: 100%;
        margin-top: 45%;
      }

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

      .bgimg {
        margin-top: 50px;
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
              <a class="nav-link active" aria-current="page" href="profDash.php">Home</a>
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
  <main class="content">
    <br><br><br>
    <section class="py-4 text-center container bgimg">
      <div class="row py-lg-4 contentinside">
        <!-- <div class=""> -->
        <?php
        $email = $_SESSION['email'];
        //grab current semester
        $semesterView = new SemesterView();
        $sem = $semesterView->currentSemester();
        $semester_name = $sem[0]['semester_name'];
        $_SESSION['semester_name'] = $semester_name;
        ?>
        <h2>
          <?php echo $semester_name ?>
        </h2>
        <p class="lead text-light">Choose the section, group and student below to visit the student profile.</p>
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
              if ($value != null) {
                $new_array[$key] = $value;
              }
              if ($value['section_name'] != null) { ?>
                <li class="nav-item" role="presentation">
                  <button style="color: black;" class="nav-link <?php if ($count == 1) {
                    echo "active";
                  } ?>" id="<?php echo $value['sectionid']; ?>-tab" data-bs-toggle="tab"
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
          $groupCount = array();
          $sectionGroups = array();
          foreach ($new_array as $key => $value) {
            if (isset($value['sectionid'])) {
              $groupCount[$value['sectionid']] = 0;
            }
            ?>
            <div class="tab-pane fade show <?php if ($count == 1) {
              echo "active";
            } ?>" id="<?php echo $value['sectionid']; ?>" role="tabpanel"
              aria-labelledby="<?php echo $value['sectionid']; ?>-tab" tabindex="0">
              <?php
              $groupView = new GroupTableView();
              $query = $groupView->groupinSec($value['sectionid']);
              // $query = $pdo->query("SELECT groupid, groupName FROM groupTable where sectionid = '".$value['sectionid']. "';");
              if ($query != null) {
                $groupIDs = array();
                foreach ($query as $key2 => $value2) {
                  array_push($groupIDs, $value2['groupid']);
                  $groupCount[$value['sectionid']] = $groupCount[$value['sectionid']] + 1;
                  ?>
                  <div class="groupBtns" id="groups<?php echo $value2['groupid'] ?>" value="<?php echo $value2['groupid'] ?>">
                    <h4><button class="grouppagebtn"
                        onclick="showStudents(<?php echo $value['sectionid']; ?>, <?php echo $value2['groupid'] ?>)"><?php
                              echo $value2['groupName'] ?> <div style="float: right;" id="btn<?php echo $value2['groupid'] ?>"> +
                        </div>
                      </button> </h4>
                  </div>
                  <?php
                  $studentsView = new StudentsView();
                  $query2 = $studentsView->studentFromGroup($value['sectionid'], $value2['groupid']);
                  // $query2 = $pdo->query("SELECT studentid, name from students where sectionid =".$value['sectionid']. " and groupid = ".$value2['groupid']. ";"); ?>
                  <div class="theStudents" style="display:none;" id="group<?php echo $value2['groupid'] ?>">
                    <?php
                    if ($query2 != null) {
                      foreach ($query2 as $key3 => $value3) { ?>
                        <div class="studentName" value="<?php echo $value2['groupid'] ?>">
                          <h4><button id="student<?php echo $value3['name'] ?><?php echo $value3['studentid'] ?>"
                              name="student-reports" class="studentpagebtn"
                              onclick="studentPage(<?php echo $value3['studentid'] ?>, 'student<?php echo $value3['name'] ?><?php echo $value3['studentid'] ?>')"><?php
                                       echo $value3['name'] ?></h4></button>
                        </div>
                      <?php }
                    } ?>
                  </div>
                  <?php
                }
                $sectionGroups[$value['sectionid']] = $groupIDs;
              } ?>
            </div>

            <?php
            $count++;

          }
          ?>
        </div>
        <!-- </div> -->

        </p>
      </div>
      </div>
    </section>
  </main>
  <div class="album py-5">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm transparent">
            <div class="card-body">
              <a href="professorDashboard.php" class="green-button">Grade Assignments</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm transparent">
            <div class="card-body">
              <a href="profDashAddGta.php" class="green-button">Add GTAs</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm transparent">
            <div class="card-body">
              <a href="profDashEditGroups.php" class="green-button">Edit Groups</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var sectionGroupJSArray;
    <?php
    // var obj = { fred: { apples: 1, oranges: 2 } sectionGroups
    $sectionGroupJSArray = "params = { ";
    $seccount = 0;
    foreach ($sectionGroups as $secid => $grparr) {
      if ($seccount == 0) {
        $sectionGroupJSArray = $sectionGroupJSArray . $secid . ": { ";
      } else {
        $sectionGroupJSArray = $sectionGroupJSArray . " ," . $secid . ": { ";
      }
      foreach ($grparr as $key => $grpid) {
        if ($key == 0) {
          $sectionGroupJSArray = $sectionGroupJSArray . $key . ": " . $grpid;
        } else {
          $sectionGroupJSArray = $sectionGroupJSArray . " ," . $key . ": " . $grpid;
        }
      }
      $sectionGroupJSArray = $sectionGroupJSArray . "}";
      $seccount = $seccount + 1;
    }
    $sectionGroupJSArray = $sectionGroupJSArray . "};\n ";
    echo $sectionGroupJSArray;


    ?>
    function showStudents(sectionid, groupid) {
      var groupids = params[sectionid];
      console.log(Reflect.ownKeys(groupids).length);
      for (let x = 0; x < Reflect.ownKeys(groupids).length; x++) {

        var matchName = "group" + groupids[x];
        console.log(matchName);
        if (matchName != "group" + groupid) {
          var y = document.getElementById("groups" + groupids[x]);
          if (y.style.display === "none") {
            y.style.display = "inline-block";
          } else {
            y.style.display = "none";
          }
        }
      }

      var x = document.getElementById("group" + groupid);
      var z = document.getElementById("btn" + groupid);
      if (x.style.display === "none") {
        z.innerHTML = ' -';
        x.style.display = "flex";
        x.style.cssText += 'justify-content:space-around;';
      } else {
        z.innerHTML = ' +';
        x.style.display = "none";
      }
    }

    function studentPage(studentid, studentName) {
      console.log()
      var x = document.getElementById(studentName);
      console.log()
      document.location.href = "studentpage.php?id=" + studentid;
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>