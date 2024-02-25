<?php

require_once 'connection.php';

$email = $_POST['email'];
$apiKey = $_POST['apiKey'];
$result = array();

if (!empty($email) && !empty($apiKey)) {
    if ($conn) {
        $sql = "SELECT * FROM driver WHERE driverEmail = '" . $email . "' and apiKey = '" . $apiKey . "'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            $result = array("status" => "success", "message" => "Data Fetched Successfully", "name" => $row['driverName'], "email" => $row['driverEmail'], "contact" => $row['driverContact']);
        } else {
            $result = array("status" => "failed", "message" => "Unauthorized Access");
        }
    } else {
        $result = array("status" => "failed", "message" => "Database Connection Failed");
    }
} else {
    $result = array("status" => "failed", "message" => "All fields are Required");
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>