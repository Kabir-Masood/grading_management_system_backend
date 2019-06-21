<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['course_id']) && isset($_POST['teacher_id'])) {

    // receiving the post params
    $course_id = $_POST['course_id'];
    $teacher_id = $_POST['teacher_id'];

    $teachers = $db->getAllStudentResultsForTeacher($course_id, $teacher_id);

    if ($teachers != null) {
        $response["error"] = FALSE;
        $response["data"] = $teachers;
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