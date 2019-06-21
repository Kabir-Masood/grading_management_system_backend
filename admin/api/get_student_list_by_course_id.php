<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['course_id'])) {

    // receiving the post params
    $id = $_POST['course_id'];

    $students = $db->getStudentListByCourseId($id);

    if ($students != null) {
        $response["error"] = FALSE;
        $response["students"] = $students;
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["message"] = "No students found. ";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["message"] = "Required parameters is missing!";
    echo json_encode($response);
}

?>