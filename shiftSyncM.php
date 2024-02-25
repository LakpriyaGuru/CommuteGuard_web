<?php

require_once 'connection.php';

$result = array();

if ($conn) {
    $sql = "SELECT s.childID, c.childName, sc.schoolName FROM shift s INNER JOIN child c ON s.childID = c.childID INNER JOIN school sc ON c.schoolID = sc.schoolID where shiftMorning = 'true'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $childNames = array();
        $schoolNames = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $childNames[] = $row['childName'];
            $schoolNames[] = $row['schoolName'];
        }
        $result = array("status" => "success", "message" => "Child and School Names Fetched Successfully", "childNames" => $childNames, "schoolNames" => $schoolNames);
    } else {
        $result = array("status" => "failed", "message" => "No Children for Morning Shift");
    }
} else {
    $result = array("status" => "failed", "message" => "Database Connection Failed");
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>