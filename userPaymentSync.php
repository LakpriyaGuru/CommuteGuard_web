<?php

require_once 'connection.php';

$email = $_POST['email'];
$apiKey = $_POST['apiKey'];
$result = array();

if (!empty($email) && !empty($apiKey)) {
    if ($conn) {
        // First query to get userID
        $userQuery = "SELECT userID FROM user WHERE userEmail = '" . $email . "' AND apiKey = '" . $apiKey . "'";
        $userRes = mysqli_query($conn, $userQuery);

        if (mysqli_num_rows($userRes) != 0) {
            $userRow = mysqli_fetch_assoc($userRes);
            $userID = $userRow['userID'];

            // Second query to get total pay amount using userID
            if (!empty($userID)) {
                $payQuery = "SELECT COALESCE(SUM(amount), 0) AS totalPayAmount FROM payment WHERE userID = '" . $userID . "'";
                $payRes = mysqli_query($conn, $payQuery);

                if ($payRes) {
                    $payRow = mysqli_fetch_assoc($payRes);
                    $result = array("status" => "success", "message" => "Data Fetched Successfully", "totalPayAmount" => $payRow['totalPayAmount']);
                } else {
                    $result = array("status" => "failed", "message" => "Error executing payment query: " . mysqli_error($conn));
                }
            } else {
                // If userID not found in payment relation, return totalPayAmount as 0
                $result = array("status" => "success", "message" => "No payment record found for the user", "totalPayAmount" => 0);
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