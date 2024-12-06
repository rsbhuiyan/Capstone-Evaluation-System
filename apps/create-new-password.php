<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Password</title>
    <link rel="icon" type="image/x-icon" href="images/wsulogo.svg.png">
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
        }

        textarea:focus,
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="datetime"]:focus,
        input[type="datetime-local"]:focus,
        input[type="date"]:focus,
        input[type="month"]:focus,
        input[type="time"]:focus,
        input[type="week"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="url"]:focus,
        input[type="search"]:focus,
        input[type="tel"]:focus,
        input[type="color"]:focus,
        .uneditable-input:focus {
            border-color: #008C81;
            box-shadow: 0 0 0 0.2rem rgba(0, 140, 129, 0.25);
            outline: 0 none;
        }

        html,
        body {
            margin: 0;
            height: 100%;

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

        .ftco-section {
            background-color: var(--section-bg-color);
            margin: auto;
            color: var(--input-text-color);
            box-sizing: border-box;
            padding: 70px 30px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, .05), 2px 2px 5px rgba(0, 0, 0, .1);
            width: 50%;
        }

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

        label {
            font-size: 20px;
        }

        h2 {
            margin-left: 20px;
        }

        .error {
            color: #FF6E6B;
            font-size: 18px;
        }

        p {
            font-size: 20px;
        }

        h3.capTitle {
            margin-left: 870px;
        }

        .ftco-section {
            margin-top: 8%;
        }

        @media only screen and (max-width: 950px) {
            .ftco-section {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                margin-top: 30%;
            }

            h3.capTitle {
                margin-left: 0px;
            }

            a.titleLabel {
                font-size: 20px;
            }

            img.wsuimg {
                margin-top: -40px;
                margin-left: 320px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar fixed-top" style="background-color:#008C81">
        <div class="container-fluid">
            <h3 class="capTitle"><a class="titleLabel"
                    style="color:#F3F7FC; text-decoration:none; text-shadow: .7px .7px #000000;"
                    href="profDash.php">Capstone
                    Course Evaluation System</a></h3>
            <img class="wsuimg" style="width:40px; height:40px;display: inline-block;" src="images/wsulogo.svg.png"
                alt="Wayne State University Logo">
        </div>
    </nav>

    <section class="ftco-section rounded ">
        <div class="">
            <div class="row justify-content-center">
                <div class="wrap">
                    <div class="wrapper-main">
                        <?php
                        $selector = $_GET["selector"];
                        $validator = $_GET["validator"];

                        if (empty($selector) || empty($validator)) {
                            echo "Could not validate your request!";
                        } else {
                            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                                ?>
                                <form action="includes/reset-password.inc.php" method="post">
                                    <h1 style="text-align:center;">Set Password!</h1>

                                    <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                    <input type="hidden" name="validator" value="<?php echo $validator ?>">
                                    <div class="form-group mt-3">
                                        <label class="form-control-placeholder" class="form-control" for="pwd">Password:</label>
                                        <input type="password" class="form-control" name="pwd" placeholder="">
                                        <?php if (isset($_SESSION['passwordError'])) { ?>
                                            <span style="color: red">
                                                <?php
                                                if (isset($_SESSION["passwordError"])) {
                                                    $error = $_SESSION["passwordError"];
                                                    unset($_SESSION["passwordError"]);
                                                    echo $error;
                                                    $error = "";
                                                } else {
                                                    $error = "";
                                                }
                                                $error = "";
                                                ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-control-placeholder" class="form-control" for="pwd-repeat">Repeat
                                            Password:</label>
                                        <input type="password" class="form-control" name="pwd-repeat">
                                        <?php if (isset($_SESSION['passwordCError'])) { ?>
                                            <span style="color: red">
                                                <?php
                                                if (isset($_SESSION["passwordCError"])) {
                                                    $error = $_SESSION["passwordCError"];
                                                    unset($_SESSION["passwordCError"]);
                                                    echo $error;
                                                    $error = "";
                                                } else {
                                                    $error = "";
                                                }
                                                $error = "";
                                                ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button class="btn" type="submit" name="reset-password-submit">Set Password!</button>
                                    </div>
                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>