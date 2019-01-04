<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100">
                <div class="login100-form-title p-t-0 p-b-20">
                    <!-- Registration form to be output if the POST variables are not
                    set or if the registration script caused an error. -->
                    Register with us
                </div>
                <div class="p-b-20">
                    <?php
                    if (!empty($error_msg)) {
                        echo $error_msg;
                    }
                    ?>
                </div>
                    <!--
                       <ul>
                            <li>Usernames may contain only digits, upper and lowercase letters and underscores</li>
                            <li>Emails must have a valid email format</li>
                            <li>Passwords must be at least 6 characters long</li>
                            <li>Passwords must contain
                                <ul>
                                    <li>At least one uppercase letter (A..Z)</li>
                                    <li>At least one lowercase letter (a..z)</li>
                                    <li>At least one number (0..9)</li>
                                </ul>
                            </li>
                            <li>Your password and confirmation must match exactly</li>
                        </ul>
                    -->
                    <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>"
                            method="post"
                            name="registration_form">
                        <div class="wrap-input100 validate-input" data-validate = "Enter Username">
                            <input class="input100" type="text" name="username" placeholder="Username" id="username">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>
                       <!-- Username: <input type='text'
                            name='username'
                            id='username' /><br>-->
                        <div class="wrap-input100 validate-input" data-validate = "Enter email">
                            <input class="input100" type="text" name="email" placeholder="Email">
                            <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="password" id="password" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Confirm password">
                            <input class="input100" type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm Password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                            <!-- Password: <input type="password"
                                         name="password"
                                         id="password"/><br>
                        Confirm password: <input type="password"
                                                 name="confirmpwd"
                                                 id="confirmpwd" /><br>-->
                        <div class="container-login100-form-btn">
                                <button class="login100-form-btn"
                                   value="Register"
                                   onclick="return regformhash(this.form,
                                                   this.form.username,
                                                   this.form.email,
                                                   this.form.password,
                                                   this.form.confirmpwd);">Register
                                </button>
                        </div>
                        </form>
                    <div class="login100-form-title text-left p-t-15">
                        <p>Return to the <a href="index.php"><u>login page</u></a>.</p>
                    </div>
                </div>
            </div>
        </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

    </body>
</html>