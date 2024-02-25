<?php

require_once 'connection.php';

$email = $_POST['email'];
$password = md5($_POST['password']);
$result = array();

// Function to validate email format
function isValidEmailFormat($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to check if the email is registered
function isEmailRegistered($conn, $email)
{
    $query = "SELECT COUNT(*) as count FROM user WHERE userEmail = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}

if (!empty($email) && !empty($password)) {
    // Check if email is in valid format
    if (!isValidEmailFormat($email)) {
        $result = array("status" => "failed", "message" => "Invalid email format");
    } else {
        if ($conn) {
            // Check if email is registered
            if (isEmailRegistered($conn, $email)) {
                $sql = "SELECT * FROM user WHERE userEmail = '" . $email . "'";
                $res = mysqli_query($conn, $sql);

                if (mysqli_num_rows($res) != 0) {
                    $row = mysqli_fetch_assoc($res);

                    if ($email == $row['userEmail'] && $password == $row['userPassword']) {
                        try {
                            $apiKey = bin2hex(random_bytes(23));
                        } catch (Exception $e) {
                            $apiKey = bin2hex(uniqid($email, true));
                        }
                        $sqlUpdate = "UPDATE user SET apiKey = '" . $apiKey . "' WHERE userEmail = '" . $email . "'";

                        if (mysqli_query($conn, $sqlUpdate)) {
                            $result = array("status" => "success", "message" => "Login Successfully", "name" => $row['userName'], "email" => $row['userEmail'], "apiKey" => $apiKey);
                        } else {
                            $result = array("status" => "failed", "message" => "Login Failed, Try Again");
                        }
                    } else {
                        $result = array("status" => "failed", "message" => "Retry with Correct Email & Password");
                    }
                } else {
                    $result = array("status" => "failed", "message" => "Retry with Correct Email & Password");
                }
            } else {
                $result = array("status" => "failed", "message" => "Email is not registered");
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