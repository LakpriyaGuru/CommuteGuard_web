<?php

require_once 'connection.php';

$email = $_POST['email'];
$apiKey = $_POST['apiKey'];

if (!empty($email) && !empty($apiKey)) {
    if ($conn) {
        $sql = "SELECT * FROM user WHERE userEmail = '" . $email . "' AND apiKey = '" . $apiKey . "'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            $sqlUpdate = "UPDATE user SET apiKey = '' WHERE userEmail = '" . $email . "'";

            if (mysqli_query($conn, $sqlUpdate)) {
                echo "success";
            } else {
                echo "Logout Failed";
            }
        } else {
            echo "Unauthorized Access";
        }
    } else {
        echo "Database Connection Failed";
    }
} else {
    echo "All fields are Required";
}

?>