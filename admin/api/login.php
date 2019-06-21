<?php
require_once 'DB_Functions.php';

$db = new DB_Functions();
$db_connect = new DB_Connect();

$conn = $db_connect->connect();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['user_id']) && isset($_POST['password']) && isset($_POST['user_type'])) {

    // receiving the post params
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // get the user by email and password

    if ($user_type === "student") {
        $user = $db->getStudentByIdAndPassword($user_id, $password);
        $semester_id = get_last_semester($conn);
    } else if ($user_type === "teacher") {
        $user = $db->getTeacherByIdAndPassword($user_id, $password);
    }

    if ($user != false) {
        // user is found
        if ($user_type === "student") {
            $response["error"] = FALSE;
            $response["id"] = $user["id"];
            $response["user"]["full_name"] = $user["full_name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["user_id"] = $user["user_id"];
            $response["user"]["mobile"] = $user["mobile"];
            $response["user"]["batch"] = $user["batch_id"];
            $response["user"]["semester_id"] = $semester_id["id"];
            $response["user"]["semester_name"] = $semester_id["semester_name"];
            $response["user"]["dept_id"] = $user["dept_id"];
            $response["user"]["user_type"] = "student";

        } else if ($user_type === "teacher") {
            $response["error"] = FALSE;
            $response["id"] = $user["id"];
            $response["user"]["full_name"] = $user["full_name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["user_id"] = $user["user_id"];
            $response["user"]["mobile"] = $user["mobile"];
            $response["user"]["dept_id"] = $user["dept_id"];
            $response["user"]["user_type"] = "teacher";
        }

        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "User not found. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters is missing!";
    echo json_encode($response);
}

function get_last_semester($conn)
{
    $stmt = $conn->prepare("SELECT * FROM tbl_semester ORDER BY id DESC LIMIT 1");
    if ($stmt->execute()) {
        $semester = $stmt->get_result()->fetch_assoc();
        return $semester;
    } else {
        return NULL;
    }

}

?>