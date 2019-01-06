<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';


sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
    <title>Login V3</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
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
    <!--===============================================================================================-->
</head>
<body>
<script>

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            document.getElementById("buttonLogin").innerHTML = "<button class=\"login100-form-btn\" " +
                "onclick=\"formhash(this.form, this.form.password);\"> Login <button>";
            document.getElementById("2FBLogin").style.display = "none";
            document.getElementById("2FBLogin").style.visibility = "hidden";
        } else {
            // The person is not logged into your app or we are unable to tell.
            document.getElementById("buttonLogin").innerHTML = '<button class="login100-form-btn" ' +
                'onclick="formhash(this.form, this.form.password);"> Login <button>';
            document.getElementById("1FBLogin").style.display = "none";
            document.getElementById("1FBLogin").style.visibility = "hidden";
        }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
var name
    function checkLoginState() {
        FB.getLoginStatus(function(response) {

            if (response.status === 'connected') {
                FB.api('/me', { locale: 'en_US', fields: 'name, email,id' },
                    function(response) {
                        name = response.name;
                        var email = response.email;
                        var id = response.id;

                    });
                console.log(name);
                window.top.location = "includes/process_fb_login.php";
            }else{
                alert("Failed to login");
            }
        });
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '2636075996618040',
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v3.2' // use graph api version 2.8
        });

        // Now that we've initialized the JavaScript SDK, we call
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });

    };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
            console.log('Successful login for: ' + response.name);
        });
    }

    function sendAJAX(){
        $.ajax({
            type : "POST",
            url : 'includes/process_fb_login.php',
            dataType : "text",
            data : JSON.stringify(name),
            success : function (data) {
                alert(data); // show response from the php script.
            },
            error : function() {
                alert("error");
            }
        });
        console.log(name);
        window.top.location = "includes/process_fb_login.php";
    }
</script>
<?php
if (isset($_GET['error'])) {
    echo '<p class="error" align="center">Error Logging In!</p>';
}
?>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
            <div class="login100-form-title">
                <!--<?php
                if (login_check($mysqli) == true) {
                    echo '<p style="color:white;">Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';

                    echo '<p><a href="includes/logout.php">Log out</a>.</p>';
                } else {
                    echo '<p style="color:white;">Currently logged ' . $logged . '.</p>';
                    echo "<p style='color:white;'>If you don't have a login, please <a href='register.php'>register<br></a></p>";
                }
                ?>-->
            </div>
            <form action ="includes/process_login.php" method="post" name="login_form" class="login100-form validate-form">
					<span class="login100-form-logo"><!-- mayfield logo-->
                        <img width="200px" src="images/MFSHLogo.png"/>
					</span>

                <span class="login100-form-title p-b-17 p-t-27">
						Log in
					</span>

                <div class="container-login100-form-btn p-b-20" id="1FBLogin">
                    <div class="fb-login-button" onlogin="checkLoginState();" data-max-rows="1" data-size="large"
                         data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false"
                         data-use-continue-as="true" data-scope="public_profile,email" action="checkLoginState()" ></div>
                </div>
                <div class="container-login100-form-btn">
                <button onclick="sendAJAX()">
                    POST
                </button>
                <div Class="login100-form-title">
                    <h6><i>or</i></h6>
                </div>

               <div class="wrap-input100 validate-input" data-validate = "Enter email">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="contact100-form-checkbox">
                    <a href="register.php"><h6><u>Register</u></h6></a>
                </div>
                <div class="container-login100-form-btn"><!-- For regular login button -->
                    <div id="buttonLogin"></div>
                </div>
                <div class="container-login100-form-btn"><!-- For Facebook button -->
                    <div id="2FBLogin">
                        <div class="fb-login-button" onlogin="checkLoginState();" data-max-rows="1" data-size="large"
                             data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false"
                             data-use-continue-as="true" data-scope="public_profile,email" action="checkLoginState()" ></div>
                        </div>
                    </div>
                </div>
                <div class="text-center p-t-90">
                    <a class="txt1" href="#">
                        Forgot Password?
                    </a>
                </div>
            </form>
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