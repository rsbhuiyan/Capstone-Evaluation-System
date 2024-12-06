<?php
session_start();
include 'includes/class.autoload.inc.php';
$util = new Apputil();
$util->checkLogin(__FILE__);
$gtaemail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html>

<!-- Scripts and linking of css pages and images to work properly -->
<head>
  <title>GTA Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" style="text/css" href="styles/gtaDash.css">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
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

    /* for sign out button in the navbar */
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
/* The button having a hover */
    .btn:hover {
      /* color optimization */
      background-color: var(--button-hover-color);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);

    }

    /* Group page Button CSS */
    .grouppagebtn {
    background-color: #5cd6cd;
    border-radius: 100px;
    box-shadow: rgba(44, 187, 99, .4) 0 -15px 18px -14px inset, rgba(44, 187, 99, .15) 0 1px 2px, rgba(44, 187, 99, .15) 0 2px 4px, rgba(44, 187, 99, .15) 0 4px 8px, rgba(44, 187, 99, .15) 0 8px 16px, rgba(44, 187, 99, .15) 0 16px 32px;
    color: black;
    font-weight: 500;
    cursor: pointer;
    display: inline-block;
    font-family: CerebriSans-Regular, -apple-system, system-ui, Roboto, sans-serif;
    padding: 7px 20px;
    text-align: center;
    text-decoration: none;
    transition: all 250ms;
    border: 0;
    font-size: 20px;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;

  }

  /* Group page Button CSS */
  .grouppagebtn:hover {
    box-shadow: rgba(44, 187, 99, .35) 0 -15px 18px -14px inset, rgba(44, 187, 99, .25) 0 1px 2px, rgba(44, 187, 99, .25) 0 2px 4px, rgba(44, 187, 99, .25) 0 4px 8px, rgba(44, 187, 99, .25) 0 8px 16px, rgba(44, 187, 99, .25) 0 16px 32px;
    transform: scale(1.05) rotate(-1deg);
  }

  /* Image being shown behind the text */
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

    /* Setting the image perfectly */
    .bgimg {
      position: relative;
      width: 100%;
      padding: 50px;
      font-weight: bold;
      text-align: center;
      color: #F3F7FC;
      text-shadow: .7px .7px #000000;
    }

    /* code for the body */
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
    
    /* DropDown menu moved to the left */
    .dropdown-menu,
    .dropdown-toggle {
      margin-left: 700px;
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
    
   
  </style>
</head>
<body>
  <?php
  $usersView = new UsersView();
  $userinfo = $usersView->allUserInfo($gtaemail);
  ?>
  <!-- Shows the bell icon in the nav bar and can access the bell icon in the navbar. -->
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
      <!-- The title of the application -->
      <h3 class = "capTitle"><a class = "titleLabel"style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;" href="gtaDash.php">Capstone
          Course Evaluation System</a></h3>
      <img class = "wsuimg" style="width:40px; height:40px;display: inline-block;"
      src="images/wsulogo.svg.png"
        alt="">
        <!-- The title of the application, in the navbar -->
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
          <!-- Other pages in the navBar for the GTA to access -->
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="gtaDash.php">Home</a>
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
    <!-- The title the GTA sees when they login to the GTA interface. -->
    <section class="py-5 text-center container bgimg">
      <div class="row py-lg-5 contentinside">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Welcome!</h1>
          <p class="lead text-light">Click on your groups below to grade their assignments.</p>
        </div>
      </div>
    </section>
    <!-- This block of code shows the groups in the database, for the GTA to grade. -->
    <div class="album py-5 ">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php
          $usersView = new UsersView();
          $user = $usersView->selectTheOneProf($gtaemail);
          $semesterView = new SemesterView();
          $sem = $semesterView->currentSemester();
          $semesterid = $sem[0]['semesterid'];
          $groupTableView = new GroupTableView();
          $query = $groupTableView->selectgtaGroups($user['userid'], $semesterid);
          if ($query != null) {
            foreach ($query as $key => $value) { ?>
              <div class="col">
                <div style="background-color: #f5f7fa;" class=" ">
                  <div style="background-color: #F3F7FC;" class="card-body">
                    <center>
                      <h4><button class="grouppagebtn"
                          id="group<?php echo $value['groupName'] ?><?php echo $value['groupid'] ?>"
                          onclick="groupPage(<?php echo $value['groupid'] ?>, 'group<?php echo $value['groupid'] ?>')"><?php echo $value['groupName'] ?></h4></button>
                    </center>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
      </div>
  </main>
  <script>
    function groupPage(groupid, groupIdName) {
      var x = document.getElementById(groupIdName);
      document.location.href = "gtaGroupPage.php?id=" + groupid;
    }
  </script>

<!-- Script for the navBar -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>