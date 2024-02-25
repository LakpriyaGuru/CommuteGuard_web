<?php

require_once 'connection.php';

$email = $_POST['email'];
$apiKey = $_POST['apiKey'];
$shiftMorning = $_POST['shiftMorning']; // Get the status of the shift from the POST data
$shiftAfternoon = $_POST['shiftAfternoon']; // Get the status of the shift from the POST data
$result = array();

if (!empty($email) && !empty($apiKey) && isset($shiftMorning) && isset($shiftAfternoon)) {
    if ($conn) {
        // Query to retrieve the childID based on the user's email and API key
        $childIDQuery = "SELECT c.childID FROM child c INNER JOIN user u ON c.userID = u.userID WHERE u.userEmail = '$email' AND u.apiKey = '$apiKey'";
        $childIDResult = mysqli_query($conn, $childIDQuery);

        if (mysqli_num_rows($childIDResult) > 0) {
            $childRow = mysqli_fetch_assoc($childIDResult);
            $childID = $childRow['childID'];

            // Insert shift status into the 'shift' table using childID
            $insertSql = "INSERT INTO shift (childID, shiftMorning, shiftAfternoon) VALUES ('$childID', '$shiftMorning', '$shiftAfternoon')
            ON DUPLICATE KEY UPDATE shiftMorning = VALUES(shiftMorning), shiftAfternoon = VALUES(shiftAfternoon)";

            if (mysqli_query($conn, $insertSql)) {
                $result = array("status" => "success", "message" => "Shift Status Updated Successfully");
            } else {
                $result = array("status" => "failed", "message" => "Error: " . mysqli_error($conn));
            }
        } else {
            $result = array("status" => "failed", "message" => "Child not found for the given user");
        }
    } else {
        $result = array("status" => "failed", "message" => "Database Connection Failed");
    }
} else {
    $result = array("status" => "failed", "message" => "All fields are Required");
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>