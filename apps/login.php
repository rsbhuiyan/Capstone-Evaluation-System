<?php
session_start();
include 'includes/class.autoload.inc.php';
?>
<!doctype html>
<!-- starting a session allows us to store session variabels and send them to other pages -->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
  <link rel="stylesheet" style="text/css" href="styles/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <style>
   

body {
  margin: 0;
  padding: 0;
  background-color: var(--background-color);
  font-family: 'Roboto', sans-serif;
  /* color optimization */
  line-height: 1.6;
  /* Increase line-height for better readability */
  font-size: 18px;
}

  </style>
</head>

<body>
<nav class="navbar fixed-top" style="background-color:#008C81">
    <div class="container-fluid">

      <h3 class = "capTitle"><a class = "titleLabel"
          style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;">Capstone
          Course Evaluation System</a></h3>
          <img class = "wsuimg"style="width:40px; height:40px;display: inline-block;"src="images/wsulogo.svg.png" alt="Wayne State University Logo">
    </div>
  </nav>
  <?php
  //create variables
  $action = isset($_POST['action']) ? $_POST['action'] : null;
  $email = isset($_POST["email"]) ? $_POST["email"] : "";
  $emailErr = "";
  $passwordError = "";
  $isError = false;

  //switch case allows for login and password to show different
  switch ($action) {
    case 'login':
      if (empty($_POST["email"])) {
        $emailErr = "* Email is required";
        $isError = true;
      } else {
        $email = $_REQUEST['email'];
        $_SESSION['email'] = $email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "* Invalid email";
          $email = "";
          $isError = true;
        }
        //UserView object to do query calls
        $userobj = new UsersView();
        $passwordSet = $userobj->emailCheck($email);
        if (!$passwordSet) {
          $emailErr = "* Sorry that email is not in our database. Please seek out an admin for assistance.";
          $email = "";
          $isError = true;
        }
      }

      if (!$isError) {
        $passexists = $userobj->passwordSet($email);
        if (!$passexists) {
          echo "<script>window.location.href='reset-password.php';</script>";
          exit;
        } else {
          ?>
          <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
              document.getElementById("emailForm").style.display = 'none';
              document.getElementById("passwordForm").style.display = 'block';
            });
          </script>
          <?php
        }
      }
      break;
    case 'other':
      //userview object to test if password is set and to get the password if so
      $userobj = new UsersView();
      $passexists = $userobj->passwordSet($email);
      if ($passexists) {
        $currentPass = $userobj->getthePassword($email);
      } else {
        $currentPass = null;
      }
      //create variables
      $pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
      //test errors
      if (empty($_POST["pass"])) {
        $passwordError = "* Password is required";
        $pass = "";
        $isError = true;
        ?>
        <script type="text/javascript">
          document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("emailForm").style.display = 'none';
            document.getElementById("passwordForm").style.display = 'block';
          });
        </script>
        <?php
      } else {
        $pass = $_REQUEST['pass'];
        $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
        if (!(password_verify($pass, $currentPass))) {
          $passwordError = "*Sorry that password didnt work try again";
          $pass = "";
          $isError = true; ?>
          <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
              document.getElementById("emailForm").style.display = 'none';
              document.getElementById("passwordForm").style.display = 'block';
            });
          </script>
          <?php
        }
      }


      if (!$isError) {
        if ($passexists) {

          if (password_verify($pass, $currentPass)) {
            $_SESSION['loggedin'] = true;
            if (isset($_POST["srcloc"])) {
              $util = new Apputil();
              $util->redirect_location($_POST["srcloc"]);
            } else {
              $role = $userobj->gettheRole($email);
              if ($role == "admin") { ?>
                <script>
                  document.location.href = 'chooseSemester.php';
                </script>
                <?php
              } else if ($role == "professor") { ?>
                  <script>
                    document.location.href = 'profDash.php';
                  </script>
                <?php
              } else { ?>
                  <script>
                    document.location.href = 'gtaDash.php';
                  </script>
                <?php
              }
            }
          }
        } else {
          $passwordError = "* Sorry that password didnt work. Try again";
        } ?>
        <script type="text/javascript">
          document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("emailForm").style.display = 'none';
            document.getElementById("passwordForm").style.display = 'block';
          });
        </script>
        <?php
      } //isError     
      break;
  } ?>
  <!-- html form code -->
  <section class="ftco-section rounded">
    <div class="container">
      <div class="row justify-content-center">
        <div class="">
          <div class="wrap">
            <div class="login-wrap ">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="emailForm" method="POST"
                class="signin-form">
                <div class="d-flex">
                  <div class="w-100 text-center">
                    <h1 class="mb-4">Sign In</h1>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <label class="form-control-placeholder col-25" for="username">Username:</label>
                  <input type="hidden" name="action" value="login">
                  <?php
                  if (isset($_GET["srcloc"]) || isset($_POST["srcloc"])) {
                    $srcloc = isset($_GET["srcloc"]) ? $_GET["srcloc"] : $_POST["srcloc"];
                    echo "<input type=\"hidden\" name=\"srcloc\" value=\"" . htmlspecialchars($srcloc) . "\" >\n";
                  } ?>
                  <input type="text" autofocus class="form-control col-75" name="email" value=""
                    placeholder="example@wayne.edu" autocomplete="off" />
                  <span class="error">
                    <?php echo $emailErr; ?>
                  </span>
                </div>
                <div class="form-group mt-3">
                  <input style="background:#88D7C0; color: black; font-weight:bold;"
                    class="form-control btn btn-block mb-4 rounded" type="submit" name="submit" value="Next" />
                </div>
              </form>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="passwordForm"
                style="display: none;" method="POST" class="signin-form">
                <div class="d-flex">
                  <div class="w-100">
                    <h1 class="mb-4 text-center">Sign In</h1>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <label class="form-control-placeholder col-25"" for=" username">Password:</label>
                  <input type="hidden" name="action" value="other">
                  <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                  <?php
                  if (isset($_GET["srcloc"]) || isset($_POST["srcloc"])) {
                    $srcloc = isset($_GET["srcloc"]) ? $_GET["srcloc"] : $_POST["srcloc"];
                    echo "<input type=\"hidden\" name=\"srcloc\" value=\"" . htmlspecialchars($srcloc) . "\" >\n";
                  } ?>
                  <input type="password" name="pass" autofocus class="form-control col-75" placeholder="password"
                    autocomplete="off" />

                  <span class="error">
                    <?php echo $passwordError; ?>
                  </span>
                </div>
                <!-- <div class="form-group mt-3" id="passwordConfirmBlock" style ="display:none;">
                <label class="form-control-placeholder" for="username">Confirm Password:</label>
                <input type="hidden" name="action" value="other">
                <input type="hidden" name = email value="<?php echo htmlspecialchars($email); ?>" >
                
                <input type="password" name="passConfirm" class="form-control" placeholder = "password" autocomplete="off"  />
                <span class = "error"> <?php echo $passwordCError; ?></span>
              </div> -->
                <div class="form-group mt-3">
                  <input style="background:#88D7C0; color: black;" class="form-control btn btn-block mb-4 rounded"
                    type="submit" name="submit" value="Submit" />
                </div>
                <?php
                if (isset($_GET["newpwd"])) {
                  if ($_GET["newpwd"] == "passwordupdated") {
                    echo "<p> your password has been reset!</p>";
                  }
                }
                ?>
                <a style="color:black" href="reset-password.php">Forgot password?</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>