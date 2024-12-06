<?php
session_start();
include 'includes/class.autoload.inc.php';
$util = new Apputil();
$util->checkLogin(__FILE__);
$adminEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Professors</title>
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="stylesheet" style="text/css" href="styles/adminDashAddProfessors.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <!-- Font awesome library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
  <style>
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

    .add-professor-container {
      position: relative;
      margin-top: 140px;
    }
    .add-professor-btn {
      width: 12%;
    }
   
    /* responsive code */
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

      .add-professor-btn {
        width: 100%;
      }

      .activated,
      .deactivated {
        width: 100%;
        height: 500px;
      }

      .professors-container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
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
      <img class="wsuimg" style="width:40px; height:40px;display: inline-block;" src="images/wsulogo.svg.png"
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
              <a class="nav-link" href="adminDashAddSemester.php">Add Semester/Section</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="adminDashAddProfessors.php">Add Professor</a>
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
  $email = isset($_POST["email"]) ? $_POST["email"] : "";
  $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
  $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";

  $firstNameErr = $lastNameErr = $emailErr = $emailExistsErr = "";
  $isError = false;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = 'mysql:dbname=ccesdb;host=127.0.0.1';
    $database = 'ccesdb';
    $username = 'john';
    $password = 'pass1234';
    $pdo = new PDO($server, $username, $password);

    // Check connection
    if ($pdo === false) {
      die("ERROR: Could not connect. ");
    }
    if (empty($_POST["firstname"])) {
      $firstNameErr = "* First name is required";
      $isError = true;

    } else {
      $firstname = ucfirst($_REQUEST['firstname']);
      if (!preg_match("/^[A-Za-z\s]*$/", $firstname)) {
        $firstNameErr = "* Only letters and white spaces are allowed";
        $firstname = "";
        $isError = true;
      }
    }
    if (empty($_POST["lastname"])) {
      $lastNameErr = "* Last name is required";
      $isError = true;
    } else {
      $lastname = ucfirst($_REQUEST['lastname']);
      if (!preg_match("/^[A-Za-z\s]*$/", $lastname)) {
        $lastNameErr = "* Only letters and white spaces are allowed";
        $lastname = "";
        $isError = true;
      }
    }
    if (empty($_POST["email"])) {
      $emailErr = "*Email is required";
      $isError = true;
    } else {
      $email = $_REQUEST['email'];
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
      $query1 = $pdo->query("SELECT email from users where email = '$email';");
      if ($query1->rowCount() > 0) {
        // get the name and email of the user
        $row = $query1->fetch(PDO::FETCH_ASSOC);
        $emailExistsErr = "This email already belongs to a user.";
        $isError = true;


      }
      if (!preg_match("/^[a-z0-9]{6}+@wayne.edu$/", $email)) {
        $emailErr = "* Invalid email: must be a wayne.edu";
        $email = "";
        $isError = true;
      }
    }
    if (!$isError) {

      $sql = "INSERT INTO users (firstname, lastname, email, roleofuser, activeUSer) VALUES ( '$firstname', '$lastname','$email',  'professor', '1');";
      $pdo->exec($sql);
      // Alert message for Add Professor
      echo '<div id="alert-message" style="margin-top: 80px; margin-bottom: -30px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
          <div id="alert-text" class="fade-out-alert">
            <strong>Professor added successfully!</strong>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
  }
  ?>
   <?php
    if (isset($_GET["delete"])) {
        if ($_GET["delete"] == "success") {
          echo '<div id="alert-message" style="margin-top: 90px; margin-bottom:-40px;width:30%; margin-left: auto; margin-right:auto;" class="alert alert-success alert-dismissible fade show" role="alert">
          <div id="alert-text" class="fade-out-alert">
            <strong>Professors activity status has been updated!</strong>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    }
    ?>
  <div class="container add-professor-container">
    <div class="circle-icon">
      <i class="fa fa-solid fa-user-plus"></i>
    </div>
    <div class="row">
      <div class="col">
        <section class="ftco-section rounded">
          <div class="row justify-content-center">
            <div class="wrap">
              <div class="login-wrap ">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="emailForm" method="POST"
                  class="signin-form">
                  <div class="d-flex">
                    <div class="w-100">
                      <h3 class="mb-1">Add Professors!</h3>
                    </div>
                  </div>
                  <div class="form-group mt-3">
                    <label class="form-control-placeholder" for="firstName">First Name *</label>
                    <input type="text" class="form-control" name="firstname" value="" placeholder="John"
                      autocomplete="off" />
                    <span class="error">
                      <?php echo $firstNameErr; ?>
                    </span>
                  </div>
                  <div class="form-group mt-3">
                    <label class="form-control-placeholder" for="lastName">Last Name *</label>
                    <input type="text" class="form-control" name="lastname" value="" placeholder="Smith"
                      autocomplete="off" />
                    <span class="error">
                      <?php echo $lastNameErr; ?>
                    </span>
                  </div>
                  <div class="form-group mt-3">
                    <label class="form-control-placeholder" for="username">Email *</label>
                    <input type="text" class="form-control" name="email" value="" placeholder="example@wayne.edu"
                      autocomplete="off" />
                    <span class="error">
                      <?php echo $emailErr; ?>
                    </span>
                  </div>
                  <div class="form-group">
                    <label></label>
                    <div class="center-button">
                      <input class="btn btn-block rounded add-professor-btn" type="submit" name="submit" value="Add" />
                    </div>
                  </div>
                  <span class="error">
                    <?php echo $emailExistsErr ?>
                  </span>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!--#####################################################################################################################################-->
      <!-- Edit POP UP FORM (Bootstrap MODAL) -->
      <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Professor Data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="edit_form" action="updatecode.php" method="POST">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">First Name:</label>
                  <input type="text" class="form-control" name="firstname" id="firstname">
                  <input type="hidden" class="form-control" name="userid" id="userid">
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Last Name:</label>
                  <input type="text" class="form-control" name="lastname" id="lastname">
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Email:</label>
                  <input type="text" class="form-control" name="email" id="email">
                </div>
                <div id="error-message"></div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" style="color:black;" class="btn btn-secondary"
                data-bs-dismiss="modal">Close</button>
              <button type="submit" style=" color:black;" form="edit_form" name="update-code-request" id="update-btn"
                class="btn btn-primary">Update Data</button>
            </div>
          </div>
        </div>
      </div>

      <!--#####################################################################################################################################-->

      <!-- Delete POP UP FORM (Bootstrap MODAL) -->
      <!--id of pop up modal form: deletemodal matches javascript function-->
      <div class="modal fade" style="" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Professor</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="activeprofessor.php" method="POST">
              <div class="modal-body">
                <input type='hidden' name='deleteuser' id='deleteuser'>
                <input type='hidden' name='toggleActive' id='toggleActive'>
                <!--Form action activeprofessor.php-->
                <h4>Do you want to delete this professors account access?</h4>
                <h5>You can add this professor again and all section data will still be available</h5>
              </div>
              <div class="modal-footer">
                <button type="button" style="color:black;" class="btn btn-secondary" data-bs-dismiss="modal">Go
                  back</button>
                <!--Delete data will go to this form  action activeprofessor.php-->
                <button type="submit" style="color:black;" name="activeprofessor"
                  class="btn btn-primary">Deactivate</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!--#####################################################################################################################################-->

      <!-- Reactivate POP UP FORM (Bootstrap MODAL) -->
      <!--id of pop up modal form: deletemodal matches javascript function-->
      <div class="modal fade" style="" id="activatemodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Reactivate Professor Account?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="activeprofessor.php" method="POST">
              <div class="modal-body">
                <input type='hidden' name='activateuser' id='activateuser'>
                <input type='hidden' name='toggleActive' id='toggleActive'>
                <h4>Do you want to give this professor account access?</h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go back</button>
                <!--Delete data will go to this form  action adminDashAddProfessors.php-->
                <button type="submit" name="activateProfessor" class="btn btn-primary">Reactivate</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Container for activated and deactivated professor accounts -->

      <!-- Professor-container div -->
      <div class="professors-container">
        <div class="activated">
          <div class="container">
            <section class="ftco-section">
              <div class="table-scroll">
                <table class="u-full-width geeks" id=professors_table>
                  <div class="professor-edit" id="professorEditPopUP">
                    <h3>Activated Professor Accounts</h3>
                    <input type="text" id="activatedSearch" onkeyup="activatedSearchFunction()"
                      placeholder="Search for activated...">
                    <tr>
                      <div class="input-group">
                        <th>Name</th>
                      </div>
                      <div class="input-group">
                        <th>Edit Professor</th>
                      </div>
                      <div class="input-group">
                        <th>Deactivate Professor</th>
                      </div>
                    </tr>
                    <!--Connecting to Users Table-->
                    <?php
                    $userView = new UsersView();
                    $query_run = $userView->professorInfo();
                    $userid = "";
                    //show only professors with account access
                    if ($query_run) {
                      foreach ($query_run as $row) {
                        ?>
                        <!--Professors Table-->
                        <tbody>
                          <tr>
                            <td style="display:none;">
                              <?php echo $row['userid']; ?>
                            </td>
                            <td>
                              <?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
                            </td>
                            <td style="display:none;">
                              <?php echo $row['lastname']; ?>
                            </td>
                            <td style="display:none;">
                              <?php echo $row['email']; ?>
                            </td>
                            <td class="button-cell">
                              <button type="button " class="btn btn-sucess editbtn">Edit</button>
                            </td>
                            <td class="button-cell">
                              <button type="button" class="btn btn-delete deletebtn">Deactivate</button>
                            </td>
                          </tr>
                        </tbody>
                        <?php
                      }
                    } else {
                      echo "No Records Found";
                    }
                    ?>
                  </div>
                </table>
              </div>
            </section>
          </div>
        </div>

        <!-- Deactivated Box  -->

        <div class="deactivated">
          <div class="container">
            <div class="professor-edit" id="professorEditPopUP">
              <section class="ftco-section">
                <div class="table-scroll">
                  <table id="deactivated_professors_table">
                    <h3>Deactivated Professor Accounts</h3>
                    <input type="text" id="deactivatedSearch" onkeyup="deactivatedSearchFunction()"
                      placeholder="Search for deactivated...">
                    <tr>
                      <div class="input-group">
                        <th>Name</th>
                      </div>
                      <div class="input-group">
                        <th>Edit Professor</th>
                      </div>
                      <div class="input-group">
                        <th>Activate Professor</th>
                      </div>
                    </tr>
                    <!--Connecting to Users Table-->
                    <?php
                    $userView = new UsersView();
                    $query_run = $userView->professorInfoDeactive();
                    $userid = "";
                    if ($query_run) {
                      foreach ($query_run as $row) {
                        if ($row['activeUser'] == 0) {
                          ?>
                          <!--Professors Table-->
                          <tbody>
                            <tr>
                              <td style="display:none;">
                                <?php echo $row['userid']; ?>
                              </td>
                              <td>
                                <?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
                              </td>
                              <td style="display:none;">
                                <?php echo $row['lastname']; ?>
                              </td>
                              <td style="display:none;">
                                <?php echo $row['email']; ?>
                              </td>
                              <td class="button-cell">
                                <button type="button " class="btn btn-sucess editbtn">Edit</button>
                              </td>
                              <!-- Activate professor button -->
                              <td class="button-cell">
                                <button type="button" class="btn btn-delete addbtn">Activate</button>
                              </td>
                            </tr>

                          </tbody>
                          <?php
                        }
                      }
                    } else {
                      echo "No Records Found";
                    }
                    ?>
                  </table>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"
        integrity="sha512-6UofPqm0QupIL0kzS/UIzekR73/luZdC6i/kXDbWnLOJoqwklBK6519iUnShaYceJ0y4FaiPtX/hRnV/X/xlUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Javascript for the deactivate user button -->
      <script>
        $(document).ready(function () {
          // when the deletetn class is clicked
          $('.deletebtn').on('click', function () {
            //id of delete pop modal
            $('#deletemodal').modal('show');
             // gets reference to closests tr
            $tr = $(this).closest('tr');
             // gets data for each td and puts in array
            var data = $tr.children("td").map(function () {
              return $(this).text();
            }).get();
            // sets value of the activateuser form field to item in array
            $('#deleteuser').val(data[0]);
          });
        });
      </script>

      <!-- Javascript fur the Reactivate User Button -->
      <script>
        $(document).ready(function () {
          // the button with the addbtn class is clicked
          $('.addbtn').on('click', function () {
            //modal is displayed
            $('#activatemodal').modal('show');
            // gets reference to closests tr
            $tr = $(this).closest('tr');
            // gets data for each td and puts in array
            var data = $tr.children("td").map(function () {
              return $(this).text();
            }).get();
            // sets value of the activateuser form field to item in array
            $('#activateuser').val(data[0]);
          });
        });
      </script>

      <!-- Javascript for the Edit Professor pop up modal -->
      <script>
        $(document).ready(function () { //execute document
          $('.editbtn').on('click', function () { //eidtbtn is clicked in Active Professors Table
            $('#editmodal').modal('show'); //shows pop up modal
            $tr = $(this).closest('tr'); //gets the tr 
            var data = $tr.children("td").map(function () { // get data from the professors table                  
              return $(this).text();
            }).get();
            //auto fills the form with the professor data from the database
            $('#userid').val(data[0]);
            var fullName = data[1].trim().split(' ');
            $('#firstname').val(fullName[0]);
            $('#lastname').val(fullName.slice(1).join(' '));
            $('#email').val(data[3].trim());  //trims white space in modal
          });
          // Handles the "update" button in the pop up modal
          $("#edit_form").on("submit", function (event) {

            $("#error-message").empty();  // clear previous error messages
            //gets professor data
            var firstName = document.querySelector("#userid").value;
            var firstName = document.querySelector("#firstname").value;
            var lastName = document.querySelector("#lastname").value;
            var email = document.querySelector("#email").value;
            var errorMessage = "";

            //error handling for a blank firstname field 
            if (firstName.trim() == "") {

              errorMessage += "First name is required.<br>";
              // prevent form submission
              event.preventDefault();
            }
            //error handling for a blank last name feild 
            if (lastName.trim() == "") {
              errorMessage += "Last name is required.<br>";
              // prevent form submission
              event.preventDefault();
            }
            //error handling for a balnk email feild
            if (email.trim() == "") {
              errorMessage += "Email is required.<br>";
              // prevent form submission
              event.preventDefault();
            }
            //error handling for the wrong email
            if (email.trim() == "" || !/wayne\.edu/.test(email.trim())) {
              errorMessage += "Email must be a valid @wayne.edu email address.<br>";
              // prevent form submission
              event.preventDefault();
            }
            //displays thr error messages in the modal
            if (errorMessage != "") {
              $('#error-message').html(errorMessage);

            }
            //Submits the form if there are no error messages
            else {
              $('#error-message').html('');
              // submit the form
              $("#edit_form").unbind('submit').submit();
            }
          });

        });
      </script>

      <!-- Seach bars for the activated and deactivates professors table -->
      <script>
        //retreive the search function to be filtered. 
        function activatedSearchFunction() {
          //references
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("activatedSearch");
          filter = input.value.toUpperCase();
          table = document.getElementById("professors_table");
          tr = table.getElementsByTagName("tr");
          // for loop over each tr and td in the table
          for (i = 0; i < tr.length; i++) {
            // gets the first name and last name of the professor
            td = tr[i].getElementsByTagName("td")[1]; //choose [1] since the first name and last name are combined in the second column.
            if (td) {
              // get values in the td
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                // show row
                tr[i].style.display = "";
              } else {
                // hide row
                tr[i].style.display = "none";
              }
            }
          }
        }

        //retreive the search function to be filtered. 
        function deactivatedSearchFunction() {
        //references
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("deactivatedSearch");
          filter = input.value.toUpperCase();
          table = document.getElementById("deactivated_professors_table");
          tr = table.getElementsByTagName("tr");
           // for loop over each tr and td in the table
          for (i = 0; i < tr.length; i++) {
            // gets the first name and last name of the professor
            td = tr[i].getElementsByTagName("td")[1]; // We choose [1] since the first name and last name are combined in the second column.
            if (td) {
              // get values in the td
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
              // show row
                tr[i].style.display = "";
              } else {
                // hide row
                tr[i].style.display = "none";
              }
            }
          }
        }


      </script>

      <!-- Script for setting a time limit for the alret message -->
      <script>
        setTimeout(function () {
          const alertMessage = document.getElementById('alert-message');
          if (alertMessage) {
            alertMessage.style.opacity = 0;
          }
        }, 3000); /*Displays alert for 3 seconds */
      </script>


</body>

</html>