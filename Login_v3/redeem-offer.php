<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
?>
<html>
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
<body onload="document.getElementById('code').style.display = 'none'">
<?php
if (login_check($mysqli) == true) {
/*    $sql = $mysqli->prepare("select username from memberinfo where username = ".$_SESSION['username'].";");
    $sql->execute();
    $sql->store_result();
    // get variables from result.
    $sql->bind_result($user_id, $username, $db_password);
    $sql->fetch();*/
    $code = generateRandomString();
    $stmt = $mysqli->prepare("insert into memberinfo(id,username,code,dateAdded)
                              values('".$_SESSION['user_id']."','".$_SESSION['username']."','$code',now());");
    $stmt->execute();
    //$mysqli = $stmt;
} else {
    $logged = 'out';
}

function generateRandomString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
<script>

    var showtimer;
    var alreadyredeemed = "This code has already been redeemed";

function retrieveCode() {
    document.getElementById("redeemOffer").style.display = "none";
    document.getElementById("code").style.display = "block";
    $.ajax({    //create an ajax request to get_code.php
        type: "GET",
        url: "get_code.php",
        dataType: "html",   //expect html to be returned
        success: function (response) {
            $("#code").html(response);
            showtimer = response;
            showTimer();
        }

    });

}
function showTimer(){
    if (showtimer === alreadyredeemed){
        console.log("already been redeemed")
    } else {
        redeemOffer()
    }

}
function redeemOffer() {

    var tenMinutes = 60 * 10,
        display = document.querySelector('#time');
    startTimer(tenMinutes,display);

}

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            document.getElementById("offer").innerHTML = "Offer expired";
        }
    }, 1000);
}
</script>
<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
            <div class="login100-form-title">
                Redeem Offer:
                <h6 class="p-b-10">insert blurb here</h6>
            </div>
            <div class="container-login100-form-btn" id="redeemOffer"><!-- For regular login button -->
                <button class="login100-form-btn p-b-25" id="buttonRedeem" onclick="retrieveCode()" >Redeem</button>
            </div>
            <div class="login100-form-code" id="code"></div>
            <div class="login100-form-timer p-t-10" id="timer">
                <span id="time"></span>
            </div>
</body>
</html>
