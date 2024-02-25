<?php

require_once 'connection.php';

$name = $_POST['name'];
$nic = $_POST['nic']; // Assuming this comes from the form
$address = $_POST['address']; // Assuming this comes from the form
$contact = $_POST['contact']; // Assuming this comes from the form
$email = $_POST['email']; // Assuming this comes from the form
$result = array();

// Function to check if a contact number has exactly 10 digits
function isValidContact($contact)
{
    return preg_match('/^\d{10}$/', $contact);
}

// Function to check if an email is already registered

// Function to check if the NIC has between 9 and 12 characters
function isValidNIC($nic)
{
    return strlen($nic) == 9 || strlen($nic) == 12;
}

// Function to validate email format

if (!empty($name) && !empty($nic) && !empty($address) && !empty($contact)) {
    if ($conn) {
        if (!isValidNIC($nic)) {
            $result = array("status" => "failed", "message" => "NIC must have 9 or 12 digits");
        } elseif (!isValidContact($contact)) {
            $result = array("status" => "failed", "message" => "Contact number must have exactly 10 digits");
        } else {
            $sql = "UPDATE user SET userName = '" . $name . "', userNIC = '" . $nic . "', userAddress = '" . $address . "', userContact = '" . $contact . "' WHERE userEmail = '" . $email . "'";

            if (mysqli_query($conn, $sql)) {
                $result = array("status" => "success", "message" => "Details Updated Successfully!");
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