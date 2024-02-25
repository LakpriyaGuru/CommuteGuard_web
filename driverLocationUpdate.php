<?php

require_once 'connection.php';

$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$email = $_POST['email']; // Get the last update time from the POST data
$result = array();

if (!empty($longitude) && !empty($latitude) && !empty($email)) {
    if ($conn) {
        // Query to get driverID based on email
        $driverIDQuery = "SELECT driverID FROM driver WHERE driverEmail = '$email'";
        $driverIDResult = mysqli_query($conn, $driverIDQuery);

        if ($driverIDResult && mysqli_num_rows($driverIDResult) > 0) {
            $row = mysqli_fetch_assoc($driverIDResult);
            $driverID = $row['driverID'];

            // Use driverID in the INSERT query
            $sql = "INSERT INTO location (locationLongitude, locationLatitude, driverID) VALUES ('$longitude', '$latitude', '$driverID') ON DUPLICATE KEY UPDATE locationLongitude = VALUES(locationLongitude), locationLatitude = VALUES(locationLatitude)";
            if (mysqli_query($conn, $sql)) {
                $result = array("status" => "success", "message" => "Location Updated Successfully");
            } else {
                $result = array("status" => "failed", "message" => "Error: " . mysqli_error($conn));
            }
        } else {
            $result = array("status" => "failed", "message" => "Driver not found for the provided email");
        }
    } else {
        $result = array("status" => "failed", "message" => "Database Connection Failed");
    }
} else {
    $result = array("status" => "failed", "message" => "All fields are Required");
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>