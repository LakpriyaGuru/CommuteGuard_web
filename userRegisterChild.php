<?php

require_once 'connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$grade = $_POST['grade'];
$school = $_POST['school'];
$result = array();

// Function to validate date format
function isValidDateFormat($date)
{
    return preg_match("/^\d{4}-\d{2}-\d{2}$/", $date);
}

// Function to validate the number of days for each month
function isValidDate($date)
{
    $parts = explode('-', $date);
    if (count($parts) != 3) {
        return false;
    }
    $year = intval($parts[0]);
    $month = intval($parts[1]);
    $day = intval($parts[2]);
    return checkdate($month, $day, $year);
}

if (!empty($name) && !empty($dob) && !empty($grade) && !empty($school) && !empty($email)) {
    // Check if date of birth is in valid format
    if (!isValidDateFormat($dob)) {
        $result = array("status" => "failed", "message" => "Invalid date of birth format. Please use YYYY-MM-DD format.");
    } elseif (!isValidDate($dob)) {
        $result = array("status" => "failed", "message" => "Invalid date of birth. Please provide a valid date.");
    } else {
        if ($conn) {
            // Get schoolID from school relation
            $schoolQuery = "SELECT schoolID FROM school WHERE schoolName = '$school'";
            $schoolResult = mysqli_query($conn, $schoolQuery);
            if ($schoolRow = mysqli_fetch_assoc($schoolResult)) {
                $schoolID = $schoolRow['schoolID'];

                // Get userID from user relation
                $userQuery = "SELECT userID FROM user WHERE userEmail = '$email'";
                $userResult = mysqli_query($conn, $userQuery);
                if ($userRow = mysqli_fetch_assoc($userResult)) {
                    $userID = $userRow['userID'];

                    // Insert child data into child table
                    $insertQuery = "INSERT INTO child (childName, childDOB, childGrade, schoolID, userID) VALUES ('$name', '$dob', '$grade', '$schoolID', '$userID')";
                    if (mysqli_query($conn, $insertQuery)) {
                        $result = array("status" => "success", "message" => "Registration Successfully");
                    } else {
                        $result = array("status" => "failed", "message" => "Registration Failed, Try Again");
                    }
                } else {
                    $result = array("status" => "failed", "message" => "User not found");
                }
            } else {
                $result = array("status" => "failed", "message" => "School not found");
            }
        } else {
            $result = array("status" => "failed", "message" => "Database Connection Failed");
        }
    }
} else {
    $result = array("status" => "failed", "message" => "All fields are Required");
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>