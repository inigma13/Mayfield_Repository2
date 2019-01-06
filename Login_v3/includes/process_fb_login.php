<?php
include_once 'db_connect.php';
include_once 'psl-config.php';

//$error_msg = "";
//if (isset($_POST['data'])) {//, $_POST['email'], $_POST['id'])) {
print_r($_POST);
var_dump($_POST);
//}
    /*// Sanitize and validate the data passed in
    $name = $_POST['name'];
    $email = $_POST['response.email'];
    $id = $_POST['response.id'];
    $name = $_POST['name'];
    echo($_POST['name']);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //

    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    // check existing email
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            header("Location: ../redeem-offer.php");
            $stmt->close();
        }
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
        $stmt->close();
    }

    // TODO:
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.*/

    /*if (empty($error_msg)) {
        $code = generateRandomString();

        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO memberinfo (name, email, id,code,dateadded) VALUES (?, ?, ?,'$code',now())")) {
            $insert_stmt->bind_param('sss', $name, $email, $uid);
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ../redeem-offer.php');
    }*/

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