<?php
include_once 'includes/psl-config.php';
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if($stmt = $mysqli->prepare("select redeemed from memberinfo 
                                    where id = ".$_SESSION['user_id']." 
                                    and redeemed = true"));{
    $stmt->execute();    // Execute the prepared query.
    $stmt->store_result();
    // get variables from result.
    $stmt->fetch();

    if ($stmt->num_rows == 1) { //if returned 1 row for the user where they have already redeemed the offer
        echo "This code has already been redeemed";
    } else {
        $sql = "select code from memberinfo where id = ".$_SESSION['user_id'];
        $result = $mysqli->query($sql);
        while($row = $result->fetch_assoc()) {
            echo $row['code'];

           if($updatesql = $mysqli->prepare("update memberinfo 
                                                  set redeemed = true, redeemedDate = now() 
                                                  where id = ".$_SESSION['user_id']));{
                $updatesql->execute();
            }
        }
    }
}
?>