<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['student_id']) && isset($_POST['semester_id'])) {

    // receiving the post params
    $student_id = $_POST['student_id'];
    $semester_id = $_POST['semester_id'];

    $results = $db->getStudentAllCourseResultBySemester($student_id, $semester_id);

    if ($results != null) {
        $response["error"] = FALSE;
        $response["data"] = $results;
    } else {
        $response["error"] = TRUE;
        $response["message"] = "No results found. ";
    }

    echo json_encode($response);
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["message"] = "Required parameters is missing!";
    echo json_encode($response);
}
?>