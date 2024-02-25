<?php

require_once 'connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$nic = $_POST['nic']; // Assuming this comes from the form
$address = $_POST['address']; // Assuming this comes from the form
$contact = $_POST['contact']; // Assuming this comes from the form
$result = array();

// Function to check if a contact number has exactly 10 digits
function isValidContact($contact)
{
    return preg_match('/^\d{10}$/', $contact);
}

// Function to check if an email is already registered
function isEmailRegistered($conn, $email)
{
    $query = "SELECT COUNT(*) as count FROM user WHERE userEmail = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}

// Function to check if the NIC has between 9 and 12 characters
function isValidNIC($nic)
{
    return strlen($nic) == 9 || strlen($nic) == 12;
}

// Function to validate email format
function isValidEmailFormat($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if (!empty($name) && !empty($email) && !empty($nic) && !empty($address) && !empty($contact) && !empty($_POST['password'])) {
    if ($conn) {
        if (!isValidEmailFormat($email)) {
            $result = array("status" => "failed", "message" => "Invalid email format");
        } elseif (isEmailRegistered($conn, $email)) {
            $result = array("status" => "failed", "message" => "Email is already registered");
        } elseif (!isValidNIC($nic)) {
            $result = array("status" => "failed", "message" => "NIC must have 9 or 12 digits");
        } elseif (!isValidContact($contact)) {
            $result = array("status" => "failed", "message" => "Contact number must have exactly 10 digits");
        } else {
            $sql = "INSERT INTO user (userName, userEmail, userPassword, userNIC, userAddress, userContact) VALUES ('" . $name . "', '" . $email . "', '" . $password . "', '" . $nic . "', '" . $address . "', '" . $contact . "')";
            if (mysqli_query($conn, $sql)) {
                $result = array("status" => "success", "message" => "Fill your Child Details here!");
            } else {
                $result = array("status" => "failed", "message" => "Registration Failed, Try Again");
            }
        }
    } else {
        $result = array("status" => "failed", "message" => "Database Connection Failed");
    }
} else {
    $result = array("status" => "failed", "message" => "All fields are Required");
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>