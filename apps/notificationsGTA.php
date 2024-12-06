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
  <title>Notifications</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" style="text/css" href="styles/notificationsGTA.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
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
    .btn {
     
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
      /* Increase line-height for better readability */
      font-size: 18px;
      /* Increase font size for better readability */
    }
    #countnotif {
      border-radius: 50%;
      position: relative;
      top: -10px;
      left: -10px;
    }
    .dropdown-menu,
    .dropdown-toggle {
      margin-left: 700px;
    }

/* to make the webpage responsive */
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
      <h3 class = "capTitle"><a class = "titleLabel"style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;" href="gtaDash.php">Capstone
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
                <button type="button" class="btn" id="right-panel-link" href="#right-panel">Sign
                  out</button>
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
    $sql = "SELECT *, DATE_FORMAT(dateSubmitted,'%m/%d/%Y') as 'date' from comments where givenToUser =? and status =1;";
    $query1 = $pdo->prepare($sql);
    $query1->execute([$userinfo[0]['userid']]);
    $notifications = $query1->fetchAll();
    ?>
    <!-- This content shows the message to the GTA. -->
    <div class="tablecontent">
      <h1>NEW MESSAGES</h1>
      <table id="newMessages" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th style="display:none;">Comment ID</th>
            <th>Date</th>
            <th>About Whom</th>
            <th>Message Text</th>
          </tr>
        </thead>
        <tbody>
          <?php $cnt = 0;
          foreach ($notifications as $key => $value) {
            $cnt++; ?>
            <tr>
              <td id="commentid<?php echo $cnt; ?>" style="display:none;">
                <?php echo $value['commentid']; ?>
              </td>
              <td>
                <?php echo $value['date']; ?>
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
                <button onclick="updateForm(<?php echo $cnt; ?>)" class="btn btnedit" id="editbtn">REVEAL MESSAGE</button>
                <p style="display:none;" id="msgText">
                  <?php echo $value['commentText']; ?>
                </p>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- This code is for the messages that have been viewed already -->
    <?php
    $sql = "SELECT *, DATE_FORMAT(dateSubmitted,'%m/%d/%Y') as 'date' from comments where givenToUser =? and status =0;";
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
            <th>About Whom</th>
            <th>Message Text</th>
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
                <!-- Displays the message from the database -->
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
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <script>
      $(document).ready(function () {
        $('#allmessages').DataTable();
        $('#newMessages').DataTable();
      });
    </script>
    <script>
      //This function makes the text be hidden and edit button to work
      function updateForm(count) {
        var x = document.getElementById("editbtn");
        var y = document.getElementById("msgText");
        var z = document.getElementById("commentid" + count).innerText.trim();
        console.log(z)
        x.style.display = "none";
        y.style.display = "block";
        $.ajax({
          type: "POST",
          data: { commentid: z },
          url: "updateCommentStatus.php",
          success: function (data) {
            console.log(data);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log("error: " + textStatus + ", error thrown: " + errorThrown);
          }
        });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
</body>

</html>