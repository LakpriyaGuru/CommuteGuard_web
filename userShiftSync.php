<?php

require_once 'connection.php';

$email = $_POST['email'];
$apiKey = $_POST['apiKey'];
$shiftMorning = $_POST['shiftMorning']; // Get the status of the shift from the POST data
$shiftAfternoon = $_POST['shiftAfternoon']; // Get the status of the shift from the POST data
$result = array();

if (!empty($email) && !empty($apiKey) && isset($shiftMorning) && isset($shiftAfternoon)) {
    if ($conn) {
        $sql = "SELECT * FROM user WHERE userEmail = '$email' AND apiKey = '$apiKey'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) != 0) {
            // Fetch user data
            $row = mysqli_fetch_assoc($res);
            // Insert shift status into the 'shift' table
            $insertSql = "INSERT INTO shift (childID, shiftMorning, shiftAfternoon) VALUES ('" . $row['userID'] . "', '$shiftMorning', '$shiftAfternoon')
            ON DUPLICATE KEY UPDATE shiftMorning = VALUES(shiftMorning), shiftAfternoon = VALUES(shiftAfternoon)";

            if (mysqli_query($conn, $insertSql)) {
                $result = array("status" => "success", "message" => "Shift Status Updated Successfully");
            } else {
                $result = array("status" => "failed", "message" => "Error: " . mysqli_error($conn));
            }
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