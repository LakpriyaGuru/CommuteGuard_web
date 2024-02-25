<?php

require_once 'connection.php';

$result = array();

if ($conn) {
    $sql = "SELECT schoolName FROM school";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $schoolNames = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $schoolNames[] = $row['schoolName'];
        }
        $result = array("status" => "success", "message" => "School Names Fetched Successfully", "schoolNames" => $schoolNames);
    } else {
        $result = array("status" => "failed", "message" => "No schools found");
    }
} else {
    $result = array("status" => "failed", "message" => "Database Connection Failed");
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>