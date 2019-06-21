<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['id']) && isset($_POST['semester_id'])) {

    // receiving the post params
    $id = $_POST['id'];
    $semester_id = $_POST['semester_id'];

    $courses = $db->getCourseByStudentId($id, $semester_id);

    if ($courses != null) {
        $response["error"] = FALSE;
        $response["courses"] = $courses;
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["message"] = "No course found. ";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["message"] = "Required parameters is missing!";
    echo json_encode($response);
}
?>