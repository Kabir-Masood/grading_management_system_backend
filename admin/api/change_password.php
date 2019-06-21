<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['user_id']) && isset($_POST['old_password']) && isset($_POST['new_password'])) {

    // receiving the post params
    $user_id = $_POST['user_id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    $user = $db->getUserByAndPassword($user_id, $old_password);

    if ($user != false) {
        // user is found
        if(strlen($user_id) >= 10){
            $status = $db->changeStudentPassword($user_id, $old_password, $new_password);

            if($status){
                $response["error"] = FALSE;
                $response["message"] = "Password successfully changed.";
            }else{
                $response["error"] = TRUE;
                $response["message"] = "Operation failed. Please try again.";
            }
        }else if(strlen($user_id) <= 6){
            $status = $db->changeTeacherPassword($user_id, $old_password, $new_password);

            if($status){
                $response["error"] = FALSE;
                $response["message"] = "Password successfully changed.";
            }else{
                $response["error"] = TRUE;
                $response["message"] = "Operation failed. Please try again with valid information.";
            }
        }

        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["message"] = "User not found. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["message"] = "Required parameters is missing!";
    echo json_encode($response);
}
?>