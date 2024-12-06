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
  <link rel="stylesheet" style="text/css" href="styles/chooseSemester.css">
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
  <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=8f7cff5ee7757412879aedf3efbfaee01">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      /* color optimization */
      background-color: var(--background-color);
      line-height: 1.6;
      font-size: 18px;
    }

    label {
      font-size: 23px;
      margin-bottom: 10px;
      /* Add spacing between label and input field */
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
    table tr:first-child th {
    color: black;
  }  
  h3.capTitle {
        margin-left: 770px;
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
      h1{
        margin-top: 10px;;
      }
      .activated{
    width: 90%;
    margin-top:-40px;
  }
    }
  </style>
  <script type="text/javascript" src="/media/js/site.js?_=1d5abd169416a09a2b389885211721dd" data-domain="datatables.net"
    data-api="https://plausible.sprymedia.co.uk/api/event"></script>
  <script src="https://media.ethicalads.io/media/client/ethicalads.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
  <nav class="navbar fixed-top navbar-static-top" style="background-color:#008C81">
    <div class="container-fluid">
      <button style = "color: #F3F7FC;" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h3 class = "capTitle"><a class = "titleLabel" style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;"
          href="chooseSemester.php">Capstone
          Course Evaluation System</a></h3>
      <img class = "wsuimg"style="width:40px; height:40px;display: inline-block;" src="images/wsulogo.svg.png"
        alt="Wayne State University Logo">
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h4 style="color:#008C81; text-shadow: .7px .7px #000000;"  class="offcanvas-title" id="offcanvasNavbarLabel">
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
              <a class="nav-link active" aria-current="page" href="chooseSemester.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="adminDashAddSemester.php">Add Semester/Section</a>
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
  <br><br><br>
  <h1>Click the semester below to view!</h1>
  <?php
  $semesterView = new SemesterView();
  $topFive = $semesterView->selectFiveSemesters();
  if ($topFive != null) { ?>
    <center>
      <div>
        <?php
        foreach ($topFive as $key => $value) {
          ?>
          <a class="semesterpagebtn" href="adminDash.php?id=<?php echo $value['semesterid'] ?>"><?php echo $value['semester_name'] ?></a>
          <?php
        } ?>
      </div>
    </center>
    <?php
  }
  ?>
<br>
  <div class="semesters-container">
    <div class="activated">
      <div id='container'>
        <section class="ftco-section">
          <div class="table-scroll">
            <div class="professor-edit" id="professorEditPopUP">
              <table class="u-full-width geeks" id="professors_table">
                <h3>Search for Semesters</h3>
                <input type="text" id="activatedSearch" onkeyup="activatedSearchFunction()"
                  placeholder="Search for semesters...">
                <tr>
                  <div class="input-group">
                    <th onclick="sortTable('professors_table', 1)">Semesters</th>
                  </div>
                </tr>
                <!--Connecting to Users Table-->
                <?php
                $semesterView = new SemesterView();
                $semesters = $semesterView->selectSemester();
                if ($semesters != NULL) {
                  foreach ($semesters as $key => $value) {
                    ?>
                    <tbody>
                      <tr>
                        <td>
                          <a class="semesterpagebtn" href="test1.php?id=<?php echo $value['semesterid'] ?>"><?php echo $value['semester_name'] ?></a>
                        </td>
                      </tr>
                    </tbody>
                    <?php
                  }
                } else {
                  echo "No Records Found";
                }
                ?>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  
  <!-- Show data tables plugin -->
  <script>
    // Executes javascript function when document is ready
    function activatedSearchFunction() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("activatedSearch");
          filter = input.value.toUpperCase();
          table = document.getElementById("professors_table");
          tr = table.getElementsByTagName("tr");

          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // We choose [1] since the first name and last name are combined in the second column.
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>