<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();

$response = array("error" => FALSE);

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $semester = $db->getStudentSemester($id);

    if ($semester != null) {
        $response["error"] = FALSE;
        $response["semester"] = $semester;
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