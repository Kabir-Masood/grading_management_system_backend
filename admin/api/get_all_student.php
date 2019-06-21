<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

$student = $db->getAllStudent();

if ($student != null) {
    $response["error"] = FALSE;
    $response["students"] = $student;
    echo json_encode($response);
} else {
    // user is not found with the credentials
    $response["error"] = TRUE;
    $response["message"] = "No Student found. ";
    echo json_encode($response);
}

?>