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
  <title>Sent Messages</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <link rel="stylesheet" style="text/css" href="styles/sentMessages.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
  <script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
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

    .tablecontent {
      margin: 20px;
      padding: 10px;
      background: rgba(249, 253, 255, .4);
    }

    html,
    body {
      margin: 0;
      height: 100%;
    }

    .btnedit {
      background-color: #A9F3E9;
    }

    .btnedit:hover {
      background-color: #A9F3E9;
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
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

    /* Nav Bar */
    .dropdown-toggle {
      margin-left: 750px;
      color:black;
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
      <h3><a style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;" href="adminDash.php">Capstone
          Course Evaluation System</a></h3>
      <img style="width:40px; height:40px;display: inline-block;" src="images/wsulogo.svg.png"
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
  <main>
    <br><br><br>

    <?php
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

    $sql = "SELECT *, DATE_FORMAT(dateSubmitted,'%m/%d/%Y') as 'date' from comments where givenByUser =?";
    $query1 = $pdo->prepare($sql);
    $query1->execute([$userinfo[0]['userid']]);
    $notifications = $query1->fetchAll();
    ?>
    <div class="tablecontent">
      <h1>ALL MESSAGES</h1>
      <table id="allmessages" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>Date</th>
            <th>To Whom</th>
            <th>About Whom</th>
            <th>Message Text</th>
            <th>Have They Read the Message</th>
          </tr>
        </thead>
        <tbody>
          <?php $cnt = 0;
          foreach ($notifications as $key => $value) {
            $cnt++; ?>
            <tr>

              <td>
                <?php echo $value['date']; ?>
              </td>
              <td>
                <?php
                $usersView = new UsersView();
                $gtainfo = $usersView->userInfoByID($value['givenToUser']);
                echo $gtainfo[0]['firstname'] . " " . $gtainfo[0]['lastname'];
                ?>
              </td>
              <td>
                <?php
                $studentsView = new StudentsView();
                $studentsinfo = $studentsView->studentInfo($value['studentid']);
                if ($studentsinfo) {
                  echo $studentsinfo[0]->name;
                } ?>

              </td>
              <td>
                <?php echo $value['commentText']; ?>
              </td>
              <td>
                <?php
                if ($value['status'] == '1') {
                  echo "No";
                }
                if ($value['status'] == '0') {
                  echo "Yes";
                }
                ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <script>
      $(document).ready(function () {
        $('#allmessages').DataTable();
        $('#sentMessages').DataTable();
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
</body>

</html>